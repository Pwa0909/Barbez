@extends('layout.admin')

@section('title', 'Editar Barbeiro')

@section('content')
<div class="admin-page">
    <h1 class="mb-4">Editar Barbeiro</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.barbeiros.update', $barbeiro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $barbeiro->nome) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $barbeiro->telefone) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Especialidade</label>
            <input type="text" name="especialidade" class="form-control" value="{{ old('especialidade', $barbeiro->especialidade) }}">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="ativo" value="1" id="ativo" {{ old('ativo', $barbeiro->ativo) ? 'checked' : '' }}>
            <label class="form-check-label" for="ativo">Ativo</label>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="{{ route('admin.barbeiros.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
