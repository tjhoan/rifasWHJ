<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/ganadores', function () {
    return view('ganadores');
});

Route::get('/carrito', function () {
    return view('carrito');
});

Route::get('/compras', function () {
    return view('compras');
});

Route::get('/facturar', function () {
    return view('facturar');
});

Route::get('/finalizar-recibos', function () {
    return view('finalizar-recibos');
});

Route::get('/login', function () {
    return view('auth.login');

Route::get('/admin', function() {
    return view('admin.rifas');
});