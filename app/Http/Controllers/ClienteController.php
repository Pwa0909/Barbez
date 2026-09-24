<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|max:100',
            'telefone' => 'nullable|max:20',
            'email' => ['required', 'email', 'unique:clientes,email', 'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i'],
            'senha' => 'required|string|min:6'
        ], [
            'email.regex' => 'O e-mail deve terminar com @gmail.com.',
        ]);

        $validated['senha'] = Hash::make($validated['senha']);

        Cliente::create($validated);

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|max:100',
            'telefone' => 'nullable|max:20',
            'email' => ['required', 'email', 'unique:clientes,email,' . $cliente->id, 'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i'],
            'senha' => 'nullable|string|min:6'
        ], [
            'email.regex' => 'O e-mail deve terminar com @gmail.com.',
        ]);

        if (!empty($validated['senha'])) {
            $validated['senha'] = Hash::make($validated['senha']);
        } else {
            unset($validated['senha']);
        }

        $cliente->update($validated);

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente excluído com sucesso!');
    }
}
