@extends('layout.app')

@section('title', 'Detalhes do Agendamento')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Detalhes do Agendamento</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $agendamento->cliente->nome }}</p>
            @if(\App\Models\Barbeiro::count() > 1)
                <p><strong>Barbeiro:</strong> {{ $agendamento->barbeiro->nome }}</p>
            @endif
            <p><strong>Serviço:</strong> {{ $agendamento->servico->nome }}</p>
            <p><strong>Horário:</strong> {{ $agendamento->horario->data }} {{ $agendamento->horario->hora }}</p>
            <p><strong>Data no agendamento:</strong> {{ $agendamento->data }}</p>
            <p><strong>Hora no agendamento:</strong> {{ $agendamento->hora }}</p>
            <p><strong>Status:</strong> {{ $agendamento->status }}</p>
            <p><strong>Observações:</strong> {{ $agendamento->observacoes ?? 'Nenhuma' }}</p>
        </div>
    </div>

    <a href="{{ route('admin.agendamentos.index') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
