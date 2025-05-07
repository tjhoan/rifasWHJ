<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes - Panel Administrativo</title>
  <link rel="stylesheet" href="{{ asset('css/admin/clientes.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
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
    <h1 class="page-title">Clientes</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif

    <!-- Lista de clientes -->
    @foreach ($clientes as $cliente)
    <div class="client-card">
      <div class="info-row">
        <div class="info-item">
          <span class="label">Primer Nombre:</span>
          <span class="value">{{ $cliente->primer_nombre_cliente }}</span>
        </div>
        <div class="info-item">
          <span class="label">Segundo Nombre:</span>
          <span class="value">{{ $cliente->segundo_nombre_cliente }}</span>
        </div>
        <div class="info-item">
          <span class="label">Primer Apellido:</span>
          <span class="value">{{ $cliente->primer_apellido_cliente }}</span>
        </div>
        <div class="info-item">
          <span class="label">Segundo Apellido:</span>
          <span class="value">{{ $cliente->segundo_apellido_cliente }}</span>
        </div>
      </div>

      <div class="info-row">
        <div class="info-item">
          <span class="label">Celular:</span>
          <span class="value">{{ $cliente->telefono_cliente }}</span>
        </div>
        <div class="info-item">
          <span class="label">Correo electrónico:</span>
          <span class="value">{{ $cliente->correo_cliente }}</span>
        </div>
        <div class="info-item">
          <span class="label">Cédula:</span>
          <span class="value">{{ $cliente->cedula }}</span>
        </div>
      </div>

      <div class="client-buttons">
        <form action="{{ route('admin.clientes.destroy', $cliente->id_cliente) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn-delete" type="submit">Eliminar</button>
        </form>
        <button class="btn-edit" data-cliente='{{ json_encode($cliente) }}' onclick="openEditModal(this)">Editar</button>
      </div>
    </div>
    @endforeach
  </div>
  <!-- MODAL EDITAR CLIENTE -->
  <div class="modal" id="modalEditarCliente">
    <div class="modal-content">
      <span class="close" id="closeEditModal">&times;</span>
      <h3>Editar Cliente</h3>
      <form class="edit-form" method="POST">
        @csrf
        @method('PUT')
        <div class="edit-row">
          <label>
            Primer Nombre:
            <input type="text" name="primer_nombre_cliente" value="Juan">
          </label>
          <label>
            Segundo Nombre:
            <input type="text" name="segundo_nombre_cliente" value="José">
          </label>
        </div>
        <div class="edit-row">
          <label>
            Primer Apellido:
            <input type="text" name="primer_apellido_cliente" value="Toro">
          </label>
          <label>
            Segundo Apellido:
            <input type="text" name="segundo_apellido_cliente" value="Pérez">
          </label>
        </div>
        <div class="edit-row">
          <label>
            Celular:
            <input type="text" name="telefono_cliente" value="3124567890">
          </label>
          <label>
            Correo electrónico:
            <input type="email" name="correo_cliente" value="Jose@gmail.com">
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
  <!-- JS para abrir/cerrar modal -->
  <script>
    const modal = document.getElementById('modalEditarCliente');
    const openBtn = document.getElementById('openEditModal');
    const closeBtn = document.getElementById('closeEditModal');

    closeBtn.addEventListener('click', () => {
      modal.classList.remove('show');
    });

    modal.addEventListener('click', e => {
      if (e.target === modal) {
        modal.classList.remove('show');
      }
    });

    function openEditModal(button) {
      const cliente = JSON.parse(button.getAttribute('data-cliente'));
      const modal = document.getElementById('modalEditarCliente');
      modal.querySelector('input[name="primer_nombre_cliente"]').value = cliente.primer_nombre_cliente;
      modal.querySelector('input[name="segundo_nombre_cliente"]').value = cliente.segundo_nombre_cliente;
      modal.querySelector('input[name="primer_apellido_cliente"]').value = cliente.primer_apellido_cliente;
      modal.querySelector('input[name="segundo_apellido_cliente"]').value = cliente.segundo_apellido_cliente;
      modal.querySelector('input[name="telefono_cliente"]').value = cliente.telefono_cliente;
      modal.querySelector('input[name="correo_cliente"]').value = cliente.correo_cliente;
      modal.querySelector('input[name="cedula"]').value = cliente.cedula;

      modal.querySelector('form').action = `/admin/clientes/${cliente.id_cliente}`;
      modal.classList.add('show');
    }

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
  </script>
</body>

</html>