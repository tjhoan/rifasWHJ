<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('empresa')->insert([
            'NIT' => '123456789',
            'nombre' => 'Mi Empresa',
            'direccion' => 'Calle Falsa 123',
            'telefono' => '1234567890',
            'redes_sociales' => '{"WhatsApp": "+57 317 836 2354", "Facebook": "https://facebook.com/miempresa", "Instagram": "https://instagram.com/miempresa"}',
            'estado' => 'activo'
        ]);
    }
}
