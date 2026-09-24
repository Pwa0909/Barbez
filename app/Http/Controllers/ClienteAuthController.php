<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClienteAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.cliente-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i'],
            'password' => ['required'],
        ], [
            'email.regex' => 'O e-mail deve terminar com @gmail.com.',
        ]);

        if (Auth::guard('cliente')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('agendamentos'));
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas para cliente.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('auth.cliente-register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:clientes,email', 'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'email.regex' => 'O e-mail deve terminar com @gmail.com.',
        ]);

        $cliente = \App\Models\Cliente::create([
            'nome' => $data['nome'],
            'telefone' => $data['telefone'] ?? null,
            'email' => $data['email'],
            'senha' => Hash::make($data['password']),
        ]);

        Auth::guard('cliente')->login($cliente);
        $request->session()->regenerate();

        return redirect()->route('agendamentos');
    }

    public function logout(Request $request)
    {
        Auth::guard('cliente')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
