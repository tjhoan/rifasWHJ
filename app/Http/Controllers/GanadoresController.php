<?php

namespace App\Http\Controllers;

use App\Models\Ganador;

class GanadoresController extends Controller
{
    public function index()
    {
        $ganadores = Ganador::with(['rifa.imagenes', 'sorteo'])->get();
        return view('ganadores', compact('ganadores'));
    }
}
