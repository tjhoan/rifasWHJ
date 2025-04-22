<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\NumeroRifa;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = Carrito::with(['rifa', 'numero'])->get();
        return view('carrito', compact('carrito'));
    }

    public function add(Request $request)
    {
        $numero = NumeroRifa::findOrFail($request->id_numero);

        $item = Carrito::where('id_numero', $numero->id)->first();

        if ($item) {
            $item->cantidad += 1;
            $item->save();
        } else {
            Carrito::create([
                'id_rifa' => $numero->id_rifa,
                'id_numero' => $numero->id,
                'cantidad' => 1,
            ]);
        }

        return response()->json(['message' => 'Número agregado al carrito']);
    }

    public function addSelected(Request $request)
    {
        try {
            $selectedNumbers = json_decode($request->input('selected_numbers', '[]'), true);
            $rifaId = $request->input('id_rifa');

            if (!is_array($selectedNumbers)) {
                return redirect()->back()->with('error', 'Los números seleccionados no son válidos.');
            }

            foreach ($selectedNumbers as $numeroId) {
                $numero = NumeroRifa::find($numeroId);

                if (!$numero) {
                    return redirect()->back()->with('error', "El número con ID {$numeroId} no existe.");
                }

                $item = Carrito::where('id_numero', $numero->id)->first();

                if ($item) {
                    $item->cantidad += 1;
                    $item->save();
                } else {
                    Carrito::create([
                        'id_rifa' => $rifaId,
                        'id_numero' => $numero->id,
                        'cantidad' => 1,
                        'fecha_creacion' => now(),
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Números agregados al carrito');
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
