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
                'id_sorteo' => 1,
                'id_cliente' => 1,
                'fecha_ganador' => now(),
                'estado' => 'activo'
            ],
            [
                'id_sorteo' => 2,
                'id_cliente' => 2,
                'fecha_ganador' => now(),
                'estado' => 'activo'
            ],
        ]);
    }
}
