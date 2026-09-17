@extends('layout.admin')

@section('title', 'Horários Disponíveis - Admin')

@section('content')
<div class="admin-page">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">Horários Disponíveis</h1>
            <p class="text-muted mb-0">Selecione uma data no calendário para ver os horários disponíveis.</p>
        </div>
        <a href="{{ route('admin.horarios.create') }}" class="btn btn-primary">Novo horário</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row gy-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 p-3 mb-4" style="background: rgba(17,17,17,0.92); border: 1px solid rgba(255,255,255,0.08);">
                <h2 class="h5 text-white mb-2">Calendário</h2>
                <p class="text-muted mb-3">Use o calendário para filtrar os horários por data.</p>
                <div id="horario-calendar" style="min-height: 280px;"></div>
                <div class="mt-3 pt-3 border-top border-white-10">
                    <strong class="text-white">Data selecionada:</strong> <span id="selected-date" class="text-light">Todas</span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0 p-3" style="background: rgba(17,17,17,0.92); border: 1px solid rgba(255,255,255,0.08);">
                <h2 class="h5 text-white mb-3">Horários disponíveis</h2>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover align-middle" id="horarios-table" style="background: transparent; color: #f7f3eb;">
                        <thead class="table-light">
                            <tr>
                                <th>Barbeiro</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Disponível</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($horarios as $horario)
                                <tr data-data="{{ $horario->data }}">
                                    <td>{{ $horario->barbeiro->nome }}</td>
                                    <td>@formatDate($horario->data)</td>
                                    <td>@formatTime($horario->hora)</td>
                                    <td>{{ $horario->disponivel ? 'Sim' : 'Não' }}</td>
                                    <td>
                                        <a href="{{ route('admin.horarios.show', $horario->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                                        <a href="{{ route('admin.horarios.edit', $horario->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <form action="{{ route('admin.horarios.destroy', $horario->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja realmente excluir este horário?')">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum horário disponível.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="alert alert-info mt-3 d-none" id="no-results">Nenhum horário disponível para essa data.</div>
            </div>
        </div>
    </div>
</div>

<style>
    #horario-calendar .datepicker {
        width: 100%;
        background: rgba(12,12,12,0.96);
        border: 1px solid rgba(201, 168, 76, 0.25);
        border-radius: 1rem;
        color: #f8f3eb;
        box-shadow: 0 22px 50px rgba(0,0,0,0.22);
    }

    #horario-calendar .datepicker table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0.25rem;
    }

    #horario-calendar .datepicker td,
    #horario-calendar .datepicker th {
        color: #f8f3eb;
        border: none;
        border-radius: .65rem;
    }

    #horario-calendar .datepicker td.active,
    #horario-calendar .datepicker td.active:hover {
        background: linear-gradient(135deg, #d7bb66, #c9a84c 45%, #b8922a);
        color: #111111;
    }

    #horario-calendar .datepicker td.day:hover,
    #horario-calendar .datepicker td.day.focused {
        background: rgba(201, 168, 76, 0.15);
        color: #fff;
    }

    #horario-calendar .datepicker .datepicker-switch,
    #horario-calendar .datepicker .prev,
    #horario-calendar .datepicker .next,
    #horario-calendar .datepicker tfoot th,
    #horario-calendar .datepicker .datepicker-title,
    #horario-calendar .datepicker .dow,
    #horario-calendar .datepicker .month,
    #horario-calendar .datepicker .year {
        color: #f0d58d;
        font-weight: 700;
        text-transform: uppercase;
    }

    #horario-calendar .datepicker .disabled,
    #horario-calendar .datepicker .disabled:hover {
        color: rgba(255,255,255,0.35) !important;
        background: rgba(255,255,255,0.02) !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof $ === 'undefined' || !$('#horario-calendar').datepicker) {
            return;
        }

        window.__barberzDatepickers = window.__barberzDatepickers || {};
        if (window.__barberzDatepickers['horario-calendar']) {
            return;
        }

        window.__barberzDatepickers['horario-calendar'] = true;

        var $calendar = $('#horario-calendar');
        var $tableRows = $('#horarios-table tbody tr[data-data]');
        var $noResults = $('#no-results');

        function updateTable(selectedDate) {
            var label = selectedDate ? selectedDate : 'Todas';
            $('#selected-date').text(label);

            var visibleCount = 0;

            $tableRows.each(function () {
                var rowDate = $(this).data('data');
                var show = !selectedDate || rowDate === selectedDate;
                $(this).toggle(show);
                if (show) {
                    visibleCount++;
                }
            });

            $noResults.toggle(visibleCount === 0);
        }

        $.fn.datepicker.dates['pt-BR'] = {
            days: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
            daysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
            daysMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Se', 'Sa'],
            months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            today: 'Hoje',
            clear: 'Limpar',
            titleFormat: 'MM yyyy',
            weekStart: 0
        };

        $calendar.off('changeDate.barberzDatepicker');

        if ($calendar.data('datepicker')) {
            $calendar.datepicker('remove');
        }

        $calendar.datepicker({
            format: 'yyyy-mm-dd',
            language: 'pt-BR',
            todayHighlight: true,
            autoclose: true,
            inline: true,
            startDate: new Date(),
            daysOfWeekDisabled: [0]
        }).on('changeDate.barberzDatepicker', function (e) {
            var selected = e ? e.format('yyyy-mm-dd') : '';
            updateTable(selected);
        });

        updateTable('');
    });
</script>
@endsection
