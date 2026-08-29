@extends('layout.app')

@section('title', 'Agendamento Confirmado')

@section('content')
<div class="container py-5 text-center" style="background:#050505; border:1px solid rgba(255,255,255,.08); border-radius:18px; box-shadow:0 24px 50px rgba(0,0,0,.45);">
    <div class="mb-4">
        <h1 class="text-white">Agendamento Confirmado</h1>
        <p class="text-secondary">Seu horário foi agendado com sucesso.</p>
    </div>

    <a href="{{ route('servicos') }}" class="btn btn-gold me-2">Ver serviços</a>
    <a href="{{ route('agendamentos') }}" class="btn btn-outline-secondary">Agendar outro horário</a>
</div>
@endsection
