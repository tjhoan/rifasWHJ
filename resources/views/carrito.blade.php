@extends('layouts.app')

@section('title', 'Carrito de Compras')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
@endpush

@section('content')
<h1 class="titulo-carrito">Carrito</h1>

<div class="carrito-container">
  <div class="carrito-item">
    <img alt="Icono" class="item-icono" src="{{ asset('https://cdn.clarosports.com/clarosports/2024/06/balotook12-071239-1024x576.jpg') }}">
    <div class="item-info">
      <div class="info-left">
        <span><strong>Nombre Rifa:</strong> Baloto</span><br>
        <span><strong>Boleto Seleccionado:</strong> 4532</span><br>
        <span><strong>Para:</strong> cancelar</span>
      </div>
      <div class="info-right">
        <span><strong>Fecha inicio:</strong> 05/12/2025</span><br>
        <span><strong>Fecha sorteo:</strong> 05/12/2025</span><br>
        <span><strong>Premio:</strong> $1.200.000</span>
      </div>
    </div>
  </div>

  <div class="carrito-item">
    <img alt="Icono" class="item-icono" src="{{ asset('https://caracoltv.brightspotcdn.com/dims4/default/c5c6777/2147483647/strip/true/crop/1280x720+0+0/resize/800x450!/quality/75/?url=http%3A%2F%2Fcaracol-brightspot.s3.us-west-2.amazonaws.com%2F9c%2F0a%2Fc45d6e02461dbf01d4c0bf9d0d20%2Floteria-del-valle.jpg') }}">
    <div class="item-info">
      <div class="info-left">
        <span><strong>Nombre Rifa:</strong> cualquiera</span><br>
        <span><strong>Boleto Seleccionado:</strong> 455545</span><br>
        <span><strong>Para:</strong> cancelar o separar</span>
      </div>
      <div class="info-right">
        <span><strong>Fecha inicio:</strong> 05/12/2025</span><br>
        <span><strong>Fecha sorteo:</strong> 05/12/2025</span><br>
        <span><strong>Premio:</strong> televisión</span>
      </div>
    </div>
  </div>
</div>

<form action="{{ url('/facturar') }}" method="GET">
  <button type="submit" class="btn-facturar">Facturar</button>
</form>
@endsection