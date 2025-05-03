<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Sorteo - Panel Administrativo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/admin/sorteo.css') }}">
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

    @if ($errors->any())
    <div class="error-box">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

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

    <!-- Datos del Ganador -->
    <div class="ganador-box">
      <h2>GANADOR</h2>
      <div class="fields">
        <div class="field">
          <label>Primer Nombre:</label>
          <p class="valor" id="ganador-primer-nombre"></p>
        </div>
        <div class="field">
          <label>Segundo Nombre:</label>
          <p class="valor" id="ganador-segundo-nombre"></p>
        </div>
        <div class="field">
          <label>Primer Apellido:</label>
          <p class="valor" id="ganador-primer-apellido"></p>
        </div>
        <div class="field">
          <label>Segundo Apellido:</label>
          <p class="valor" id="ganador-segundo-apellido"></p>
        </div>
        <div class="field">
          <label>Nombre de la Rifa:</label>
          <p class="valor" id="ganador-nombre-rifa"></p>
        </div>
        <div class="field">
          <label>Fecha Inicio:</label>
          <p class="valor" id="ganador-fecha-inicio"></p>
        </div>
        <div class="field">
          <label>Fecha Sorteo:</label>
          <p class="valor" id="ganador-fecha-sorteo"></p>
        </div>
        <div class="field">
          <label>Premio:</label>
          <p class="valor" id="ganador-premio"></p>
        </div>
        <div class="field">
          <label>Número Ganador:</label>
          <p class="valor" id="ganador-numero"></p>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.querySelector('.btn-sortear').addEventListener('click', function(event) {
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
          if (!data.success || !data.ganador) {
            alert(data.message || 'Error al realizar el sorteo.');
            return;
          }

          document.getElementById('ganador-primer-nombre').textContent = data.ganador.primer_nombre || '';
          document.getElementById('ganador-segundo-nombre').textContent = data.ganador.segundo_nombre || '';
          document.getElementById('ganador-primer-apellido').textContent = data.ganador.primer_apellido || '';
          document.getElementById('ganador-segundo-apellido').textContent = data.ganador.segundo_apellido || '';
          document.getElementById('ganador-nombre-rifa').textContent = data.ganador.nombre_rifa || '';
          document.getElementById('ganador-fecha-inicio').textContent = data.ganador.fecha_inicio || '';
          document.getElementById('ganador-fecha-sorteo').textContent = data.ganador.fecha_sorteo || '';
          document.getElementById('ganador-premio').textContent = data.ganador.premio || '';
          document.getElementById('ganador-numero').textContent = data.ganador.numero_ganador || '';
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Error al realizar el sorteo.');
        });
    });
  </script>
</body>

</html>