<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class FacturarController extends Controller
{
    public function index()
    {
        return view('facturar');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cedula' => 'required|string|max:20|unique:clientes,cedula',
            'primer_nombre' => 'required|string|max:50',
            'segundo_nombre' => 'nullable|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'segundo_apellido' => 'nullable|string|max:50',
            'correo' => 'required|email|max:100|unique:clientes,correo',
            'celular' => 'nullable|string|max:20',
        ]);

        Cliente::create($validatedData);

        session(['cliente' => $validatedData]);

        return redirect()->route('finalizar-recibos')->with('success', 'Datos del cliente guardados correctamente.');
    }
}
