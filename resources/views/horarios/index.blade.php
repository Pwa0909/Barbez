@extends('layout.app')

@section('title', 'Horários Disponíveis - Admin')

@section('content')
<div class="container py-5">
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
            <div class="card shadow-sm border-0 p-3 mb-4">
                <h2 class="h5">Calendário</h2>
                <p class="text-muted">Use o calendário para filtrar os horários por data.</p>
                <div id="horario-calendar"></div>
                <div class="mt-3">
                    <strong>Data selecionada:</strong> <span id="selected-date">Todas</span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0 p-3">
                <h2 class="h5">Horários disponíveis</h2>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover align-middle" id="horarios-table">
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
                                    <td>{{ $horario->data }}</td>
                                    <td>{{ $horario->hora }}</td>
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

        $calendar.off('changeDate.barberzDatepicker');

        if ($calendar.data('datepicker')) {
            $calendar.datepicker('remove');
        }

        $calendar.datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            inline: true
        }).on('changeDate.barberzDatepicker', function (e) {
            var selected = e.format('yyyy-mm-dd');
            $('#selected-date').text(selected);
            var visibleCount = 0;

            $('#horarios-table tbody tr[data-data]').each(function () {
                var rowDate = $(this).data('data');
                var show = selected === '' || rowDate === selected;
                $(this).toggle(show);
                if (show) {
                    visibleCount++;
                }
            });

            $('#no-results').toggle(visibleCount === 0);
        });
    });
</script>
@endsection
