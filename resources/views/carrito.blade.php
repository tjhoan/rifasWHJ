<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito de Compras</title>
  <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
  <header class="header">
    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Página de Inicio</a></li>
        <li><a href="{{ url('/ganadores') }}">Ganadores</a></li>
    </ul>
    <div class="logo">
        <img src="{{ asset('img/images.png') }}" alt="Logo">
    </div>
  </header>

  <main>
    <h1 class="titulo-carrito">Carrito de compras</h1>

    <div class="carrito-item">
      <img src="{{ asset('img/image.png') }}" alt="Icono" class="item-icono">
      <div class="item-info">
        <div>
          <strong>Nombre Rifa: cualquiera</strong><br>
          Boleto Seleccionado (Número): 455545<br>
          Para: cancelar o separar
        </div>
        <div>
          Fecha inicio: 05/12/2025<br>
          Fecha sorteo: 05/12/2025<br>
          Premio: celular 
        </div>
      </div>
    </div>

    <div class="carrito-item">
      <img src="{{ asset('img/image.png') }}" alt="Icono" class="item-icono">
      <div class="item-info">
        <div>
          <strong>Nombre Rifa: cualquiera</strong><br>
          Boleto Seleccionado (Número): 455545<br>
          Para: cancelar o separar
        </div>
        <div>
          Fecha inicio: 05/12/2025<br>
          Fecha sorteo: 05/12/2025<br>
          Premio: televisión 
        </div>
      </div>
    </div>

    <div class="divisor">//</div>

    <form action="{{ url('/facturar') }}" method="GET">
    <button type="submit" class="btn-facturar">Facturar</button>
</form>

    
    <!-- <button class="btn-facturar">Facturar</button> -->
  </main>

  <footer class="footer">
    <div class="social-links">
        <a href="#"><i class="fab fa-whatsapp"></i> Número</a>
        <a href="#"><i class="fab fa-facebook"></i> Perfil</a>
        <a href="#"><i class="fab fa-instagram"></i> Perfil</a>
    </div>
  </footer>
</body>
</html>
