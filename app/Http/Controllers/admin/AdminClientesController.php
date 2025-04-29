<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminClientesController extends Controller
{
    public function index()
    {
        try {
            $clientes = Cliente::where('cedula', '!=', '00000000')->get();
            return view('admin.clientes', compact('clientes'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al cargar los clientes: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            return redirect()->route('admin.clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar el cliente: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'primer_nombre_cliente' => 'required|string|max:255',
            'segundo_nombre_cliente' => 'nullable|string|max:255',
            'primer_apellido_cliente' => 'required|string|max:255',
            'segundo_apellido_cliente' => 'nullable|string|max:255',
            'correo_cliente' => 'required|email|max:255|unique:clientes,correo_cliente,' . $id . ',id_cliente',
            'telefono_cliente' => 'nullable|string|max:15',
            'cedula' => 'required|string|max:20|unique:clientes,cedula,' . $id . ',id_cliente',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->all());

            return redirect()->route('admin.clientes.index')->with('success', 'Cliente actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar el cliente: ' . $e->getMessage()]);
        }
    }
}
