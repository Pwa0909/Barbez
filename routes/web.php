<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\AgendamentoController;

Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');

Route::get('/servicos', [ServicoController::class, 'index'])->name('servicos');
Route::get('/agendamentos', [AgendamentoController::class, 'index'])->name('agendamentos');

//Route::resource('servicos', ServicoController::class);

Route::get('/agendar', [AgendamentoController::class, 'create'])
    ->name('agendamentos.create');

Route::post('/agendar', [AgendamentoController::class, 'store'])
    ->name('agendamentos.store');

Route::get('/agendamentos', [AgendamentoController::class, 'index'])
    ->name('agendamentos');

Route::view('/sucesso', 'pages.agendamentos.sucesso')
    ->name('agendamentos.sucesso');

Route::get('/', function () {
    return view('welcome');
});