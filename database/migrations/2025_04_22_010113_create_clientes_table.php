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
            $table->string('primer_nombre_cliente');
            $table->string('segundo_nombre_cliente')->nullable();
            $table->string('primer_apellido_cliente');
            $table->string('segundo_apellido_cliente')->nullable();
            $table->string('correo_cliente')->unique();
            $table->string('telefono_cliente', 15)->nullable();
            $table->string('cedula')->unique();
            $table->timestamps(); 
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
