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

        $admin = Admin::where('correo', $request->correo)->first();

        if ($admin && Hash::check($request->contrasena, $admin->contrasena)) {
            session(['admin' => $admin]);

            return redirect('/admin');
        }

        return back()->withErrors(['login_error' => 'Credenciales incorrectas.']);
    }
}
