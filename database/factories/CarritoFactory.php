<?php

namespace Database\Factories;

use App\Models\Carrito;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarritoFactory extends Factory
{
    protected $model = Carrito::class;

    public function definition()
    {
        return [
            'id_cliente' => Cliente::factory(),
            'estado' => 'activo',
        ];
    }
}
