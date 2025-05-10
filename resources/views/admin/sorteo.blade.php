<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Sorteo - Panel Administrativo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/admin/sorteo.css') }}">
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
      <li><a href="{{ url('/admin/ventas') }}">Ventas</a></li>
      <li><a href="{{ url('/admin/clientes') }}">Clientes</a></li>
      <li class="active"><a href="{{ url('/admin/sorteo') }}">Sorteo</a></li>
      <li><a href="{{ url('/admin/configuracion') }}">Configuración</a></li>
    </ul>
  </div>
  <!-- Contenido principal -->
  <div class="content">
    <h1>Sorteo</h1>

    @if (!$haySorteos)
    <div class="no-sorteos">
      <p>No hay sorteos disponibles en este momento.</p>
    </div>
    @else
    <!-- Seleccionar Rifa y Botón Sortear -->
    <div class="sortear-box">
      <form action="{{ route('admin.sorteo.sortear') }}" method="POST">
        @csrf
        <label for="id_sorteo">Selecciona el sorteo:</label>
        <select name="id_sorteo" id="id_sorteo" required>
          @foreach ($sorteos as $sorteo)
          <option value="{{ $sorteo->id_sorteo }}">{{ $sorteo->rifa->nombre_rifa }} - {{ $sorteo->fecha_sorteo }}</option>
          @endforeach
        </select>
        <button type="submit" class="btn-sortear">Sortear</button>
      </form>
    </div>
    @endif
  </div>

  <!-- Sección Ganador (Oculta por defecto) -->
  <div class="ganador-box" style="display: none;">
    <h2>GANADOR</h2>
    <div class="fields">
      <div class="field">
        <label>Primer Nombre:</label>
        <p class="valor" id="ganador-primer-nombre">N/A</p>
      </div>
      <div class="field">
        <label>Segundo Nombre:</label>
        <p class="valor" id="ganador-segundo-nombre">N/A</p>
      </div>
      <div class="field">
        <label>Primer Apellido:</label>
        <p class="valor" id="ganador-primer-apellido">N/A</p>
      </div>
      <div class="field">
        <label>Segundo Apellido:</label>
        <p class="valor" id="ganador-segundo-apellido">N/A</p>
      </div>
      <div class="field">
        <label>Nombre de la Rifa:</label>
        <p class="valor" id="ganador-nombre-rifa">N/A</p>
      </div>
      <div class="field">
        <label>Fecha Inicio:</label>
        <p class="valor" id="ganador-fecha-inicio">N/A</p>
      </div>
      <div class="field">
        <label>Fecha Sorteo:</label>
        <p class="valor" id="ganador-fecha-sorteo">N/A</p>
      </div>
      <div class="field">
        <label>Premio:</label>
        <p class="valor" id="ganador-premio">N/A</p>
      </div>
      <div class="field">
        <label>Número Ganador:</label>
        <p class="valor" id="ganador-numero">N/A</p>
      </div>
    </div>
  </div>

  <!-- Sección Modificar Fecha (Oculta por defecto) -->
  <div class="fecha-sorteo-container" style="display: none;">
    <label for="fechaSorteo">Fecha del sorteo:</label>
    <input type="date" id="fechaSorteo" value="{{ $sorteo ? $sorteo->fecha_sorteo : '' }}">
    <button class="btn-modificar-fecha">Modificar fecha</button>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const btnSortear = document.querySelector('.btn-sortear');
      const fechaSorteoInput = document.getElementById('fechaSorteo');
      const btnModificarFecha = document.querySelector('.btn-modificar-fecha');

      if (btnSortear) {
        btnSortear.addEventListener('click', function(event) {
          event.preventDefault();

          const idSorteo = document.getElementById('id_sorteo').value;

          fetch("{{ route('admin.sorteo.sortear') }}", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
              },
              body: JSON.stringify({
                id_sorteo: idSorteo
              })
            })
            .then(response => response.json())
            .then(data => {
              const ganadorBox = document.querySelector('.ganador-box');
              const fechaSorteoContainer = document.querySelector('.fecha-sorteo-container');

              if (data.success) {
                if (ganadorBox) {
                  ganadorBox.style.display = 'block';

                  document.getElementById('ganador-primer-nombre').textContent = data.ganador.primer_nombre || 'N/A';
                  document.getElementById('ganador-segundo-nombre').textContent = data.ganador.segundo_nombre || 'N/A';
                  document.getElementById('ganador-primer-apellido').textContent = data.ganador.primer_apellido || 'N/A';
                  document.getElementById('ganador-segundo-apellido').textContent = data.ganador.segundo_apellido || 'N/A';
                  document.getElementById('ganador-nombre-rifa').textContent = data.ganador.nombre_rifa || 'N/A';
                  document.getElementById('ganador-fecha-inicio').textContent = data.ganador.fecha_inicio || 'N/A';
                  document.getElementById('ganador-fecha-sorteo').textContent = data.ganador.fecha_sorteo || 'N/A';
                  document.getElementById('ganador-premio').textContent = data.ganador.premio || 'N/A';
                  document.getElementById('ganador-numero').textContent = data.ganador.numero_ganador || 'N/A';
                }

                if (fechaSorteoContainer) {
                  fechaSorteoContainer.style.display = 'none';
                }

                Swal.fire({
                  icon: 'success',
                  title: 'Se ha encontrado un ganador',
                  text: 'El sorteo se ha realizado con éxito.',
                });
              } else {
                if (fechaSorteoContainer) {
                  fechaSorteoContainer.style.display = 'block';

                  fechaSorteoInput.setAttribute('min', new Date().toISOString().split('T')[0]);
                }

                if (ganadorBox) {
                  ganadorBox.style.display = 'none';
                }

                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: data.message || 'No se pudo determinar un ganador.',
                });
              }
            })
            .catch(error => {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al realizar el sorteo.',
              });
            });
        });
      }

      if (btnModificarFecha) {
        btnModificarFecha.addEventListener('click', function() {
          const idSorteo = document.getElementById('id_sorteo').value;
          const nuevaFecha = fechaSorteoInput.value;

          if (!nuevaFecha || new Date(nuevaFecha) <= new Date()) {
            Swal.fire({
              icon: 'error',
              title: 'Fecha inválida',
              text: 'La fecha del sorteo debe ser mayor a la fecha actual.',
            });
            return;
          }

          fetch(`{{ url('/admin/sorteo/modificar-fecha') }}/${idSorteo}`, {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
              },
              body: JSON.stringify({
                fecha_sorteo: nuevaFecha
              })
            })
            .then(async response => {
              const data = await response.json();

              if (!response.ok) {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: data.message || 'No se pudo actualizar la fecha del sorteo.',
                });
                throw new Error(data.message || 'Error al actualizar la fecha del sorteo.');
              }

              Swal.fire({
                icon: 'success',
                title: 'Fecha actualizada',
                text: data.message || 'La fecha del sorteo se actualizó correctamente.',
              });
            })
            .catch(error => {
              console.error('Error:', error);
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar la fecha del sorteo.',
              });
            });
        });
      }
    });
  </script>
</body>

</html>