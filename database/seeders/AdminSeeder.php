<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->insert([
            'correo' => 'admin@gmail.com',
            'contrasena' => bcrypt('password'),
            'nombre_admin' => 'Hernando Vivas Franco',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
