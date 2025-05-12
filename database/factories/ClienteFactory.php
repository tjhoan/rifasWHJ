<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
            'primer_nombre_cliente' => $this->faker->firstName,
            'segundo_nombre_cliente' => $this->faker->optional()->firstName,
            'primer_apellido_cliente' => $this->faker->lastName,
            'segundo_apellido_cliente' => $this->faker->optional()->lastName,
            'correo_cliente' => $this->faker->unique()->safeEmail,
            'telefono_cliente' => $this->faker->optional()->numerify('##########'),
            'cedula' => $this->faker->unique()->numerify('########'),
            'estado' => 'activo',
        ];
    }
}