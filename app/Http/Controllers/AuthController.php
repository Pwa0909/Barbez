<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.cliente-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = strtolower(trim($credentials['email']));
        $adminEmail = 'admin@barbearia.com';

        $guard = $email === $adminEmail ? 'web' : 'cliente';

        if (Auth::guard($guard)->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(
                $guard === 'web' ? route('admin.dashboard') : route('agendamentos')
            );
        }

        return back()->withErrors([
            'email' => $guard === 'web'
                ? 'Credenciais inválidas para admin.'
                : 'Credenciais inválidas para cliente.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        if (Auth::guard('cliente')->check()) {
            Auth::guard('cliente')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
