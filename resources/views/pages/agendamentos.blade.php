@extends('layout.app')

@section('title', 'Agendar Horário')

@section('content')
<div class="position-relative text-center py-5 mb-5" style="background: linear-gradient(135deg,rgba(10,10,10,.92) 40%,rgba(10,10,10,.7)),url('https://images.unsplash.com/photo-1517832606299-7ae9b720a186?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;border-bottom: 1px solid rgba(201,168,76,.15);">
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
                    <input type="text" name="nome" class="input-gold form-control" value="{{ old('nome', auth('cliente')->user()->nome ?? '') }}" placeholder="Digite seu nome completo" readonly required>
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

                <div id="agendamento-resumo" class="resumo-box mb-4 d-none">
                    <div class="resumo-label">Resumo do agendamento</div>
                    <div class="resumo-item">
                        <span>Serviço</span>
                        <strong id="resumo-servico">-</strong>
                    </div>
                    <div class="resumo-item">
                        <span>Data</span>
                        <strong id="resumo-data">-</strong>
                    </div>
                    <div class="resumo-item">
                        <span>Horário</span>
                        <strong id="resumo-horario">-</strong>
                    </div>
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
                            <label class="horario-card {{ old('horario_disponivel_id') == $horario->id ? 'selected' : '' }} d-none" data-date="{{ \Illuminate\Support\Carbon::parse($horario->data)->format('Y-m-d') }}">
                                <input type="radio" name="horario_disponivel_id" value="{{ $horario->id }}" hidden {{ old('horario_disponivel_id') == $horario->id ? 'checked' : '' }}>
                                <div class="horario-card-content">
                                    <div class="horario-card-top">
                                        <span class="horario-day">{{ \Illuminate\Support\Carbon::parse($horario->data)->format('d/m/Y') }}</span>
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
    .alert-secondary {
        background: rgba(201, 168, 76, 0.08);
        border: 1px solid rgba(201, 168, 76, 0.2);
        color: #efe6d2;
        border-radius: 1rem;
    }
    .agendamento-form {
        background: linear-gradient(180deg, rgba(15,15,15,0.98), rgba(10,10,10,0.95));
        border: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 24px 60px rgba(0,0,0,0.42), inset 0 1px 0 rgba(255,255,255,0.04);
        border-radius: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    .agendamento-form::before {
        content: "";
        position: absolute;
        inset: 0 auto auto 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, transparent, rgba(201,168,76,0.9), transparent);
    }
    .selected-day {
        font-size: 0.96rem;
        color: rgba(245,240,232,0.9);
    }
    .selected-day span {
        color: #f2d58e;
        font-weight: 600;
    }
    .horario-options { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 0.9rem; }
    .horario-card {
        display: block;
        cursor: pointer;
        background: linear-gradient(180deg, rgba(11,11,11,0.92), rgba(18,18,18,0.92));
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 1rem;
        padding: 1rem;
        transition: transform .2s, border-color .2s, background .2s, box-shadow .2s;
        position: relative;
        overflow: hidden;
    }
    .horario-card::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(201,168,76,0.8), transparent);
        opacity: 0;
        transition: opacity .2s ease;
    }
    .calendar-box {
        background: rgba(255,255,255,.025);
        border: 1px solid rgba(201,168,76,0.14);
        border-radius: 1.2rem;
    }
    .resumo-box {
        background: rgba(201,168,76,0.06);
        border: 1px solid rgba(201,168,76,0.2);
        border-radius: 1rem;
        padding: 1rem 1.1rem;
        color: #f5f0e8;
    }
    .resumo-label {
        font-size: .72rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(201,168,76,.9);
        margin-bottom: .75rem;
        font-weight: 600;
    }
    .resumo-item {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        padding: .5rem 0;
        border-bottom: 1px solid rgba(255,255,255,.06);
    }
    .resumo-item:last-child {
        border-bottom: none;
    }
    .resumo-item span {
        color: rgba(245,240,232,.7);
    }
    .resumo-item strong {
        color: #fff;
        text-align: right;
    }
    .horario-card:hover {
        transform: translateY(-2px);
        border-color: rgba(201,168,76,.6);
        background: rgba(201,168,76,.04);
        box-shadow: 0 12px 26px rgba(0,0,0,0.18);
    }
    .horario-card:hover::before,
    .horario-card.selected::before,
    .horario-card input:checked + .horario-card-content::before {
        opacity: 1;
    }
    .horario-card.selected, .horario-card input:checked + .horario-card-content {
        border-color: rgba(201,168,76,.8);
        box-shadow: 0 0 0 3px rgba(201,168,76,.08);
        background: rgba(201,168,76,.04);
    }
    .horario-card input { display: none; }
    .horario-card-content {
        display: grid;
        gap: 0.35rem;
        position: relative;
        z-index: 1;
    }
    .horario-card-top { display: flex; justify-content: space-between; align-items: center; gap: 0.75rem; }
    .horario-day { font-size: .9rem; color: rgba(245,240,232,.75); }
    .horario-time { font-size: 1.1rem; font-weight: 700; color: #fff; }
    .horario-note { font-size: .82rem; color: rgba(245,240,232,.6); }
    .horario-filter-message { color: rgba(245,240,232,.75); font-size: .9rem; }

    #horario-datepicker .datepicker {
        width: 100%;
        max-width: 100%;
        background: rgba(12, 12, 12, 0.96);
        border: 1px solid rgba(201, 168, 76, 0.18);
        border-radius: 1.2rem;
        padding: 1rem;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.28);
        color: #f5f0e8;
    }

    @media (max-width: 576px) {
        .agendamento-form {
            padding: 1.2rem !important;
        }

        .horario-card {
            padding: 0.85rem;
        }
    }

    #horario-datepicker .datepicker table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0.35rem;
        margin: 0;
    }

    #horario-datepicker .datepicker {
        max-width: 360px;
        margin: 0 auto;
    }

    #horario-datepicker .datepicker .datepicker-switch,
    #horario-datepicker .datepicker .prev,
    #horario-datepicker .datepicker .datepicker-months,
    #horario-datepicker .datepicker .datepicker-years,
    #horario-datepicker .datepicker .datepicker-decades {
        display: none !important;
    }

    #horario-datepicker .datepicker .next,
    #horario-datepicker .datepicker tfoot tr th {
        color: #f0d58d;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        background: transparent;
    }

    #horario-datepicker .datepicker .next:hover,
    #horario-datepicker .datepicker tfoot tr th:hover {
        background: rgba(201, 168, 76, 0.12);
        color: #fff4d1;
    }

    #horario-datepicker .datepicker th,
    #horario-datepicker .datepicker td {
        border: none;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
    }

    #horario-datepicker .datepicker thead th {
        color: rgba(255,255,255,0.72);
        font-size: 0.72rem;
        padding: 0.4rem 0;
    }

    #horario-datepicker .datepicker td.day {
        background: rgba(255,255,255,0.02);
        color: #f5f0e8;
        transition: transform 0.15s ease, background 0.15s ease, box-shadow 0.15s ease;
    }

    #horario-datepicker .datepicker td.day:hover,
    #horario-datepicker .datepicker td.day.focused {
        background: rgba(201, 168, 76, 0.12);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(201, 168, 76, 0.08);
    }

    #horario-datepicker .datepicker td.old,
    #horario-datepicker .datepicker td.new {
        color: rgba(245,240,232,0.35);
        display: none !important;
    }

    #horario-datepicker .datepicker td.disabled,
    #horario-datepicker .datepicker td.disabled:hover {
        background: rgba(255,255,255,0.02);
        color: rgba(255,255,255,0.2);
        cursor: not-allowed;
    }

    #horario-datepicker .datepicker td.active,
    #horario-datepicker .datepicker td.active:hover {
        background: linear-gradient(135deg, #d7bb66, #c9a84c 45%, #b8922a);
        color: #101010;
        box-shadow: 0 12px 26px rgba(201, 168, 76, 0.22);
        text-shadow: none;
    }

    #horario-datepicker .datepicker td.today,
    #horario-datepicker .datepicker td.today:hover {
        background: rgba(201, 168, 76, 0.14);
        border: 1px solid rgba(201, 168, 76, 0.4);
        color: #f0d58d;
    }

    #horario-datepicker .datepicker td.range {
        background: rgba(201, 168, 76, 0.08);
    }

    #horario-datepicker .datepicker-dropdown:before,
    #horario-datepicker .datepicker-dropdown:after {
        display: none;
    }

    #horario-datepicker + .datepicker {
        display: none !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof $ === 'undefined' || !$('#horario-datepicker').datepicker) {
            return;
        }

        var $picker = $('#horario-datepicker');

        if ($picker.attr('data-barberz-datepicker') === '1') {
            if ($picker.data('datepicker')) {
                $picker.datepicker('remove');
            }
            $picker.find('.datepicker').remove();
            $picker.next('.datepicker').remove();
            $picker.removeAttr('data-barberz-datepicker');
        }

        $('.datepicker').each(function () {
            var $dp = $(this);
            if ($dp.is($picker) || $dp.closest('#horario-datepicker').length) {
                return;
            }
            if ($dp.data('datepicker')) {
                $dp.datepicker('remove');
            }
            $dp.remove();
        });

        $picker.find('.datepicker').remove();
        $picker.next('.datepicker').remove();

        if ($picker.data('datepicker')) {
            $picker.datepicker('remove');
        }

        $picker.empty();
        $picker.attr('data-barberz-datepicker', '1');

        var selectedDate = null;
        var selectedHorario = null;
        var $cards = $('.horario-card');
        var $message = $('#horario-no-results');
        var $submitButton = $('button[type="submit"]');
        var $resumoBox = $('#agendamento-resumo');
        var $resumoServico = $('#resumo-servico');
        var $resumoData = $('#resumo-data');
        var $resumoHorario = $('#resumo-horario');

        function updateSummary() {
            var servico = $('select[name="servico_id"] option:selected').text();
            servico = servico ? servico.replace(/\s*-\s*R\$.*$/, '').trim() : '';

            if (servico || selectedDate || selectedHorario) {
                $resumoBox.removeClass('d-none');
            }

            $resumoServico.text(servico || '-');
            $resumoData.text(selectedDate ? formatDate(selectedDate) : '-');
            $resumoHorario.text(selectedHorario || '-');

            var hasServico = !!$('select[name="servico_id"]').val();
            var hasDate = !!selectedDate;
            var hasHorario = !!selectedHorario;
            $submitButton.prop('disabled', !(hasServico && hasDate && hasHorario));
            $submitButton.css('opacity', (hasServico && hasDate && hasHorario) ? '1' : '0.6');
        }

        $('select[name="servico_id"]').on('change.barberzDatepicker', updateSummary);
        $picker.off('changeDate.barberzDatepicker');
        $('#horario-back-button').off('click.barberzDatepicker');
        $cards.off('click.barberzDatepicker');

        $.fn.datepicker.dates['pt-BR'] = {
            days: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
            daysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
            daysMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Se', 'Sá'],
            months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            today: 'Hoje',
            clear: 'Limpar',
            titleFormat: 'MM yyyy',
            weekStart: 0
        };

        var hoje = new Date();
        var primeiroDiaDoMes = new Date(hoje.getFullYear(), hoje.getMonth(), 1);
        var ultimoDiaDoMes = new Date(hoje.getFullYear(), hoje.getMonth() + 1, 0);

        $picker.datepicker({
            format: 'yyyy-mm-dd',
            language: 'pt-BR',
            todayHighlight: true,
            autoclose: true,
            inline: true,
            startDate: primeiroDiaDoMes,
            endDate: ultimoDiaDoMes,
            daysOfWeekDisabled: [0],
            numberOfMonths: 1,
            calendarWeeks: false,
            orientation: 'bottom',
            clearBtn: false,
            weekStart: 0,
            minViewMode: 'days',
            maxViewMode: 'days',
            viewMode: 'days',
            showDaysOfWeek: true
        }).on('changeDate.barberzDatepicker', function (e) {
            selectedDate = e.format('yyyy-mm-dd');
            selectedHorario = null;
            var visibleCount = 0;

            $cards.each(function () {
                var cardDate = String($(this).attr('data-date'));
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
            updateSummary();
        });

        $('#horario-back-button').on('click.barberzDatepicker', function () {
            $('#horario-times-screen').addClass('d-none');
            $('#horario-calendar-screen').removeClass('d-none');
            $cards.addClass('d-none');
            $('#horario-no-results').addClass('d-none');
            selectedHorario = null;
            updateSummary();
        });

        updateSummary();

        $cards.on('click.barberzDatepicker', function () {
            $(this).find('input').prop('checked', true);
            $cards.removeClass('selected');
            $(this).addClass('selected');
            selectedHorario = $(this).find('.horario-time').text();
            updateSummary();
        });

        $('form[action="{{ route('agendamentos.store') }}"]').off('submit.barberzDatepicker').on('submit.barberzDatepicker', function (event) {
            var $form = $(this);
            var $selectedHorario = $form.find('input[name="horario_disponivel_id"]:checked');

            if (!$selectedHorario.length) {
                event.preventDefault();
                $message.removeClass('d-none').text('Selecione um horário antes de confirmar o agendamento.');
                $('#horario-times-screen').removeClass('d-none');
            }
        });

        function formatDate(value) {
            var parts = value.split('-');
            return parts[2] + '/' + parts[1] + '/' + parts[0];
        }
    });
</script>
@endsection
