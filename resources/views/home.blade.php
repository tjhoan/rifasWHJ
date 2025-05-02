@extends('layouts.app')

@section('title', 'Gestión de Rifas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<h1>Compras De Rifas</h1>
<section class="rifas-container">
    @foreach ($rifas as $rifa)
    <div class="rifa-card">
        <img alt="Rifa" src="{{ $rifa->imagen_rifa }}">
        <div class="info">
            <div class="left">
                <p><strong>Nombre:</strong> {{ $rifa->nombre_rifa }}</p>
                <p><strong>Cantidad de boletos:</strong> {{ $rifa->cantidad_boletos }}</p>
                <p><strong>Precio por boleto:</strong> ${{ number_format($rifa->precio_boleto, 2, ',', '.') }}</p>
            </div>
            <div class="right">
                <p><strong>Fecha inicio:</strong> {{ \Carbon\Carbon::parse($rifa->fecha_inicio)->format('d/m/Y') }}</p>
                <p><strong>Fecha sorteo:</strong> {{ \Carbon\Carbon::parse($rifa->fecha_sorteo)->format('d/m/Y') }}</p>
                <p><strong>Premio:</strong> {{ $rifa->premio }}</p>
            </div>
        </div>
        <a href="{{ route('compras.show', $rifa->id_rifa) }}" class="comprar-btn">Comprar</a>
    </div>
    @endforeach
</section>
@endsection