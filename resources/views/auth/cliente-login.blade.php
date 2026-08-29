@extends('layout.app')

@section('title', 'Login Cliente')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="mb-4">Login Cliente</h2>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('cliente.login.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember-client">
                            <label class="form-check-label" for="remember-client">Lembrar-me</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                    </form>

                    <div class="mt-3 text-center">
                        <p class="mb-2">Ainda não tem cadastro?</p>
                        <a href="{{ route('cliente.register') }}" class="btn btn-outline-primary w-100">Ir para Cadastro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
