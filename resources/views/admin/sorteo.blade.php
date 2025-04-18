<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Sorteo - Panel Administrativo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/admin/sorteo.css') }}">
  <!-- Fuente Inter desde Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="admin-info">
      <span>ADMINISTRADOR</span>
      <h3>Hernando Vivas Franco</h3>
    </div>
    <ul class="menu">
      <li><a href="{{ url('/admin') }}">Rifas</a></li>
      <li><a href="{{ url('/admin/ventas') }}">Ventas</a></li>
      <li><a href="{{ url('/admin/clientes') }}">Clientes</a></li>
      <li class="active"><a href="{{ url('/admin/sorteo') }}">Sorteo</a></li>
      <li><a href="{{ url('/admin/configuracion') }}">Configuración</a></li>
    </ul>
  </div>

  <!-- Contenido principal -->
  <div class="content">
    <h1>Sorteo</h1>

    <!-- Seleccionar Rifa y Botón Sortear -->
    <div class="sortear-box">
      <label for="tipoRifa">Tipo de rifa a sortear:</label>
      <select id="tipoRifa">
        <option>Rifa Especial - Día del Padre</option>
        <option>Rifa Oro</option>
        <option>Rifa Vacaciones</option>
      </select>
      <button class="btn-sortear">Sortear</button>
    </div>

    <!-- Datos del Ganador -->
    <div class="ganador-box">
      <h2>GANADOR</h2>
      <div class="fields">
        <div class="field">
          <label>Primer Nombre:</label>
          <p class="valor">Juan</p>
        </div>
        <div class="field">
          <label>Segundo Nombre:</label>
          <p class="valor">Pablo</p>
        </div>
        <div class="field">
          <label>Primer Apellido:</label>
          <p class="valor">Díaz</p>
        </div>
        <div class="field">
          <label>Segundo Apellido:</label>
          <p class="valor">Ramírez</p>
        </div>
      </div>
      <div class="fields">
        <div class="field">
          <label>Nombre de la Rifa:</label>
          <p class="valor">Rifa Especial - Día del Padre</p>
        </div>
        <div class="field">
          <label>Fecha Inicio:</label>
          <p class="valor">2025-05-01</p>
        </div>
        <div class="field">
          <label>Fecha Sorteo:</label>
          <p class="valor">2025-06-15</p>
        </div>
        <div class="field">
          <label>Premio:</label>
          <p class="valor">Moto AKT 125</p>
        </div>
      </div>

      <div class="publicar-ganador">
        <button class="btn-publicar">Publicar Ganador</button>
      </div>
    </div>

    <!-- Fecha del Sorteo + Botón Modificar Fecha -->
    <div class="fecha-sorteo-container">
      <label for="fechaSorteo">Fecha del sorteo:</label>
      <input type="date" id="fechaSorteo" value="2025-06-15">
      <button class="btn-modificar-fecha">Modificar fecha</button>
    </div>

  </div>
</body>
</html>
