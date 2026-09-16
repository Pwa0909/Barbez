<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - BarberPoint')</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --admin-bg: #0b0b0b;
            --admin-panel: #121212;
            --admin-panel-alt: #171717;
            --admin-text: #f8f3eb;
            --admin-muted: rgba(248, 243, 235, 0.82);
            --admin-gold: #c9a84c;
            --admin-gold-soft: rgba(201, 168, 76, 0.18);
            --admin-border: rgba(255,255,255,0.1);
            --admin-success: #9ae6b4;
            --admin-danger: #f59ea2;
            --admin-heading: #ffffff;
        }

        body {
            margin: 0;
            background: linear-gradient(135deg, #070707 0%, #101010 100%);
            color: var(--admin-text);
            font-family: 'DM Sans', sans-serif;
        }

        .admin-page,
        .admin-sidebar,
        .admin-main,
        .admin-topbar,
        .card,
        .card-admin,
        .admin-form,
        .stat-card,
        .dashboard-hero {
            color: var(--admin-text);
        }

        h1, h2, h3, h4, h5, h6,
        .page-title,
        .page-subtitle,
        .admin-topbar-title,
        .admin-brand-name,
        .stat-value,
        .stat-label,
        .card-title,
        .text-white,
        .text-gold {
            color: var(--admin-heading) !important;
        }

        p,
        span,
        li,
        td,
        th,
        label,
        .text-muted,
        .text-white-50,
        .text-success,
        .text-danger {
            color: var(--admin-muted) !important;
        }

        .text-success {
            color: var(--admin-success) !important;
        }

        .text-danger {
            color: var(--admin-danger) !important;
        }

        .admin-shell {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 260px;
            background: rgba(8, 8, 8, 0.96);
            border-right: 1px solid var(--admin-border);
            padding: 2rem 1.25rem;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0.9rem 1.5rem;
            border-bottom: 1px solid var(--admin-border);
            margin-bottom: 1.5rem;
        }

        .admin-brand-mark {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--admin-gold), #e5cd82);
            color: #141414;
            font-weight: 700;
        }

        .admin-brand-name {
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--admin-text);
        }

        .admin-nav {
            display: grid;
            gap: 0.5rem;
        }

        .admin-nav a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem 0.9rem;
            border-radius: 0.8rem;
            color: var(--admin-muted);
            text-decoration: none;
            transition: .2s ease;
        }

        .admin-nav a:hover,
        .admin-nav a.active {
            background: var(--admin-gold-soft);
            border: 1px solid rgba(201, 168, 76, 0.2);
            color: var(--admin-text);
        }

        .admin-main {
            flex: 1;
            padding: 2rem;
        }

        .admin-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(18, 18, 18, 0.8);
            border: 1px solid var(--admin-border);
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            margin-bottom: 2rem;
        }

        .admin-topbar-title {
            font-size: 0.82rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--admin-gold);
            margin: 0;
        }

        .admin-topbar-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-page {
            background: rgba(18, 18, 18, 0.72);
            border: 1px solid var(--admin-border);
            border-radius: 1.25rem;
            padding: 2rem;
        }

        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .page-kicker {
            font-size: 0.75rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--admin-gold);
            margin-bottom: 0.5rem;
        }

        .page-title {
            font-size: clamp(1.8rem, 2vw, 2.4rem);
            font-weight: 700;
            margin: 0;
            color: var(--admin-text);
        }

        .page-subtitle {
            color: var(--admin-muted);
            margin: 0.25rem 0 0;
        }

        .btn-gold {
            background: var(--admin-gold);
            color: #111111;
            border: none;
            font-weight: 700;
            padding: 0.7rem 1.1rem;
            border-radius: 0.75rem;
        }

        .btn-gold:hover {
            background: #e8c97a;
            color: #111111;
        }

        .btn-outline-light {
            border-color: rgba(255,255,255,0.12);
            color: var(--admin-text);
        }

        .btn-outline-light:hover {
            background: rgba(255,255,255,0.06);
            color: var(--admin-text);
        }

        .card-admin {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--admin-border);
            border-radius: 1rem;
            overflow: hidden;
        }

        .data-table thead th {
            background: rgba(255,255,255,0.03);
            color: var(--admin-text);
            border-bottom: 1px solid var(--admin-border);
            padding: 0.9rem 1rem;
            vertical-align: middle;
        }

        .data-table tbody td {
            color: var(--admin-muted);
            border-bottom: 1px solid rgba(255,255,255,0.04);
            padding: 0.9rem 1rem;
            vertical-align: middle;
        }

        .data-table tbody tr:hover {
            background: rgba(255,255,255,0.02);
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            font-weight: 600;
            letter-spacing: 0.02em;
            font-size: 0.72rem;
            text-transform: uppercase;
        }

        .badge-agendado { background: rgba(201,168,76,.16); color: #d7c28e; }
        .badge-concluido { background: rgba(46,213,115,.12); color: #96e7af; }
        .badge-cancelado { background: rgba(255,107,107,.14); color: #f3a1a1; }

        .admin-form {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--admin-border);
            border-radius: 1rem;
            padding: 1.5rem;
        }

        .form-label {
            color: var(--admin-text);
            font-weight: 600;
        }

        .form-control,
        .form-select,
        .form-control:focus,
        .form-select:focus {
            background: rgba(255,255,255,0.02);
            border-color: rgba(255,255,255,0.08);
            color: var(--admin-text);
            box-shadow: none;
        }

        .form-control::placeholder {
            color: rgba(245,240,232,0.4);
        }

        .alert {
            border-radius: 0.9rem;
        }

        @media (max-width: 991px) {
            .admin-shell {
                display: block;
            }

            .admin-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid var(--admin-border);
            }

            .admin-main {
                padding: 1.25rem;
            }

            .page-head {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <div class="admin-brand-mark">BP</div>
                <div class="admin-brand-name">BarberPoint</div>
            </div>

            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span>Painel</span>
                    <span>›</span>
                </a>
                <a href="{{ route('admin.agendamentos.index') }}" class="{{ request()->routeIs('admin.agendamentos.*') ? 'active' : '' }}">
                    <span>Agendamentos</span>
                    <span>›</span>
                </a>
                <a href="{{ route('admin.horarios.index') }}" class="{{ request()->routeIs('admin.horarios.*') ? 'active' : '' }}">
                    <span>Horários</span>
                    <span>›</span>
                </a>
                <a href="{{ route('admin.servicos.index') }}" class="{{ request()->routeIs('admin.servicos.*') ? 'active' : '' }}">
                    <span>Serviços</span>
                    <span>›</span>
                </a>
                <a href="{{ route('admin.barbeiros.index') }}" class="{{ request()->routeIs('admin.barbeiros.*') ? 'active' : '' }}">
                    <span>Barbeiros</span>
                    <span>›</span>
                </a>
                <a href="{{ route('admin.clientes.index') }}" class="{{ request()->routeIs('admin.clientes.*') ? 'active' : '' }}">
                    <span>Clientes</span>
                    <span>›</span>
                </a>
            </nav>
        </aside>

        <main class="admin-main">
            <header class="admin-topbar">
                <div>
                    <p class="admin-topbar-title">Área administrativa</p>
                </div>
                <div class="admin-topbar-actions">
                    <span class="text-white-50">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Sair</button>
                    </form>
                </div>
            </header>

            @yield('content')
        </main>
    </div>
</body>
</html>
