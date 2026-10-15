<?php

use App\Http\Controllers\MobileApiController;
use App\Http\Middleware\AuthenticateMobileToken;
use Illuminate\Support\Facades\Route;

Route::prefix('mobile')->group(function (): void {
    Route::get('/status', [MobileApiController::class, 'status']);
    Route::post('/usuarios', [MobileApiController::class, 'register'])->middleware('throttle:10,1');
    Route::post('/login', [MobileApiController::class, 'login'])->middleware('throttle:10,1');

    Route::middleware(AuthenticateMobileToken::class)->group(function (): void {
        Route::post('/logout', [MobileApiController::class, 'logout']);
        Route::get('/servicos', [MobileApiController::class, 'services']);
        Route::get('/agendamentos', [MobileApiController::class, 'appointments']);
        Route::post('/agendamentos', [MobileApiController::class, 'createAppointment']);
        Route::delete('/agendamentos/{id}', [MobileApiController::class, 'deleteAppointment']);
    });
});