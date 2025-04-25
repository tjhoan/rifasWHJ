<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('correo')->unique();
            $table->string('contrasena');
            $table->string('nombre_admin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
