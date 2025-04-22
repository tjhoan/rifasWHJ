<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->string('cedula', 20)->primary();
            $table->string('primer_nombre', 50);
            $table->string('segundo_nombre', 50)->nullable();
            $table->string('primer_apellido', 50);
            $table->string('segundo_apellido', 50)->nullable();
            $table->string('correo', 100)->unique();
            $table->string('celular', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
