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
      <label>
        <input type="radio" name="accion" value="separar" onclick="toggleAccion('ticket')" />
        Separar
      </label>
      <div id="ticket" class="detalle-accion">
        <strong>TICKET</strong><br />
        Válido hasta: {{ now()->addDays(3)->format('d/m/Y') }}
      </div>
    </div>

    <div class="accion">
      <label>
        <input type="radio" name="accion" value="comprar" onclick="toggleAccion('metodo-pago')" />
        Comprar
      </label>
      <div id="metodo-pago" class="detalle-accion">
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

<script>
  function toggleAccion(id) {
    // Ocultar todas las cajas de detalle
    document.querySelectorAll('.detalle-accion').forEach(el => {
      el.style.visibility = 'hidden';
      el.style.opacity = '0';
    });

    // Mostrar la caja seleccionada
    const selected = document.getElementById(id);
    selected.style.visibility = 'visible';
    selected.style.opacity = '1';
  }
</script>
@endsection