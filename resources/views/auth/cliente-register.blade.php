@extends('layout.app')

@section('title', 'Cadastro Cliente')

@section('content')
<div class="position-relative text-center py-5 mb-5" style="background: linear-gradient(135deg,rgba(10,10,10,.92) 40%,rgba(10,10,10,.7)),url('/images/hero_2.jpg') center/cover no-repeat;border-bottom: 1px solid rgba(201,168,76,.15);">
    <div class="container py-4">
        <div class="section-label justify-content-center mb-3">BarberPoint</div>
        <h1 class="font-serif fw-bold text-white mb-3" style="font-size:clamp(2.2rem,5vw,3.5rem);">Cadastro</h1>
        <p class="fw-light mx-auto mb-0" style="color:rgba(245,240,232,.55); max-width:420px;">Crie sua conta e agende seu próximo atendimento.</p>
        <div class="divider-gold mt-3"></div>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="agendamento-form p-4 p-md-5 bg-dark shadow-dark rounded-4">
                @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('cliente.register.submit') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label-gold">Nome</label>
                        <input type="text" name="nome" class="input-gold form-control" value="{{ old('nome') }}" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-gold">E-mail</label>
                        <input type="email" name="email" class="input-gold form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-gold">Senha</label>
                        <input type="password" name="password" class="input-gold form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-gold">Confirmar senha</label>
                        <input type="password" name="password_confirmation" class="input-gold form-control" required>
                    </div>

                    <button type="submit" class="btn btn-gold w-100 py-3">Cadastrar</button>
                </form>

                <div class="mt-4 text-center">
                    <p class="mb-2 text-white-50">Já tem cadastro?</p>
                    <a href="{{ route('login') }}" class="btn btn-outline-light w-100">Ir para Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .section-label { display:inline-flex; align-items:center; gap:10px; font-size:.7rem; font-weight:500; letter-spacing:4px; text-transform:uppercase; color:#C9A84C; }
    .section-label::before { content:''; width:28px; height:1px; background:#C9A84C; }
    .divider-gold { width:48px; height:2px; background:#C9A84C; margin:.9rem auto 0; }
    .font-serif { font-family:'Playfair Display', serif; }
    .form-label-gold { display:flex; align-items:center; gap:8px; font-size:.72rem; font-weight:500; letter-spacing:2px; text-transform:uppercase; color:rgba(201,168,76,.9); margin-bottom:.75rem; }
    .input-gold { background: #070707 !important; border: 1px solid rgba(255,255,255,.12) !important; border-radius: .65rem !important; color: #F5F0E8 !important; font-family: 'Outfit', sans-serif; font-size: .95rem; padding: .85rem 1rem; transition: border-color .2s, box-shadow .2s; }
    .input-gold::placeholder { color: rgba(245,240,232,.35) !important; }
    .input-gold:focus { background: #080808 !important; border-color: rgba(201,168,76,.6) !important; box-shadow: 0 0 0 3px rgba(201,168,76,.08) !important; outline: none; color: #F5F0E8 !important; }
    .agendamento-form { background: #0d0d0d; border: 1px solid rgba(255,255,255,.08); }
    .bg-dark { background: #070707 !important; }
    .shadow-dark { box-shadow: 0 24px 60px rgba(0, 0, 0, 0.45); }
    .btn-gold { background: #C9A84C; color: #0F0F0F !important; font-size: .88rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; border: none; border-radius: .75rem; transition: background .2s, transform .2s; }
    .btn-gold:hover { background: #E8C97A; transform: translateY(-2px); }
    .btn-outline-light { border: 1px solid rgba(255,255,255,.12); color:#F5F0E8; }
    .btn-outline-light:hover { background: rgba(255,255,255,.04); color:#F5F0E8; }
    .alert-danger { background: #2c0505; border-color: #600000; color: #f8d7da; }
</style>
@endsection
