@extends('layouts.app')

@section('title', 'Compras')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/compras.css') }}">
@endpush

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="rifa-id" content="{{ $rifa->id_rifa }}">
<script src="{{ asset('js/compras.js') }}" defer></script>
@endpush

@section('content')

<section class="info-section">
    <div class="rifa-image">
        <img src="{{ $rifa->imagenes->first()->ruta_imagen }}" alt="Imagen de la Rifa">
    </div>
    <div class="info-container">
        <div class="left-info">
            <p><strong>Nombre Rifa:</strong> {{ $rifa->nombre }}</p>
        </div>
        <div class="right-info">
            <p class="pp"><strong>Fecha inicio:</strong> {{ \Carbon\Carbon::parse($rifa->fecha_inicio)->format('d/m/Y') }}</p>
            <p><strong>Fecha sorteo:</strong> {{ \Carbon\Carbon::parse($rifa->fecha_sorteo)->format('d/m/Y') }}</p>
            <p><strong>Premio:</strong> {{ $rifa->premio }}</p>
        </div>
    </div>
</section>
<section class="search-section">
    <form method="GET" action="{{ route('compras.show', $rifa->id_rifa) }}" class="search-content">
        <input type="text" name="search" placeholder="Buscar números..." class="search-bar" value="{{ request('search') }}">
        <button type="submit" class="search-button">
            <i class="fas fa-search"></i>
        </button>
    </form>
</section>
<section class="numbers-section">
    <div class="numbers-grid">
        @foreach ($numeros as $numero)
        <button class="number {{ $numero->estado == 'comprado' ? 'comprado' : '' }}" data-id="{{ $numero->id }}">
            {{ $numero->numero }}
        </button>
        @endforeach

        @for ($i = $numeros->count(); $i < 22; $i++)
            <div class="number empty">
    </div>
    @endfor
    </div>
    {{ $numeros->links() }}
</section>
<section class="actions-section">
    <form method="POST" action="{{ route('carrito.addSelected') }}">
        @csrf
        <input type="hidden" name="selected_numbers" id="selected-numbers">
        <input type="hidden" name="id_rifa" value="{{ $rifa->id_rifa }}">
        <button type="submit" class="action-button">Añadir al carrito</button>
    </form>
    <button class="action-button">Facturar</button>
</section>
@endsection