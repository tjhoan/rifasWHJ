<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('numeros_rifa', function (Blueprint $table) {
            $table->id('id_numero');
            $table->foreignId('id_rifa')->constrained('rifas', 'id_rifa');
            $table->integer('numero');
            $table->foreignId('id_cliente')->nullable()->constrained('clientes', 'id_cliente');
            $table->enum('estado', ['disponible', 'vendido', 'reservado'])->default('disponible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('numeros_rifa');
    }
};
