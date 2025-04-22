<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('datos_empresa', function (Blueprint $table) {
            $table->string('NIT', 20)->primary();
            $table->string('nombre_empresa', 100);
            $table->string('direccion', 255);
            $table->string('celular', 20);
            $table->string('redes_sociales', 255)->nullable();
            $table->unsignedBigInteger('id_administrador');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('datos_empresa');
    }
};
