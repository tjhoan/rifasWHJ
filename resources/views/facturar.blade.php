@extends('layouts.app')

@section('title', 'Página de Inicio')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/facturar.css') }}">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/alerts.js') }}" defer></script>
@endpush

@section('content')

<h1>Proceso de facturación</h1>
<form class="formulario" id="form-facturar" method="POST" action="{{ route('facturar.store') }}">
  @csrf
  <div class="row">
    <input type="text" name="primer_nombre" placeholder="Primer Nombre" required>
    @error('primer_nombre') <div class="error">{{ $message }}</div> @enderror
    <input type="text" name="segundo_nombre" placeholder="Segundo Nombre">
    @error('segundo_nombre') <div class="error">{{ $message }}</div> @enderror
    <input type="text" name="primer_apellido" placeholder="Primer Apellido" required>
    @error('primer_apellido') <div class="error">{{ $message }}</div> @enderror
    <input type="text" name="segundo_apellido" placeholder="Segundo Apellido">
    @error('segundo_apellido') <div class="error">{{ $message }}</div> @enderror
  </div>
  <div class="row">
    <input type="tel" name="telefono" placeholder="Celular" required>
    @error('celular') <div class="error">{{ $message }}</div> @enderror
    <input type="email" name="correo" placeholder="Correo electrónico" required>
    @error('correo') <div class="error">{{ $message }}</div> @enderror
    <input type="text" name="cedula" placeholder="Cédula" required>
    @error('cedula') <div class="error">{{ $message }}</div> @enderror
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
          @foreach ($metodoPago as $metodo)
          <option value="{{ $metodo->nombre_metodo }}">{{ $metodo->nombre_metodo }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <input type="hidden" name="tipo_accion" id="tipo_accion" value="separar">

  <div style="text-align: center;">
    <button type="submit" class="btn-finalizar">Finalizar</button>
  </div>
</form>

<script>
  function toggleAccion(id) {
    document.querySelectorAll('.detalle-accion').forEach(el => {
      el.style.visibility = 'hidden';
      el.style.opacity = '0';
    });

    const selected = document.getElementById(id);
    selected.style.visibility = 'visible';
    selected.style.opacity = '1';

    const tipoAccion = document.querySelector('input[name="accion"]:checked').value;
    document.getElementById('tipo_accion').value = tipoAccion;
  }
</script>

@endsection