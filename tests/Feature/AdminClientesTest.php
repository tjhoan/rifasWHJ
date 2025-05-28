<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cliente;
use App\Models\Admin;

class AdminClientesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $admin = Admin::factory()->create([
            'nombre_admin' => 'Admin Test',
            'correo' => 'admin@test.com',
            'contrasena' => bcrypt('password123')
        ]);

        session(['admin' => $admin]);
    }

    public function test_clientes_index_carga_correctamente()
    {
        Cliente::factory()->create([
            'cedula' => '11111111',
            'primer_nombre_cliente' => 'ClienteTest1'
        ]);

        Cliente::factory()->create([
            'cedula' => '22222222',
            'primer_nombre_cliente' => 'ClienteTest2'
        ]);

        Cliente::factory()->create([
            'cedula' => '33333333',
            'primer_nombre_cliente' => 'ClienteTest3'
        ]);

        $response = $this->get(route('admin.clientes.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.clientes');
        $response->assertViewHas('clientes');
    }

    public function test_actualizar_cliente_funciona_correctamente()
    {
        $cliente = Cliente::factory()->create([
            'primer_nombre_cliente' => 'Pedro',
            'segundo_nombre_cliente' => 'Luis',
            'primer_apellido_cliente' => 'Martínez',
            'segundo_apellido_cliente' => 'López',
            'correo_cliente' => 'pedro@test.com',
            'telefono_cliente' => '9876543210',
            'cedula' => '87654321'
        ]);

        $data = [
            'primer_nombre_cliente' => 'Juan',
            'segundo_nombre_cliente' => 'Carlos',
            'primer_apellido_cliente' => 'Pérez',
            'segundo_apellido_cliente' => 'Gómez',
            'correo_cliente' => 'juan.carlos@example.com',
            'telefono_cliente' => '1234567890',
            'cedula' => '44444444'
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
        $cliente = Cliente::factory()->create([
            'primer_nombre_cliente' => 'ClienteEliminar',
            'correo_cliente' => 'eliminar@test.com',
            'cedula' => '98765432'
        ]);

        $this->assertDatabaseHas('clientes', [
            'id_cliente' => $cliente->id_cliente
        ]);

        $response = $this->delete(route('admin.clientes.destroy', $cliente->id_cliente));

        $this->assertDatabaseMissing('clientes', [
            'id_cliente' => $cliente->id_cliente,
        ]);

        $response->assertRedirect(route('admin.clientes.index'));
        $response->assertSessionHas('success', 'Cliente eliminado correctamente.');
    }
}
