@extends('layout.app')

@section('title', 'Detalhes do Serviço')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Detalhes do Serviço</h1>

    <div class="card">
        <div class="card-body">
            <h2>{{ $servico->nome }}</h2>
            <p>{{ $servico->descricao ?? 'Sem descrição' }}</p>
            <p><strong>Preço:</strong> R$ {{ number_format($servico->preco, 2, ',', '.') }}</p>
            <p><strong>Duração:</strong> {{ $servico->duracao_min }} minutos</p>
        </div>
    </div>

    <a href="{{ route('admin.servicos.index') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
