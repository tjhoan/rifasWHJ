@extends('layouts.app')

@section('title', 'Gestión de Rifas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<h1>Compras De Rifas</h1>
<main>
    <section class="rifas-container">
        <div class="rifa-card">
            <img alt="Rifa" src="{{ asset('https://cdn.clarosports.com/clarosports/2024/06/balotook12-071239-1024x576.jpg') }}">
            <div class="info">
                <div class="left">
                    <p><strong>Nombre:</strong> Baloto</p>
                    <p><strong>Cantidad vendida:</strong> 50</p>
                    <p><strong>Precio:</strong> $2.000</p>
                </div>
                <div class="right">
                    <p><strong>Fecha inicio:</strong> 01/04/2025</p>
                    <p><strong>Fecha sorteo:</strong> 30/04/2025</p>
                    <p><strong>Premio:</strong> $1.2000.000</p>
                </div>
            </div>
            <a href="/compras" class="comprar-btn">Comprar</a>
        </div>

        <div class="rifa-card">
            <img alt="Rifa" src="{{ asset('https://caracoltv.brightspotcdn.com/dims4/default/c5c6777/2147483647/strip/true/crop/1280x720+0+0/resize/800x450!/quality/75/?url=http%3A%2F%2Fcaracol-brightspot.s3.us-west-2.amazonaws.com%2F9c%2F0a%2Fc45d6e02461dbf01d4c0bf9d0d20%2Floteria-del-valle.jpg') }}">
            <div class="info">
                <div class="left">
                    <p><strong>Nombre:</strong> Loteria del Valle</p>
                    <p><strong>Cantidad vendida:</strong> 120</p>
                    <p><strong>Precio:</strong> $1.500</p>
                </div>
                <div class="right">
                    <p><strong>Fecha inicio:</strong> 05/04/2025</p>
                    <p><strong>Fecha sorteo:</strong> 25/04/2025</p>
                    <p><strong>Premio:</strong> $2.000.000</p>
                </div>
            </div>
            <a href="/compras" class="comprar-btn">Comprar</a>
        </div>
    </section>
</main>
@endsection