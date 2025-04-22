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
            $table->string('boletos_ganador', 100);
            $table->string('nombre_ganador', 100);
            $table->unsignedBigInteger('id_sorteo');
            $table->unsignedBigInteger('id_rifa');
            $table->foreign('id_sorteo')->references('id_sorteo')->on('sorteos');
            $table->foreign('id_rifa')->references('id_rifa')->on('rifas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ganadores');
    }
};
