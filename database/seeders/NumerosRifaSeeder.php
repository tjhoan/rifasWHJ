<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NumerosRifaSeeder extends Seeder
{
    public function run(): void
    {
        $numeros = [];
        $rifas = [
            1 => 1000,
            2 => 2000,
            3 => 2000,
        ];

        foreach ($rifas as $idRifa => $cantidadBoletos) {
            for ($i = 1; $i <= $cantidadBoletos; $i++) {
                $numeros[] = [
                    'id_rifa' => $idRifa,
                    'numero' => $i,
                    'id_cliente' => null,
                    'estado' => 'disponible',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('numeros_rifa')->insert($numeros);
    }
}
