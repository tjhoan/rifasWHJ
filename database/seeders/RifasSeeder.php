<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RifasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rifas')->insert([
            [
                'id_rifa' => 1,
                'nombre_rifa' => 'Baloto',
                'imagen_rifa' => 'https://www.ganagana.com.co/images/Logo-baloto.png',
                'precio_boleto' => 5000,
                'cantidad_boletos' => 20,
                'fecha_inicio' => '2025-04-01',
                'fecha_sorteo' => '2025-04-22',
                'premio' => '1000000',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_rifa' => 2,
                'nombre_rifa' => 'Lotería Del Valle',
                'imagen_rifa' => 'https://caracoltv.brightspotcdn.com/dims4/default/940e1cd/2147483647/strip/true/crop/1280x720+0+0/resize/1280x720!/format/webp/quality/75/?url=http%3A%2F%2Fcaracol-brightspot.s3.us-west-2.amazonaws.com%2F9c%2F0a%2Fc45d6e02461dbf01d4c0bf9d0d20%2Floteria-del-valle.jpg',
                'precio_boleto' => 2300,
                'cantidad_boletos' => 100,
                'fecha_inicio' => '2025-05-01',
                'fecha_sorteo' => '2025-05-22',
                'premio' => '500000',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_rifa' => 3,
                'nombre_rifa' => 'Chontico Día',
                'imagen_rifa' => 'https://loteriasdehoy.co/images/chontico-dia.jpg',
                'precio_boleto' => 2000,
                'cantidad_boletos' => 100,
                'fecha_inicio' => '2025-06-01',
                'fecha_sorteo' => '2025-06-22',
                'premio' => '200000',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
