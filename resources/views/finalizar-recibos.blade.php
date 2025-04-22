<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Recibos</title>
    <link rel="stylesheet" href="{{ asset('css/finalizar-recibos.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <main>
        <div class="img-logo">
            <div class="logo">
                <img src="{{ $carrito->first()->rifa->imagenes->first()->ruta_imagen ?? asset('images/default-logo.png') }}" alt="Logo">
            </div>
            <h1>{{ $tipoAccion == 'separar' ? 'TICKET' : 'FACTURA' }}</h1>
        </div>

        <form method="POST" action="{{ url('/guardar-datos-empresa') }}">
            @csrf
            <div class="grid-container">
                <div class="form-group">
                    <label for="empresa">Nombre Empresa:</label>
                    <input type="text" id="empresa" name="empresa">
                </div>
                <div class="form-group">
                    <label for="nit">NIT:</label>
                    <input type="text" id="nit" name="nit">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion">
                </div>
                <div class="form-group">
                    <label for="celular">Celular:</label>
                    <input type="text" id="celular" name="celular">
                </div>

                <div class="form-group full-width fecha-container">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                </div>

                <div class="form-group">
                    <label for="primer-nombre">Primer Nombre:</label>
                    <input type="text" id="primer-nombre" name="primer-nombre" value="{{ $cliente['primer_nombre'] ?? '' }}" readonly>
                </div>
                <div class="form-group">
                    <label for="segundo-nombre">Segundo Nombre:</label>
                    <input type="text" id="segundo-nombre" name="segundo-nombre" value="{{ $cliente['segundo_nombre'] ?? '' }}" readonly>
                </div>
                <div class="form-group">
                    <label for="primer-apellido">Primer Apellido:</label>
                    <input type="text" id="primer-apellido" name="primer-apellido" value="{{ $cliente['primer_apellido'] ?? '' }}" readonly>
                </div>
                <div class="form-group">
                    <label for="segundo-apellido">Segundo Apellido:</label>
                    <input type="text" id="segundo-apellido" name="segundo-apellido" value="{{ $cliente['segundo_apellido'] ?? '' }}" readonly>
                </div>
            </div>
            <div class="form-group-row">
                <div class="form-group">
                    <label for="celular2">Celular:</label>
                    <input type="text" id="celular2" name="celular2" value="{{ $cliente['celular'] ?? '' }}" readonly>
                </div>
                <div class="form-group correo-group">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" id="correo" name="correo" value="{{ $cliente['correo'] ?? '' }}" readonly>
                </div>
                <div class="form-group">
                    <label for="cedula">Cédula:</label>
                    <input type="text" id="cedula" name="cedula" value="{{ $cliente['cedula'] ?? '' }}" readonly>
                </div>
            </div>


            <div class="total-pagar-container">
                <h2 class="total-pagar">Total a pagar: <span>${{ number_format($total) }}</span></h2>
            </div>

            <!-- Raffle Information -->
            <section class="raffle-section">
                @if($carrito->isNotEmpty())
                <div class="raffle-grid">
                    <div class="left-column">
                        <div class="row">
                            <label>Nombre Rifa:</label>
                            <span>{{ $carrito->first()->rifa->nombre ?? 'N/A' }}</span>
                        </div>
                        <div class="row">
                            <label>Separar:</label>
                            <input type="checkbox" disabled {{ $tipoAccion == 'separar' ? 'checked' : '' }}>
                        </div>
                        <div class="row">
                            <label>Comprar:</label>
                            <input type="checkbox" disabled {{ $tipoAccion == 'comprar' ? 'checked' : '' }}>
                        </div>
                    </div>

                    <div class="right-column">
                        <div class="row">
                            <label>Fecha inicio:</label>
                            <span>{{ $carrito->first()->rifa->fecha_inicio ? \Carbon\Carbon::parse($carrito->first()->rifa->fecha_inicio)->format('d/m/Y') : 'N/A' }}</span>
                        </div>
                        <div class="row">
                            <label>Fecha sorteo:</label>
                            <span>{{ $carrito->first()->rifa->fecha_sorteo ? \Carbon\Carbon::parse($carrito->first()->rifa->fecha_sorteo)->format('d/m/Y') : 'N/A' }}</span>
                        </div>
                        <div class="row">
                            <label>Premio:</label>
                            <span>{{ $carrito->first()->rifa->premio }}</span>
                        </div>
                    </div>
                </div>
                @if($tipoAccion == 'separar')
                <div class="container-row">
                    <span>Valido hasta: {{ $carrito->first()->rifa->fecha_sorteo }}</span>
                </div>
                <div class="container-row">
                    <span>Boleto no cancelado no participa</span>
                </div>
                @endif
                @endif
            </section>
        </form>
    </main>
</body>

</html>