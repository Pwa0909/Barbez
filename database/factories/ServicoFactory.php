<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServicoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->randomElement([
                'Corte',
                'Barba',
                'Corte + Barba',
                'Sobrancelha',
                'Pigmentação',
                'Hidratação'
            ]),

            'preco' => fake()->randomFloat(2, 20, 120),
        ];
    }
}