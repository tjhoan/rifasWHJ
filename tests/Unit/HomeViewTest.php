<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Rifa;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_muestra_detalles_de_la_rifa_correctamente_en_la_vista()
    {
        $rifa = Rifa::factory()->create([
            'nombre_rifa' => 'Rifa Test',
            'precio_boleto' => 5000,
            'cantidad_boletos' => 50,
            'fecha_inicio' => now(),
            'fecha_sorteo' => now()->addDays(10),
            'premio' => 100000
        ]);

        $response = $this->get(route('home'));

        $response->assertSee($rifa->nombre_rifa);
        $response->assertSee(number_format($rifa->precio_boleto, 0));
        $response->assertSee($rifa->cantidad_boletos);
        $response->assertSee('$' . number_format($rifa->premio, 0));
        $response->assertSee($rifa->fecha_inicio->format('d/m/Y'));
        $response->assertSee($rifa->fecha_sorteo->format('d/m/Y'));
    }

    public function test_muestra_sweetalert_en_sesion_de_exito_y_error()
    {
        session()->flash('success', '¡Éxito!');

        $response = $this->get(route('home'));

        $response->assertSee('const successMessage = "¡Éxito!";', false);
        $response->assertSee('Swal.fire({', false);

        session()->flash('error', 'Hubo un error');

        $response = $this->get(route('home'));

        $response->assertSee('const errorMessage = "Hubo un error";', false);
        $response->assertSee('Swal.fire({', false);
    }
}
