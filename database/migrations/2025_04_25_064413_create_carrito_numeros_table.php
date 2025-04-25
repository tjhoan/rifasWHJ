<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito_numeros', function (Blueprint $table) {
            $table->foreignId('id_carrito')->constrained('carrito');
            $table->foreignId('id_numero')->constrained('numeros_rifa');
            $table->primary(['id_carrito', 'id_numero']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito_numeros');
    }
};
