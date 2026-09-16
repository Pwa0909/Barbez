@extends('layout.admin')

@section('title', 'Detalhes do Horário')

@section('content')
<div class="admin-page">
    <h1 class="mb-4">Detalhes do Horário</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Barbeiro:</strong> {{ $horario->barbeiro->nome }}</p>
            <p><strong>Data:</strong> @formatDate($horario->data)</p>
            <p><strong>Hora:</strong> @formatTime($horario->hora)</p>
            <p><strong>Disponível:</strong> {{ $horario->disponivel ? 'Sim' : 'Não' }}</p>
        </div>
    </div>

    <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
