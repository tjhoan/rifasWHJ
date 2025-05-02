<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->insert([
            'correo' => 'admin@emailk.com',
            'contrasena' => bcrypt('password'),
            'nombre_admin' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
