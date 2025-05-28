<?php

namespace Tests\Feature;

use App\Models\Rifa;
use App\Models\Cliente;
use App\Models\NumerosRifa;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminVentasControllerTest extends TestCase
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

    public function test_muestra_la_página_de_ventas_con_datos_correctos()
    {
        $rifa = Rifa::factory()->create([
            'nombre_rifa' => 'Rifa de Ventas Test',
            'precio_boleto' => 10.50,
            'estado' => 'activo'
        ]);

        $cliente = Cliente::factory()->create([
            'primer_nombre_cliente' => 'Cliente Test',
            'cedula' => '12345678'
        ]);

        $numerosRifa = NumerosRifa::factory()->create([
            'id_rifa' => $rifa->id_rifa,
            'id_cliente' => $cliente->id_cliente,
            'estado' => 'vendido',
            'numero' => '123'
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

        $this->assertEquals(0, Rifa::count());
        $this->assertEquals(0, NumerosRifa::count());
        $this->assertEquals(0, Cliente::count());

        $response = $this->get(route('admin.ventas.index'));

        $response->assertStatus(302);
        $response->assertSessionHas('error', 'Hubo un problema al cargar los datos. Por favor, intenta nuevamente.');
    }
}
