<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdministradoresSeeder::class,
            SorteosSeeder::class,
            RifasSeeder::class,
            ImagenRifaSeeder::class,
            GanadoresSeeder::class,
            NumerosRifaSeeder::class,
        ]);
    }
}
