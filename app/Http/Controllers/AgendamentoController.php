<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Servico;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
   public function index()
{
    $servicos = [
        ['id' => 1, 'nome' => 'Corte Masculino', 'preco' => 25.00],
        ['id' => 2, 'nome' => 'Barba', 'preco' => 15.00],
        ['id' => 3, 'nome' => 'Corte + Barba', 'preco' => 35.00],
        ['id' => 4, 'nome' => 'Sobrancelha', 'preco' => 5.00],
    ];

    $horarios = [
        '09:00',
        '10:00',
        '11:00',
        '13:00',
        '14:00',
        '15:00',
        '16:00',
    ];

    return view('pages.agendamentos', compact('servicos', 'horarios'));
}
}