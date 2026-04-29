@extends('layout.app')

@section('title', 'Serviços')

@section('content')

{{-- ═══ PAGE HEADER ═══ --}}
<div class="position-relative text-center py-5 mb-5"
     style="background: linear-gradient(135deg,rgba(10,10,10,.92) 40%,rgba(10,10,10,.7)),
            url('/images/hero_1.jpg') center/cover no-repeat;
            border-bottom: 1px solid rgba(201,168,76,.15);">
  <div class="container py-4">
    <div class="section-label justify-content-center mb-3">BarberPoint</div>
    <h1 class="font-serif fw-bold text-white mb-3" style="font-size:clamp(2.2rem,5vw,3.5rem);">
      Nossos Serviços
    </h1>
    <p class="fw-light mx-auto mb-0" style="color:rgba(245,240,232,.55); max-width:420px;">
      Escolha o serviço ideal e agende agora mesmo com nossos profissionais.
    </p>
    <div class="divider-gold mt-3"></div>
  </div>
</div>

{{-- ═══ CARDS ═══ --}}
<div class="container pb-5">
  <div class="row g-4 justify-content-center">

    @foreach($servicos as $servico)
    <div class="col-sm-6 col-lg-4">
      <div class="servico-card h-100 d-flex flex-column align-items-center text-center p-4">

        {{-- Ícone decorativo --}}
        <div class="servico-icon mb-4">
          <span class="flaticon-scissors"></span>
        </div>

        {{-- Nome --}}
        <h5 class="font-serif fw-bold text-white mb-2" style="font-size:1.2rem;">
          {{ $servico['nome'] }}
        </h5>

        {{-- Descrição (se existir) --}}
        @if(!empty($servico['descricao']))
        <p class="fw-light mb-4" style="color:rgba(245,240,232,.5); font-size:.88rem; line-height:1.7;">
          {{ $servico['descricao'] }}
        </p>
        @else
        <p class="fw-light mb-4" style="color:rgba(245,240,232,.5); font-size:.88rem; line-height:1.7;">
          Atendimento realizado por profissionais especializados com técnica e cuidado.
        </p>
        @endif

        {{-- Preço (se existir) --}}
        @if(!empty($servico['preco']))
        <div class="mb-4">
          <span class="text-gold fw-bold" style="font-size:1.4rem; font-family:'Playfair Display',serif;">
            R$ {{ number_format($servico['preco'], 2, ',', '.') }}
          </span>
        </div>
        @endif

        {{-- Botão --}}
        <div class="mt-auto w-100">
          <a href="{{ route('agendamentos') }}" class="btn btn-gold w-100 py-2">
            Agendar
          </a>
        </div>

      </div>
    </div>
    @endforeach

  </div>
</div>

<style>
  /* ── LABEL & DIVIDER ── */
  .section-label {
    display: inline-flex; align-items: center; gap: 10px;
    font-size: .7rem; font-weight: 500;
    letter-spacing: 4px; text-transform: uppercase; color: #C9A84C;
  }
  .section-label::before { content:''; width:28px; height:1px; background:#C9A84C; }
  .divider-gold { width:48px; height:2px; background:#C9A84C; margin: .9rem auto 0; }
  .font-serif   { font-family:'Playfair Display', serif; }
  .text-gold    { color:#C9A84C !important; }

  /* ── BOTÃO GOLD ── */
  .btn-gold {
    background: #C9A84C; color: #0F0F0F !important;
    font-size: .78rem; font-weight: 500;
    letter-spacing: 2px; text-transform: uppercase;
    border: none; border-radius: 2px;
    transition: background .2s, transform .2s;
  }
  .btn-gold:hover { background: #E8C97A; transform: translateY(-2px); }

  /* ── CARD ── */
  .servico-card {
    background: #1A1A1A;
    border: 1px solid rgba(201,168,76,.15);
    border-radius: 2px;
    position: relative;
    overflow: hidden;
    transition: background .3s, transform .3s, box-shadow .3s;
  }
  .servico-card::after {
    content: ''; position: absolute; bottom: 0; left: 0;
    width: 0; height: 2px; background: #C9A84C; transition: width .4s;
  }
  .servico-card:hover {
    background: #242424;
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0,0,0,.4);
  }
  .servico-card:hover::after { width: 100%; }

  /* ── ÍCONE ── */
  .servico-icon {
    width: 54px; height: 54px;
    border: 1px solid rgba(201,168,76,.35);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #C9A84C; font-size: 1.3rem;
    transition: background .3s;
  }
  .servico-card:hover .servico-icon { background: rgba(201,168,76,.08); }
</style>

@endsection