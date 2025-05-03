<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodoPagoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('metodos_pago')->insert([
            [
                'id_pago' => 1,
                'nombre_metodo' => 'Nequi',
                'digito_cuenta' => '3156571234',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_pago' => 2,
                'nombre_metodo' => 'Daviplata',
                'digito_cuenta' => '3156571234',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_pago' => 3,
                'nombre_metodo' => 'Paypal',
                'digito_cuenta' => '31561234',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
