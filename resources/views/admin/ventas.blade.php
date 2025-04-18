<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventas - Panel Administrativo</title>
  <link rel="stylesheet" href="{{ asset('css/admin/ventas.css') }}">
  <!-- Fuente Inter desde Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
      <li class="active"><a href="{{ url('admin/ventas') }}">Ventas</a></li>
      <li><a href="{{ url('/admin/clientes') }}">Clientes</a></li>
      <li><a href="{{ url('admin/sorteo') }}">Sorteo</a></li>
      <li><a href="{{ url('admin/configuracion') }}">Configuración</a></li>
    </ul>
  </div>

  <!-- Contenido principal -->
  <div class="main-content">
    <div class="ventas-container">
      <h1 class="titulo-seccion">Ventas</h1>

      <div class="ventas-box">
        <p>Tipo de boleta totales vendidas / separada: <span>### / ###</span></p>
        <p>Tipo de boleta totales vendidas / separada: <span>### / ###</span></p>
      </div>

      <div class="ventas-box">
        <p>Ventas Totales Carrito: <span>$$$$$$$$</span></p>
        <p>Boletas Totales Vendidas: <span>######</span></p>
        <p>Boletas Totales Separadas: <span>######</span></p>
      </div>

    </div>
  </div>

</body>
</html>
