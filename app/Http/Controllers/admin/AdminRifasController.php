<?php

namespace App\Http\Controllers\admin;

use App\Models\Rifa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminRifasController extends Controller
{
    public function index()
    {
        $rifas = Rifa::withCount(['numeros as reservados_count' => function ($query) {
            $query->where('estado', 'reservado');
        }])->get();

        return view('admin.rifas', compact('rifas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_rifa' => 'required|string|max:255',
            'precio_boleto' => 'required|numeric|min:0',
            'cantidad_boletos' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'fecha_sorteo' => 'required|date|after_or_equal:fecha_inicio',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'premio' => 'required|string|max:255',
            'imagen_rifa' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen_rifa')) {
            $validated['imagen_rifa'] = $request->file('imagen_rifa')->store('rifas', 'public');
        }

        Rifa::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Rifa creada exitosamente.');
    }
    public function update(Request $request, $id)
    {
        $rifa = Rifa::findOrFail($id);

        $validated = $request->validate([
            'nombre_rifa' => 'nullable|string|max:255',
            'precio_boleto' => 'nullable|numeric|min:0',
            'cantidad_boletos' => 'nullable|integer|min:1',
            'fecha_inicio' => 'nullable|date',
            'fecha_sorteo' => 'nullable|date|after_or_equal:fecha_inicio',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'premio' => 'nullable|string|max:255',
            'imagen_rifa' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen_rifa')) {
            if ($rifa->imagen_rifa) {
                Storage::disk('public')->delete($rifa->imagen_rifa);
            }
            $validated['imagen_rifa'] = $request->file('imagen_rifa')->store('rifas', 'public');
        }

        $rifa->update(array_filter($validated));

        return redirect()->route('admin.dashboard')->with('success', 'Rifa actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $rifa = Rifa::findOrFail($id);

        if ($rifa->imagen_rifa) {
            Storage::disk('public')->delete($rifa->imagen_rifa);
        }

        $rifa->delete();

        return response()->json(['success' => true, 'message' => 'Rifa eliminada exitosamente.']);
    }
}
