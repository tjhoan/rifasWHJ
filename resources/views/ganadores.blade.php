@extends('layouts.app')

@section('title', 'Ganadores de Rifas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/ganadores.css') }}">
@endpush

@section('content')
<h1>Ganadores de Rifas</h1>

<section class="ganadores-container">
  @forelse ($ganadores as $ganador)
  <div class="ganador-card">
    <img
      src="{{ $ganador->sorteo->rifa->imagen_rifa }}"
      alt="Imagen de la Rifa"
      class="icono">

    <div class="info">
      <div class="col">
        <p><strong>Nombre de la rifa:</strong> {{ $ganador->sorteo->rifa->nombre_rifa }}</p>
        <p><strong>Número de boleto:</strong> {{ $ganador->sorteo->numero_ganador }}</p>
        <p><strong>Nombre del ganador:</strong>
          {{ $ganador->cliente->primer_nombre_cliente }}
          {{ $ganador->cliente->segundo_nombre_cliente ? $ganador->cliente->segundo_nombre_cliente . ' ' : '' }}
          {{ $ganador->cliente->primer_apellido_cliente }}
        </p>
      </div>
      <div class="col">
        <p><strong>Fecha inicio:</strong> {{ $ganador->sorteo->rifa->fecha_inicio }}</p>
        <p><strong>Fecha sorteo:</strong> {{ $ganador->sorteo->rifa->fecha_sorteo }}</p>
        <p><strong>Premio:</strong> {{ $ganador->sorteo->rifa->premio }}</p>
      </div>
    </div>
  </div>
  @empty
  <p>No hay ganadores registrados.</p>
  @endforelse
</section>
@endsection