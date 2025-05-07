<?php

namespace App\Http\Controllers;

class FinalizarReciboController extends Controller
{
    public function index()
    {
        try {
            return view('finalizar-recibos');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al cargar la página. Por favor, intenta nuevamente.');
        }
    }
}
