@extends('layouts.app')

@section('title', 'Compras')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/compras.css') }}">
@endpush

@section('content')
<section class="info-section">
    <div class="rifa-image">
        <img src="{{ asset('https://cdn.clarosports.com/clarosports/2024/06/balotook12-071239-1024x576.jpg') }}" alt="Imagen de la Rifa">
    </div>
    <div class="info-container">
        <div class="left-info">
            <p><strong>Nombre Rifa:</strong> Baloto</p>
            <label class="option"><input type="checkbox"> Separar</label>
            <label class="option"><input type="checkbox"> Comprar</label>
        </div>
        <div class="right-info">
            <p class="pp"><strong>Fecha inicio:</strong> 01/04/2025</p>
            <p><strong>Fecha sorteo:</strong> 30/04/2025</p>
            <p><strong>Premio:</strong> $1.2000.000</p>
        </div>
    </div>
</section>
<section class="search-section">
    <input type="text" placeholder="Barra de búsqueda números" class="search-bar">
    <button class="search-button"><i class="fas fa-search"></i></button>
</section>
<section class="numbers-section">
    <div class="numbers-grid">
        <button class="number">2345</button>
        <button class="number">2345</button>
        <button class="number selected">2345</button>
        <button class="number">2345</button>
        <button class="number">2345</button>
        <button class="number">2345</button>
        <button class="number">2345</button>
        <button class="number selected">2345</button>
        <button class="number">2345</button>
        <button class="number">2345</button>
        <button class="number">2345</button>
        <button class="number">2345</button>
        <button class="number">2345</button>
    </div>
</section>
<section class="actions-section">
    <button class="action-button">Añadir al carrito</button>
    <button class="action-button" onclick="window.location.href='/facturar'">Facturar</button>
</section>
@endsection