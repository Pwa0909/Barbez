@extends('layout.app')

@section('title', 'Clientes - Admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">Clientes</h1>
            <p class="text-muted mb-0">CRUD completo de clientes.</p>
        </div>
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary">Novo cliente</a>
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
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->telefone ?? '—' }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>
                            <a href="{{ route('admin.clientes.show', $cliente->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                            <a href="{{ route('admin.clientes.edit', $cliente->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('admin.clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Nenhum cliente cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
