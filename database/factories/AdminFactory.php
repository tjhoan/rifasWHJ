<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'correo' => $this->faker->unique()->safeEmail,
            'contrasena' => Hash::make('password'),
            'nombre_admin' => $this->faker->name
        ];
    }
}