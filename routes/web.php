<?php

use App\Http\Controllers\GanadoresController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// ruta para acceder a la pagina de inicio  
Route::get('/', [HomeController::class, 'index']);

// ruta para acceder a la vista de ganadores 
Route::get('/ganadores', [GanadoresController::class, 'index']);

// ruta para acceder a la vista del carrito de compras 
Route::get('/carrito', function () {
    return view('carrito');
});

// ruta para acceder la vista de comprar los tickets de las rifas 
Route::get('/compras', function () {
    return view('compras');
});

// ruta para ecceder a la vista del proceso de facturacion 
Route::get('/facturar', function () {
    return view('facturar');
});

// ruta para acceder a la vista que generar el tickets 
Route::get('/finalizar-recibos', function () {
    return view('finalizar-recibos');
});

// ruta para acceder a la vista del login del administrador 
Route::get('/login', function () {
    return view('auth.login');
});

// ruta para acceder al panel administrativo 
Route::get('/admin', function() {
    return view('admin.rifas');
});

// vista para acceder a la vista de las ventas 
Route::get('/admin/ventas', function() {
    return view('admin.ventas');
});

// ruta para acceder a la vista de los clientes en el panel administrativo 
Route::get('/admin/clientes', function() {
    return view('admin.clientes');
});

// ruta para acceder a la vista del sorteo para las rifas 
Route::get('/admin/sorteo', function() {
    return view('admin.sorteo');
});

// ruta para acceder a la vista de la configuracion de la empresa 
Route::get('/admin/configuracion', function() {
    return view('admin.configuracion');
});