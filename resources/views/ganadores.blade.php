@extends('layouts.app')

@section('title', 'Ganadores de Rifas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/ganadores.css') }}">
@endpush

@section('content')
  <h1>Ganadores de Rifas</h1>
  <section class="ganadores-container">

    <div class="ganador-card">
      <!-- Imagen a la izquierda -->
      <img src="{{ asset('img/pc-gamer.png') }}" alt="Ícono Rifa" class="icono">

      <div class="info">
        <div class="col">
          <p><strong>Nombre de la rifa:</strong> cualquier</p>
          <p><strong>Número de boleto:</strong> 12345</p>
          <p><strong>Nombre del ganador:</strong> Juan Pérez</p>
        </div>
        <div class="col">
          <p><strong>Fecha inicio:</strong> 01/03/2025</p>
          <p><strong>Fecha sorteo:</strong> 10/03/2025</p>
          <p><strong>Premio:</strong> Laptop Gamer</p>
        </div>
      </div>
    </div>

    <div class="ganador-card">
      <img src="{{ asset('img/iphone.jpg') }}" alt="Ícono Rifa" class="icono">

      <div class="info">
        <div class="col">
          <p><strong>Nombre de la rifa:</strong> cualquier</p>
          <p><strong>Número de boleto:</strong> 67890</p>
          <p><strong>Nombre del ganador:</strong> María Gómez</p>
        </div>
        <div class="col">
          <p><strong>Fecha inicio:</strong> 05/03/2025</p>
          <p><strong>Fecha sorteo:</strong> 15/03/2025</p>
          <p><strong>Premio:</strong> Smartphone</p>
        </div>
      </div>
    </div>

  </section>
@endsection
