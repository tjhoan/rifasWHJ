<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Configuración - Panel Administrativo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/admin/configuracion.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <div class="section">
      <h2>Datos Empresa</h2>
      <form class="fields" action="{{ route('admin.configuracion.updateEmpresa') }}" method="POST">
        @csrf
        <input type="hidden" name="id_empresa" value="{{ $empresa->id_empresa ?? '' }}">
        <div class="field">
          <label>Nombre Empresa:</label>
          <input type="text" name="nombre" value="{{ $empresa->nombre ?? '' }}" placeholder="Nombre o razón social">
        </div>
        <div class="field">
          <label>NIT:</label>
          <input type="text" name="NIT" value="{{ $empresa->NIT ?? '' }}" placeholder="123456789-0">
        </div>
        <div class="field">
          <label>Dirección:</label>
          <input type="text" name="direccion" value="{{ $empresa->direccion ?? '' }}" placeholder="Cra 12 #34-56">
        </div>
        <div class="field">
          <label>Celular:</label>
          <input type="text" name="telefono" value="{{ $empresa->telefono ?? '' }}" placeholder="+57 300 123 4567">
        </div>
        <div class="button-area">
          <button type="submit">Modificar</button>
        </div>
      </form>
    </div>
    <div class="section">
      <h2>Medios de Comunicación</h2>
      <form action="{{ route('admin.configuracion.updateMedios') }}" method="POST">
        @csrf
        <div class="fields">
          <div class="field">
            <label>WhatsApp:</label>
            <input type="text" name="whatsapp" value="{{ $empresa->redes_sociales['WhatsApp'] ?? '' }}">
          </div>
          <div class="field">
            <label>Facebook:</label>
            <input type="text" name="facebook" value="{{ $empresa->redes_sociales['Facebook'] ?? '' }}">
          </div>
          <div class="field">
            <label>Instagram:</label>
            <input type="text" name="instagram" value="{{ $empresa->redes_sociales['Instagram'] ?? '' }}">
          </div>
        </div>
        <div class="button-area">
          <button type="submit">Modificar</button>
        </div>
      </form>
    </div>
    <div class="section">
      <h2>Usuario - Contraseña Administrador</h2>
      <form action="{{ route('admin.configuracion.updateAdmin') }}" method="POST">
        @csrf
        <input type="hidden" name="id_admin" value="{{ $admin->id_admin ?? '' }}">
        <div class="fields">
          <div class="field">
            <label>Usuario (Correo):</label>
            <input type="email" name="correo" value="{{ $admin->correo ?? '' }}" required>
          </div>
          <div class="field">
            <label>Nueva Contraseña:</label>
            <input type="password" name="contrasena" placeholder="Dejar en blanco para no cambiar">
          </div>
          <div class="field">
            <label>Confirmar Contraseña:</label>
            <input type="password" name="contrasena_confirmation" placeholder="Repite la nueva contraseña">
          </div>
        </div>
        <div class="button-area">
          <button type="submit">Modificar</button>
        </div>
      </form>
    </div>
    <div class="section">
      <h2>Métodos de Pago</h2>
      <form action="{{ route('admin.configuracion.addMetodoPago') }}" method="POST">
        @csrf
        <div class="fields">
          <div class="field">
            <label>Método adicional:</label>
            <input type="text" name="nombre_metodo" placeholder="Ej. Nequi, PayPal, Daviplata, etc.">
          </div>
          <div class="field">
            <label>Cuenta:</label>
            <input type="text" name="digito_cuenta" placeholder="Número de cuenta o referencia">
          </div>
        </div>
        <div class="button-area">
          <button type="submit">Agregar</button>
        </div>
      </form>
    </div>
  </div>
  <script src="{{ asset('js/alerts.js') }}" defer></script>
</body>

</html>