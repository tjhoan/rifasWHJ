<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $rifas = DB::table('rifas')
            ->leftJoin('imagen_rifa', 'rifas.id_rifa', '=', 'imagen_rifa.id_rifa')
            ->select('rifas.*', 'imagen_rifa.ruta_imagen')
            ->get();

        return view('home', compact('rifas'));
    }
}
