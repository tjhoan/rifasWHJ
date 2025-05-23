<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventas - Panel Administrativo</title>
  <link rel="stylesheet" href="{{ asset('css/admin/ventas.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <!-- Sidebar / Menú lateral -->
  <div class="sidebar">
    <div class="admin-info">
      <span>ADMINISTRADOR</span>
      <h3>{{ session('admin')->nombre_admin }}</h3>
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
    <h1 class="titulo-seccion">Ventas</h1>
    <div class="dashboard">
      <div class="card">
        <i class="fas fa-ticket-alt icon"></i>
        <h2>Total Rifas</h2>
        <p class="value">{{ $totalRifas }}</p>
        <p class="description">{{ $rifasActivas }} rifas activas</p>
      </div>
      <div class="card">
        <i class="fas fa-chart-line icon"></i>
        <h2>Boletas Vendidas</h2>
        <p class="value">{{ $boletasVendidas }}</p>
        <p class="description">{{ $porcentajeVendidas }}% del total ({{ $totalBoletos }})</p>
      </div>
      <div class="card">
        <i class="fas fa-dollar-sign icon"></i>
        <h2>Ingresos Totales</h2>
        <p class="value">${{ number_format($ingresosTotales, 0, ',', '.') }}</p>
        <p class="description">Promedio: ${{ number_format($promedioPorBoleta, 0, ',', '.') }} por boleta</p>
      </div>
      <div class="card">
        <i class="fas fa-users icon"></i>
        <h2>Clientes</h2>
        <p class="value">{{ $totalClientes }}</p>
        <p class="description">{{ number_format($promedioBoletasPorCliente, 1) }} boletas por cliente</p>
      </div>
      <div class="card">
        <i class="fas fa-crown icon"></i>
        <h2>Rifa Más Vendida</h2>
        @if ($rifaMasVendida)
          <p class="value">{{ $rifaMasVendida->nombre_rifa }}</p>
          <p class="description">{{ $rifaMasVendida->boletos_vendidos }} boletos vendidos</p>
        @else
          <p class="value">No Hay</p>
          <p class="description">No hay datos disponibles</p>
        @endif
      </div>
      <div class="card">
        <i class="fas fa-user icon"></i>
        <h2>Cliente Más Activo</h2>
        @if ($clienteMasActivo)
        <p class="value">{{ $clienteMasActivo->primer_nombre_cliente }} {{ $clienteMasActivo->primer_apellido_cliente }}</p>
        <p class="description">{{ $clienteMasActivo->boletos_comprados }} boletos comprados</p>
        @else
        <p class="value">No Hay</p>
        <p class="description">No hay datos disponibles</p>
        @endif
      </div>
    </div>
    <div class="rifas-section">
      <h2 class="titulo-seccion">Detalle de Rifas</h2>
      <div class="rifas-dashboard">
        @foreach ($rifas as $rifa)
        <div class="rifa-card">
          <h3>{{ $rifa->nombre_rifa }}</h3>
          <p><strong>Vendidos:</strong> {{ $rifa->boletos_vendidos }}</p>
          <p><strong>Reservados:</strong> {{ $rifa->boletos_reservados }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const successMessage = "{{ session('success') }}";
      const errorMessage = "{{ session('error') }}";

      if (successMessage) {
        Swal.fire({
          icon: "success",
          title: "¡Éxito!",
          text: successMessage,
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Aceptar",
        });
      }

      if (errorMessage) {
        Swal.fire({
          icon: "error",
          title: "¡Error!",
          text: errorMessage,
          confirmButtonColor: "#d33",
          confirmButtonText: "Aceptar",
        });
      }
    });
  </script>
</body>

</html>