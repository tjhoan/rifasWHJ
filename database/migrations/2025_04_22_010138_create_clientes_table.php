<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nombre_cliente');
            $table->string('correo_cliente')->unique();
            $table->string('telefono_cliente', 15)->nullable();
            $table->text('direccion_cliente')->nullable();
            $table->timestamps(); // Añade created_at y updated_at
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
