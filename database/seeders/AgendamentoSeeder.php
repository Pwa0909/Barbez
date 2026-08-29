<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AgendamentoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('agendamentos')->insert([
            [
                'cliente_id' => 1,
                'barbeiro_id' => 1,
                'servico_id' => 1,
                'horario_disponivel_id' => 1,
                'data' => '2026-08-05',
                'hora' => '09:00:00',
                'status' => 'confirmado',
                'observacoes' => 'Cliente prefere máquina número 2 nas laterais.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cliente_id' => 2,
                'barbeiro_id' => 1,
                'servico_id' => 4,
                'horario_disponivel_id' => 2,
                'data' => '2026-08-05',
                'hora' => '10:00:00',
                'status' => 'confirmado',
                'observacoes' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cliente_id' => 3,
                'barbeiro_id' => 2,
                'servico_id' => 2,
                'horario_disponivel_id' => 3,
                'data' => '2026-08-05',
                'hora' => '11:00:00',
                'status' => 'pendente',
                'observacoes' => 'Primeira vez na barbearia.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cliente_id' => 4,
                'barbeiro_id' => 3,
                'servico_id' => 3,
                'horario_disponivel_id' => 4,
                'data' => '2026-08-06',
                'hora' => '14:00:00',
                'status' => 'pendente',
                'observacoes' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cliente_id' => 5,
                'barbeiro_id' => 2,
                'servico_id' => 5,
                'horario_disponivel_id' => 5,
                'data' => '2026-08-06',
                'hora' => '15:00:00',
                'status' => 'confirmado',
                'observacoes' => 'Cabelo ressecado, tratamento intensivo.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cliente_id' => 1,
                'barbeiro_id' => 3,
                'servico_id' => 6,
                'horario_disponivel_id' => 6,
                'data' => '2026-08-04',
                'hora' => '16:00:00',
                'status' => 'concluido',
                'observacoes' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        $this->command->info('Agendamentos criados com sucesso!');
    }
}