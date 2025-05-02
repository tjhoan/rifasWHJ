<?php

use App\Http\Controllers\admin\AdminRifasController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\FacturarController;
use App\Http\Controllers\FinalizarReciboController;
use App\Http\Controllers\GanadoresController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/facturar', [FacturarController::class, 'index'])->name('facturar.index');
Route::post('/facturar', [FacturarController::class, 'store'])->name('facturar.store');

Route::get('/finalizar-recibos', [FinalizarReciboController::class, 'index'])->name('finalizar-recibos');
Route::post('/guardar-datos-empresa', [FinalizarReciboController::class, 'store'])->name('datos-empresa.store');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminRifasController::class, 'index'])->name('admin.dashboard');
    Route::post('/rifas', [AdminRifasController::class, 'store'])->name('admin.rifas.store');
    Route::put('/rifas/{id}', [AdminRifasController::class, 'update'])->name('admin.rifas.update');
    Route::delete('/rifas/{id}', [AdminRifasController::class, 'destroy'])->name('admin.rifas.destroy');

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
