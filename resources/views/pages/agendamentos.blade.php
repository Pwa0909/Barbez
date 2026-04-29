@extends('layout.app')

@section('title', 'Agendar Horário')

@section('content')

{{-- ═══ PAGE HEADER ═══ --}}
<div class="position-relative text-center py-5 mb-5"
     style="background: linear-gradient(135deg,rgba(10,10,10,.92) 40%,rgba(10,10,10,.7)),
            url('/images/hero_2.jpg') center/cover no-repeat;
            border-bottom: 1px solid rgba(201,168,76,.15);">
  <div class="container py-4">
    <div class="section-label justify-content-center mb-3">BarberPoint</div>
    <h1 class="font-serif fw-bold text-white mb-3" style="font-size:clamp(2.2rem,5vw,3.5rem);">
      Agendar Horário
    </h1>
    <p class="fw-light mx-auto mb-0" style="color:rgba(245,240,232,.55); max-width:420px;">
      Preencha os dados abaixo e garanta seu horário com nossos profissionais.
    </p>
    <div class="divider-gold mt-3"></div>
  </div>
</div>

{{-- ═══ FORMULÁRIO ═══ --}}
<div class="container pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

      <form action="{{ route('agendamentos.store') }}" method="POST" class="agendamento-form p-4 p-md-5">
        @csrf

        {{-- Cliente --}}
        <div class="mb-4">
          <label class="form-label-gold">
            <span class="label-line"></span> Cliente
          </label>
          <input type="text"
                 name="cliente"
                 class="input-gold form-control"
                 placeholder="Seu nome completo"
                 required>
        </div>

        {{-- Serviço --}}
        <div class="mb-4">
          <label class="form-label-gold">
            <span class="label-line"></span> Serviço
          </label>
          <select name="servico_id" class="input-gold form-select">
            <option value="" disabled selected>Selecione um serviço…</option>
            @foreach($servicos as $servico)
              <option value="{{ $servico['id'] }}">
                {{ $servico['nome'] }} — R$ {{ number_format($servico['preco'], 2, ',', '.') }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Data + Horário lado a lado --}}
        <div class="row g-3 mb-4">
          <div class="col-6">
            <label class="form-label-gold">
              <span class="label-line"></span> Data
            </label>
            <input type="date"
                   name="data"
                   class="input-gold form-control"
                   required>
          </div>
          <div class="col-6">
            <label class="form-label-gold">
              <span class="label-line"></span> Horário
            </label>
            <select name="hora" class="input-gold form-select">
              <option value="" disabled selected>Selecione…</option>
              @foreach($horarios as $hora)
                <option value="{{ $hora }}">{{ $hora }}</option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- Divider --}}
        <div class="mb-4" style="height:1px; background:rgba(201,168,76,.12);"></div>

        {{-- Botão --}}
        <button type="submit" class="btn btn-gold w-100 py-3">
          Confirmar Agendamento
        </button>

        <p class="text-center fw-light mt-3 mb-0" style="color:rgba(245,240,232,.3); font-size:.78rem; letter-spacing:1px;">
          Você receberá uma confirmação após o agendamento.
        </p>

      </form>

    </div>
  </div>
</div>

<style>
  /* ── UTILITÁRIOS ── */
  .section-label {
    display: inline-flex; align-items: center; gap: 10px;
    font-size: .7rem; font-weight: 500;
    letter-spacing: 4px; text-transform: uppercase; color: #C9A84C;
  }
  .section-label::before { content:''; width:28px; height:1px; background:#C9A84C; }
  .divider-gold { width:48px; height:2px; background:#C9A84C; margin:.9rem auto 0; }
  .font-serif   { font-family:'Playfair Display', serif; }

  /* ── FORM CONTAINER ── */
  .agendamento-form {
    background: #1A1A1A;
    border: 1px solid rgba(201,168,76,.15);
    border-radius: 2px;
    position: relative;
    overflow: hidden;
  }
  .agendamento-form::before {
    content: '';
    position: absolute; top: 0; left: 0;
    width: 100%; height: 2px;
    background: linear-gradient(to right, transparent, #C9A84C, transparent);
  }

  /* ── LABELS ── */
  .form-label-gold {
    display: flex; align-items: center; gap: 8px;
    font-size: .72rem; font-weight: 500;
    letter-spacing: 2px; text-transform: uppercase;
    color: rgba(201,168,76,.8);
    margin-bottom: .6rem;
  }
  .label-line { display:block; width:16px; height:1px; background:#C9A84C; flex-shrink:0; }

  /* ── INPUTS & SELECTS ── */
  .input-gold {
    background: rgba(255,255,255,.04) !important;
    border: 1px solid rgba(255,255,255,.1) !important;
    border-radius: 2px !important;
    color: #F5F0E8 !important;
    font-family: 'Outfit', sans-serif;
    font-size: .92rem;
    padding: .75rem 1rem;
    transition: border-color .2s, box-shadow .2s;
    appearance: auto;
  }
  .input-gold::placeholder { color: rgba(245,240,232,.25) !important; }
  .input-gold:focus {
    background: rgba(255,255,255,.07) !important;
    border-color: rgba(201,168,76,.6) !important;
    box-shadow: 0 0 0 3px rgba(201,168,76,.08) !important;
    outline: none;
    color: #F5F0E8 !important;
  }
  .input-gold option {
    background: #1A1A1A;
    color: #F5F0E8;
  }

  /* ── BOTÃO ── */
  .btn-gold {
    background: #C9A84C; color: #0F0F0F !important;
    font-size: .82rem; font-weight: 600;
    letter-spacing: 2px; text-transform: uppercase;
    border: none; border-radius: 2px;
    transition: background .2s, transform .2s;
  }
  .btn-gold:hover { background: #E8C97A; transform: translateY(-2px); }
</style>

@endsection