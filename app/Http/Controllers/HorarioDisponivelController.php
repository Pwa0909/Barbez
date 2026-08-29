<?php

namespace App\Http\Controllers;

use App\Models\Barbeiro;
use App\Models\HorarioDisponivel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HorarioDisponivelController extends Controller
{
    public function index()
    {
        $horarios = HorarioDisponivel::with('barbeiro')
            ->where('disponivel', true)
            ->orderBy('data')
            ->orderBy('hora')
            ->get()
            ->unique(function ($horario) {
                return $horario->barbeiro_id.'|'.$horario->data.'|'.$horario->hora;
            });

        return view('horarios.index', compact('horarios'));
    }

    public function create()
    {
        $barbeiros = Barbeiro::all();

        return view('horarios.create', compact('barbeiros'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barbeiro_id' => 'required|exists:barbeiros,id',
            'data' => 'required|date',
            'hora' => [
                'required',
                'date_format:H:i',
                Rule::unique('horarios_disponiveis')->where(function ($query) use ($request) {
                    return $query
                        ->where('barbeiro_id', $request->barbeiro_id)
                        ->where('data', $request->data)
                        ->where('hora', $request->hora);
                }),
            ],
            'disponivel' => 'boolean'
        ]);

        $validated['disponivel'] = $request->boolean('disponivel');

        HorarioDisponivel::create($validated);

        return redirect()->route('admin.horarios.index')
            ->with('success', 'Horário cadastrado com sucesso!');
    }

    public function show($id)
    {
        $horario = HorarioDisponivel::with('barbeiro')->findOrFail($id);

        return view('horarios.show', compact('horario'));
    }

    public function edit($id)
    {
        $horario = HorarioDisponivel::findOrFail($id);
        $barbeiros = Barbeiro::all();

        return view('horarios.edit', compact('horario', 'barbeiros'));
    }

    public function update(Request $request, $id)
    {
        $horario = HorarioDisponivel::findOrFail($id);

        $validated = $request->validate([
            'barbeiro_id' => 'required|exists:barbeiros,id',
            'data' => 'required|date',
            'hora' => [
                'required',
                'date_format:H:i',
                Rule::unique('horarios_disponiveis')->where(function ($query) use ($request) {
                    return $query
                        ->where('barbeiro_id', $request->barbeiro_id)
                        ->where('data', $request->data)
                        ->where('hora', $request->hora);
                })->ignore($horario->id),
            ],
            'disponivel' => 'boolean'
        ]);

        $validated['disponivel'] = $request->boolean('disponivel');

        $horario->update($validated);

        return redirect()->route('admin.horarios.index')
            ->with('success', 'Horário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $horario = HorarioDisponivel::findOrFail($id);
        $horario->delete();

        return redirect()->route('admin.horarios.index')
            ->with('success', 'Horário excluído com sucesso!');
    }
}
