@extends('layout.admin')

@section('title', 'Cadastrar Serviço')

@section('content')
<div class="admin-page">
    <h1 class="mb-4">Cadastrar Serviço</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.servicos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control">{{ old('descricao') }}</textarea>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Preço</label>
                <input type="number" step="0.01" name="preco" class="form-control" value="{{ old('preco') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Duração (min)</label>
                <input type="number" name="duracao_min" class="form-control" value="{{ old('duracao_min') }}" required>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('admin.servicos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
