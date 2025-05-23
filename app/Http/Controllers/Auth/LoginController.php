<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required',
        ]);

        try {
            $admin = Admin::where('correo', $request->correo)->first();

            if ($admin && Hash::check($request->contrasena, $admin->contrasena)) {
                session(['admin' => $admin]);

                return response()->json([
                    'success' => true,
                    'message' => 'Inicio de sesión exitoso.',
                    'redirect' => url('/admin'),
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Credenciales incorrectas.',
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un problema, por favor intenta nuevamente.',
            ], 500);
        }
    }
    
    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        return redirect()->route('login.index')->with('success', 'Has cerrado sesión correctamente.');
    }
}
