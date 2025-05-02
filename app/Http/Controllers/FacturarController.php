<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Factura;
use App\Models\Cliente;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\FacturaStoreRequest;
use Illuminate\Support\Facades\DB;

class FacturarController extends Controller
{
    public function index()
    {
        return view('facturar');
    }

    public function store(FacturaStoreRequest $request)
    {
        $cliente = $this->getOrCreateCliente();

        $cliente->update([
            'primer_nombre_cliente' => $request->primer_nombre,
            'segundo_nombre_cliente' => $request->segundo_nombre,
            'primer_apellido_cliente' => $request->primer_apellido,
            'segundo_apellido_cliente' => $request->segundo_apellido,
            'correo_cliente' => $request->correo,
            'telefono_cliente' => $request->telefono,
            'cedula' => $request->cedula
        ]);

        $carrito = $cliente->carritos()->where('estado', 'activo')->first();

        if ($carrito) {
            $factura = Factura::create([
                'id_cliente' => $cliente->id_cliente,
                'id_carrito' => $carrito->id_carrito,
                'fecha_compra' => now(),
                'metodo_pago' => $request->metodo_pago,
                'estado' => 'pagado',
                'total' => $this->calculateTotal($carrito),
                'tipo_compra' => $request->tipo_accion,
            ]);

            $carrito->update(['estado' => 'inactivo']);

            $nuevoCarrito = Carrito::create([
                'id_cliente' => $cliente->id_cliente,
                'estado' => 'activo',
            ]);

            $empresa = DB::table('empresa')->first();

            return view('finalizar-recibos', [
                'cliente' => $cliente,
                'carrito' => $carrito,
                'numeros' => $carrito->numeros,
                'factura' => $factura,
                'empresa' => $empresa,
                'tipoAccion' => $request->tipo_accion,
            ]);
        }
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
