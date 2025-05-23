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

    public function test_muestra_la_pagina_de_configuracion_con_datos_correctos()
    {
        $empresa = Empresa::factory()->create();
        $admin = Admin::factory()->create();

        $response = $this->get(route('admin.configuracion.index'));

        $response->assertStatus(200);
        $response->assertViewHas('empresa');
        $response->assertViewHas('admin');
        $response->assertViewHas('metodosPago');
    }

    public function test_actualiza_datos_de_empresa_exitosamente()
    {
        $empresa = Empresa::factory()->create();

        $response = $this->post(route('admin.configuracion.updateEmpresa'), [
            'id_empresa' => $empresa->id_empresa,
            'nombre' => 'Nuevo Nombre',
            'NIT' => '123456789',
            'direccion' => 'Nueva Direccion',
            'telefono' => '3001234567',
        ]);

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
            'redes_sociales' => ['Facebook' => 'old_facebook', 'WhatsApp' => 'old_whatsapp'],
        ]);

        $response = $this->post(route('admin.configuracion.updateMedios'), [
            'whatsapp' => 'new_whatsapp',
            'facebook' => 'https://facebook.com/new_facebook',
            'instagram' => 'https://instagram.com/new_instagram'
        ]);

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
        $admin = Admin::factory()->create();

        $response = $this->post(route('admin.configuracion.updateAdmin'), [
            'id_admin' => $admin->id_admin,
            'correo' => 'newadmin@example.com',
            'contrasena' => 'newpassword',
            'contrasena_confirmation' => 'newpassword',
        ]);

        $response->assertRedirect(route('admin.configuracion.index'));
        $this->assertDatabaseHas('admin', [
            'correo' => 'newadmin@example.com',
        ]);
        $this->assertTrue(Hash::check('newpassword', $admin->fresh()->contrasena));
    }

    public function test_maneja_errores_para_actualizacion_invalida_de_empresa()
    {
        $response = $this->post(route('admin.configuracion.updateEmpresa'), [
            'nombre' => '', // Invalid data
            'NIT' => 'notanumber',
            'direccion' => '',
            'telefono' => '',
        ]);

        $response->assertSessionHasErrors();
    }
}
