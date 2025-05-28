<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Rifa;
use App\Models\Admin;

class AdminRifasTest extends TestCase
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

    public function test_rifas_index_carga_correctamente()
    {
        Rifa::factory()->count(3)->create();

        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.rifas');
        $response->assertViewHas('rifas');
    }

    public function test_crear_rifa_funciona_correctamente()
    {
        $data = [
            'nombre_rifa' => 'Rifa de prueba',
            'precio_boleto' => 100.50,
            'cantidad_boletos' => 1000,
            'fecha_inicio' => now()->format('Y-m-d'),
            'fecha_sorteo' => now()->addMonth()->format('Y-m-d'),
            'premio' => 'Premio de prueba',
            'estado' => 'activo',
        ];

        $rifasAntes = Rifa::count();

        $response = $this->post(route('admin.rifas.store'), $data);

        $this->assertEquals($rifasAntes + 1, Rifa::count());

        $this->assertDatabaseHas('rifas', [
            'nombre_rifa' => $data['nombre_rifa'],
            'precio_boleto' => $data['precio_boleto'],
            'cantidad_boletos' => $data['cantidad_boletos'],
            'premio' => $data['premio'],
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success', 'La rifa ha sido creada correctamente.');
    }

    public function test_actualizar_rifa_funciona_correctamente()
    {
        $rifa = Rifa::factory()->create([
            'nombre_rifa' => 'Rifa original',
            'precio_boleto' => 50.25,
            'cantidad_boletos' => 100,
            'premio' => 'Premio original',
            'estado' => 'activo',
            'fecha_inicio' => now()->format('Y-m-d'),
            'fecha_sorteo' => now()->addWeek()->format('Y-m-d'),
        ]);

        $data = [
            'nombre_rifa' => 'Rifa actualizada',
            'precio_boleto' => 200.75,
            'cantidad_boletos' => 500,
            'fecha_inicio' => now()->format('Y-m-d'),
            'fecha_sorteo' => now()->addMonth()->format('Y-m-d'),
            'premio' => 'Premio actualizado',
            'estado' => 'activo',
        ];

        $response = $this->put(route('admin.rifas.update', $rifa->id_rifa), $data);

        $this->assertDatabaseHas('rifas', [
            'id_rifa' => $rifa->id_rifa,
            'nombre_rifa' => $data['nombre_rifa'],
            'precio_boleto' => $data['precio_boleto'],
            'cantidad_boletos' => $data['cantidad_boletos'],
            'premio' => $data['premio'],
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success', 'La rifa ha sido modificada exitosamente.');
    }

    public function test_eliminar_rifa_funciona_correctamente()
    {
        $rifa = Rifa::factory()->create([
            'nombre_rifa' => 'Rifa para eliminar',
            'estado' => 'activo'
        ]);

        $this->assertDatabaseHas('rifas', [
            'id_rifa' => $rifa->id_rifa,
            'estado' => 'activo',
        ]);

        $response = $this->delete(route('admin.rifas.destroy', $rifa->id_rifa));

        $this->assertDatabaseHas('rifas', [
            'id_rifa' => $rifa->id_rifa,
            'estado' => 'inactivo',
        ]);

        $response->assertJson([
            'success' => true,
            'message' => 'La rifa ha sido eliminada correctamente.',
        ]);
    }
}
