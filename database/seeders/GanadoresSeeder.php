<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GanadoresSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ganadores')->insert([
            [
                'boletos_ganador' => '34601',
                'nombre_ganador' => 'Juan Pérez',
                'id_sorteo' => 1,
                'id_rifa' => 1
            ],
            [
                'boletos_ganador' => '67890',
                'nombre_ganador' => 'María Gómez',
                'id_sorteo' => 2,
                'id_rifa' => 2
            ],
        ]);
    }
}
