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
                'fecha_realizacion' => '2025-04-30',
                'estado' => 'Pendiente'
            ],
            [
                'id_sorteo' => 2,
                'fecha_realizacion' => '2025-04-25',
                'estado' => 'Pendiente'
            ],
        ]);
    }
}
