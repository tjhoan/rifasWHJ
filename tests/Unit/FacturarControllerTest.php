<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cliente;
use App\Models\Carrito;
use App\Models\MetodoPago;
use App\Models\NumerosRifa;
use App\Models\Rifa;

class FacturarControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_facturar_index_muestra_la_vista_correcta()
    {
        $cliente = Cliente::factory()->create();
        session(['cliente_id' => $cliente->id_cliente]);

        $rifa = Rifa::factory()->create();
        $carrito = Carrito::factory()->create([
            'id_cliente' => $cliente->id_cliente,
            'estado' => 'activo'
        ]);
        $numero = NumerosRifa::factory()->create([
            'id_rifa' => $rifa->id_rifa,
            'estado' => 'reservado',
        ]);
        $carrito->numeros()->attach($numero);

        MetodoPago::factory()->count(3)->create();

        $response = $this->get(route('facturar.index'));

        $response->assertStatus(200);
        $response->assertViewIs('facturar');
        $response->assertViewHas('metodoPago');
    }

    public function test_facturar_store_crea_factura_correctamente()
    {
        $cliente = Cliente::factory()->create();
        session(['cliente_id' => $cliente->id_cliente]);

        $rifa = Rifa::factory()->create();
        $carrito = Carrito::factory()->create([
            'id_cliente' => $cliente->id_cliente,
            'estado' => 'activo'
        ]);
        $numero = NumerosRifa::factory()->create([
            'id_rifa' => $rifa->id_rifa,
            'estado' => 'reservado',
        ]);
        $carrito->numeros()->attach($numero);

        $metodoPago = MetodoPago::factory()->create([
            'estado' => 'activo'
        ]);

        $response = $this->post(route('facturar.store'), [
            'primer_nombre' => 'Juan',
            'segundo_nombre' => 'Carlos',
            'primer_apellido' => 'Pérez',
            'segundo_apellido' => 'Gómez',
            'telefono' => '1234567890',
            'correo' => 'juan@example.com',
            'cedula' => '12345678',
            'metodo_pago' => $metodoPago->nombre_metodo,
            'tipo_accion' => 'comprar',
        ]);

        $this->assertDatabaseHas('facturas', [
            'id_cliente' => $cliente->id_cliente,
            'id_carrito' => $carrito->id_carrito,
            'metodo_pago' => $metodoPago->nombre_metodo,
            'estado' => 'pagado',
            'tipo_compra' => 'comprar',
        ]);
    }

    public function test_facturar_index_redirige_si_el_carrito_esta_vacio()
    {
        $cliente = Cliente::factory()->create();
        session(['cliente_id' => $cliente->id_cliente]);

        $response = $this->get(route('facturar.index'));

        $response->assertRedirect(route('carrito.index'));
        $response->assertSessionHas('error', 'El carrito está vacío. No puedes facturar.');
    }
}