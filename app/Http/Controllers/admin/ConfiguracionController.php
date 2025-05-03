<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Admin;
use App\Models\MetodoPago;
use Illuminate\Support\Facades\Log;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $empresa = Empresa::first();
        $admin = Admin::first();
        $metodosPago = MetodoPago::all();

        return view('admin.configuracion', compact('empresa', 'admin', 'metodosPago'));
    }

    public function updateEmpresa(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'NIT' => 'required|numeric|unique:empresa,NIT,' . ($request->id_empresa ?? 'NULL') . ',id_empresa',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
        ]);
        Log::info('Datos de la empresa: ', $request->all());

        $empresa = Empresa::first();
        if (!$empresa) {
            $empresa = new Empresa();
        }

        $empresa->fill($request->only(['nombre', 'NIT', 'direccion', 'telefono']));
        $empresa->save();

        return redirect()->route('admin.configuracion.index')->with('success', 'Datos de la empresa actualizados correctamente.');
    }

    public function updateMedios(Request $request)
    {
        $request->validate([
            'whatsapp' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ]);

        $empresa = Empresa::first();
        if (!$empresa) {
            return redirect()->route('admin.configuracion.index')->with('error', 'No se encontró la empresa.');
        }

        $redesSociales = $empresa->redes_sociales ?? [];

        $redesSociales['WhatsApp'] = $request->whatsapp;
        $redesSociales['Facebook'] = $request->facebook;
        $redesSociales['Instagram'] = $request->instagram;

        $empresa->redes_sociales = $redesSociales;
        $empresa->save();

        return redirect()->route('admin.configuracion.index')->with('success', 'Medios de comunicación actualizados correctamente.');
    }

    public function updateAdmin(Request $request)
    {
        $request->validate([
            'correo' => 'required|email|max:255|unique:admin,correo,' . ($request->id_admin ?? 'NULL') . ',id_admin',
            'contrasena' => 'nullable|string|min:8|confirmed'
        ]);

        $admin = Admin::first();
        if (!$admin) {
            return redirect()->route('admin.configuracion.index')->with('error', 'No se encontró el administrador.');
        }

        $admin->correo = $request->correo;

        if ($request->filled('contrasena')) {
            $admin->contrasena = bcrypt($request->contrasena);
        }

        $admin->save();

        return redirect()->route('admin.configuracion.index')->with('success', 'Datos del administrador actualizados correctamente.');
    }

    public function addMetodoPago(Request $request)
    {
        $request->validate([
            'nombre_metodo' => 'required|string|max:255|unique:metodos_pago,nombre_metodo',
            'digito_cuenta' => 'required|string|max:255',
        ]);

        try {
            MetodoPago::create([
                'nombre_metodo' => $request->nombre_metodo,
                'digito_cuenta' => $request->digito_cuenta,
                'estado' => 'activo'
            ]);

            return redirect()->route('admin.configuracion.index')->with('success', 'Método de pago agregado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.configuracion.index')->with('error', 'Ocurrió un error al agregar el método de pago.');
        }
    }
}
