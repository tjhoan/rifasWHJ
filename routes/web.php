<?php

use App\Http\Controllers\ComprasController;
use App\Http\Controllers\GanadoresController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/ganadores', [GanadoresController::class, 'index']);
Route::get('/compras/{id}', [ComprasController::class, 'show'])->name('compras.show');

Route::prefix('carrito')->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/add', [CarritoController::class, 'add'])->name('carrito.add');
    Route::post('/add-selected', [CarritoController::class, 'addSelected'])->name('carrito.addSelected');
    Route::post('/remove', [CarritoController::class, 'remove'])->name('carrito.remove');
    Route::post('/clear', [CarritoController::class, 'clear'])->name('carrito.clear');
});

Route::get('/facturar', function () {
    return view('facturar');
});

Route::get('/finalizar-recibos', function () {
    return view('finalizar-recibos');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.rifas');
    });

    Route::get('/ventas', function () {
        return view('admin.ventas');
    });

    Route::get('/clientes', function () {
        return view('admin.clientes');
    });

    Route::get('/sorteo', function () {
        return view('admin.sorteo');
    });

    Route::get('/configuracion', function () {
        return view('admin.configuracion');
    });
});
