<?php

namespace Database\Factories;

use App\Models\Rifa;
use Illuminate\Database\Eloquent\Factories\Factory;

class RifaFactory extends Factory
{
    protected $model = Rifa::class;

    public function definition()
    {
        return [
            'nombre_rifa' => $this->faker->word,
            'imagen_rifa' => $this->faker->imageUrl(),
            'precio_boleto' => $this->faker->randomFloat(2, 1000, 10000),
            'cantidad_boletos' => $this->faker->numberBetween(10, 100),
            'fecha_inicio' => $this->faker->date(),
            'fecha_sorteo' => $this->faker->date('Y-m-d', '+1 month'),
            'premio' => $this->faker->randomNumber(6),
            'estado' => 'activo',
        ];
    }
}
