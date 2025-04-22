<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('metodos_pago', function (Blueprint $table) {
            $table->id('id_metodo_pago');
            $table->date('fecha_pago');
            $table->decimal('total_pago', 10, 2);
            $table->string('metodo_pago', 50);
            $table->unsignedBigInteger('id_administrador');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metodos_pago');
    }
};
