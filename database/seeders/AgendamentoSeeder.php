<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
 
class AgendamentoSeeder extends Seeder
{
    public function run(): void
    {
        $agendamentos = [
            [
                'cliente_id'   => 1,
                'barbeiro_id'  => 1,
                'servico_id'   => 1, // Corte Simples
                'data'         => Carbon::today()->toDateString(),
                'hora'         => '09:00:00',
                'status'       => 'confirmado',
                'observacoes'  => 'Cliente prefere máquina número 2 nas laterais.',
                'criado_em'    => Carbon::now(),
            ],
            [
                'cliente_id'   => 2,
                'barbeiro_id'  => 1,
                'servico_id'   => 4, // Corte + Barba
                'data'         => Carbon::today()->toDateString(),
                'hora'         => '10:00:00',
                'status'       => 'confirmado',
                'observacoes'  => null,
                'criado_em'    => Carbon::now(),
            ],
            [
                'cliente_id'   => 3,
                'barbeiro_id'  => 2,
                'servico_id'   => 2, // Degradê
                'data'         => Carbon::today()->toDateString(),
                'hora'         => '11:00:00',
                'status'       => 'pendente',
                'observacoes'  => 'Primeira vez na barbearia.',
                'criado_em'    => Carbon::now(),
            ],
            [
                'cliente_id'   => 4,
                'barbeiro_id'  => 3,
                'servico_id'   => 3, // Barba
                'data'         => Carbon::tomorrow()->toDateString(),
                'hora'         => '14:00:00',
                'status'       => 'pendente',
                'observacoes'  => null,
                'criado_em'    => Carbon::now(),
            ],
            [
                'cliente_id'   => 5,
                'barbeiro_id'  => 2,
                'servico_id'   => 5, // Hidratação
                'data'         => Carbon::tomorrow()->toDateString(),
                'hora'         => '15:00:00',
                'status'       => 'confirmado',
                'observacoes'  => 'Cabelo ressecado, tratamento intensivo.',
                'criado_em'    => Carbon::now(),
            ],
            [
                'cliente_id'   => 1,
                'barbeiro_id'  => 3,
                'servico_id'   => 6, // Pigmentação
                'data'         => Carbon::yesterday()->toDateString(),
                'hora'         => '16:00:00',
                'status'       => 'concluido',
                'observacoes'  => null,
                'criado_em'    => Carbon::yesterday(),
            ],
        ];
 
        DB::table('agendamentos')->insert($agendamentos);
 
        // Marca os horários ocupados como indisponíveis
        foreach ($agendamentos as $ag) {
            DB::table('horarios_disponiveis')
                ->where('barbeiro_id', $ag['barbeiro_id'])
                ->where('data', $ag['data'])
                ->where('hora', $ag['hora'])
                ->update(['disponivel' => 0]);
        }
 
        $this->command->info('✅ Agendamentos criados: ' . count($agendamentos));
        $this->command->info('✅ Horários ocupados marcados como indisponíveis.');
    }
}