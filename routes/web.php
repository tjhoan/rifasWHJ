<?php

use App\Http\Controllers\admin\AdminClientesController;
use App\Http\Controllers\admin\AdminRifasController;
use App\Http\Controllers\admin\AdminSorteosController;
use App\Http\Controllers\Admin\AdminVentasController;
use App\Http\Controllers\Admin\ConfiguracionController;
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
    Route::post('/rifa/modificar-fecha/{id}', [AdminRifasController::class, 'modificarFecha'])->name('admin.rifa.modificarFecha');

    Route::get('/clientes', [AdminClientesController::class, 'index'])->name('admin.clientes.index');
    Route::put('/clientes/{id}', [AdminClientesController::class, 'update'])->name('admin.clientes.update');
    Route::delete('/clientes/{id}', [AdminClientesController::class, 'destroy'])->name('admin.clientes.destroy');

    Route::get('/sorteo', [AdminSorteosController::class, 'index'])->name('admin.sorteo.index');
    Route::post('/sorteo/sortear', [AdminSorteosController::class, 'sortear'])->name('admin.sorteo.sortear');
    Route::post('/sorteo/modificar-fecha/{id}', [AdminSorteosController::class, 'modificarFecha'])->name('admin.sorteo.modificarFecha');
    Route::post('/sorteo/publicar-ganador', [AdminSorteosController::class, 'publicarGanador'])->name('admin.sorteo.publicarGanador');
    Route::put('/sorteo/{id}/fecha', [AdminSorteosController::class, 'updateFechaSorteo'])->name('admin.sorteo.updateFecha');
    Route::get('/sorteo/{id}/data', [AdminSorteosController::class, 'getSorteoData'])->name('admin.sorteo.data');

    Route::get('/ventas', [AdminVentasController::class, 'index'])->name('admin.ventas.index');

    Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('admin.configuracion.index');
    Route::post('/configuracion/updateEmpresa', [ConfiguracionController::class, 'updateEmpresa'])->name('admin.configuracion.updateEmpresa');
    Route::post('/configuracion/updateMedios', [ConfiguracionController::class, 'updateMedios'])->name('admin.configuracion.updateMedios');
    Route::post('/configuracion/updateAdmin', [ConfiguracionController::class, 'updateAdmin'])->name('admin.configuracion.updateAdmin');
    Route::post('/configuracion/addMetodoPago', [ConfiguracionController::class, 'addMetodoPago'])->name('admin.configuracion.addMetodoPago');
});
