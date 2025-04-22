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
        src="{{ $ganador->rifa->imagenes->first()?->ruta_imagen ?? asset('img/default.png') }}" 
        alt="Imagen de la Rifa" 
        class="icono">

      <div class="info">
        <div class="col">
          <p><strong>Nombre de la rifa:</strong> {{ $ganador->rifa->nombre ?? 'N/A' }}</p>
          <p><strong>Número de boleto:</strong> {{ $ganador->boletos_ganador }}</p>
          <p><strong>Nombre del ganador:</strong> {{ $ganador->nombre_ganador }}</p>
        </div>
        <div class="col">
          <p><strong>Fecha inicio:</strong> {{ $ganador->rifa->fecha_inicio ?? 'N/A' }}</p>
          <p><strong>Fecha sorteo:</strong> {{ $ganador->rifa->fecha_sorteo ?? 'N/A' }}</p>
          <p><strong>Premio:</strong> {{ $ganador->rifa->premio ?? 'N/A' }}</p>
        </div>
      </div>
    </div>
  @empty
    <p>No hay ganadores registrados.</p>
  @endforelse
</section>
@endsection