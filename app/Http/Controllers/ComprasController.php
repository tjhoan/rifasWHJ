<?php

namespace App\Http\Controllers;

use App\Models\Rifa;
use App\Models\NumerosRifa;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
    public function show($id, Request $request)
    {
        $rifa = Rifa::with(['sorteos'])->findOrFail($id);
        $query = NumerosRifa::where('id_rifa', $id);

        if ($request->has('search') && $request->search !== null) {
            $query->where('numero', 'like', '%' . $request->search . '%');
        }

        $numeros = $query->paginate(22);

        return view('compras', compact('rifa', 'numeros'));
    }
}
