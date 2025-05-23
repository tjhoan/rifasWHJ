<?php

namespace Tests\Feature;

use App\Models\Rifa;
use App\Models\Cliente;
use App\Models\NumerosRifa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminVentasControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_muestra_la_página_de_ventas_con_datos_correctos()
    {
        $rifa = Rifa::factory()->create();
        $cliente = Cliente::factory()->create();
        $numerosRifa = NumerosRifa::factory()->create([
            'id_rifa' => $rifa->id_rifa,
            'id_cliente' => $cliente->id_cliente,
            'estado' => 'vendido',
        ]);

        $response = $this->get(route('admin.ventas.index'));

        $response->assertStatus(200);
        $response->assertViewHas('totalRifas', Rifa::count());
        $response->assertViewHas('rifasActivas', Rifa::where('estado', 'activo')->count());
        $response->assertViewHas('boletasVendidas', NumerosRifa::where('estado', 'vendido')->count());
        $response->assertViewHas('ingresosTotales');
        $response->assertViewHas('clienteMasActivo');
        $response->assertViewHas('rifas');
    }

    public function test_muestra_mensaje_de_error_en_caso_de_fallo()
    {
        Rifa::query()->delete();
        NumerosRifa::query()->delete();
        Cliente::query()->delete();

        $response = $this->get(route('admin.ventas.index'));

        $response->assertSessionHas('error', 'Hubo un problema al cargar los datos. Por favor, intenta nuevamente.');
    }
}
