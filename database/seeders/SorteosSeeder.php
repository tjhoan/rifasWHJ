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
                'fecha_sorteo' => '2025-04-22',
                'ganador_id_cliente' => 1,
                'numero_ganador' => 123456,
                'estado' => 'sin_reclamo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_sorteo' => 2,
                'id_rifa' => 2,
                'fecha_sorteo' => '2025-05-22',
                'ganador_id_cliente' => 1,
                'numero_ganador' => 223,
                'estado' => 'sin_reclamo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_sorteo' => 3,
                'id_rifa' => 3,
                'fecha_sorteo' => '2025-06-22',
                'ganador_id_cliente' => 2,
                'numero_ganador' => 5467,
                'estado' => 'sin_reclamo',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
