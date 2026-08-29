<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $agendamentos = Agendamento::with(['cliente', 'barbeiro', 'servico', 'horario'])
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        return view('admin.dashboard', compact('agendamentos'));
    }
}
