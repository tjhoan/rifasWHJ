<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RifasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rifas')->insert([
            [
                'nombre' => 'Baloto',
                'premio' => '$1.200.000',
                'precio' => 2000,
                'cantidad_numero' => 50,
                'fecha_inicio' => '2025-04-01',
                'fecha_sorteo' => '2025-04-30',
                'id_administrador' => 1,
                'id_sorteo' => 1
            ],
            [
                'nombre' => 'Loteria del Valle',
                'premio' => '$2.000.000',
                'precio' => 1500,
                'cantidad_numero' => 120,
                'fecha_inicio' => '2025-04-05',
                'fecha_sorteo' => '2025-04-25',
                'id_administrador' => 1,
                'id_sorteo' => 2
            ],
        ]);
    }
}
