<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Barbeiro;
use App\Models\Cliente;
use App\Models\HorarioDisponivel;
use App\Models\Servico;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class MobileApiController extends Controller
{
    public function status(): JsonResponse
    {
        return response()->json(['mensagem' => 'API BarberPoint funcionando.']);
    }

    public function register(Request $request): JsonResponse
    {
        $emailInformado = Str::lower(trim((string) $request->input('email')));
        if (
            Cliente::whereRaw('LOWER(email) = ?', [$emailInformado])->exists() ||
            User::whereRaw('LOWER(email) = ?', [$emailInformado])->exists()
        ) {
            return response()->json(['erro' => 'Este e-mail já está cadastrado.'], 409);
        }

        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:clientes,email',
                'unique:users,email',
                'regex:/^(?:[A-Za-z0-9._%+-]+@gmail\.com|admin@barbearia\.com)$/i',
            ],
            'telefone' => ['nullable', 'string', 'max:20'],
            'senha' => ['required', 'string', 'min:6'],
        ], [
            'email.unique' => 'Este e-mail já está cadastrado.',
            'email.regex' => 'O e-mail deve terminar com @gmail.com ou ser o e-mail do admin.',
            'senha.min' => 'A senha deve ter pelo menos 6 caracteres.',
        ]);

        Cliente::create([
            'nome' => $dados['nome'],
            'email' => Str::lower($dados['email']),
            'telefone' => $dados['telefone'] ?? null,
            'senha' => Hash::make($dados['senha']),
        ]);

        return response()->json(['mensagem' => 'Cadastro realizado com sucesso.'], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'senha' => ['required', 'string'],
        ]);
        $email = Str::lower(trim($dados['email']));
        $senha = $dados['senha'];

        $cliente = Cliente::whereRaw('LOWER(email) = ?', [$email])->first();
        if ($cliente && Hash::check($senha, $cliente->senha)) {
            return $this->emitirToken($cliente, 'cliente');
        }

        $administrador = User::whereRaw('LOWER(email) = ?', [$email])->first();
        if ($administrador && Hash::check($senha, $administrador->password)) {
            return $this->emitirToken($administrador, 'admin');
        }

        return response()->json(['erro' => 'Email ou senha incorretos.'], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        DB::table('mobile_api_tokens')
            ->where('id', $request->attributes->get('mobile_token_id'))
            ->delete();

        return response()->json(['mensagem' => 'Sessão encerrada.']);
    }

    public function services(): JsonResponse
    {
        $servicos = Servico::query()
            ->orderBy('nome')
            ->get(['id', 'nome', 'preco'])
            ->map(fn (Servico $servico): array => [
                'id' => (string) $servico->id,
                'nome' => $servico->nome,
                'preco' => (float) $servico->preco,
            ]);

        return response()->json($servicos);
    }

    public function appointments(Request $request): JsonResponse
    {
        $userType = $request->attributes->get('mobile_user_type');
        $user = $request->attributes->get('mobile_user');
        $todos = $request->query('todos') === '1';
        $painelAdmin = $request->query('painel') === '1';

        if ($painelAdmin) {
            if ($userType !== 'admin') {
                return response()->json(['erro' => 'Acesso permitido apenas ao administrador.'], 403);
            }

            $agendamentos = Agendamento::with(['cliente', 'servico'])
                ->orderByDesc('data')
                ->orderBy('hora')
                ->get()
                ->map(fn (Agendamento $agendamento): array => $this->formatAppointment($agendamento, true));

            return response()->json($agendamentos);
        }

        if ($todos) {
            $dados = $request->validate([
                'data' => ['required', 'date_format:d/m/Y'],
            ]);
            $data = Carbon::createFromFormat('!d/m/Y', $dados['data']);
            if ($data->lt(today()) || $data->gt(today()->addDays(90))) {
                return response()->json(['erro' => 'Escolha uma data dentro dos próximos 90 dias.'], 422);
            }
            $this->ensureSchedulesFor($data);

            $horariosDoDia = HorarioDisponivel::whereDate('data', $data->toDateString())
                ->get(['hora', 'disponivel']);
            $horariosOcupados = collect();
            for ($minutos = 7 * 60; $minutos <= 17 * 60; $minutos += 30) {
                $hora = sprintf('%02d:%02d', intdiv($minutos, 60), $minutos % 60);
                $temVaga = $horariosDoDia->contains(
                    fn (HorarioDisponivel $horario): bool =>
                        substr((string) $horario->hora, 0, 5) === $hora &&
                        (bool) $horario->disponivel,
                );
                if (! $temVaga) {
                    $horariosOcupados->push([
                        'servico' => '',
                        'data' => $data->format('d/m/Y'),
                        'hora' => $hora,
                    ]);
                }
            }

            return response()->json($horariosOcupados);
        }

        if ($userType !== 'cliente') {
            return response()->json(['erro' => 'Não foi possível carregar os agendamentos.'], 403);
        }

        $agendamentos = Agendamento::with('servico')
            ->where('cliente_id', $user->id)
            ->orderBy('data')
            ->orderBy('hora')
            ->get()
            ->map(fn (Agendamento $agendamento): array => $this->formatAppointment($agendamento));

        return response()->json($agendamentos);
    }

    public function createAppointment(Request $request): JsonResponse
    {
        if ($request->attributes->get('mobile_user_type') !== 'cliente') {
            return response()->json(['erro' => 'Somente clientes podem realizar agendamentos.'], 403);
        }

        $dados = $request->validate([
            'servico' => ['required', 'string', 'max:100'],
            'data' => ['required', 'date_format:d/m/Y'],
            'hora' => ['required', 'date_format:H:i'],
        ]);

        $data = Carbon::createFromFormat('!d/m/Y', $dados['data']);
        $dataHora = Carbon::createFromFormat('!d/m/Y H:i', $dados['data'].' '.$dados['hora']);
        if ($data->lt(today()) || $data->gt(today()->addDays(90))) {
            return response()->json(['erro' => 'Escolha uma data dentro dos próximos 90 dias.'], 422);
        }
        if ($data->isSunday()) {
            return response()->json(['erro' => 'Não é permitido agendar aos domingos.'], 422);
        }
        if (! $dataHora->isFuture()) {
            return response()->json(['erro' => 'Não é possível agendar um horário que já passou.'], 422);
        }

        $servico = Servico::whereRaw('LOWER(nome) = ?', [Str::lower(trim($dados['servico']))])->first();
        if (! $servico) {
            return response()->json(['erro' => 'O serviço selecionado não está mais disponível. Atualize a lista e tente novamente.'], 422);
        }

        $cliente = $request->attributes->get('mobile_user');
        try {
            $agendamento = DB::transaction(function () use ($cliente, $data, $dados, $servico): Agendamento {
                $horario = HorarioDisponivel::query()
                    ->whereDate('data', $data->toDateString())
                    ->where('hora', $dados['hora'].':00')
                    ->where('disponivel', true)
                    ->orderBy('barbeiro_id')
                    ->lockForUpdate()
                    ->first();

                if (! $horario) {
                    throw new BookingUnavailableException;
                }

                $horario->update(['disponivel' => false]);

                return Agendamento::create([
                    'cliente_id' => $cliente->id,
                    'barbeiro_id' => $horario->barbeiro_id,
                    'servico_id' => $servico->id,
                    'horario_disponivel_id' => $horario->id,
                    'data' => $horario->data,
                    'hora' => $horario->hora,
                    'status' => 'Agendado',
                ])->load('servico');
            });
        } catch (BookingUnavailableException) {
            return response()->json(['erro' => 'Este horário já está ocupado.'], 409);
        } catch (Throwable $exception) {
            Log::error('Falha ao criar agendamento pelo app.', [
                'cliente_id' => $cliente->id,
                'exception' => $exception,
            ]);

            return response()->json(['erro' => 'Não foi possível criar o agendamento. Tente novamente.'], 500);
        }

        return response()->json($this->formatAppointment($agendamento), 201);
    }

    public function deleteAppointment(Request $request, string $id): JsonResponse
    {
        $userType = $request->attributes->get('mobile_user_type');
        $user = $request->attributes->get('mobile_user');
        $agendamento = Agendamento::find($id);
        if (! $agendamento || ($userType !== 'admin' && $agendamento->cliente_id !== $user->id)) {
            return response()->json(['erro' => 'Agendamento não encontrado.'], 404);
        }

        if ($userType !== 'admin') {
            $dataHora = Carbon::parse($agendamento->data.' '.$agendamento->hora);
            if (now()->diffInHours($dataHora, false) < 24) {
                return response()->json([
                    'erro' => 'Para cancelar com menos de 24 horas, entre em contato com a barbearia.',
                ], 403);
            }
        }

        DB::transaction(function () use ($agendamento): void {
            $horario = HorarioDisponivel::whereKey($agendamento->horario_disponivel_id)
                ->lockForUpdate()
                ->first();
            if ($horario) {
                $horario->update(['disponivel' => true]);
            }
            $agendamento->delete();
        });

        return response()->json(['mensagem' => 'Agendamento removido.']);
    }

    private function emitirToken(Cliente|User $usuario, string $tipo): JsonResponse
    {
        $token = bin2hex(random_bytes(32));
        DB::table('mobile_api_tokens')->insert([
            'tipo' => $tipo,
            'usuario_id' => $usuario->id,
            'token_hash' => hash('sha256', $token),
            'expires_at' => now()->addDays(90),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'id' => (string) $usuario->id,
            'nome' => $tipo === 'admin' ? $usuario->name : $usuario->nome,
            'email' => $usuario->email,
            'tipo' => $tipo,
            'token' => $token,
        ]);
    }

    private function formatAppointment(Agendamento $agendamento, bool $includeCustomer = false): array
    {
        $result = [
            'id' => (string) $agendamento->id,
            'servico' => $agendamento->servico?->nome ?? 'Serviço',
            'data' => Carbon::parse($agendamento->data)->format('d/m/Y'),
            'hora' => substr((string) $agendamento->hora, 0, 5),
        ];

        if ($includeCustomer) {
            $result['email'] = $agendamento->cliente?->email;
            $result['nomeCliente'] = $agendamento->cliente?->nome ?? 'Nome não informado';
            $result['telefone'] = $agendamento->cliente?->telefone ?? 'Telefone não informado';
        }

        return $result;
    }

    private function ensureSchedulesFor(Carbon $data): void
    {
        if ($data->isSunday() || HorarioDisponivel::whereDate('data', $data->toDateString())->exists()) {
            return;
        }

        $barbeiros = Barbeiro::where('ativo', true)->pluck('id');
        $horarios = [];
        foreach ($barbeiros as $barbeiroId) {
            for ($minutos = 7 * 60; $minutos <= 17 * 60; $minutos += 30) {
                $horarios[] = [
                    'barbeiro_id' => $barbeiroId,
                    'data' => $data->toDateString(),
                    'hora' => sprintf('%02d:%02d:00', intdiv($minutos, 60), $minutos % 60),
                    'disponivel' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if ($horarios) {
            DB::table('horarios_disponiveis')->insertOrIgnore($horarios);
        }
    }
}

class BookingUnavailableException extends \RuntimeException {}