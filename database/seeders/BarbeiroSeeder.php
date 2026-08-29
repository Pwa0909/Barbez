<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarbeiroSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barbeiros')->insert([
            [
                'nome' => 'João Silva',
                'telefone' => '(35) 99901-1111',
                'especialidade' => 'Corte Degradê e Barba',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Pablo Martins',
                'telefone' => '(35) 99901-2222',
                'especialidade' => 'Corte Clássico e Acabamento',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Marcos Lima',
                'telefone' => '(35) 99901-3333',
                'especialidade' => 'Barba e Tratamentos',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}