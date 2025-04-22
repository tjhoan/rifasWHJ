<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('administradores', function (Blueprint $table) {
            $table->id('id_administrador');
            $table->string('nombre_admin');
            $table->string('correo')->unique();
            $table->string('contrasena');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('administradores');
    }
};
