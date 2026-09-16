@extends('layout.admin')

@section('title', 'Detalhes do Barbeiro')

@section('content')
<div class="admin-page">
    <h1 class="mb-4">Detalhes do Barbeiro</h1>

    <div class="card">
        <div class="card-body">
            <h2>{{ $barbeiro->nome }}</h2>
            <p><strong>Telefone:</strong> {{ $barbeiro->telefone ?? '—' }}</p>
            <p><strong>Especialidade:</strong> {{ $barbeiro->especialidade ?? '—' }}</p>
            <p><strong>Ativo:</strong> {{ $barbeiro->ativo ? 'Sim' : 'Não' }}</p>
        </div>
    </div>

    <a href="{{ route('admin.barbeiros.index') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
