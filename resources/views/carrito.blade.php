@extends('layouts.app')

@section('title', 'Carrito de Compras')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
@endpush

@section('content')
<h1 class="titulo-carrito">Carrito</h1>

<div class="carrito-container">
  @forelse ($carrito as $item)
  <div class="carrito-item">
    <img alt="Icono" class="item-icono" src="{{ $item->rifa->imagenes->first()->ruta_imagen }}">
    <div class="item-info">
      <div class="info-left">
        <h3>{{ $item->rifa->nombre }}</h3>
        <p>Boleto: <strong>{{ $item->numero->numero }}</strong></p>
        <p>Cantidad: <strong>{{ $item->cantidad }}</strong></p>
      </div>
      <div class="info-right">
        <p>Inicio: <strong>{{ \Carbon\Carbon::parse($item->rifa->fecha_inicio)->format('d/m/Y') }}</strong></p>
        <p>Sorteo: <strong>{{ \Carbon\Carbon::parse($item->rifa->fecha_sorteo)->format('d/m/Y') }}</strong></p>
        <p>Premio: <strong>{{ $item->rifa->premio }}</strong></p>
      </div>
    </div>
    <form method="POST" action="{{ route('carrito.remove') }}" class="form-inline">
      @csrf
      <input type="hidden" name="id_carrito" value="{{ $item->id_carrito }}">
      <button type="submit" class="btn btn-remove">
        <i class="fa-solid fa-trash"></i>
      </button>
    </form>
  </div>
  @empty
  <p class="empty-message">No hay elementos en el carrito.</p>
  @endforelse
</div>

<div class="carrito-actions">
  <form method="POST" action="{{ route('carrito.clear') }}">
    @csrf
    <button type="submit" class="btn btn-clear">Vaciar Carrito</button>
  </form>

  <form action="{{ url('/facturar') }}" method="GET">
    <button type="submit" class="btn btn-facturar">Facturar</button>
  </form>
</div>
@endsection