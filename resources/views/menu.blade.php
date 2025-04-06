<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Rifas</title>
    <link rel="stylesheet" href="{{ asset('css/estilos_menu.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">Página de Inicio</a></li>
            <li><a href="{{ url('/ganadores') }}">Ganadores</a></li>
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
    
    <h1>COMPRAS DE RIFAS</h1>
    <main>
        <section class="rifas-container">
            <div class="rifa-card">
                <img src="{{ asset('img/rifa-icon.png') }}" alt="Rifa">
                <div class="info">
                    <p><strong>Nombre:</strong> Rifa Ejemplo</p>
                    <p><strong>Cantidad vendida:</strong> 50</p>
                    <p><strong>Precio:</strong> $10</p>
                    <p><strong>Fecha inicio:</strong> 01/04/2025</p>
                    <p><strong>Fecha sorteo:</strong> 30/04/2025</p>
                    <p><strong>Premio:</strong> Laptop Gamer</p>
                </div>
                <button class="comprar-btn">Comprar</button>
            </div>
            
            <div class="rifa-card">
                <img src="{{ asset('img/rifa-icon.png') }}" alt="Rifa">
                <div class="info">
                    <p><strong>Nombre:</strong> Rifa Especial</p>
                    <p><strong>Cantidad vendida:</strong> 30</p>
                    <p><strong>Precio:</strong> $5</p>
                    <p><strong>Fecha inicio:</strong> 05/04/2025</p>
                    <p><strong>Fecha sorteo:</strong> 25/04/2025</p>
                    <p><strong>Premio:</strong> Smartphone</p>
                </div>
                <button class="comprar-btn">Comprar</button>
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
