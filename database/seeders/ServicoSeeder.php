<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 
class ServicoSeeder extends Seeder
{
    public function run(): void
    {
        $servicos = [
            [
                'nome'        => 'Corte Simples',
                'descricao'   => 'Corte tradicional com tesoura ou máquina.',
                'preco'       => 25.00,
                'duracao_min' => 30,
            ],
            [
                'nome'        => 'Corte Degradê',
                'descricao'   => 'Corte moderno com degradê nas laterais.',
                'preco'       => 35.00,
                'duracao_min' => 45,
            ],
            [
                'nome'        => 'Barba Completa',
                'descricao'   => 'Aparar, modelar e hidratação da barba.',
                'preco'       => 30.00,
                'duracao_min' => 30,
            ],
            [
                'nome'        => 'Corte + Barba',
                'descricao'   => 'Combo corte e barba com desconto.',
                'preco'       => 55.00,
                'duracao_min' => 60,
            ],
            [
                'nome'        => 'Hidratação Capilar',
                'descricao'   => 'Tratamento com máscara hidratante profissional.',
                'preco'       => 40.00,
                'duracao_min' => 45,
            ],
            [
                'nome'        => 'Pigmentação de Barba',
                'descricao'   => 'Coloração e preenchimento da barba.',
                'preco'       => 50.00,
                'duracao_min' => 60,
            ],
        ];
 
        DB::table('servicos')->insert($servicos);
 
        $this->command->info('✅ Serviços criados: ' . count($servicos));
    }
}