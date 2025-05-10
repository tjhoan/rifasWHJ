<?php

namespace App\Http\Controllers\admin;

use App\Models\Rifa;
use App\Models\Sorteo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminRifasController extends Controller
{
    public function index()
    {
        try {
            $rifas = Rifa::where('estado', 'activo')
                ->withCount(['numeros as reservados_count' => function ($query) {
                    $query->where('estado', 'reservado');
                }])
                ->get();

            $hayRifas = $rifas->isNotEmpty();

            return view('admin.rifas', compact('rifas', 'hayRifas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al cargar las rifas. Por favor, intenta nuevamente.');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validateRifa($request);

            if ($request->hasFile('imagen_rifa')) {
                $validated['imagen_rifa'] = $request->file('imagen_rifa')->store('rifas', 'public');
            }

            $rifa = Rifa::create($validated);
            $this->generateNumeros($rifa->id_rifa, $validated['cantidad_boletos']);

            Sorteo::create([
                'id_rifa' => $rifa->id_rifa,
                'fecha_sorteo' => $validated['fecha_sorteo'],
                'estado' => 'sin_ganador',
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'La rifa ha sido creada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al crear la rifa. Por favor, intenta nuevamente.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $rifa = Rifa::findOrFail($id);
            $validated = $this->validateRifa($request, false);

            if ($request->hasFile('imagen_rifa')) {
                $this->deleteImage($rifa->imagen_rifa);
                $validated['imagen_rifa'] = $request->file('imagen_rifa')->store('rifas', 'public');
            }

            if (isset($validated['cantidad_boletos'])) {
                $this->updateNumeros($rifa->id_rifa, $validated['cantidad_boletos']);
            }

            $rifa->update(array_filter($validated));

            return redirect()->route('admin.dashboard')->with('success', 'La rifa ha sido modificada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al modificar la rifa. Por favor, intenta nuevamente.');
        }
    }

    public function destroy($id)
    {
        try {
            $rifa = Rifa::findOrFail($id);
            $this->deleteImage($rifa->imagen_rifa);

            $rifa->update(['estado' => 'inactivo']);
            DB::table('numeros_rifa')->where('id_rifa', $id)->delete();

            $sorteos = Sorteo::where('id_rifa', $id)->get();
            foreach ($sorteos as $sorteo) {
                $sorteo->update(['estado' => 'anulado']);
            }

            return response()->json([
                'success' => true,
                'message' => 'La rifa ha sido eliminada correctamente.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un problema al eliminar la rifa. Por favor, intenta nuevamente.',
            ], 500);
        }
    }

    public function modificarFecha(Request $request, $id)
    {
        $request->validate([
            'fecha_sorteo' => 'required|date|after:today',
        ]);

        try {
            $rifa = Rifa::findOrFail($id);
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

    private function validateRifa(Request $request, $isCreate = true)
    {
        $rules = [
            'nombre_rifa' => 'required|string|max:255',
            'precio_boleto' => 'required|numeric|min:0',
            'cantidad_boletos' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'fecha_sorteo' => 'required|date|after_or_equal:fecha_inicio',
            'premio' => 'required|string|max:255',
            'imagen_rifa' => 'nullable|image|max:2048'
        ];

        if (!$isCreate) {
            $rules = array_map(fn($rule) => str_replace('required', 'nullable', $rule), $rules);
        }

        return $request->validate($rules);
    }

    private function generateNumeros($rifaId, $cantidad)
    {
        $numeros = [];
        $chunkSize = 200;

        try {
            for ($i = 1; $i <= $cantidad; $i++) {
                $numeros[] = [
                    'id_rifa' => $rifaId,
                    'numero' => $i,
                    'estado' => 'disponible',
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                if (count($numeros) === $chunkSize) {
                    DB::table('numeros_rifa')->insert($numeros);
                    $numeros = [];
                }
            }

            if (!empty($numeros)) {
                DB::table('numeros_rifa')->insert($numeros);
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function updateNumeros($rifaId, $cantidadNueva)
    {
        $cantidadActual = DB::table('numeros_rifa')->where('id_rifa', $rifaId)->count();

        if ($cantidadNueva > $cantidadActual) {
            $this->generateNumeros($rifaId, $cantidadNueva - $cantidadActual);
        } elseif ($cantidadNueva < $cantidadActual) {
            $numerosAEliminar = DB::table('numeros_rifa')
                ->where('id_rifa', $rifaId)
                ->where('numero', '>', $cantidadNueva)
                ->get();

            foreach ($numerosAEliminar as $numero) {
                if ($numero->estado !== 'disponible') {
                    throw new \Exception('No se pueden eliminar números que no estén en estado "disponible".');
                }
            }

            DB::table('numeros_rifa')
                ->where('id_rifa', $rifaId)
                ->where('numero', '>', $cantidadNueva)
                ->delete();
        }
    }

    private function deleteImage($imagePath)
    {
        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
