<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            RifasSeeder::class,
            NumerosRifaSeeder::class,
            ClientesSeeder::class,
            SorteosSeeder::class,
            GanadoresSeeder::class,
            EmpresaSeeder::class,
            MetodoPagoSeeder::class
        ]);
    }
}
