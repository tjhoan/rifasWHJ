<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('imagen_rifa', function (Blueprint $table) {
            $table->id('id_imagen');
            $table->string('ruta_imagen', 255);
            $table->unsignedBigInteger('id_rifa');
            $table->foreign('id_rifa')->references('id_rifa')->on('rifas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagen_rifa');
    }
};
