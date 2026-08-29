@extends('layout.app')

@section('title', 'Editar Cliente')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Editar Cliente</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $cliente->nome) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $cliente->telefone) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $cliente->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Senha (deixe em branco para manter a mesma)</label>
            <input type="password" name="senha" class="form-control">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
