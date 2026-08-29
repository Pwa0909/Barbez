<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function publicIndex()
    {
        $servicos = Servico::all();

        return view('pages.servicos', compact('servicos'));
    }

    public function index()
    {
        $servicos = Servico::all();

        return view('servicos.index', compact('servicos'));
    }

    public function create()
    {
        return view('servicos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|max:100',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'duracao_min' => 'required|integer|min:1'
        ]);

        Servico::create($validated);

        return redirect()->route('admin.servicos.index')
            ->with('success', 'Serviço cadastrado com sucesso!');
    }

    public function show($id)
    {
        $servico = Servico::findOrFail($id);

        return view('servicos.show', compact('servico'));
    }

    public function edit($id)
    {
        $servico = Servico::findOrFail($id);

        return view('servicos.edit', compact('servico'));
    }

    public function update(Request $request, $id)
    {
        $servico = Servico::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|max:100',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'duracao_min' => 'required|integer|min:1'
        ]);

        $servico->update($validated);

        return redirect()->route('admin.servicos.index')
            ->with('success', 'Serviço atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $servico = Servico::findOrFail($id);
        $servico->delete();

        return redirect()->route('admin.servicos.index')
            ->with('success', 'Serviço excluído com sucesso!');
    }
}
