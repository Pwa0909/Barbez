@extends('layout.app')

@section('title', 'Detalhes do Cliente')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Detalhes do Cliente</h1>

    <div class="card">
        <div class="card-body">
            <h2>{{ $cliente->nome }}</h2>
            <p><strong>Telefone:</strong> {{ $cliente->telefone ?? '—' }}</p>
            <p><strong>E-mail:</strong> {{ $cliente->email }}</p>
        </div>
    </div>

    <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
