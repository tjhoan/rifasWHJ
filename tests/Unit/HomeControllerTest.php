<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Rifa;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_muestra_rifas_activas_en_la_vista_home()
    {
        Rifa::factory()->create([
            'nombre_rifa' => 'Rifa Activa',
            'estado' => 'activo',
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Rifa Activa');
    }

    public function test_muestra_mensaje_de_error_cuando_falla_la_consulta_de_rifas()
    {
        DB::shouldReceive('table')->andThrow(new \Exception('Database error'));

        $response = $this->get(route('home'));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Hubo un problema al cargar las rifas. Por favor, intenta nuevamente.');
    }

    public function test_muestra_rifas_de_la_base_de_datos()
    {
        $rifa = Rifa::factory()->create([
            'nombre_rifa' => 'Rifa Test',
            'estado' => 'activo',
        ]);

        $response = $this->get(route('home'));

        $response->assertSee($rifa->nombre_rifa);
        $response->assertSee(number_format($rifa->precio_boleto, 0));
    }
}
