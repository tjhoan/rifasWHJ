<?php

namespace Database\Factories;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Carrito;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacturaFactory extends Factory
{
    protected $model = Factura::class;

    public function definition()
    {
        return [
            'id_cliente' => Cliente::factory(),
            'id_carrito' => Carrito::factory(),
            'fecha_compra' => now(),
            'metodo_pago' => $this->faker->randomElement(['Efectivo', 'Tarjeta', 'Transferencia']),
            'estado' => $this->faker->randomElement(['pagado', 'pendiente', 'cancelado']),
            'total' => $this->faker->randomFloat(2, 1000, 10000),
            'tipo_compra' => $this->faker->randomElement(['comprar', 'separar']),
        ];
    }
}
