<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            [
                'nome' => 'Carlos Mendes',
                'telefone' => '(35) 99801-1234',
                'email' => 'carlos@email.com',
                'senha' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Rafael Costa',
                'telefone' => '(35) 99802-5678',
                'email' => 'rafael@email.com',
                'senha' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Lucas Ferreira',
                'telefone' => '(35) 99803-9012',
                'email' => 'lucas@email.com',
                'senha' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Bruno Oliveira',
                'telefone' => '(35) 99804-3456',
                'email' => 'bruno@email.com',
                'senha' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Thiago Santos',
                'telefone' => '(35) 99805-7890',
                'email' => 'thiago@email.com',
                'senha' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('clientes')->insert($clientes);

        $this->command->info('Clientes criados: ' . count($clientes));
    }
}