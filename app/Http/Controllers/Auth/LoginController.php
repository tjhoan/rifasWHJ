<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Administrador;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required',
        ]);

        $admin = Administrador::where('correo', $request->correo)->first();

        if ($admin && Hash::check($request->contrasena, $admin->contrasena)) {
            // Store admin session
            session(['admin_logged_in' => true]);
            return redirect('/admin/');
        }

        return back()->withErrors(['login_error' => 'Credenciales incorrectas.']);
    }
}
