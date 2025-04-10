<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganadores de Rifas</title>
    <link rel="stylesheet" href="{{ asset('css/estilo_ganadores.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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

    <h1>Ganadores de Rifas</h1>
    <main>
        <section class="ganadores-container">
            <div class="ganador-card">
                <img src="{{ asset('img/icono.png') }}" alt="Ícono Rifa" class="icono">
                <div class="info">
                    <h2>Juan Pérez</h2>
                    <p><strong>Número de boleto:</strong> 12345</p>
                    <p><strong>Nombre de la rifa:</strong> cualquier</p>
                    <p><strong>Fecha inicio:</strong> 01/03/2025</p>
                    <p><strong>Fecha sorteo:</strong> 10/03/2025</p>
                    <p><strong>Premio:</strong> Laptop Gamer</p>
                </div>
            </div>

            <div class="ganador-card">
                <img src="{{ asset('img/icono.png') }}" alt="Ícono Rifa" class="icono">
                <div class="info">
                    <h2>María Gómez</h2>
                    <p><strong>Número de boleto:</strong> 67890</p>
                    <p><strong>Nombre de la rifa:</strong> cualquier</p>
                    <p><strong>Fecha inicio:</strong> 05/03/2025</p>
                    <p><strong>Fecha sorteo:</strong> 15/03/2025</p>
                    <p><strong>Premio:</strong> Smartphone</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="social-links">
            <a href="#"><i class="fab fa-whatsapp"></i> Número</a>
            <a href="#"><i class="fab fa-facebook"></i> Perfil</a>
            <a href="#"><i class="fab fa-instagram"></i> Perfil</a>
        </div>
    </footer>
</body>

</html>