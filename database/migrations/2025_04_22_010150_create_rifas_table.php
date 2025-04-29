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
            $table->string('nombre_rifa');
            $table->string('imagen_rifa', 512)->nullable();
            $table->decimal('precio_boleto', 10, 2);
            $table->integer('cantidad_boletos');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->date('fecha_sorteo');
            $table->text('premio');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rifas');
    }
};
