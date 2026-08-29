<?php

namespace Database\Factories;

use App\Models\Barbeiro;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioDisponivelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'barbeiro_id' => Barbeiro::factory(),

            'data' => fake()->date(),

            'hora' => fake()->time(),

            'disponivel' => true,
        ];
    }
}