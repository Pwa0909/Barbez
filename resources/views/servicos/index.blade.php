@extends('layout.app')

@section('title', 'Serviços - Admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">Serviços</h1>
            <p class="text-muted mb-0">CRUD completo de serviços.</p>
        </div>
        <a href="{{ route('admin.servicos.create') }}" class="btn btn-primary">Novo serviço</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Duração (min)</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($servicos as $servico)
                    <tr>
                        <td>{{ $servico->id }}</td>
                        <td>{{ $servico->nome }}</td>
                        <td>{{ $servico->descricao ?? '—' }}</td>
                        <td>R$ {{ number_format($servico->preco, 2, ',', '.') }}</td>
                        <td>{{ $servico->duracao_min }}</td>
                        <td>
                            <a href="{{ route('admin.servicos.show', $servico->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                            <a href="{{ route('admin.servicos.edit', $servico->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('admin.servicos.destroy', $servico->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este serviço?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhum serviço cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
