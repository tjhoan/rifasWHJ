<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
</head>
<body>
    <h1>Factura de Compra</h1>
    <p>Hola {{ $cliente->primer_nombre_cliente }} {{ $cliente->primer_apellido_cliente }},</p>
    <p>Gracias por tu compra. Aquí están los detalles de tu factura:</p>

    <h2>Detalles de la Factura</h2>
    <ul>
        <li><strong>Número de Factura:</strong> {{ $factura->id_factura }}</li>
        <li><strong>Fecha de Compra:</strong> {{ $factura->fecha_compra }}</li>
        <li><strong>Total:</strong> ${{ $factura->total }}</li>
        <li><strong>Método de Pago:</strong> {{ $factura->metodo_pago }}</li>
        <li><strong>Tipo de Compra:</strong> {{ ucfirst($factura->tipo_compra) }}</li>
    </ul>

    <h2>Detalles de la Rifa</h2>
    <ul>
        <li><strong>Nombre de la Rifa:</strong> {{ $carrito->numeros->first()->rifa->nombre_rifa }}</li>
        <li><strong>Premio:</strong> {{ $carrito->numeros->first()->rifa->premio }}</li>
        <li><strong>Fecha del Sorteo:</strong> {{ $carrito->numeros->first()->rifa->fecha_sorteo }}</li>
    </ul>

    <p>¡Buena suerte!</p>
</body>
</html>