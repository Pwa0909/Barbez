@extends('layout.app')

@section('title', 'Detalhes do Horário')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Detalhes do Horário</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Barbeiro:</strong> {{ $horario->barbeiro->nome }}</p>
            <p><strong>Data:</strong> {{ $horario->data }}</p>
            <p><strong>Hora:</strong> {{ $horario->hora }}</p>
            <p><strong>Disponível:</strong> {{ $horario->disponivel ? 'Sim' : 'Não' }}</p>
        </div>
    </div>

    <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
