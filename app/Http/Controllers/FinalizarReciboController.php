<?php

namespace App\Http\Controllers;

use App\Models\Empresa;

class FinalizarReciboController extends Controller
{
    public function index()
    {
        try {
            $tipoAccion = session('tipoAccion', 'comprar');
            $empresa = Empresa::first();

            if (!$empresa) {
                return redirect()->back()->with('error', 'No se encontró información de la empresa.');
            }

            return view('finalizar-recibos', compact('tipoAccion', 'empresa'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al cargar la página. Por favor, intenta nuevamente.');
        }
    }
}
