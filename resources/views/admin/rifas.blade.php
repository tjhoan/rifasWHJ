<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Administrativo</title>
  <link rel="stylesheet" href="{{ asset('css/adminPanel.css') }}">
</head>
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
      <div class="rifa-card">
        <div class="rifa-icon">
          <img src="{{ asset('img/pc-gamer.png') }}" alt="Ícono Rifa">
        </div>
        <div class="rifa-info">
          <p><strong>Nombre:</strong> Rifa Especial</p>
          <p><strong>Cantidad vendida:</strong> 50</p>
          <p><strong>Precio:</strong> $10</p>
          <p><strong>Fecha inicio:</strong> 01/04/2025</p>
          <p><strong>Fecha sorteo:</strong> 30/04/2025</p>
          <p><strong>Premio:</strong> Laptop Gamer</p>
        </div>
        <div class="rifa-boletos">
          <span>234</span>
          <span>235</span>
          <span>236</span>
          <span>237</span>
          <span>238</span>
          <span>238</span>
          <span>231</span>
          <span>232</span>
          <span>233</span>
          <span>240</span>
          <span>241</span>
          <span>242</span>
          <span>243</span>
          <span>244</span>
        </div>
      </div>

      <div class="rifa-card">
        <div class="rifa-icon">
          <img src="{{ asset('img/iphone.jpg') }}" alt="Ícono Rifa">
        </div>
        <div class="rifa-info">
          <p><strong>Nombre:</strong> Rifa Oro</p>
          <p><strong>Cantidad vendida:</strong> 30</p>
          <p><strong>Precio:</strong> $5</p>
          <p><strong>Fecha inicio:</strong> 05/04/2025</p>
          <p><strong>Fecha sorteo:</strong> 25/04/2025</p>
          <p><strong>Premio:</strong> Smartphone</p>
        </div>
        <div class="rifa-boletos">
          <span>345</span>
          <span>346</span>
          <span>347</span>
          <span>348</span>
          <span>349</span>
        </div>
      </div>
    </section>
  </div>

</body>
</html>
