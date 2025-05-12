<?php

namespace Tests\Feature;

use App\Models\Rifa;
use App\Models\NumerosRifa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComprasControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_mostrar_una_rifa_con_numeros()
    {
        $rifa = Rifa::factory()->create();
        $numero = NumerosRifa::factory()->create(['id_rifa' => $rifa->id_rifa]);

        $response = $this->get(route('compras.show', $rifa->id_rifa));

        $response->assertStatus(200);
        $response->assertViewHas('rifa', $rifa);
        $response->assertViewHas('numeros');
    }

    public function test_puede_buscar_numeros_en_rifa()
    {
        $rifa = Rifa::factory()->create();
        $numero = NumerosRifa::factory()->create(['id_rifa' => $rifa->id_rifa, 'numero' => '1234']);

        $response = $this->get(route('compras.show', [$rifa->id_rifa, 'search' => '1234']));

        $response->assertStatus(200);
        $response->assertSee('1234');
    }

    public function test_devuelve_error_cuando_no_se_encuentra_la_rifa()
    {
        $response = $this->get(route('compras.show', 999));

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('error');
    }
}
