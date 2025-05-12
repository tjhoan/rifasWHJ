<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{
    protected $model = Empresa::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->company,
            'NIT' => $this->faker->numerify('#########'),
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->numerify('##########')
        ];
    }
}