@extends('layouts.app')

@section('title', 'Gestión de Rifas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<h1>Compras de Rifas</h1>
<section class="rifas-container">
    @foreach ($rifas as $rifa)
    <div class="rifa-card">
        <img alt="Rifa" src="{{ filter_var($rifa->imagen_rifa, FILTER_VALIDATE_URL) ? $rifa->imagen_rifa : asset('storage/' . $rifa->imagen_rifa) }}">
        <div class="info">
            <div class="left">
                <p><strong>Nombre:</strong> {{ $rifa->nombre_rifa }}</p>
                <p><strong>Cantidad de boletos:</strong> {{ $rifa->cantidad_boletos }}</p>
                <p><strong>Precio por boleto:</strong> ${{ number_format((float) $rifa->precio_boleto, 0) }}</p>
            </div>
            <div class="right">
                <p><strong>Fecha inicio:</strong> {{ \Carbon\Carbon::parse($rifa->fecha_inicio)->format('d/m/Y') }}</p>
                <p><strong>Fecha sorteo:</strong> {{ \Carbon\Carbon::parse($rifa->fecha_sorteo)->format('d/m/Y') }}</p>
                <p><strong>Premio:</strong> ${{ number_format((float) $rifa->premio, 0) }}</p>
            </div>
        </div>
        <a href="{{ route('compras.show', $rifa->id_rifa) }}" class="comprar-btn">Comprar</a>
    </div>
    @endforeach
</section>
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
@endsection