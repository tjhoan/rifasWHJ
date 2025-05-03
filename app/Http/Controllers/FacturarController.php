<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Factura;
use App\Models\Cliente;
use App\Models\MetodoPago;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\FacturaStoreRequest;
use Illuminate\Support\Facades\DB;
use App\Mail\FacturaMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Asegúrate de importar Log

class FacturarController extends Controller
{
    public function index()
    {
        $metodoPago = MetodoPago::where('estado', 'activo')->get();

        return view('facturar', compact('metodoPago'));
    }

    public function store(FacturaStoreRequest $request)
    {
        Log::info('Iniciando el proceso de facturación.');

        $cliente = $this->getOrCreateCliente();
        Log::info('Cliente obtenido o creado.', ['cliente_id' => $cliente->id_cliente]);

        $cliente->update([
            'primer_nombre_cliente' => $request->primer_nombre,
            'segundo_nombre_cliente' => $request->segundo_nombre,
            'primer_apellido_cliente' => $request->primer_apellido,
            'segundo_apellido_cliente' => $request->segundo_apellido,
            'correo_cliente' => $request->correo,
            'telefono_cliente' => $request->telefono,
            'cedula' => $request->cedula
        ]);
        Log::info('Cliente actualizado.', ['cliente' => $cliente]);

        $carrito = $cliente->carritos()->where('estado', 'activo')->first();
        if (!$carrito) {
            Log::error('No se encontró un carrito activo para el cliente.', ['cliente_id' => $cliente->id_cliente]);
            return back()->withErrors(['error' => 'No se encontró un carrito activo.']);
        }
        Log::info('Carrito activo encontrado.', ['carrito_id' => $carrito->id_carrito]);

        $factura = Factura::create([
            'id_cliente' => $cliente->id_cliente,
            'id_carrito' => $carrito->id_carrito,
            'fecha_compra' => now(),
            'metodo_pago' => $request->metodo_pago,
            'estado' => 'pagado',
            'total' => $this->calculateTotal($carrito),
            'tipo_compra' => $request->tipo_accion,
        ]);
        Log::info('Factura creada.', ['factura_id' => $factura->id_factura]);

        $carrito->update(['estado' => 'inactivo']);
        Log::info('Carrito actualizado a inactivo.', ['carrito_id' => $carrito->id_carrito]);

        foreach ($carrito->numeros as $numero) {
            $numero->update(['estado' => 'vendido', 'id_cliente' => $cliente->id_cliente]);
        }
        Log::info('Números del carrito actualizados a vendido.', ['carrito_id' => $carrito->id_carrito]);

        try {
            Mail::to($cliente->correo_cliente)->send(new FacturaMailable($factura, $cliente, $carrito));
            Log::info('Correo enviado exitosamente.', ['correo' => $cliente->correo_cliente]);
        } catch (\Exception $e) {
            Log::error('Error al enviar el correo.', [
                'correo' => $cliente->correo_cliente,
                'error' => $e->getMessage()
            ]);
        }

        $nuevoCarrito = Carrito::create([
            'id_cliente' => $cliente->id_cliente,
            'estado' => 'activo',
        ]);
        Log::info('Nuevo carrito creado.', ['carrito_id' => $nuevoCarrito->id_carrito]);

        $empresa = DB::table('empresa')->first();
        Log::info('Datos de la empresa obtenidos.', ['empresa' => $empresa]);

        return view('finalizar-recibos', [
            'cliente' => $cliente,
            'carrito' => $carrito,
            'numeros' => $carrito->numeros,
            'factura' => $factura,
            'empresa' => $empresa,
            'tipoAccion' => $request->tipo_accion,
        ]);
    }

    private function calculateTotal($carrito)
    {
        $total = 0;
        foreach ($carrito->numeros as $numero) {
            $total += $numero->rifa->precio_boleto;
        }
        return $total;
    }

    private function getOrCreateCliente()
    {
        if (!Session::has('cliente_id')) {
            $cliente = Cliente::create([
                'primer_nombre_cliente' => 'Cliente',
                'segundo_nombre_cliente' => 'Temporal',
                'primer_apellido_cliente' => '',
                'segundo_apellido_cliente' => '',
                'estado' => 'activo',
                'correo_cliente' => 'temporal@correo.com',
                'telefono_cliente' => '0000000000',
                'cedula' => '00000000',
            ]);
            Session::put('cliente_id', $cliente->id_cliente);
        } else {
            $cliente = Cliente::find(Session::get('cliente_id'));
        }

        return $cliente;
    }
}
