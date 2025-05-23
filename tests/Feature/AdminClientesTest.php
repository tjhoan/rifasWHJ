<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cliente;

class AdminClientesTest extends TestCase
{
    use RefreshDatabase;

    public function test_clientes_index_carga_correctamente()
    {
        Cliente::factory()->count(3)->create();

        $response = $this->get(route('admin.clientes.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.clientes');
        $response->assertViewHas('clientes');
    }

    public function test_actualizar_cliente_funciona_correctamente()
    {
        $cliente = Cliente::factory()->create();

        $data = [
            'primer_nombre_cliente' => 'Juan',
            'segundo_nombre_cliente' => 'Carlos',
            'primer_apellido_cliente' => 'Pérez',
            'segundo_apellido_cliente' => 'Gómez',
            'correo_cliente' => 'juan.carlos@example.com',
            'telefono_cliente' => '1234567890',
            'cedula' => '12345678',
        ];

        $response = $this->put(route('admin.clientes.update', $cliente->id_cliente), $data);

        $this->assertDatabaseHas('clientes', [
            'id_cliente' => $cliente->id_cliente,
            'primer_nombre_cliente' => $data['primer_nombre_cliente'],
            'correo_cliente' => $data['correo_cliente'],
        ]);

        $response->assertRedirect(route('admin.clientes.index'));
        $response->assertSessionHas('success', 'Cliente actualizado correctamente.');
    }

    public function test_eliminar_cliente_funciona_correctamente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->delete(route('admin.clientes.destroy', $cliente->id_cliente));

        $this->assertDatabaseMissing('clientes', [
            'id_cliente' => $cliente->id_cliente,
        ]);

        $response->assertRedirect(route('admin.clientes.index'));
        $response->assertSessionHas('success', 'Cliente eliminado correctamente.');
    }
}