<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        session()->forget(['total', 'tipoAccion']);

        $rifas = DB::table('rifas')
            ->select('rifas.id_rifa', 'rifas.nombre_rifa', 'rifas.imagen_rifa', 'rifas.precio_boleto', 'rifas.cantidad_boletos', 'rifas.fecha_inicio', 'rifas.fecha_sorteo', 'rifas.premio', 'rifas.estado')
            ->get();

        return view('home', compact('rifas'));
    }
}
