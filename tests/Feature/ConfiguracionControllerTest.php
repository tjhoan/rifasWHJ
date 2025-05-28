<?php

namespace Tests\Feature;

use App\Models\Empresa;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ConfiguracionControllerTest extends TestCase
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

    public function test_muestra_la_pagina_de_configuracion_con_datos_correctos()
    {
        $empresa = Empresa::factory()->create([
            'nombre' => 'Empresa Test',
            'NIT' => '123456789'
        ]);

        $response = $this->get(route('admin.configuracion.index'));

        $response->assertStatus(200);
        $response->assertViewHas('empresa');
        $response->assertViewHas('admin');
        $response->assertViewHas('metodosPago');
    }

    public function test_actualiza_datos_de_empresa_exitosamente()
    {
        $empresa = Empresa::factory()->create([
            'nombre' => 'Empresa Original',
            'NIT' => '987654321',
            'direccion' => 'Dirección Original',
            'telefono' => '1234567890'
        ]);

        $datosNuevos = [
            'id_empresa' => $empresa->id_empresa,
            'nombre' => 'Nuevo Nombre',
            'NIT' => '123456789',
            'direccion' => 'Nueva Direccion',
            'telefono' => '3001234567',
        ];

        $response = $this->post(route('admin.configuracion.updateEmpresa'), $datosNuevos);

        $response->assertRedirect(route('admin.configuracion.index'));
        $this->assertDatabaseHas('empresa', [
            'nombre' => 'Nuevo Nombre',
            'NIT' => '123456789',
            'direccion' => 'Nueva Direccion',
            'telefono' => '3001234567',
        ]);
    }

    public function test_actualiza_medios_exitosamente()
    {
        $empresa = Empresa::factory()->create([
            'nombre' => 'Empresa Redes',
            'redes_sociales' => [
                'Facebook' => 'old_facebook',
                'WhatsApp' => 'old_whatsapp',
                'Instagram' => ''
            ],
        ]);

        $this->assertEquals('old_facebook', $empresa->redes_sociales['Facebook']);

        $datosNuevos = [
            'whatsapp' => 'new_whatsapp',
            'facebook' => 'https://facebook.com/new_facebook',
            'instagram' => 'https://instagram.com/new_instagram'
        ];

        $response = $this->post(route('admin.configuracion.updateMedios'), $datosNuevos);

        $response->assertRedirect(route('admin.configuracion.index'));

        $empresa->refresh();

        $this->assertEquals([
            'WhatsApp' => 'new_whatsapp',
            'Facebook' => 'https://facebook.com/new_facebook',
            'Instagram' => 'https://instagram.com/new_instagram',
        ], $empresa->redes_sociales);
    }

    public function test_actualiza_datos_de_admin_exitosamente()
    {
        $admin = Admin::where('correo', 'admin@test.com')->first();

        $datosNuevos = [
            'id_admin' => $admin->id_admin,
            'correo' => 'newadmin@example.com',
            'contrasena' => 'newpassword',
            'contrasena_confirmation' => 'newpassword',
        ];

        $response = $this->post(route('admin.configuracion.updateAdmin'), $datosNuevos);

        $response->assertRedirect(route('admin.configuracion.index'));

        $this->assertDatabaseHas('admin', [
            'id_admin' => $admin->id_admin,
            'correo' => 'newadmin@example.com',
        ]);

        $adminActualizado = $admin->fresh();
        $this->assertTrue(Hash::check('newpassword', $adminActualizado->contrasena));
    }

    public function test_maneja_errores_para_actualizacion_invalida_de_empresa()
    {
        $empresa = Empresa::factory()->create();

        $datosInvalidos = [
            'id_empresa' => $empresa->id_empresa,
            'nombre' => '',
            'NIT' => 'notanumber',
            'direccion' => '',
            'telefono' => '',
        ];

        $response = $this->post(route('admin.configuracion.updateEmpresa'), $datosInvalidos);

        $response->assertSessionHasErrors(['nombre', 'NIT']);

        $empresaActualizada = $empresa->fresh();
        $this->assertNotEquals('', $empresaActualizada->nombre);
        $this->assertNotEquals('notanumber', $empresaActualizada->NIT);
    }
}
