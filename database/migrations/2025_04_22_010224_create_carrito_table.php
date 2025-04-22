<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id('id_carrito');
            $table->integer('cantidad');
            $table->date('fecha_creacion');
            $table->unsignedBigInteger('id_rifa');
            $table->foreign('id_rifa')->references('id_rifa')->on('rifas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};
