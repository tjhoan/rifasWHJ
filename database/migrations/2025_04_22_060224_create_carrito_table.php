<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id('id_carrito');
            $table->unsignedBigInteger('id_rifa');
            $table->unsignedBigInteger('id_numero');
            $table->integer('cantidad')->default(1);
            $table->string('estado')->default('activo');
            $table->foreign('id_rifa')->references('id_rifa')->on('rifas')->onDelete('cascade');
            $table->foreign('id_numero')->references('id')->on('numeros_rifas')->onDelete('cascade');
            $table->timestamp('fecha_creacion')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};
