<?php

namespace Database\Factories;

use App\Models\NumerosRifa;
use App\Models\Rifa;
use Illuminate\Database\Eloquent\Factories\Factory;

class NumerosRifaFactory extends Factory
{
    protected $model = NumerosRifa::class;

    public function definition()
    {
        return [
            'id_rifa' => Rifa::factory(),
            'numero' => $this->faker->randomNumber(4),
            'estado' => 'disponible',
        ];
    }
}
