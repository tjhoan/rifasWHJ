<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NumerosRifaSeeder extends Seeder
{
    public function run(): void
    {
        // rifa con ID 1
        $rifaId = 1;
        $cantidadNumeros = 50;

        $numeros = [];
        for ($i = 1; $i <= $cantidadNumeros; $i++) {
            $numeros[] = [
                'numero' => $i,
                'estado' => 'disponible',
                'id_rifa' => $rifaId
            ];
        }

        DB::table('numeros_rifas')->insert($numeros);

        // rifa con ID 2
        $rifaId = 2;
        $cantidadNumeros = 120;

        $numeros = [];
        for ($i = 1; $i <= $cantidadNumeros; $i++) {
            $numeros[] = [
                'numero' => $i,
                'estado' => 'disponible',
                'id_rifa' => $rifaId
            ];
        }

        DB::table('numeros_rifas')->insert($numeros);
    }
}
