<?php

namespace App\Http\Controllers;

use App\Models\Ganador;

class GanadoresController extends Controller
{
    public function index()
    {
        $ganadores = Ganador::with(['sorteo.rifa', 'cliente'])->get();
        return view('ganadores', compact('ganadores'));
    }
}
