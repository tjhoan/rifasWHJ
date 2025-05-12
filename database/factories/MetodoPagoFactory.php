<?php

namespace Database\Factories;

use App\Models\MetodoPago;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetodoPagoFactory extends Factory
{
    protected $model = MetodoPago::class;

    public function definition()
    {
        return [
            'nombre_metodo' => $this->faker->unique()->randomElement(['Paypal', 'Efectivo', 'Tarjeta']),
            'digito_cuenta' => $this->faker->numerify('####'),
            'estado' => 'activo',
        ];
    }
}