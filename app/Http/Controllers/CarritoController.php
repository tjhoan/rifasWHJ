<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\CarritoNumero;
use App\Models\Cliente;
use App\Models\NumerosRifa;

class CarritoController extends Controller
{
    public function index()
    {
        try {
            $cliente = $this->getOrCreateCliente();
            $carrito = $cliente->carritos()->where('estado', 'activo')->first();

            if ($carrito) {
                $carrito->load('numeros');
            } else {
                $carrito = [];
            }

            return view('carrito', compact('carrito'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Hubo un problema al cargar el carrito. Por favor, intenta nuevamente.'], 500);
        }
    }

    public function addSelected(Request $request)
    {
        try {
            $cliente = $this->getOrCreateCliente();
            $carrito = $cliente->carritos()->where('estado', 'activo')->first();

            if (!$carrito) {
                $carrito = Carrito::create([
                    'id_cliente' => $cliente->id_cliente,
                    'estado' => 'activo',
                ]);
            }

            $selectedNumbers = json_decode($request->selected_numbers);

            DB::transaction(function () use ($selectedNumbers, $carrito) {
                foreach ($selectedNumbers as $numberId) {
                    $numero = NumerosRifa::find($numberId);

                    if ($numero && $numero->estado == 'disponible') {
                        $numero->update(['estado' => 'reservado']);

                        CarritoNumero::create([
                            'id_carrito' => $carrito->id_carrito,
                            'id_numero' => $numero->id_numero,
                        ]);
                    }
                }
            });

            return redirect()->route('carrito.index');
        } catch (\Exception $e) {
            return redirect()->route('carrito.index')->with('error', 'Hubo un problema al agregar los números al carrito. Por favor, intenta nuevamente.');
        }
    }

    public function remove(Request $request)
    {
        try {
            $carrito = Carrito::find($request->id_carrito);
            $numero = NumerosRifa::find($request->id_numero);

            if ($carrito && $numero) {
                $carrito->numeros()->detach($numero->id_numero);
                $numero->update(['estado' => 'disponible']);

                return redirect()->route('carrito.index')->with('success', 'Número eliminado del carrito correctamente.');
            } else {
                return redirect()->route('carrito.index')->with('error', 'Número o carrito no encontrado.');
            }
        } catch (\Exception $e) {
            return redirect()->route('carrito.index')->with('error', 'Hubo un problema al eliminar el número del carrito. Por favor, intenta nuevamente.');
        }
    }

    public function clear(Request $request)
    {
        try {
            $carrito = Carrito::find($request->id_carrito);

            if ($carrito) {
                foreach ($carrito->numeros as $numero) {
                    $numero->update(['estado' => 'disponible']);
                }

                $carrito->numeros()->detach();

                return redirect()->route('carrito.index')->with('success', 'El carrito ha sido vaciado correctamente.');
            } else {
                return response()->json(['error' => 'Carrito no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return redirect()->route('carrito.index')->with('error', 'Hubo un problema al vaciar el carrito. Por favor, intenta nuevamente.');
        }
    }

    private function getOrCreateCliente()
    {
        try {
            if (!Session::has('cliente_id')) {
                $uniqueEmail = 'temporal_' . uniqid() . '@correo.com';

                $cliente = Cliente::create([
                    'primer_nombre_cliente' => 'Cliente',
                    'segundo_nombre_cliente' => 'Temporal',
                    'primer_apellido_cliente' => '',
                    'segundo_apellido_cliente' => '',
                    'estado' => 'activo',
                    'correo_cliente' => $uniqueEmail,
                    'telefono_cliente' => '0000000000',
                    'cedula' => '00000000',
                ]);

                Session::put('cliente_id', $cliente->id_cliente);
            } else {
                $cliente = Cliente::find(Session::get('cliente_id'));
            }

            return $cliente;
        } catch (\Exception $e) {
            throw new \Exception('Hubo un problema al gestionar el cliente.');
        }
    }
}
