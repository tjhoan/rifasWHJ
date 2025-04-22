<?php

namespace App\Http\Controllers;

use App\Models\Rifa;
use App\Models\NumeroRifa;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
    public function show($id, Request $request)
    {
        $rifa = Rifa::with(['imagenes', 'sorteos'])->findOrFail($id);
        $query = NumeroRifa::where('id_rifa', $id);

        if ($request->has('search') && $request->search !== null) {
            $query->where('numero', 'like', '%' . $request->search . '%');
        }

        $numeros = $query->paginate(22);

        return view('compras', compact('rifa', 'numeros'));
    }

    public function updateNumeroEstado(Request $request)
    {
        // Cambiar el estado de los números seleccionados
        $numeroIds = $request->input('numeros');
        NumeroRifa::whereIn('id', $numeroIds)->update(['estado' => 'comprado']);

        return response()->json(['success' => true]);
    }
}
