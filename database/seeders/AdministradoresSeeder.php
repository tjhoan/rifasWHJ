<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministradoresSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('administradores')->insert([
            [
                'id_administrador' => 1,
                'nombre_admin' => 'Admin',
                'correo' => 'admin@rifas.com',
                'contrasena' => bcrypt('password')
            ],
        ]);
    }
}
