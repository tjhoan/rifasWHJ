<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_ventas');
            $table->string('factura', 50);
            $table->string('ticket', 50);
            $table->string('estado', 20);
            $table->string('cedula_cliente', 20);
            $table->unsignedBigInteger('id_metodo_pago');
            $table->unsignedBigInteger('id_rifa');
            $table->foreign('cedula_cliente')->references('cedula')->on('clientes');
            $table->foreign('id_metodo_pago')->references('id_metodo_pago')->on('metodos_pago');
            $table->foreign('id_rifa')->references('id_rifa')->on('rifas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
