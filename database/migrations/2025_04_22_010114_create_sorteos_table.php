<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sorteos', function (Blueprint $table) {
            $table->id('id_sorteo');
            $table->foreignId('id_rifa')->constrained('rifas');
            $table->date('fecha_sorteo');
            $table->foreignId('ganador_id_cliente')->nullable()->constrained('clientes');
            $table->integer('numero_ganador')->nullable();
            $table->enum('estado', ['realizado', 'sin_ganador', 'sin_reclamo', 'anulado'])->default('sin_ganador');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sorteos');
    }
};
