@extends('layout.app')

@section('title', 'Agendamento Confirmado')

@section('content')
<div class="success-page">
    <div class="success-hero text-center">
        <div class="container py-5">
            <div class="section-label justify-content-center mb-3">BarberPoint</div>
            <h1 class="font-serif fw-bold text-white mb-3">Agendamento confirmado</h1>
            <p class="success-subtitle mx-auto mb-0">Seu horário foi reservado com sucesso.</p>
            <div class="divider-gold mt-4"></div>
        </div>
    </div>

    <div class="container success-content">
        <div class="success-panel text-center">
            <div class="success-icon" aria-hidden="true">&#10003;</div>
            <h2 class="font-serif text-white mb-3">Tudo certo</h2>
            <p class="success-message mx-auto mb-4">Aguardamos você para um atendimento especial. Consulte nossos serviços ou escolha outro horário quando precisar.</p>

            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <a href="{{ route('servicos') }}" class="btn btn-gold px-4 py-3">Ver serviços</a>
                <a href="{{ route('agendamentos') }}" class="btn btn-outline-light px-4 py-3">Agendar outro horário</a>
            </div>
        </div>
    </div>
</div>

<style>
    .success-page { background:#0f0f0f; color:#F5F0E8; }
    .success-hero { background: linear-gradient(135deg, rgba(10,10,10,.96), rgba(10,10,10,.72)), url('/images/hero_2.jpg') center/cover no-repeat; border-bottom: 1px solid rgba(201,168,76,.15); }
    .section-label { display:inline-flex; align-items:center; gap:10px; font-size:.7rem; font-weight:500; letter-spacing:4px; text-transform:uppercase; color:#C9A84C; }
    .section-label::before { content:''; width:28px; height:1px; background:#C9A84C; }
    .font-serif { font-family:'Playfair Display', Georgia, serif; }
    .success-hero h1 { font-size:clamp(2.2rem,5vw,3.5rem); }
    .success-subtitle, .success-message { color:rgba(245,240,232,.62); font-weight:300; }
    .success-subtitle { max-width:420px; }
    .divider-gold { width:48px; height:2px; background:#C9A84C; margin-left:auto; margin-right:auto; }
    .success-content { padding-top:5rem; padding-bottom:6rem; }
    .success-panel { max-width:650px; margin:0 auto; padding:3.5rem 2rem; background:#070707; border:1px solid rgba(201,168,76,.16); border-radius:1rem; box-shadow:0 24px 60px rgba(0,0,0,.45); }
    .success-icon { display:flex; align-items:center; justify-content:center; width:72px; height:72px; margin:0 auto 1.5rem; border:1px solid rgba(201,168,76,.55); border-radius:50%; color:#E8C97A; font-size:2rem; }
    .success-message { max-width:450px; line-height:1.8; }
    .btn-gold { background:#C9A84C; color:#0F0F0F !important; border:0; border-radius:.75rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; }
    .btn-gold:hover { background:#E8C97A; }
    .btn-outline-light { border-color:rgba(255,255,255,.2); color:#F5F0E8; border-radius:.75rem; }
    .btn-outline-light:hover { background:rgba(255,255,255,.06); color:#fff; }
</style>
@endsection
