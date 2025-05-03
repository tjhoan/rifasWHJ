<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rifa;
use App\Models\Cliente;
use App\Models\NumerosRifa;

class AdminVentasController extends Controller
{
    public function index()
    {
        $totalRifas = Rifa::count();
        $rifasActivas = Rifa::where('estado', 'activo')->count();
        $totalBoletos = Rifa::sum('cantidad_boletos');
        $boletasVendidas = NumerosRifa::where('estado', 'vendido')->count();
        $porcentajeVendidas = $totalBoletos > 0 ? ($boletasVendidas / $totalBoletos) * 100 : 0;

        $ingresosTotales = NumerosRifa::join('rifas', 'numeros_rifa.id_rifa', '=', 'rifas.id_rifa')
            ->where('numeros_rifa.estado', 'vendido')
            ->sum('rifas.precio_boleto');

        $promedioPorBoleta = $boletasVendidas > 0 ? $ingresosTotales / $boletasVendidas : 0;
        $totalClientes = Cliente::count();
        $promedioBoletasPorCliente = $totalClientes > 0 ? $boletasVendidas / $totalClientes : 0;

        $rifaMasVendida = Rifa::withCount(['numeros as boletos_vendidos' => function ($query) {
            $query->where('estado', 'vendido');
        }])->orderBy('boletos_vendidos', 'desc')->first();

        $clienteMasActivoData = NumerosRifa::selectRaw('id_cliente, COUNT(*) as boletos_comprados')
            ->where('estado', 'vendido')
            ->groupBy('id_cliente')
            ->orderByDesc('boletos_comprados')
            ->first();

        $clienteMasActivo = null;

        if ($clienteMasActivoData && $clienteMasActivoData->id_cliente) {
            $clienteMasActivo = Cliente::find($clienteMasActivoData->id_cliente);
            if ($clienteMasActivo) {
                $clienteMasActivo->boletos_comprados = $clienteMasActivoData->boletos_comprados;
            }
        }

        $rifas = Rifa::withCount([
            'numeros as boletos_vendidos' => function ($query) {
                $query->where('estado', 'vendido');
            },
            'numeros as boletos_reservados' => function ($query) {
                $query->where('estado', 'reservado');
            }
        ])->get();

        return view('admin.ventas', compact(
            'totalRifas',
            'rifasActivas',
            'totalBoletos',
            'boletasVendidas',
            'porcentajeVendidas',
            'ingresosTotales',
            'promedioPorBoleta',
            'totalClientes',
            'promedioBoletasPorCliente',
            'rifaMasVendida',
            'clienteMasActivo',
            'rifas'
        ));
    }
}
