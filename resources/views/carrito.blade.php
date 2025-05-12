@extends('layouts.app')

@section('title', 'Carrito de Compras')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
@endpush

@section('content')
<h1 class="titulo-carrito">Carrito</h1>

@if (session('error'))
<script>
  document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
      icon: "error",
      title: "¡Error!",
      text: "{{ session('error') }}",
      confirmButtonColor: "#d33",
      confirmButtonText: "Aceptar",
    });
  });
</script>
@endif

<div class="carrito-container">
  @if ($carrito && is_iterable($carrito->numeros))
  @foreach ($carrito->numeros as $numero)
  <div class="carrito-item">
    <img alt="Icono" class="item-icono" src="{{ filter_var($numero->rifa->imagen_rifa, FILTER_VALIDATE_URL) ? $numero->rifa->imagen_rifa : asset('storage/' . $numero->rifa->imagen_rifa) }}">
    <div class="item-info">
      <div class="info-left">
        <h3>{{ $numero->rifa->nombre_rifa }}</h3>
        <p>Boleto: <strong>{{ $numero->numero }}</strong></p>
      </div>
      <div class="info-right">
        <p>Inicio: <strong>{{ \Carbon\Carbon::parse($numero->rifa->fecha_inicio)->format('d/m/Y') }}</strong></p>
        <p>Sorteo: <strong>{{ \Carbon\Carbon::parse($numero->rifa->fecha_sorteo)->format('d/m/Y') }}</strong></p>
        <p>Premio: <strong>{{ number_format((float) $numero->rifa->premio, 0 ) }}</strong></p>
      </div>
    </div>
    <form method="POST" action="{{ route('carrito.remove') }}" class="form-inline">
      @csrf
      <input type="hidden" name="id_carrito" value="{{ $carrito->id_carrito }}">
      <input type="hidden" name="id_numero" value="{{ $numero->id_numero }}">
      <button type="submit" class="btn btn-remove">
        <i class="fa-solid fa-trash"></i>
      </button>
    </form>
  </div>
  @endforeach
  @else
  <p>No hay elementos en el carrito.</p>
  @endif
</div>

<div class="carrito-actions">
  @if ($carrito)
  <form method="POST" action="{{ route('carrito.clear') }}">
    @csrf
    <input type="hidden" name="id_carrito" value="{{ $carrito->id_carrito }}">
    <button type="submit" class="btn btn-clear">Vaciar Carrito</button>
  </form>
  @endif

  <form action="{{ url('/facturar') }}" method="GET">
    <button type="submit" class="btn btn-facturar">Facturar</button>
  </form>
</div>
@endsection