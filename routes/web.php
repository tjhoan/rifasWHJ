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