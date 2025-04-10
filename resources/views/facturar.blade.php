@extends('layouts.app')

@section('title', 'Página de Inicio')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/facturar.css') }}">
@endpush

@section('content')

<h1>Proceso de facturación</h1>

<form class="formulario" method="POST" action="{{ url('/facturar') }}">
  @csrf
  <div class="row">
    <input type="text" name="primer_nombre" placeholder="Primer Nombre" required>
    <input type="text" name="segundo_nombre" placeholder="Segundo Nombre">
  </div>
  <div class="row">
    <input type="text" name="primer_apellido" placeholder="Primer Apellido" required>
    <input type="text" name="segundo_apellido" placeholder="Segundo Apellido">
  </div>
  <div class="row">
    <input type="tel" name="celular" placeholder="Celular" required>
    <input type="email" name="correo" placeholder="Correo electrónico" required>
    <input type="text" name="cedula" placeholder="Cédula" required>
  </div>

  <div class="acciones">
    <div class="accion">
      <label>Separar</label>
      <input type="checkbox" name="accion" value="separar" />
      <div class="ticket">
        <strong>TICKET</strong><br />
        Válido hasta: {{ now()->addDays(3)->format('d/m/Y') }}
      </div>
    </div>

    <div class="accion">
      <label>Comprar</label>
      <input type="checkbox" name="accion" value="comprar" />
      <div class="metodo-pago">
        <label>Métodos de pago</label>
        <select name="metodo_pago">
          <option>Nequi</option>
          <option>Daviplata</option>
          <option>Paypal</option>
        </select>
      </div>
    </div>
  </div>

  <div class="finalizar">
    <button class="btn-finalizar" type="submit">Finalizar</button>
  </div>
</form>
@endsection