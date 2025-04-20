<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes - Panel Administrativo</title>
  <link rel="stylesheet" href="{{ asset('css/admin/clientes.css') }}">
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet"
  />
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
  <div class="main-content">

    <!-- TÍTULO DE LA PÁGINA -->
    <h1 class="page-title">Clientes</h1>

    <!-- BUSCADOR -->
    <div class="search-box">
      <input type="text" placeholder="BUSCAR CÉDULA" />
      <button class="btn-search"><i class="fas fa-search"></i></button>
    </div>

    <!-- TARJETA DE CLIENTE -->
    <div class="client-card">
      <!-- PRIMERA FILA DE DATOS -->
      <div class="info-row">
        <div class="info-item">
          <span class="label">Primer Nombre:</span>
          <span class="value">Juan</span>
        </div>
        <div class="info-item">
          <span class="label">Segundo Nombre:</span>
          <span class="value">José</span>
        </div>
        <div class="info-item">
          <span class="label">Primer Apellido:</span>
          <span class="value">Soto</span>
        </div>
        <div class="info-item">
          <span class="label">Segundo Apellido:</span>
          <span class="value">Pérez</span>
        </div>
      </div>

      <!-- SEGUNDA FILA DE DATOS -->
      <div class="info-row">
        <div class="info-item">
          <span class="label">Celular:</span>
          <span class="value">3124567890</span>
        </div>
        <div class="info-item">
          <span class="label">Correo electrónico:</span>
          <span class="value">Jose@gmail.com</span>
        </div>
        <div class="info-item">
          <span class="label">Cédula:</span>
          <span class="value">1113435678</span>
        </div>
      </div>

      <!-- BOTONES ABAJO -->
      <div class="client-buttons">
        <button class="btn-delete">Eliminar</button>
        <button class="btn-edit" id="openEditModal">Editar</button>
      </div>
    </div>

    <!-- MODAL EDITAR CLIENTE -->
  <div class="modal" id="modalEditarCliente">
    <div class="modal-content">
      <span class="close" id="closeEditModal">&times;</span>
      <h3>Editar Cliente</h3>
      <form class="edit-form">
        <div class="edit-row">
          <label>
            Primer Nombre:
            <input type="text" name="primerNombre" value="Juan">
          </label>
          <label>
            Segundo Nombre:
            <input type="text" name="segundoNombre" value="José">
          </label>
        </div>
        <div class="edit-row">
          <label>
            Primer Apellido:
            <input type="text" name="primerApellido" value="Toro">
          </label>
          <label>
            Segundo Apellido:
            <input type="text" name="segundoApellido" value="Pérez">
          </label>
        </div>
        <div class="edit-row">
          <label>
            Celular:
            <input type="text" name="celular" value="3124567890">
          </label>
          <label>
            Correo electrónico:
            <input type="email" name="correo" value="Jose@gmail.com">
          </label>
          <label>
            Cédula:
            <input type="text" name="cedula" value="1113435678">
          </label>
        </div>
        <div class="edit-buttons">
          <button type="submit" class="btn-save">Guardar</button>
        </div>
      </form>
    </div>
  </div>

  </div>
   <!-- JS para abrir/cerrar modal -->
   <script>
    const modal = document.getElementById('modalEditarCliente');
    const openBtn = document.getElementById('openEditModal');
    const closeBtn = document.getElementById('closeEditModal');

    openBtn.addEventListener('click', () => {
      modal.classList.add('show');
    });
    closeBtn.addEventListener('click', () => {
      modal.classList.remove('show');
    });
    // Cerrar al clicar fuera del contenido
    modal.addEventListener('click', e => {
      if (e.target === modal) modal.classList.remove('show');
    });
  </script>
</body>
</html>
