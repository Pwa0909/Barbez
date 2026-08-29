@extends('layout.app')

@section('title', 'Editar Horário')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Editar Horário</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.horarios.update', $horario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Barbeiro</label>
            <select name="barbeiro_id" class="form-select" required>
                <option value="">Selecione...</option>
                @foreach($barbeiros as $barbeiro)
                    <option value="{{ $barbeiro->id }}" {{ old('barbeiro_id', $horario->barbeiro_id) == $barbeiro->id ? 'selected' : '' }}>{{ $barbeiro->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Data</label>
                <input type="date" name="data" class="form-control" value="{{ old('data', $horario->data) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Hora</label>
                <input type="time" name="hora" class="form-control" value="{{ old('hora', $horario->hora) }}" required>
            </div>
        </div>

        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" name="disponivel" value="1" id="disponivel" {{ old('disponivel', $horario->disponivel) ? 'checked' : '' }}>
            <label class="form-check-label" for="disponivel">Disponível</label>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
