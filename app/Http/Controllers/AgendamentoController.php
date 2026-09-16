<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendamentoRequest;
use App\Models\Agendamento;
use App\Models\Barbeiro;
use App\Models\Cliente;
use App\Models\HorarioDisponivel;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AgendamentoController extends Controller
{
    public function publicCreate()
    {
        if (!auth('cliente')->check()) {
            return redirect()->route('login');
        }

        $cliente = auth('cliente')->user();
        $this->ensureUpcomingSchedules();
        $servicos = Servico::all();
        $horarios = HorarioDisponivel::where('disponivel', true)
            ->orderBy('data')
            ->orderBy('hora')
            ->get()
            ->unique(function ($horario) {
                return $horario->data.'|'.$horario->hora;
            });

        return view('pages.agendamentos', compact(
            'cliente',
            'servicos',
            'horarios'
        ));
    }

    private function ensureUpcomingSchedules(): void
    {
        if (HorarioDisponivel::where('disponivel', true)
            ->whereDate('data', '>=', Carbon::today())
            ->exists()) {
            return;
        }

        $barbeiros = Barbeiro::where('ativo', true)->get();
        $horarios = [];

        for ($dia = 0; $dia <= 6; $dia++) {
            $data = Carbon::today()->addDays($dia);

            if ($data->isSunday()) {
                continue;
            }

            foreach ($barbeiros as $barbeiro) {
                for ($minutos = 7 * 60; $minutos <= 17 * 60; $minutos += 30) {
                    $horarios[] = [
                        'barbeiro_id' => $barbeiro->id,
                        'data' => $data->toDateString(),
                        'hora' => sprintf('%02d:%02d', intdiv($minutos, 60), $minutos % 60),
                        'disponivel' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        if ($horarios) {
            DB::table('horarios_disponiveis')->insertOrIgnore($horarios);
        }
    }

    public function publicStore(AgendamentoRequest $request)
    {
        $cliente = auth('cliente')->user();
        if (!$cliente) {
            return redirect()->route('login');
        }

        $data = $request->validated();
        $data['cliente_id'] = $cliente->id;

        if (!empty($data['nome']) && $data['nome'] !== $cliente->nome) {
            $cliente->update(['nome' => $data['nome']]);
        }

        try {
            DB::beginTransaction();

            $horario = HorarioDisponivel::where('id', $data['horario_disponivel_id'])
                ->where('disponivel', true)
                ->lockForUpdate()
                ->first();

            if (!$horario) {
                DB::rollBack();
                return back()->withErrors(['horario_disponivel_id' => 'O horário selecionado já foi reservado. Por favor escolha outro.'])->withInput();
            }

            $horario->update(['disponivel' => false]);
            $data['barbeiro_id'] = $horario->barbeiro_id;
            $data['data'] = $horario->data;
            $data['hora'] = $horario->hora;

            unset($data['nome']);

            $agendamento = Agendamento::create($data);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Erro ao reservar horário no atendimento público.', [
                'cliente_id' => $cliente->id,
                'horario_disponivel_id' => $data['horario_disponivel_id'] ?? null,
                'exception' => $e,
            ]);
            return back()->withErrors(['error' => 'Erro ao reservar o horário. Tente novamente.'])->withInput();
        }

        return redirect()->route('agendamentos.sucesso')
            ->with('success', 'Agendamento cadastrado com sucesso!');
    }

    public function index()
    {
        $agendamentos = Agendamento::with([
            'cliente',
            'barbeiro',
            'servico',
            'horario'
        ])->get();

        return view('agendamentos.index', compact('agendamentos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $servicos = Servico::all();
        $horarios = HorarioDisponivel::with('barbeiro')->get();

        return view('agendamentos.create', compact(
            'clientes',
            'servicos',
            'horarios'
        ));
    }

    public function store(AgendamentoRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $updated = HorarioDisponivel::where('id', $data['horario_disponivel_id'])
                ->where('disponivel', true)
                ->update(['disponivel' => false]);

            if (!$updated) {
                DB::rollBack();
                return back()->withErrors(['horario_disponivel_id' => 'Horário indisponível.'])->withInput();
            }

            $horario = HorarioDisponivel::findOrFail($data['horario_disponivel_id']);
            $data['barbeiro_id'] = $horario->barbeiro_id;
            $data['data'] = $horario->data;
            $data['hora'] = $horario->hora;

            $agendamento = Agendamento::create($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao criar agendamento.'])->withInput();
        }

        return redirect()->route('admin.agendamentos.index')
            ->with('success', 'Agendamento cadastrado com sucesso!');
    }

    public function show($id)
    {
        $agendamento = Agendamento::with([
            'cliente',
            'barbeiro',
            'servico',
            'horario'
        ])->findOrFail($id);

        return view('agendamentos.show', compact('agendamento'));
    }

    public function edit($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $clientes = Cliente::all();
        $servicos = Servico::all();
        $horarios = HorarioDisponivel::with('barbeiro')->get();

        return view('agendamentos.edit', compact(
            'agendamento',
            'clientes',
            'servicos',
            'horarios'
        ));
    }

    public function update(AgendamentoRequest $request, $id)
    {
        $agendamento = Agendamento::findOrFail($id);

        $data = $request->validated();

        try {
            DB::beginTransaction();

            if ($agendamento->horario_disponivel_id !== $data['horario_disponivel_id']) {
                
                $oldHorario = HorarioDisponivel::find($agendamento->horario_disponivel_id);
                if ($oldHorario) {
                    $oldHorario->update(['disponivel' => true]);
                }

               
                $updated = HorarioDisponivel::where('id', $data['horario_disponivel_id'])
                    ->where('disponivel', true)
                    ->update(['disponivel' => false]);

                if (!$updated) {
                    DB::rollBack();
                    return back()->withErrors(['horario_disponivel_id' => 'O novo horário já está ocupado.'])->withInput();
                }
            }

            $horario = HorarioDisponivel::findOrFail($data['horario_disponivel_id']);
            $data['barbeiro_id'] = $horario->barbeiro_id;
            $data['data'] = $horario->data;
            $data['hora'] = $horario->hora;

            $agendamento->update($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao atualizar agendamento.'])->withInput();
        }

        return redirect()->route('admin.agendamentos.index')
            ->with('success', 'Agendamento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $horario = HorarioDisponivel::find($agendamento->horario_disponivel_id);
        if ($horario) {
            $horario->update(['disponivel' => true]);
        }
        $agendamento->delete();

        return redirect()->route('admin.agendamentos.index')
            ->with('success', 'Agendamento excluído com sucesso!');
    }
}
