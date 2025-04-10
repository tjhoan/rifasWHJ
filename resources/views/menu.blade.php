@extends('layouts.app')

@section('title', 'Gestión de Rifas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos_menu.css') }}">
@endpush

@section('content')
<h1>Compras De Rifas</h1>
<main>
    <section class="rifas-container">
        <div class="rifa-card">
            <img src="{{ asset('img/rifa-icon.png') }}" alt="Rifa">
            <div class="info">
                <p><strong>Nombre:</strong> Rifa Ejemplo</p>
                <p><strong>Cantidad vendida:</strong> 50</p>
                <p><strong>Precio:</strong> $10</p>
                <p><strong>Fecha inicio:</strong> 01/04/2025</p>
                <p><strong>Fecha sorteo:</strong> 30/04/2025</p>
                <p><strong>Premio:</strong> Laptop Gamer</p>
            </div>
            <button class="comprar-btn">Comprar</button>
        </div>

        <div class="rifa-card">
            <img src="{{ asset('img/rifa-icon.png') }}" alt="Rifa">
            <div class="info">
                <p><strong>Nombre:</strong> Rifa Especial</p>
                <p><strong>Cantidad vendida:</strong> 30</p>
                <p><strong>Precio:</strong> $5</p>
                <p><strong>Fecha inicio:</strong> 05/04/2025</p>
                <p><strong>Fecha sorteo:</strong> 25/04/2025</p>
                <p><strong>Premio:</strong> Smartphone</p>
            </div>
            <button class="comprar-btn">Comprar</button>
        </div>
    </section>
</main>
@endsection