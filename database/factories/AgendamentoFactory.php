<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Barbeiro;
use App\Models\Servico;
use App\Models\HorarioDisponivel;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendamentoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory(),

            'barbeiro_id' => Barbeiro::factory(),

            'servico_id' => Servico::factory(),

            'horario_disponivel_id' => HorarioDisponivel::factory(),
        ];
    }
}