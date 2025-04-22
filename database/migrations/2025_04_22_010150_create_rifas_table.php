<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rifas', function (Blueprint $table) {
            $table->id('id_rifa');
            $table->string('nombre', 100);
            $table->string('premio', 100);
            $table->decimal('precio', 10, 2);
            $table->integer('cantidad_numero');
            $table->date('fecha_inicio');
            $table->date('fecha_sorteo');
            $table->unsignedBigInteger('id_administrador');
            $table->unsignedBigInteger('id_sorteo');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores');
            $table->foreign('id_sorteo')->references('id_sorteo')->on('sorteos');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rifas');
    }
};
