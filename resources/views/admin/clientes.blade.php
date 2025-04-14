<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes - Panel Administrativo</title>
  <link rel="stylesheet" href="{{ asset('css/admin/clientes.css') }}">
</head>
<body>
  <!-- Sidebar / Menú lateral -->
  <div class="sidebar">
    <div class="admin-info">
      <span>ADMINISTRADOR</span>
      <h3>Hernando Vivas Franco</h3>
    </div>
    <ul class="menu">
      <li><a href="{{ url('/admin') }}">Rifas</a></li>
      <li><a href="{{ url('/admin/ventas') }}">Ventas</a></li>
      <li class="active"><a href="{{ url('/admin/clientes') }}">Clientes</a></li>
      <li><a href="{{ url('/admin/sorteo') }}">Sorteo</a></li>
      <li><a href="{{ url('/admin/configuracion') }}">Configuración</a></li>
    </ul>
  </div>

  <!-- Contenido principal -->
  <main class="main-content">
    <h1>Clientes</h1>

    <div class="form-box">
      <!-- Fila de nombres y apellidos -->
      <div class="row">
        <div class="field">
          <label>Primer Nombre:</label>
          <input type="text">
        </div>
        <div class="field">
          <label>Segundo Nombre:</label>
          <input type="text">
        </div>
        <div class="field">
          <label>Primer Apellido:</label>
          <input type="text">
        </div>
        <div class="field">
          <label>Segundo Apellido:</label>
          <input type="text">
        </div>
      </div>

      <!-- Fila de contacto -->
      <div class="row">
        <div class="field">
          <label>Celular:</label>
          <input type="number">
        </div>
        <div class="field">
          <label>Correo electrónico:</label>
          <input type="email">
        </div>
        <div class="field">
          <label>Cédula:</label>
          <input type="number">
        </div>
      </div>

      <!-- Valor a pagar -->
      <h2 class="payment">Valor a pagar: "$"</h2>

      <!-- Información de la rifa -->
      <div class="raffle-info">
        <!-- Columna izquierda -->
        <div class="column">
          <div class="field">
            <label>Nombre Rifa:</label>
            <p class="static-data">Rifa Día del Padre</p>
          </div>
          <div class="field">
            <label>Separar:</label>
            <p class="static-data">❌</p>
          </div>
          <div class="field">
            <label>Comprar:</label>
            <p class="static-data">✅</p>
          </div>
        </div>

        <!-- Columna derecha -->
        <div class="column">
          <div class="field">
            <label>Fecha inicio:</label>
            <p class="static-data">2025-05-01</p>
          </div>
          <div class="field">
            <label>Fecha sorteo:</label>
            <p class="static-data">2025-06-15</p>
          </div>
          <div class="field">
            <label>Premio:</label>
            <p class="static-data">Moto AKT 125</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
