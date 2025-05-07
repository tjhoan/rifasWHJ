<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Administrativo</title>
  <link rel="stylesheet" href="{{ asset('css/admin/adminPanel.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@if(session('success'))
<script>
  Swal.fire({
    icon: 'success',
    title: '¡Éxito!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#3085d6',
  });
</script>
@endif

@if(session('error'))
<script>
  Swal.fire({
    icon: 'error',
    title: '¡Error!',
    text: "{{ session('error') }}",
    confirmButtonColor: '#d33',
  });
</script>
@endif

<body>
  <!-- Sidebar / Menú lateral -->
  <div class="sidebar">
    <div class="admin-info">
      <span>ADMINISTRADOR</span>
      <h3>Hernando Vivas Franco</h3>
    </div>
    <ul class="menu">
      <li class="active"><a href="{{ url('/admin') }}">Rifas</a></li>
      <li><a href="{{ url('/admin/ventas') }}">Ventas</a></li>
      <li><a href="{{ url('/admin/clientes') }}">Clientes</a></li>
      <li><a href="{{ url('/admin/sorteo') }}">Sorteo</a></li>
      <li><a href="{{ url('/admin/configuracion') }}">Configuración</a></li>
    </ul>
  </div>
  <!-- Contenido principal -->
  <div class="main-content">
    <header>
      <h1>Rifas</h1>
      <button class="btn-nueva" id="btnAbrirModal">+ Nueva</button>
    </header>
    <section class="rifas-container">
      @foreach ($rifas as $rifa)
      <div class="rifa-card">
        <div class="rifa-icon">
          <img
            src="{{ filter_var($rifa->imagen_rifa, FILTER_VALIDATE_URL) ? $rifa->imagen_rifa : asset('storage/' . $rifa->imagen_rifa) }}" alt="Ícono Rifa">
        </div>
        <div class="rifa-info">
          <p><strong>Nombre:</strong> {{ $rifa->nombre_rifa }}</p>
          <p><strong>Cantidad vendida:</strong> {{ $rifa->numeros()->where('estado', 'vendido')->count() }}</p>
          <p><strong>Precio:</strong> ${{ $rifa->precio_boleto }}</p>
          <p><strong>Fecha inicio:</strong> {{ $rifa->fecha_inicio }}</p>
          <p><strong>Fecha sorteo:</strong> {{ $rifa->fecha_sorteo }}</p>
          <p><strong>Premio:</strong> {{ $rifa->premio }}</p>
        </div>
        <div class="actions">
          <button class="btn-eliminar" data-id="{{ $rifa->id_rifa }}">Eliminar</button>
          <button class="btn-modificar" data-rifa="{{ $rifa->toJson() }}">Modificar</button>
        </div>
        <div class="rifa-boletos">
          <p><strong>Números reservados:</strong> {{ $rifa->reservados_count }}</p>
        </div>
      </div>
      @endforeach
    </section>
  </div>
  <!-- Modal para crear nueva rifa -->
  <div class="modal" id="modalRifa">
    <div class="modal-content">
      <span class="close" id="btnCerrarModal">&times;</span>
      <h3>Crear Nueva Rifa</h3>
      <form action="{{ route('admin.rifas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>
          Nombre de la rifa:
          <input type="text" name="nombre_rifa" placeholder="Nombre de la rifa" required>
        </label>
        <label>
          Precio:
          <input type="number" name="precio_boleto" min="0" step="0.01" placeholder="Precio" required>
        </label>
        <label>
          Fecha inicio:
          <input type="date" name="fecha_inicio" value="{{ date('Y-m-d') }}" required>
        </label>
        <label>
          Fecha sorteo:
          <input type="date" name="fecha_sorteo" required>
        </label>
        <label>
          Imagen:
          <input type="file" name="imagen_rifa" accept="image/*">
        </label>
        <label>
          Premio:
          <input type="text" name="premio" placeholder="Premio" required>
        </label>
        <label>
          Cantidad de números:
          <input type="number" name="cantidad_boletos" min="1" placeholder="Ej. 1000" required>
        </label>
        <button type="submit" class="btn-agregar">Agregar</button>
      </form>
    </div>
  </div>
  <!-- Modal para modificar rifa rifa -->
  <div class="modal" id="modificarRifa">
    <div class="modal-content">
      <span class="close" id="cerrarModal">&times;</span>
      <h3>Modificar la rifa</h3>
      <form id="formModificarRifa" action="{{ route('admin.rifas.update', ['id' => 0]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id_rifa" id="id_rifa">
        <label>
          Nombre de la rifa:
          <input type="text" name="nombre_rifa" id="nombre_rifa" placeholder="Nombre de la rifa">
        </label>
        <label>
          Precio:
          <input type="number" name="precio_boleto" id="precio_boleto" min="0" step="0.01" placeholder="Precio">
        </label>
        <label>
          Fecha inicio:
          <input type="date" name="fecha_inicio" id="fecha_inicio">
        </label>
        <label>
          Fecha sorteo:
          <input type="date" name="fecha_sorteo" id="fecha_sorteo">
        </label>
        <label>
          Imagen actual:
          <div id="imagen_actual_container" style="text-align: center; margin-bottom: 10px;">
            <img id="imagen_actual" src="" alt="Imagen actual" style="max-width: 120px; border-radius: 5px; margin-bottom: 5px;">
            <p style="font-size: 0.9em; color: #555;">Cambiar imagen:</p>
            <input type="file" name="imagen_rifa" id="imagen_rifa" accept="image/*">
          </div>
        </label>
        <label>
          Premio:
          <input type="text" name="premio" id="premio" placeholder="Premio">
        </label>
        <label>
          Cantidad de números:
          <input type="number" name="cantidad_boletos" id="cantidad_boletos" min="1" placeholder="Ej. 1000">
        </label>
        <button type="submit" class="btn-agregar">Modificar</button>
      </form>
    </div>
  </div>
  <script>
    const btnAbrir = document.getElementById('btnAbrirModal');
    const btnCerrar = document.getElementById('btnCerrarModal');
    const modalRifa = document.getElementById('modalRifa');

    // funciones para abrir y cerrar el modal para la nueva rifa 
    btnAbrir.addEventListener('click', () => {
      modalRifa.classList.add('show');
    });

    btnCerrar.addEventListener('click', () => {
      modalRifa.classList.remove('show');
    });

    // Cerrar modal de nueva rifa al hacer clic fuera de la ventana modal
    window.addEventListener('click', (e) => {
      if (e.target === modalRifa) {
        modalRifa.classList.remove('show');
      }
    });

    const openButtons = document.querySelectorAll('.btn-modificar');
    const modal = document.getElementById('modificarRifa');
    const form = document.getElementById('formModificarRifa');

    openButtons.forEach(btn => {
      btn.addEventListener('click', (e) => {
        const rifa = JSON.parse(btn.dataset.rifa);

        form.action = `{{ url('/admin/rifas') }}/${rifa.id_rifa}`;
        document.getElementById('id_rifa').value = rifa.id_rifa;
        document.getElementById('nombre_rifa').value = rifa.nombre_rifa;
        document.getElementById('precio_boleto').value = rifa.precio_boleto;
        document.getElementById('fecha_inicio').value = rifa.fecha_inicio;
        document.getElementById('fecha_sorteo').value = rifa.fecha_sorteo;
        document.getElementById('premio').value = rifa.premio;
        document.getElementById('cantidad_boletos').value = rifa.cantidad_boletos;

        const imagenActual = document.getElementById('imagen_actual');
        if (rifa.imagen_rifa) {
          const isAbsoluteUrl = rifa.imagen_rifa.startsWith('http://') || rifa.imagen_rifa.startsWith('https://');
          imagenActual.src = isAbsoluteUrl ? rifa.imagen_rifa : `{{ asset('storage') }}/${rifa.imagen_rifa}`;
          imagenActual.style.display = 'block';
        } else {
          imagenActual.style.display = 'none';
        }

        modal.classList.add('show');
      });
    });

    modal.addEventListener('click', e => {
      if (e.target === modal) {
        modal.classList.remove('show');
      }
    });

    const closeButtons = modal.querySelectorAll('.close');
    closeButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        modal.classList.remove('show');
      });
    });

    const deleteButtons = document.querySelectorAll('.btn-eliminar');

    deleteButtons.forEach(button => {
      button.addEventListener('click', () => {
        const rifaId = button.dataset.id;

        Swal.fire({
          title: '¿Estás seguro?',
          text: "Esta acción no se puede deshacer.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar!',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch(`{{ url('/admin/rifas') }}/${rifaId}`, {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Content-Type': 'application/json',
                },
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  Swal.fire('Eliminado!', data.message, 'success');
                  location.reload();
                } else {
                  Swal.fire('Error', data.message, 'error');
                }
              })
              .catch(error => {
                Swal.fire('Error', 'Ocurrió un error al intentar eliminar la rifa.', 'error');
              });
          }
        });
      });
    });
  </script>
</body>

</html>