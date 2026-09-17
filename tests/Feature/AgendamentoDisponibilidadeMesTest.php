<?php

namespace Tests\Feature;

use App\Models\Barbeiro;
use App\Models\Cliente;
use App\Models\HorarioDisponivel;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AgendamentoDisponibilidadeMesTest extends TestCase
{
    use RefreshDatabase;

    public function test_o_calendario_gera_horarios_para_todos_os_dias_do_mes_atual(): void
    {
        Barbeiro::create([
            'nome' => 'José',
            'telefone' => '(11) 99999-9999',
            'especialidade' => 'Corte',
            'ativo' => true,
        ]);

        $cliente = Cliente::create([
            'nome' => 'Cliente Teste',
            'telefone' => '(11) 98888-7777',
            'email' => 'cliente@test.com',
            'senha' => bcrypt('secret123'),
        ]);

        $this->actingAs($cliente, 'cliente');

        $this->get(route('agendamentos'))->assertOk();

        $inicio = Carbon::now()->startOfMonth();
        $fim = Carbon::now()->endOfMonth();

        $data = $inicio->copy();

        while ($data->lte($fim)) {
            if (! $data->isSunday()) {
                $this->assertTrue(
                    HorarioDisponivel::whereDate('data', $data->toDateString())
                        ->where('disponivel', true)
                        ->exists(),
                    'Deveria existir pelo menos 1 horário disponível em ' . $data->toDateString()
                );
            }

            $data->addDay();
        }
    }
}
