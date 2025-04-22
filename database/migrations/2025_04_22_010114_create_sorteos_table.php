<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sorteos', function (Blueprint $table) {
            $table->id('id_sorteo');
            $table->date('fecha_realizacion');
            $table->string('estado', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sorteos');
    }
};
