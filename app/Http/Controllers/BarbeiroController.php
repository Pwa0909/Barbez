<?php

namespace App\Http\Controllers;

use App\Models\Barbeiro;
use Illuminate\Http\Request;

class BarbeiroController extends Controller
{
    public function index()
    {
        $barbeiros = Barbeiro::all();

        return view('barbeiros.index', compact('barbeiros'));
    }

    public function create()
    {
        return view('barbeiros.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|max:100',
            'telefone' => 'nullable|max:20',
            'especialidade' => 'nullable|max:100',
            'ativo' => 'boolean'
        ]);

        $validated['ativo'] = $request->boolean('ativo');

        Barbeiro::create($validated);

        return redirect()->route('admin.barbeiros.index')
            ->with('success', 'Barbeiro cadastrado com sucesso!');
    }

    public function show($id)
    {
        $barbeiro = Barbeiro::findOrFail($id);

        return view('barbeiros.show', compact('barbeiro'));
    }

    public function edit($id)
    {
        $barbeiro = Barbeiro::findOrFail($id);

        return view('barbeiros.edit', compact('barbeiro'));
    }

    public function update(Request $request, $id)
    {
        $barbeiro = Barbeiro::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|max:100',
            'telefone' => 'nullable|max:20',
            'especialidade' => 'nullable|max:100',
            'ativo' => 'boolean'
        ]);

        $validated['ativo'] = $request->boolean('ativo');

        $barbeiro->update($validated);

        return redirect()->route('admin.barbeiros.index')
            ->with('success', 'Barbeiro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $barbeiro = Barbeiro::findOrFail($id);
        $barbeiro->delete();

        return redirect()->route('admin.barbeiros.index')
            ->with('success', 'Barbeiro excluído com sucesso!');
    }
}
