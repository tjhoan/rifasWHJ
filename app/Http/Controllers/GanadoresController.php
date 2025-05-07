<?php

namespace App\Http\Controllers;

use App\Models\Ganador;

class GanadoresController extends Controller
{
    public function index()
    {
        try {
            $ganadores = Ganador::with(['sorteo.rifa', 'cliente'])->get();

            return view('ganadores', compact('ganadores'));
        } catch (\Exception $e) {
            return view('ganadores', ['ganadores' => []])
                ->with('error', 'Hubo un problema al cargar la lista de ganadores. Por favor, intenta nuevamente.');
        }
    }
}
