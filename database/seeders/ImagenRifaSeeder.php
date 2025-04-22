<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagenRifaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('imagen_rifa')->insert([
            [
                'ruta_imagen' => 'https://cdn.clarosports.com/clarosports/2024/06/balotook12-071239-1024x576.jpg',
                'id_rifa' => 1
            ],
            [
                'ruta_imagen' => 'https://caracoltv.brightspotcdn.com/dims4/default/c5c6777/2147483647/strip/true/crop/1280x720+0+0/resize/800x450!/quality/75/?url=http%3A%2F%2Fcaracol-brightspot.s3.us-west-2.amazonaws.com%2F9c%2F0a%2Fc45d6e02461dbf01d4c0bf9d0d20%2Floteria-del-valle.jpg',
                'id_rifa' => 2
            ],
        ]);
    }
}
