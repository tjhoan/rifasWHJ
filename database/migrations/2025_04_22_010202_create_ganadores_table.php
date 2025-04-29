<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ganadores', function (Blueprint $table) {
            $table->id('id_ganador');
            $table->foreignId('id_sorteo')->constrained('sorteos', 'id_sorteo');
            $table->foreignId('id_cliente')->constrained('clientes', 'id_cliente');
            $table->timestamp('fecha_ganador')->useCurrent();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ganadores');
    }
};
