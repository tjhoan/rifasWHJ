<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
    <link href="{{ asset('css/compras.css') }}" rel="stylesheet">
</head>

<body>
    <header>
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
    <main class="main-content">
        <section class="info-section">
            <div class="rifa-image">
                <img src="{{ asset('img/rifa-icon.png') }}" alt="Imagen de la Rifa">
            </div>
            <div class="info-container">
                <div class="left-info">
                    <p><strong>Nombre Rifa:</strong></p>
                    <label class="option"><input type="checkbox"> Separar</label>
                    <label class="option"><input type="checkbox"> Comprar</label>
                </div>
                <div class="right-info">
                    <p class="pp"><strong>Fecha inicio:</strong></p>
                    <p><strong>Fecha sorteo:</strong></p>
                    <p><strong>Premio:</strong></p>
                </div>
            </div>
        </section>
        <section class="search-section">
            <input type="text" placeholder="Barra de búsqueda números" class="search-bar">
            <button class="search-button">🔍</button>
        </section>
        <section class="numbers-section">
            <div class="numbers-grid">
                <button class="number">2345</button>
                <button class="number">2345</button>
                <button class="number selected">2345</button>
                <button class="number">2345</button>
                <button class="number">2345</button>
                <button class="number">2345</button>
                <button class="number">2345</button>
                <button class="number selected">2345</button>
                <button class="number">2345</button>
            </div>
        </section>
        <section class="actions-section">
            <button class="action-button">Añadir al carrito</button>
            <button class="action-button">Facturar</button>
        </section>
    </main>

    <footer>
        <div class="social-links">
            <a href="#"><i class="fab fa-whatsapp"></i> Número</a>
            <a href="#"><i class="fab fa-facebook"></i> Perfil</a>
            <a href="#"><i class="fab fa-instagram"></i> Perfil</a>
        </div>
    </footer>
    <script src="{{ asset('js/compras.js') }}"></script>
</body>

</html>