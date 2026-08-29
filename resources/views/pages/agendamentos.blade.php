@extends('layout.app')

@section('title', 'Agendar Horário')

@section('content')
<div class="position-relative text-center py-5 mb-5" style="background: linear-gradient(135deg,rgba(10,10,10,.92) 40%,rgba(10,10,10,.7)),url('/images/hero_2.jpg') center/cover no-repeat;border-bottom: 1px solid rgba(201,168,76,.15);">
    <div class="container py-4">
        <div class="section-label justify-content-center mb-3">BarberPoint</div>
        <h1 class="font-serif fw-bold text-white mb-3" style="font-size:clamp(2.2rem,5vw,3.5rem);">Agendar Horário</h1>
        <p class="fw-light mx-auto mb-0" style="color:rgba(245,240,232,.55); max-width:420px;">Preencha os dados abaixo e garanta seu horário com nossos profissionais.</p>
        <div class="divider-gold mt-3"></div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('agendamentos.store') }}" method="POST" class="agendamento-form p-4 p-md-5 bg-dark shadow-dark rounded-4">
                @csrf

                <div class="mb-4">
                    <div class="alert alert-secondary py-3">
                        Você está logado e pronto para agendar. Selecione o serviço, depois o dia e o horário.
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label-gold">Nome completo</label>
                    <input type="text" name="nome" class="input-gold form-control" value="{{ old('nome') }}" placeholder="Digite seu nome completo" required>
                </div>

                <div class="mb-4">
                    <label class="form-label-gold">Serviço</label>
                    <select name="servico_id" class="input-gold form-select" required>
                        <option value="">Selecione o serviço...</option>
                        @foreach($servicos as $servico)
                            <option value="{{ $servico->id }}" {{ old('servico_id') == $servico->id ? 'selected' : '' }}>{{ $servico->nome }} — R$ {{ number_format($servico->preco, 2, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="horario-calendar-screen" class="mb-4">
                    <label class="form-label-gold">Selecione o dia</label>
                    <div class="calendar-box rounded-4 p-3 bg-black border border-white-10 mb-3">
                        <div id="horario-datepicker"></div>
                    </div>
                    <p class="text-muted small mb-2">Não é possível escolher dias ou meses anteriores. Após selecionar o dia, você será direcionado para os horários disponíveis.</p>
                </div>

                <div id="horario-times-screen" class="mb-4 d-none">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <label class="form-label-gold">Horários disponíveis</label>
                            <div class="selected-day text-white mb-1">Dia escolhido: <span id="chosen-date-label"></span></div>
                            <p class="text-muted small mb-0">Selecione o horário desejado para este dia.</p>
                        </div>
                        <button type="button" class="btn btn-outline-light btn-sm" id="horario-back-button">Voltar ao calendário</button>
                    </div>
                    <div class="horario-options">
                        @forelse($horarios as $horario)
                            <label class="horario-card {{ old('horario_disponivel_id') == $horario->id ? 'selected' : '' }} d-none" data-date="{{ $horario->data }}">
                                <input type="radio" name="horario_disponivel_id" value="{{ $horario->id }}" required hidden {{ old('horario_disponivel_id') == $horario->id ? 'checked' : '' }}>
                                <div class="horario-card-content">
                                    <div class="horario-card-top">
                                        <span class="horario-day">{{ date('d/m/Y', strtotime($horario->data)) }}</span>
                                        <span class="horario-time">{{ date('H:i', strtotime($horario->hora)) }}</span>
                                    </div>
                                    <div class="horario-note">Escolha este horário</div>
                                </div>
                            </label>
                        @empty
                            <div class="alert alert-warning mb-0">Nenhum horário disponível no momento. Tente novamente mais tarde ou entre em contato.</div>
                        @endforelse
                    </div>
                    <div class="alert alert-warning mt-3 d-none" id="horario-no-results">Nenhum horário disponível para o dia selecionado.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label-gold">Observações</label>
                    <textarea name="observacoes" class="input-gold form-control" rows="4" placeholder="Adicione detalhes opcionais">{{ old('observacoes') }}</textarea>
                </div>

                <div class="mb-4" style="height:1px; background:rgba(201,168,76,.12);"></div>

                <button type="submit" class="btn btn-gold w-100 py-3">Confirmar Agendamento</button>
            </form>
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
    .input-gold option { background: #0a0a0a !important; color: #F5F0E8 !important; }
    .agendamento-form { background: #0d0d0d; border: 1px solid rgba(255,255,255,.08); }
    .agendamento-form .form-label-gold { color: rgba(201,168,76,.95); }
    .agendamento-form textarea, .agendamento-form input, .agendamento-form select { background: #090909 !important; }
    .btn-gold { background: #C9A84C; color: #0F0F0F !important; font-size: .88rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; border: none; border-radius: .75rem; transition: background .2s, transform .2s; }
    .btn-gold:hover { background: #E8C97A; transform: translateY(-2px); }
    .bg-dark { background: #070707 !important; }
    .shadow-dark { box-shadow: 0 24px 60px rgba(0, 0, 0, 0.45); }
    .alert-danger { background: #2c0505; border-color: #600000; color: #f8d7da; }
    .horario-options { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 0.9rem; }
    .horario-card { display: block; cursor: pointer; background: #090909; border: 1px solid rgba(255,255,255,.08); border-radius: 1rem; padding: 1rem; transition: transform .2s, border-color .2s, background .2s, box-shadow .2s; }
    .calendar-box { background: rgba(255,255,255,.03); }
    .horario-card:hover { transform: translateY(-2px); border-color: rgba(201,168,76,.6); background: rgba(201,168,76,.04); }
    .horario-card.selected, .horario-card input:checked + .horario-card-content { border-color: rgba(201,168,76,.8); box-shadow: 0 0 0 3px rgba(201,168,76,.08); }
    .horario-card input { display: none; }
    .horario-card-content { display: grid; gap: 0.35rem; }
    .horario-card-top { display: flex; justify-content: space-between; align-items: center; gap: 0.75rem; }
    .horario-day { font-size: .9rem; color: rgba(245,240,232,.75); }
    .horario-time { font-size: 1.1rem; font-weight: 700; color: #fff; }
    .horario-note { font-size: .82rem; color: rgba(245,240,232,.6); }
    .horario-filter-message { color: rgba(245,240,232,.75); font-size: .9rem; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof $ === 'undefined' || !$('#horario-datepicker').datepicker) {
            return;
        }

        window.__barberzDatepickers = window.__barberzDatepickers || {};
        if (window.__barberzDatepickers['horario-datepicker']) {
            return;
        }

        window.__barberzDatepickers['horario-datepicker'] = true;

        var selectedDate = null;
        var $cards = $('.horario-card');
        var $message = $('#horario-no-results');
        var $picker = $('#horario-datepicker');

        $picker.off('changeDate.barberzDatepicker');

        if ($picker.data('datepicker')) {
            $picker.datepicker('remove');
        }

        $picker.datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            startDate: new Date()
        }).on('changeDate.barberzDatepicker', function (e) {
            selectedDate = e.format('yyyy-mm-dd');
            var visibleCount = 0;

            $cards.each(function () {
                var cardDate = $(this).data('date');
                var show = cardDate === selectedDate;
                $(this).toggleClass('d-none', !show);
                if (show) {
                    visibleCount++;
                } else {
                    $(this).find('input').prop('checked', false);
                    $(this).removeClass('selected');
                }
            });

            $('#chosen-date-label').text(formatDate(selectedDate));
            $('#horario-calendar-screen').addClass('d-none');
            $('#horario-times-screen').removeClass('d-none');
            $message.toggle(visibleCount === 0);
        });

        $('#horario-back-button').on('click', function () {
            $('#horario-times-screen').addClass('d-none');
            $('#horario-calendar-screen').removeClass('d-none');
            $cards.addClass('d-none');
            $('#horario-no-results').addClass('d-none');
        });

        $cards.on('click', function () {
            $(this).find('input').prop('checked', true);
            $cards.removeClass('selected');
            $(this).addClass('selected');
        });

        function formatDate(value) {
            var parts = value.split('-');
            return parts[2] + '/' + parts[1] + '/' + parts[0];
        }
    });
</script>
@endsection
