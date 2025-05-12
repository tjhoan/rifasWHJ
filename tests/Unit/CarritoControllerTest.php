<?php

namespace Tests\Feature;

use App\Models\Carrito;
use App\Models\NumerosRifa;
use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarritoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_mostrar_el_carrito()
    {
        $cliente = Cliente::factory()->create();
        session(['cliente_id' => $cliente->id_cliente]);

        $carrito = Carrito::factory()->create(['id_cliente' => $cliente->id_cliente]);
        $numero = NumerosRifa::factory()->create();

        $carrito->numeros()->attach($numero);

        $response = $this->get(route('carrito.index'));

        $response->assertStatus(200);
        $response->assertViewHas('carrito');
    }

    public function test_puede_agregar_numeros_al_carrito()
    {
        $cliente = Cliente::factory()->create();
        session(['cliente_id' => $cliente->id_cliente]);

        $carrito = Carrito::factory()->create(['id_cliente' => $cliente->id_cliente]);
        $numero = NumerosRifa::factory()->create(['estado' => 'disponible']);

        $response = $this->post(route('carrito.addSelected'), [
            'selected_numbers' => json_encode([$numero->id_numero]),
            'id_rifa' => $numero->id_rifa,
        ]);

        $response->assertRedirect(route('carrito.index'));
        $this->assertDatabaseHas('carrito_numeros', ['id_carrito' => $carrito->id_carrito, 'id_numero' => $numero->id_numero]);
    }

    public function test_puede_remover_numeros_del_carrito()
    {
        $cliente = Cliente::factory()->create();
        $carrito = Carrito::factory()->create(['id_cliente' => $cliente->id_cliente]);
        $numero = NumerosRifa::factory()->create();
        $carrito->numeros()->attach($numero);

        $response = $this->post(route('carrito.remove'), [
            'id_carrito' => $carrito->id_carrito,
            'id_numero' => $numero->id_numero,
        ]);

        $response->assertRedirect(route('carrito.index'));
        $this->assertDatabaseMissing('carrito_numeros', ['id_carrito' => $carrito->id_carrito, 'id_numero' => $numero->id_numero]);
    }

    public function test_puede_vaciar_el_carrito()
    {
        $cliente = Cliente::factory()->create();
        $carrito = Carrito::factory()->create(['id_cliente' => $cliente->id_cliente]);
        $numero = NumerosRifa::factory()->create();
        $carrito->numeros()->attach($numero);

        $response = $this->post(route('carrito.clear'), ['id_carrito' => $carrito->id_carrito]);

        $response->assertRedirect(route('carrito.index'));
        $this->assertEmpty($carrito->numeros);
    }
}
