<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sorteo;
use App\Models\Rifa;
use App\Models\Ganador;
use App\Models\NumerosRifa;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSorteosController extends Controller
{
    public function index()
    {
        try {
            $sorteos = Sorteo::with(['rifa', 'ganador.cliente'])->whereIn('estado', ['sin_ganador', 'sin_reclamo'])->get();
            $rifas = Rifa::where('estado', 'activo')->get();

            return view('admin.sorteo', compact('sorteos', 'rifas'));
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

            $fechaActual = now()->toDateString();
            if ($sorteo->fecha_sorteo <= $fechaActual) {
                return response()->json([
                    'success' => false,
                    'message' => 'La fecha del sorteo debe ser mayor a la fecha actual.',
                ], 400);
            }

            $cantidadBoletos = $sorteo->rifa->cantidad_boletos;

            $existeNumeroGanador = NumerosRifa::where('id_rifa', $sorteo->id_rifa)
                ->whereNotNull('id_cliente')
                ->exists();

            if (!$existeNumeroGanador) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay números asociados a un cliente para este sorteo.',
                    'fecha_sorteo' => $sorteo->fecha_sorteo
                ], 400);
            }

            $intentos = 0;
            $maxIntentos = 1;
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
                        'success' => false,
                        'message' => 'No se pudo determinar un ganador. Por favor, modifique la fecha del sorteo.',
                        'fecha_sorteo' => $sorteo->fecha_sorteo
                    ]);
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

            $sorteo->rifa->update(['estado' => 'inactivo']);

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

    public function modificarFecha(Request $request, $id)
    {
        $request->validate([
            'fecha_sorteo' => 'required|date|after:today',
        ]);

        try {
            $sorteo = Sorteo::findOrFail($id);

            if ($request->fecha_sorteo <= now()->toDateString()) {
                return response()->json([
                    'success' => false,
                    'message' => 'La fecha del sorteo debe ser mayor a la fecha actual.',
                ], 400);
            }

            $sorteo->update(['fecha_sorteo' => $request->fecha_sorteo]);

            $rifa = Rifa::findOrFail($sorteo->id_rifa);
            $rifa->update(['fecha_sorteo' => $request->fecha_sorteo]);

            return response()->json([
                'success' => true,
                'message' => 'Fecha del sorteo actualizada correctamente.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la fecha del sorteo.',
            ], 500);
        }
    }

    public function getSorteoData($id)
    {
        try {
            $sorteo = Sorteo::with(['rifa', 'ganador.cliente'])->findOrFail($id);

            $data = [
                'id_sorteo' => $sorteo->id_sorteo,
                'nombre_rifa' => $sorteo->rifa->nombre_rifa,
                'fecha_sorteo' => $sorteo->fecha_sorteo,
                'premio' => $sorteo->rifa->premio,
                'ganador' => $sorteo->ganador ? [
                    'primer_nombre' => $sorteo->ganador->cliente->primer_nombre_cliente,
                    'segundo_nombre' => $sorteo->ganador->cliente->segundo_nombre_cliente,
                    'primer_apellido' => $sorteo->ganador->cliente->primer_apellido_cliente,
                    'segundo_apellido' => $sorteo->ganador->cliente->segundo_apellido_cliente,
                    'numero_ganador' => $sorteo->numero_ganador,
                ] : null,
            ];

            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al obtener los datos del sorteo.'], 500);
        }
    }
}
