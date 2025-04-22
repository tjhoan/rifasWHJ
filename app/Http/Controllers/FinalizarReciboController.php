<?php

namespace App\Http\Controllers;

use App\Models\DatoEmpresa;
use Illuminate\Http\Request;

class FinalizarReciboController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_empresa' => 'required|string|max:100',
            'nit' => 'required|string|max:20|unique:datos_empresa,NIT',
            'direccion' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'redes_sociales' => 'nullable|string|max:255',
        ]);

        DatoEmpresa::create($validatedData);

        return redirect('/')->with('success', 'Datos de la empresa guardados exitosamente.');
    }
}
