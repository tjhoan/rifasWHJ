<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Recibos</title>
    <link rel="stylesheet" href="{{ asset('css/finalizar-recibos.css') }}" />
</head>

<body>
    <main>
        <div class="img-logo">
            <h1>{{ $tipoAccion == 'separar' ? 'TICKET' : 'FACTURA' }}</h1>
        </div>

        <form method="POST" action="{{ url('/guardar-datos-empresa') }}">
            @csrf
            <div class="grid-container">
                <div class="form-group">
                    <label for="empresa">Nombre Empresa:</label>
                    <input type="text" id="empresa" name="empresa" value="{{ $empresa->nombre }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nit">NIT:</label>
                    <input type="text" id="nit" name="nit" value="{{ $empresa->NIT }}" readonly>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="{{ $empresa->direccion }}" readonly>
                </div>
                <div class="form-group">
                    <label for="celular">Celular:</label>
                    <input type="text" id="celular" name="celular" value="{{ $empresa->telefono }}" readonly>
                </div>

                <div class="form-group full-width fecha-container">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" value="{{ $factura->fecha_compra->format('Y-m-d') }}" readonly>
                </div>

                <div class="form-group">
                    <label for="primer-nombre">Primer Nombre:</label>
                    <input type="text" id="primer-nombre" name="primer-nombre" value="{{ $cliente->primer_nombre_cliente }}" readonly>
                </div>
                <div class="form-group">
                    <label for="segundo-nombre">Segundo Nombre:</label>
                    <input type="text" id="segundo-nombre" name="segundo-nombre" value="{{ $cliente->segundo_nombre_cliente }}" readonly>
                </div>
                <div class="form-group">
                    <label for="primer-apellido">Primer Apellido:</label>
                    <input type="text" id="primer-apellido" name="primer-apellido" value="{{ $cliente->primer_apellido_cliente }}" readonly>
                </div>
                <div class="form-group">
                    <label for="segundo-apellido">Segundo Apellido:</label>
                    <input type="text" id="segundo-apellido" name="segundo-apellido" value="{{ $cliente->segundo_apellido_cliente }}" readonly>
                </div>
            </div>
            <div class="form-group-row">
                <div class="form-group">
                    <label for="celular2">Celular:</label>
                    <input type="text" id="celular2" name="celular2" value="{{ $cliente->telefono_cliente }}" readonly>
                </div>
                <div class="form-group correo-group">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" id="correo" name="correo" value="{{ $cliente->correo_cliente }}" readonly>
                </div>
                <div class="form-group">
                    <label for="cedula">Cédula:</label>
                    <input type="text" id="cedula" name="cedula" value="{{ $cliente->cedula }}" readonly>
                </div>
            </div>

            <div class="total-pagar-container">
                <h2 class="total-pagar">Total a pagar: <span>${{ number_format($factura->total) }}</span></h2>
            </div>

            <!-- Raffle Information -->
            <section class="raffle-section">
                <div class="raffle-grid">
                    <div class="left-column">
                        <div class="row">
                            <label>Nombre Rifa:</label>
                            <span>{{ $carrito->numeros->first()->rifa->nombre_rifa }}</span>
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
                            <span>{{ $carrito->numeros->first()->rifa->fecha_inicio }}</span>
                        </div>
                        <div class="row">
                            <label>Fecha sorteo:</label>
                            <span>{{ $carrito->numeros->first()->rifa->fecha_sorteo }}</span>
                        </div>
                        <div class="row">
                            <label>Premio:</label>
                            <span>{{ number_format($carrito->numeros->first()->rifa->premio) }}</span>
                        </div>
                    </div>
                </div>
                @if($tipoAccion == 'separar')
                <div class="container-row">
                    <span>Valido hasta: {{ now()->addDays(3)->format('d/m/Y') }}</span>
                </div>
                <div class="container-row">
                    <span>Boleto no cancelado no participa</span>
                </div>
                @endif
            </section>
        </form>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = "{{ session('success') }}";
            const errorMessage = "{{ session('error') }}";

            if (successMessage) {
                Swal.fire({
                    icon: "success",
                    title: "¡Éxito!",
                    text: successMessage,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Aceptar",
                });
            }

            if (errorMessage) {
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: errorMessage,
                    confirmButtonColor: "#d33",
                    confirmButtonText: "Aceptar",
                });
            }
        });
    </script>
</body>

</html>