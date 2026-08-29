@extends('layout.app')

@section('title', 'Barbeiros - Admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">Barbeiros</h1>
            <p class="text-muted mb-0">CRUD completo de barbeiros.</p>
        </div>
        <a href="{{ route('admin.barbeiros.create') }}" class="btn btn-primary">Novo barbeiro</a>
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
                    <th>Telefone</th>
                    <th>Especialidade</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barbeiros as $barbeiro)
                    <tr>
                        <td>{{ $barbeiro->id }}</td>
                        <td>{{ $barbeiro->nome }}</td>
                        <td>{{ $barbeiro->telefone ?? '—' }}</td>
                        <td>{{ $barbeiro->especialidade ?? '—' }}</td>
                        <td>{{ $barbeiro->ativo ? 'Sim' : 'Não' }}</td>
                        <td>
                            <a href="{{ route('admin.barbeiros.show', $barbeiro->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                            <a href="{{ route('admin.barbeiros.edit', $barbeiro->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('admin.barbeiros.destroy', $barbeiro->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhum barbeiro cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
