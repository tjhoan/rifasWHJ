<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\CarritoNumero;
use App\Models\Sorteo;
use App\Models\Rifa;
use App\Models\Ganador;
use App\Models\NumerosRifa;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminSorteosController extends Controller
{
    public function index()
    {
        try {
            $sorteos = Sorteo::with('rifa')->whereIn('estado', ['sin_reclamo', 'sin_ganador'])->get();
            $rifas = Rifa::where('estado', 'activo')->get();

            $ultimoSorteo = Sorteo::with(['rifa', 'ganador.cliente'])
                ->where('estado', 'realizado')
                ->latest('fecha_sorteo')
                ->first();

            return view('admin.sorteo', compact('sorteos', 'rifas', 'ultimoSorteo'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al cargar los sorteos: ' . $e->getMessage()]);
        }
    }

    public function sortear(Request $request)
    {
        $request->validate([
            'id_sorteo' => 'required|exists:sorteos,id_sorteo',
        ]);

        try {
            DB::beginTransaction();

            $sorteo = Sorteo::with('rifa')->findOrFail($request->id_sorteo);
            $cantidadBoletos = $sorteo->rifa->cantidad_boletos;

            $existeNumeroGanador = NumerosRifa::where('id_rifa', $sorteo->id_rifa)
                ->whereNotNull('id_cliente')
                ->exists();

            if (!$existeNumeroGanador) {
                return response()->json([
                    'error' => 'No hay números asociados a un cliente para este sorteo.',
                ], 400);
            }

            $intentos = 0;
            $maxIntentos = 100;
            $numeroGanador = null;
            $numeroRifa = null;

            do {
                $numeroGanador = rand(1, $cantidadBoletos);

                $numeroRifa = NumerosRifa::where('id_rifa', $sorteo->id_rifa)
                    ->where('numero', $numeroGanador)
                    ->first();

                $intentos++;

                if ($intentos >= $maxIntentos) {
                    DB::rollBack();
                    return response()->json([
                        'error' => 'No se pudo determinar un ganador después de 100 intentos.',
                    ], 500);
                }
            } while (!$numeroRifa || !$numeroRifa->id_cliente);

            $clienteGanador = Cliente::findOrFail($numeroRifa->id_cliente);

            $sorteo->update([
                'ganador_id_cliente' => $clienteGanador->id_cliente,
                'numero_ganador' => $numeroGanador,
                'estado' => 'realizado',
            ]);

            Ganador::create([
                'id_sorteo' => $sorteo->id_sorteo,
                'id_cliente' => $clienteGanador->id_cliente,
                'estado' => 'activo',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'ganador' => [
                    'primer_nombre' => $clienteGanador->primer_nombre_cliente,
                    'segundo_nombre' => $clienteGanador->segundo_nombre_cliente,
                    'primer_apellido' => $clienteGanador->primer_apellido_cliente,
                    'segundo_apellido' => $clienteGanador->segundo_apellido_cliente,
                    'numero_ganador' => $numeroGanador,
                    'nombre_rifa' => $sorteo->rifa->nombre_rifa,
                    'fecha_inicio' => $sorteo->rifa->fecha_inicio,
                    'fecha_sorteo' => $sorteo->fecha_sorteo,
                    'premio' => $sorteo->rifa->premio,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error al realizar el sorteo: ' . $e->getMessage(),
            ], 500);
        }
    }
}
