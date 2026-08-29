@extends('layout.app')

@section('title', 'Editar Serviço')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Editar Serviço</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.servicos.update', $servico->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $servico->nome) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control">{{ old('descricao', $servico->descricao) }}</textarea>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Preço</label>
                <input type="number" step="0.01" name="preco" class="form-control" value="{{ old('preco', $servico->preco) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Duração (min)</label>
                <input type="number" name="duracao_min" class="form-control" value="{{ old('duracao_min', $servico->duracao_min) }}" required>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="{{ route('admin.servicos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
