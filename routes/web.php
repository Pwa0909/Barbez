<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarbeiroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorarioDisponivelController;
use App\Http\Controllers\ServicoController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.submit');
Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');

Route::get('/servicos', [ServicoController::class, 'publicIndex'])->name('servicos');

Route::middleware('auth:cliente')->group(function () {
    Route::get('/agendamentos', [AgendamentoController::class, 'publicCreate'])->name('agendamentos');
    Route::post('/agendamentos', [AgendamentoController::class, 'publicStore'])->name('agendamentos.store');
});

Route::redirect('/agendar', '/agendamentos');
Route::view('/sucesso', 'pages.agendamentos.sucesso')->name('agendamentos.sucesso');
Route::redirect('/login/admin', '/login');
Route::redirect('/login/cliente', '/login');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/register/cliente', [App\Http\Controllers\ClienteAuthController::class, 'showRegisterForm'])->name('cliente.register');
Route::post('/register/cliente', [App\Http\Controllers\ClienteAuthController::class, 'register'])->name('cliente.register.submit');
Route::post('/logout/cliente', [App\Http\Controllers\ClienteAuthController::class, 'logout'])->name('cliente.logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('servicos', ServicoController::class);
    Route::resource('barbeiros', BarbeiroController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('horarios', HorarioDisponivelController::class);
    Route::resource('agendamentos', AgendamentoController::class);
});

Route::get('/', function () {
    return view('welcome');
});
