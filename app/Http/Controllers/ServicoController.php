<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
  //leva pra pagina serviço
     public function index()
{
    $servicos = [
        ['id' => 1, 'nome' => 'Corte '],
        ['id' => 2, 'nome' => 'Barba'],
        ['id' => 3, 'nome' => 'Corte + Barba'],
        ['id' => 4, 'nome' => 'Sobrancelha'],
    ];

    return view('pages.servicos', compact('servicos'));
}

    public function create()
    {
        return view('pages.servicos.create');
    }

    public function store(Request $request)
    {
        Servico::create($request->all());
        return redirect()->route('servicos.index');
    }

    public function edit($id)
    {
        $servico = Servico::findOrFail($id);
        return view('pages.servicos.edit', compact('servico'));
    }

    public function update(Request $request, $id)
    {
        $servico = Servico::findOrFail($id);
        $servico->update($request->all());

        return redirect()->route('servicos.index');
    }

    public function destroy($id)
    {
        Servico::destroy($id);
        return redirect()->route('servicos.index');
    }
}