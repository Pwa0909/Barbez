<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 
class BarbeiroSeeder extends Seeder
{
    public function run(): void
    {
        $barbeiros = [
            [
                'nome'          => 'João Silva',
                'especialidade' => 'Corte Degradê e Barba',
                'telefone'      => '(35) 99901-1111',
                'ativo'         => 1,
            ],
            [
                'nome'          => 'Pablo Martins',
                'especialidade' => 'Corte Clássico e Acabamento',
                'telefone'      => '(35) 99901-2222',
                'ativo'         => 1,
            ],
            [
                'nome'          => 'Marcos Lima',
                'especialidade' => 'Barba e Tratamentos',
                'telefone'      => '(35) 99901-3333',
                'ativo'         => 1,
            ],
        ];
 
        DB::table('barbeiros')->insert($barbeiros);
 
        $this->command->info('✅ Barbeiros criados: ' . count($barbeiros));
    }
}
 