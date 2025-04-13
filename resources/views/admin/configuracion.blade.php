<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Configuración - Panel Administrativo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/configuracion.css') }}">
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
      <li><a href="{{ url('admin/ventas') }}">Ventas</a></li>
      <li><a href="{{ url('/admin/clientes') }}">Clientes</a></li>
      <li><a href="{{ url('/admin/sorteo') }}">Sorteo</a></li>
      <li class="active"><a href="{{ url('/admin/configuracion') }}">Configuración</a></li>
    </ul>
  </div>

  <!-- Contenido principal -->
  <div class="content">
    <h1>Configuración</h1>

    <!-- Sección 1: Datos de la Empresa -->
    <div class="section">
      <h2>Datos Empresa</h2>
      <div class="fields">
        <div class="field">
          <label>Nombre Empresa:</label>
          <input type="text" placeholder="Nombre o razón social">
        </div>
        <div class="field">
          <label>NIT:</label>
          <input type="text" placeholder="123456789-0">
        </div>
        <div class="field">
          <label>Dirección:</label>
          <input type="text" placeholder="Cra 12 #34-56">
        </div>
        <div class="field">
          <label>Celular:</label>
          <input type="text" placeholder="+57 300 123 4567">
        </div>
      </div>
      <div class="button-area">
        <button>Modificar</button>
      </div>
    </div>

    <!-- Sección 2: Medios de Comunicación -->
    <div class="section">
      <h2>Medios de Comunicación</h2>
      <div class="fields">
        <div class="field">
          <label>WhatsApp:</label>
          <input type="text" placeholder="+57 300 123 4567">
        </div>
        <div class="field">
          <label>Facebook:</label>
          <input type="text" placeholder="https://facebook.com/empresa">
        </div>
        <div class="field">
          <label>Instagram:</label>
          <input type="text" placeholder="https://instagram.com/empresa">
        </div>
      </div>
      <div class="button-area">
        <button>Modificar</button>
      </div>
    </div>

    <!-- Sección 3: Usuario - Contraseña Administrador -->
    <div class="section">
      <h2>Usuario - Contraseña Administrador</h2>
      <div class="fields">
        <div class="field">
          <label>Usuario:</label>
          <input type="text" placeholder="admin123">
        </div>
        <div class="field">
          <label>Contraseña:</label>
          <input type="password" placeholder="********">
        </div>
      </div>
      <div class="button-area">
        <button>Modificar</button>
      </div>
    </div>

    <!-- Sección 4: Métodos de Pago -->
    <div class="section">
      <h2>Métodos de Pago</h2>
      <div class="fields">
        <div class="field">
          <label>Método adicional:</label>
          <input type="text" placeholder="Ej. Nequi, PayPal, Daviplata, etc.">
        </div>
      </div>
      <div class="button-area">
        <button>Agregar</button>
      </div>
    </div>

  </div>
</body>
</html>
