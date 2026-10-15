<?php

namespace Tests\Feature;

use App\Models\Agendamento;
use App\Models\Barbeiro;
use App\Models\Cliente;
use App\Models\HorarioDisponivel;
use App\Models\Servico;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MobileApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_sign_in_and_load_site_services(): void
    {
        $cliente = Cliente::create([
            'nome' => 'Cliente Mobile',
            'email' => 'mobile@gmail.com',
            'telefone' => '35999990000',
            'senha' => Hash::make('senha123'),
        ]);
        Servico::create([
            'nome' => 'Corte Simples',
            'descricao' => 'Corte tradicional',
            'preco' => 25,
            'duracao_min' => 30,
        ]);

        $login = $this->postJson('/api/mobile/login', [
            'email' => $cliente->email,
            'senha' => 'senha123',
        ])->assertOk()->assertJsonPath('tipo', 'cliente');

        $this->withToken($login->json('token'))
            ->getJson('/api/mobile/servicos')
            ->assertOk()
            ->assertJsonPath('0.nome', 'Corte Simples')
            ->assertJsonPath('0.preco', 25);
    }

    public function test_client_can_book_list_and_cancel_a_site_schedule(): void
    {
        $cliente = Cliente::create([
            'nome' => 'Cliente Mobile',
            'email' => 'mobile@gmail.com',
            'telefone' => '35999990000',
            'senha' => Hash::make('senha123'),
        ]);
        $barbeiro = Barbeiro::create([
            'nome' => 'Barbeiro Teste',
            'telefone' => '35999990001',
            'especialidade' => 'Corte',
            'ativo' => true,
        ]);
        $servico = Servico::create([
            'nome' => 'Corte Simples',
            'descricao' => 'Corte tradicional',
            'preco' => 25,
            'duracao_min' => 30,
        ]);
        $data = now()->addDays(3);
        while ($data->isSunday()) {
            $data->addDay();
        }
        $horario = HorarioDisponivel::create([
            'barbeiro_id' => $barbeiro->id,
            'data' => $data->toDateString(),
            'hora' => '10:00:00',
            'disponivel' => true,
        ]);
        $token = $this->postJson('/api/mobile/login', [
            'email' => $cliente->email,
            'senha' => 'senha123',
        ])->assertOk()->json('token');

        $this->withToken($token)
            ->postJson('/api/mobile/agendamentos', [
                'servico' => $servico->nome,
                'data' => $data->format('d/m/Y'),
                'hora' => '10:00',
            ])
            ->assertCreated()
            ->assertJsonPath('servico', $servico->nome)
            ->assertJsonPath('hora', '10:00');

        $agendamento = Agendamento::firstOrFail();
        $this->assertFalse((bool) $horario->fresh()->disponivel);

        $this->withToken($token)
            ->getJson('/api/mobile/agendamentos?todos=1&data='.$data->format('d/m/Y'))
            ->assertOk()
            ->assertJsonFragment([
                'servico' => '',
                'data' => $data->format('d/m/Y'),
                'hora' => '10:00',
            ]);

        $this->withToken($token)
            ->deleteJson('/api/mobile/agendamentos/'.$agendamento->id)
            ->assertOk();

        $this->assertDatabaseMissing('agendamentos', ['id' => $agendamento->id]);
        $this->assertTrue((bool) $horario->fresh()->disponivel);
    }

    public function test_mobile_endpoints_require_a_bearer_token(): void
    {
        $this->getJson('/api/mobile/servicos')
            ->assertUnauthorized()
            ->assertJsonPath('erro', 'Entre na sua conta novamente.');
    }
}
