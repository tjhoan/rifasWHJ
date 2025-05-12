<?php

namespace Database\Factories;

use App\Models\CarritoNumero;
use App\Models\Carrito;
use App\Models\NumerosRifa;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarritoNumeroFactory extends Factory
{
    protected $model = CarritoNumero::class;

    public function definition()
    {
        return [
            'id_carrito' => Carrito::factory(),
            'id_numero' => NumerosRifa::factory(),
        ];
    }
}
