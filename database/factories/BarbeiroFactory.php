<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarbeiroFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'telefone' => fake()->numerify('(##) #####-####'),
            'especialidade' => fake()->randomElement([
                'Corte Masculino',
                'Barba',
                'Degradê',
                'Navalhado',
                'Corte Infantil'
            ]),
            'ativo' => true,
        ];
    }
}