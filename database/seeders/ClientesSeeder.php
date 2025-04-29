<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clientes')->insert([
            [
                'id_cliente' => 1,
                'primer_nombre_cliente' => 'Juan',
                'segundo_nombre_cliente' => 'Carlos',
                'primer_apellido_cliente' => 'Pérez',
                'segundo_apellido_cliente' => 'Gómez',
                'correo_cliente' => 'juan.perez@example.com',
                'telefono_cliente' => '3001234567',
                'cedula' => '1234567890',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_cliente' => 2,
                'primer_nombre_cliente' => 'María',
                'segundo_nombre_cliente' => 'Fernanda',
                'primer_apellido_cliente' => 'López',
                'segundo_apellido_cliente' => 'Martínez',
                'correo_cliente' => 'maria.lopez@example.com',
                'telefono_cliente' => '3007654321',
                'cedula' => '0987654321',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
