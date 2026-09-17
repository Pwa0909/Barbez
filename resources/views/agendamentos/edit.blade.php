@extends('layout.admin')

@section('title', 'Editar Agendamento')

@section('content')
<div class="admin-page">
    <h1 class="mb-4">Editar Agendamento</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.agendamentos.update', $agendamento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nome do cliente</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome', $agendamento->cliente?->nome ?? '') }}" placeholder="Nome do cliente">
            </div>
            <div class="col-md-6">
                <label class="form-label">Cliente</label>
                <select name="cliente_id" class="form-select" required>
                    <option value="">Selecione...</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente_id', $agendamento->cliente_id) == $cliente->id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Serviço</label>
                <select name="servico_id" class="form-select" required>
                    <option value="">Selecione...</option>
                    @foreach($servicos as $servico)
                        <option value="{{ $servico->id }}" {{ old('servico_id', $agendamento->servico_id) == $servico->id ? 'selected' : '' }}>{{ $servico->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Horário disponível</label>
            <select name="horario_disponivel_id" class="form-select" required>
                <option value="">Selecione...</option>
                @foreach($horarios as $horario)
                    <option value="{{ $horario->id }}" {{ old('horario_disponivel_id', $agendamento->horario_disponivel_id) == $horario->id ? 'selected' : '' }}>
                        {{ $horario->barbeiro->nome }} — @formatDate($horario->data) @formatTime($horario->hora)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 mt-3">
            <label class="form-label">Status</label>
            <input type="text" name="status" class="form-control" value="{{ old('status', $agendamento->status) }}" required>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="{{ route('admin.agendamentos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
