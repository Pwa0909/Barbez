@extends('layout.admin')

@section('title', 'Painel Admin')

@section('content')
<div class="admin-page">
    @php $barbeirosCount = \App\Models\Barbeiro::count(); @endphp
    <div class="dashboard-hero rounded-4 p-4 mb-4 overflow-hidden">
        <div class="row align-items-center gy-3">
            <div class="col-md-8">
                <p class="text-uppercase text-gold mb-2">Painel do administrador</p>
                <h1 class="display-6 mb-2">Controle total da barbearia</h1>
                <p class="text-muted mb-0">Acompanhe os agendamentos, visualize os próximos horários e mantenha o fluxo do salão organizado.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.horarios.index') }}" class="btn btn-outline-light btn-sm me-2">Horários</a>
                <a href="{{ route('admin.agendamentos.index') }}" class="btn btn-gold btn-sm">Agenda completa</a>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card p-4 rounded-4 h-100">
                <span class="stat-label">Total de agendamentos</span>
                <h2 class="stat-value">{{ $agendamentos->count() }}</h2>
                <p class="text-muted mb-0">Os registros mais recentes estão abaixo.</p>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card p-4 rounded-4 h-100">
                <span class="stat-label">Agendados</span>
                <h2 class="stat-value">{{ $agendamentos->where('status', 'Agendado')->count() }}</h2>
                <p class="text-success mb-0">Prontos para serem atendidos.</p>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card p-4 rounded-4 h-100">
                <span class="stat-label">Concluídos</span>
                <h2 class="stat-value">{{ $agendamentos->where('status', 'Concluído')->count() }}</h2>
                <p class="text-muted mb-0">Serviços finalizados.</p>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card p-4 rounded-4 h-100">
                <span class="stat-label">Cancelados</span>
                <h2 class="stat-value">{{ $agendamentos->where('status', 'Cancelado')->count() }}</h2>
                <p class="text-danger mb-0">Atenção aos horários não confirmados.</p>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-4">
            <div class="card card-highlight rounded-4 p-4 mb-4">
                <h2 class="h5 text-white mb-3">Próximo horário</h2>
                @if($agendamentos->isNotEmpty())
                    @php
                        $next = $agendamentos->first();
                    @endphp
                    @if($barbeirosCount > 1)
                        <p class="text-muted mb-1">{{ $next->cliente->nome }} com {{ $next->barbeiro->nome }}</p>
                    @else
                        <p class="text-muted mb-1">{{ $next->cliente->nome }}</p>
                    @endif
                    <p class="h4 mb-1">@formatDate($next->data) às @formatTime($next->hora)</p>
                    <span class="badge badge-status badge-status-{{ strtolower(str_replace(' ', '-', $next->status)) }}">{{ $next->status }}</span>
                @else
                    <p class="text-muted mb-0">Nenhum agendamento disponível no momento.</p>
                @endif
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card rounded-4 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h2 class="h5 mb-0">Agendamentos recentes</h2>
                        <p class="text-muted mb-0">Ordens por data e hora.</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless table-hover align-middle mb-0 admin-table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                @if($barbeirosCount > 1)
                                    <th>Barbeiro</th>
                                @endif
                                <th>Serviço</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($agendamentos as $agendamento)
                                <tr>
                                    <td>{{ $agendamento->cliente->nome }}</td>
                                    @if($barbeirosCount > 1)
                                        <td>{{ $agendamento->barbeiro->nome }}</td>
                                    @endif
                                    <td>{{ $agendamento->servico->nome }}</td>
                                    <td>@formatDate($agendamento->data)</td>
                                    <td>@formatTime($agendamento->hora)</td>
                                    <td>
                                        <span class="badge badge-status badge-status-{{ strtolower(str_replace(' ', '-', $agendamento->status)) }}">{{ $agendamento->status }}</span>
                                    </td>
                                </tr>
                            @empty
                                @php $colspan = $barbeirosCount > 1 ? 6 : 5; @endphp
                                <tr>
                                    <td colspan="{{ $colspan }}" class="text-center text-muted">Nenhum agendamento encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-hero {
        background: radial-gradient(circle at top left, rgba(201,168,76,.16), transparent 35%), linear-gradient(135deg,#0b0b0b,#181818);
        border: 1px solid rgba(255,255,255,.07);
    }
    .text-gold { color: #C9A84C; }
    .btn-gold { background: #C9A84C; color: #090909 !important; border: 1px solid transparent; }
    .btn-gold:hover { background: #e8c97a; }
    .stat-card { background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.08); }
    .stat-label { display: block; font-size: .8rem; text-transform: uppercase; letter-spacing: .18em; color: rgba(255,255,255,.7); margin-bottom: .75rem; }
    .stat-value { font-size: 2.25rem; margin: 0; color: #fff; }
    .card-highlight { background: rgba(201,168,76,.08); border: 1px solid rgba(201,168,76,.24); }
    .badge-status { padding: .55em .8em; font-size: .72rem; text-transform: uppercase; letter-spacing: .08em; border-radius: 999px; }
    .badge-status-agendado { background: rgba(201,168,76,.15); color: #D8C08A; }
    .badge-status-concluído, .badge-status-concluido { background: rgba(40,167,69,.16); color: #A8D6A5; }
    .badge-status-cancelado { background: rgba(220,53,69,.14); color: #F1A1A9; }
    .admin-table thead tr { border-bottom: 1px solid rgba(255,255,255,.08); }
    .admin-table tbody tr:hover { background: rgba(255,255,255,.03); }
    .admin-table td, .admin-table th { padding: 1rem 0.75rem; border-top: none; color: rgba(255,255,255,.85); }
</style>
@endsection
