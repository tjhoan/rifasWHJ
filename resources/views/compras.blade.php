@extends('layouts.app')

@section('title', 'Compras')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/compras.css') }}">
@endpush

@section('content')
<section class="info-section">
    <div class="rifa-image">
        <img src="{{ asset('img/rifa-icon.png') }}" alt="Imagen de la Rifa">
    </div>
    <div class="info-container">
        <div class="left-info">
            <p><strong>Nombre Rifa:</strong></p>
            <label class="option"><input type="checkbox"> Separar</label>
            <label class="option"><input type="checkbox"> Comprar</label>
        </div>
        <div class="right-info">
            <p class="pp"><strong>Fecha inicio:</strong></p>
            <p><strong>Fecha sorteo:</strong></p>
            <p><strong>Premio:</strong></p>
        </div>
    </div>
</section>
<section class="search-section">
    <input type="text" placeholder="Barra de búsqueda números" class="search-bar">
    <button class="search-button">🔍</button>
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
    </div>
</section>
<section class="actions-section">
    <button class="action-button">Añadir al carrito</button>
    <button class="action-button">Facturar</button>
</section>
@endsection