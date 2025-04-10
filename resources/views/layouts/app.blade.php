<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rifa')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @stack('styles')
</head>

<body>
    <header class="header">
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">Página de Inicio</a></li>
            <li><a href="{{ url('/ganadores') }}">Ganadores</a></li>
            <li><a href="{{ url('/compras') }}">Compras</a></li>
            <li><a href="{{ url('/facturar') }}">Factura</a></li>
        </ul>
        <div class="logo">
            <img src="{{ asset('img/images.png') }}" alt="Logo">
        </div>
        <div class="header-right">
            <div class="carrito-contenedor">
                <a href="{{ url('/carrito') }}">
                    <img src="{{ asset('img/verificar.png') }}" alt="Carrito de compras" class="carrito-imagen">
                </a>
            </div>
            <div class="user-icon">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
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