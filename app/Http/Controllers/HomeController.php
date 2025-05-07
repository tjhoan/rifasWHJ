<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        try {
            session()->forget(['total', 'tipoAccion']);

            $rifas = DB::table('rifas')
                ->select('rifas.id_rifa', 'rifas.nombre_rifa', 'rifas.imagen_rifa', 'rifas.precio_boleto', 'rifas.cantidad_boletos', 'rifas.fecha_inicio', 'rifas.fecha_sorteo', 'rifas.premio', 'rifas.estado')
                ->whereNotIn('estado', ['inactivo'])
                ->get();

            return view('home', compact('rifas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al cargar las rifas. Por favor, intenta nuevamente.');
        }
    }
}
