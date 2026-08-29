@extends('layout.app')

@section('title', 'Agendamentos - Admin')

@section('content')
<div class="container py-5">
    @php $barbeirosCount = \App\Models\Barbeiro::count(); @endphp
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">Agendamentos</h1>
            <p class="text-muted mb-0">CRUD completo de agendamentos.</p>
        </div>
        <a href="{{ route('admin.agendamentos.create') }}" class="btn btn-primary">Novo agendamento</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    @if($barbeirosCount > 1)
                        <th>Barbeiro</th>
                    @endif
                    <th>Serviço</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agendamentos as $agendamento)
                    <tr>
                        <td>{{ $agendamento->id }}</td>
                        <td>{{ $agendamento->cliente->nome }}</td>
                        @if($barbeirosCount > 1)
                            <td>{{ $agendamento->barbeiro->nome }}</td>
                        @endif
                        <td>{{ $agendamento->servico->nome }}</td>
                        <td>{{ $agendamento->data }}</td>
                        <td>{{ $agendamento->hora }}</td>
                        <td>{{ $agendamento->status }}</td>
                        <td>
                            <a href="{{ route('admin.agendamentos.show', $agendamento->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                            <a href="{{ route('admin.agendamentos.edit', $agendamento->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('admin.agendamentos.destroy', $agendamento->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    @php $colspan = $barbeirosCount > 1 ? 8 : 7; @endphp
                    <tr>
                        <td colspan="{{ $colspan }}" class="text-center">Nenhum agendamento cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
