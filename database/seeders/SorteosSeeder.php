<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SorteosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sorteos')->insert([
            [
                'id_sorteo' => 1,
                'id_rifa' => 1,
                'fecha_sorteo' => '2025-06-22',
                'estado' => 'sin_ganador',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_sorteo' => 2,
                'id_rifa' => 2,
                'fecha_sorteo' => '2025-06-22',
                'estado' => 'sin_ganador',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_sorteo' => 3,
                'id_rifa' => 3,
                'fecha_sorteo' => '2025-06-22',
                'estado' => 'sin_ganador',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
