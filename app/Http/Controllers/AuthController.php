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
        ], [
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        $guard = null;

        foreach (['web', 'cliente'] as $candidate) {
            if (Auth::guard($candidate)->attempt($credentials, $request->boolean('remember'))) {
                $guard = $candidate;
                break;
            }
        }

        if ($guard) {
            $request->session()->regenerate();

            return redirect()->intended(
                $guard === 'web' ? route('admin.dashboard') : route('agendamentos')
            );
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
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
