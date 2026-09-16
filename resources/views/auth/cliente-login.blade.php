@extends('layout.app')

@section('title', 'Login')

@section('content')
<div class="position-relative text-center py-5 mb-5" style="background: linear-gradient(135deg,rgba(10,10,10,.92) 40%,rgba(10,10,10,.7)),url('https://images.unsplash.com/photo-1517832606299-7ae9b720a186?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;border-bottom: 1px solid rgba(201,168,76,.15);">
    <div class="container py-4">
        <div class="section-label justify-content-center mb-3">BarberPoint</div>
        <h1 class="font-serif fw-bold text-white mb-3" style="font-size:clamp(2.2rem,5vw,3.5rem);">Login</h1>
        <p class="fw-light mx-auto mb-0" style="color:rgba(245,240,232,.55); max-width:420px;">Acesse sua conta para continuar.</p>
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

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label-gold">E-mail</label>
                        <input type="email" name="email" class="input-gold form-control" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-gold">Senha</label>
                        <input type="password" name="password" class="input-gold form-control" required>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember-client" style="background: #070707; border-color: rgba(255,255,255,.12);">
                        <label class="form-check-label text-white-50" for="remember-client">Lembrar-me</label>
                    </div>

                    <button type="submit" class="btn btn-gold w-100 py-3">Entrar</button>
                </form>

                <div class="mt-4 text-center">
                    <p class="mb-2 text-white-50">Ainda não tem cadastro?</p>
                    <a href="{{ route('cliente.register') }}" class="btn btn-outline-light w-100">Ir para Cadastro</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .section-label {
        display:inline-flex;
        align-items:center;
        gap:10px;
        font-size:.72rem;
        font-weight:700;
        letter-spacing:4px;
        text-transform:uppercase;
        color:#f0d58d;
    }
    .section-label::before {
        content:'';
        width:28px;
        height:1px;
        background:#c9a84c;
        box-shadow: 0 0 12px rgba(201,168,76,.8);
    }
    .divider-gold {
        width:72px;
        height:3px;
        background: linear-gradient(90deg, rgba(201,168,76,0), #c9a84c, rgba(201,168,76,0));
        margin: 1rem auto 0;
        border-radius:999px;
    }
    .font-serif {
        font-family:'Playfair Display', serif;
        letter-spacing: .02em;
    }
    .form-label-gold {
        display:flex;
        align-items:center;
        gap:8px;
        font-size:.72rem;
        font-weight:700;
        letter-spacing:2px;
        text-transform:uppercase;
        color:#dfc57b;
        margin-bottom:.85rem;
    }
    .input-gold {
        background: rgba(14,14,14,0.9) !important;
        border: 1px solid rgba(255,255,255,.12) !important;
        border-radius: .9rem !important;
        color: #f5f0e8 !important;
        font-family: 'Outfit', sans-serif;
        font-size: .97rem;
        padding: .9rem 1rem;
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        box-shadow: inset 0 0 0 1px rgba(255,255,255,.02);
    }
    .input-gold::placeholder { color: rgba(245,240,232,.38) !important; }
    .input-gold:focus {
        background: rgba(12,12,12,0.96) !important;
        border-color: rgba(201,168,76,.8) !important;
        box-shadow: 0 0 0 4px rgba(201,168,76,.12), inset 0 0 0 1px rgba(201,168,76,.35) !important;
        outline: none;
        color: #f5f0e8 !important;
        transform: translateY(-1px);
    }
    .agendamento-form {
        background: linear-gradient(180deg, rgba(15,15,15,0.96), rgba(8,8,8,0.96));
        border: 1px solid rgba(255,255,255,.08);
        box-shadow: 0 28px 80px rgba(0,0,0,.5);
    }
    .bg-dark { background: rgba(7,7,7,.92) !important; }
    .shadow-dark {
        box-shadow: 0 24px 60px rgba(0,0,0,.45), 0 0 0 1px rgba(201,168,76,.08);
    }
    .btn-gold {
        background: linear-gradient(135deg, #d7bb66, #c9a84c 45%, #b8922a);
        color: #0f0f0f !important;
        font-size: .82rem;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        border: none;
        border-radius: .85rem;
        transition: transform .2s ease, filter .2s ease, box-shadow .2s ease;
        box-shadow: 0 14px 26px rgba(201,168,76,.22);
    }
    .btn-gold:hover {
        background: linear-gradient(135deg, #ebcf7d, #d9b85e 45%, #c49e39);
        transform: translateY(-2px);
        filter: brightness(1.04);
    }
    .btn-outline-light {
        border: 1px solid rgba(255,255,255,.12);
        color:#f5f0e8;
        background: rgba(255,255,255,.02);
        border-radius: .85rem;
    }
    .btn-outline-light:hover {
        background: rgba(255,255,255,.06);
        color:#f5f0e8;
    }
    .alert-danger {
        background: linear-gradient(180deg, rgba(70,12,12,.8), rgba(38,7,7,.9));
        border: 1px solid rgba(244,121,121,.6);
        color: #f8d7da;
        border-radius: .9rem;
    }
</style>
@endsection
