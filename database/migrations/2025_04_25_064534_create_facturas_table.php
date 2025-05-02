<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('id_factura');
            $table->foreignId('id_cliente')->constrained('clientes', 'id_cliente');
            $table->foreignId('id_carrito')->constrained('carrito', 'id_carrito');
            $table->timestamp('fecha_compra')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('metodo_pago');
            $table->enum('estado', ['pagado', 'pendiente', 'cancelado'])->default('pendiente');
            $table->decimal('total', 10, 2);
            $table->enum('tipo_compra', ['comprar', 'separar']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
