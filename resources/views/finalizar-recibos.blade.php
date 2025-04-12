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
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
            </div>
            <h1>TICKET</h1>
        </div>

        <form>
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
                    <input type="date" id="fecha" name="fecha">
                </div>

                <div class="form-group">
                    <label for="primer-nombre">Primer Nombre:</label>
                    <input type="text" id="primer-nombre" name="primer-nombre">
                </div>
                <div class="form-group">
                    <label for="segundo-nombre">Segundo Nombre:</label>
                    <input type="text" id="segundo-nombre" name="segundo-nombre">
                </div>
                <div class="form-group">
                    <label for="primer-apellido">Primer Apellido:</label>
                    <input type="text" id="primer-apellido" name="primer-apellido">
                </div>
                <div class="form-group">
                    <label for="segundo-apellido">Segundo Apellido:</label>
                    <input type="text" id="segundo-apellido" name="segundo-apellido">
                </div>
            </div>
            <div class="form-group-row">
                <div class="form-group">
                    <label for="celular2">Celular:</label>
                    <input type="text" id="celular2" name="celular2">
                </div>
                <div class="form-group correo-group">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" id="correo" name="correo">
                </div>
                <div class="form-group">
                    <label for="cedula">Cédula:</label>
                    <input type="text" id="cedula" name="cedula">
                </div>
            </div>

            <!-- Raffle Information -->
            <section class="raffle-section">
                <div class="raffle-grid">

                <div class="left-column">
                        <div class="row">
                            <label>Nombre Rifa:</label>
                            <span>Baloto</span>
                        </div>
                        <div class="row">
                            <label>Separar:</label>
                            <input type="checkbox">
                        </div>
                        <div class="row">
                            <label>Comprar:</label>
                            <input type="checkbox">
                        </div>
                    </div>

                    <div class="right-column">
                        <div class="row">
                            <label>Fecha inicio:</label>
                            <span>14/06/2025</span>
                        </div>
                        <div class="row">
                            <label>Fecha sorteo:</label>
                            <span>20/12/2025</span>
                        </div>
                        <div class="row">
                            <label>Premio:</label>
                            <span>$2.000.000</span>
                        </div>
                    </div>
                </div>
                <div class="container-row">
                    <span>Valido hasta: 20/12/2025</span>
                </div>
                <div class="container-row">
                    <span>Boleto no cancelado no participa</span>
                </div>
            </section>
        </form>
    </main>
</body>

</html>