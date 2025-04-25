<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\NumeroRifa;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = Carrito::with(['rifa', 'numero'])->where('estado', 'activo')->get();
        return view('carrito', compact('carrito'));
    }

    public function addSelected(Request $request)
    {
        try {
            $selectedNumbers = json_decode($request->input('selected_numbers', '[]'), true);
            $rifaId = $request->input('id_rifa');

            foreach ($selectedNumbers as $numeroId) {
                $numero = NumeroRifa::find($numeroId);
                $item = Carrito::where('id_numero', $numero->id)->first();

                if ($item) {
                    $item->save();
                } else {
                    Carrito::create([
                        'id_rifa' => $rifaId,
                        'id_numero' => $numero->id,
                        'fecha_creacion' => now(),
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Números agregados al carrito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function finalizar(Request $request)
    {
        try {
            $carrito = Carrito::with(['rifa', 'numero', 'rifa.imagenes'])->where('estado', 'activo')->get();

            if ($carrito->isEmpty()) {
                $carrito = session('carrito', collect());
                $total = session('total', 0);
                $tipoAccion = session('tipoAccion', 'separar');
            }

            $cliente = session('cliente');
            $tipoAccion = $request->input('tipo_accion', 'separar');

            $total = $carrito->sum(function ($item) {
                $precio = is_numeric($item->rifa->precio) ? (float) $item->rifa->precio : 0;
                return $precio;
            });

            session(['carrito' => $carrito, 'total' => $total, 'tipoAccion' => $tipoAccion]);

            if ($carrito->isEmpty()) {
                return view('finalizar-recibos', [
                    'carrito' => $carrito,
                    'cliente' => $cliente,
                    'total' => $total,
                ])->with('warning', 'El carrito está vacío.');
            }

            return view('finalizar-recibos', [
                'carrito' => $carrito,
                'cliente' => $cliente,
                'total' => (float) $total,
                'tipoAccion' => $tipoAccion
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function remove(Request $request)
    {
        $item = Carrito::findOrFail($request->id_carrito);
        $item->delete();

        return redirect()->back()->with('success', 'Número eliminado del carrito');
    }

    public function clear()
    {
        Carrito::truncate();
        return redirect()->back()->with('success', 'Carrito vaciado');
    }
}
