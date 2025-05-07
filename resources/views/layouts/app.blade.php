<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rifa')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <header class="header">
        <div class="header-left">
            <div class="hamburger-menu" id="hamburgerMenu">
                <i class="fas fa-bars"></i>
            </div>
            <div class="logo">
                <img src="{{ asset('img/images.png') }}" alt="Logo">
            </div>
        </div>
        <div class="header-right">
            <div class="carrito-contenedor">
                <a href="{{ url('/carrito') }}">
                    <i class="fas fa-shopping-cart carrito-icon"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3>Menú</h3>
            <i class="fas fa-times close-btn" id="closeSidebar"></i>
        </div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Página de Inicio</a></li>
            <li><a href="{{ url('/ganadores') }}"><i class="fas fa-trophy"></i> Ganadores</a></li>
        </ul>
    </aside>

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

    <script>
        const hamburgerMenu = document.getElementById('hamburgerMenu');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        hamburgerMenu.addEventListener('click', () => {
            sidebar.classList.add('open');
            overlay.classList.add('active');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });
    </script>
    @stack('scripts')
</body>

</html>