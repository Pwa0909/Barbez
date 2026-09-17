<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - BarberPoint')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon-scissors.svg') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --admin-bg: #0b0b0b;
            --admin-panel: #131313;
            --admin-panel-alt: #1a1a1a;
            --admin-text: #f8f3eb;
            --admin-muted: rgba(248, 243, 235, 0.78);
            --admin-gold: #c9a84c;
            --admin-gold-soft: rgba(201, 168, 76, 0.16);
            --admin-border: rgba(255,255,255,0.1);
            --admin-success: #9ae6b4;
            --admin-danger: #f59ea2;
            --admin-heading: #ffffff;
            --admin-panel-shadow: 0 24px 64px rgba(0, 0, 0, 0.4);
        }

        body {
            margin: 0;
            background:
                radial-gradient(circle at top left, rgba(201, 168, 76, 0.08), transparent 35%),
                linear-gradient(135deg, #070707 0%, #101010 100%);
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
            width: 280px;
            background: linear-gradient(180deg, rgba(10,10,10,0.98), rgba(17,17,17,0.96));
            border-right: 1px solid var(--admin-border);
            padding: 2rem 1.25rem;
            box-shadow: inset -1px 0 0 rgba(255,255,255,0.02);
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
            width: 2.7rem;
            height: 2.7rem;
            border-radius: 0.85rem;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--admin-gold), #e5cd82);
            color: #141414;
            font-weight: 800;
            box-shadow: 0 12px 28px rgba(201,168,76,0.28);
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
            padding: 0.9rem 0.95rem;
            border-radius: 0.9rem;
            color: var(--admin-muted);
            text-decoration: none;
            transition: .2s ease;
            border: 1px solid transparent;
            font-weight: 600;
        }

        .admin-nav a:hover,
        .admin-nav a.active {
            background: linear-gradient(135deg, rgba(201, 168, 76, 0.12), rgba(201, 168, 76, 0.22));
            border: 1px solid rgba(201, 168, 76, 0.26);
            color: var(--admin-text);
            box-shadow: inset 0 0 0 1px rgba(201,168,76,0.08);
        }

        .admin-main {
            flex: 1;
            padding: 2rem;
        }

        .admin-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(180deg, rgba(18,18,18,0.92), rgba(15,15,15,0.9));
            border: 1px solid var(--admin-border);
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            margin-bottom: 2rem;
            box-shadow: var(--admin-panel-shadow);
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
            background: linear-gradient(180deg, rgba(18, 18, 18, 0.88), rgba(15,15,15,0.9));
            border: 1px solid var(--admin-border);
            border-radius: 1.25rem;
            padding: 2rem;
            box-shadow: var(--admin-panel-shadow);
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

        .btn-secondary,
        .btn-outline-secondary,
        .btn-outline-primary,
        .btn-outline-danger,
        .btn-success,
        .btn-danger {
            border-radius: 0.75rem;
            font-weight: 600;
        }

        .btn-secondary,
        .btn-outline-secondary,
        .btn-outline-primary,
        .btn-outline-danger {
            background: rgba(255,255,255,0.04);
            border-color: rgba(255,255,255,0.12);
            color: var(--admin-text);
        }

        .btn-secondary:hover,
        .btn-outline-secondary:hover,
        .btn-outline-primary:hover,
        .btn-outline-danger:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.18);
            color: var(--admin-text);
        }

        .btn-success {
            background: #2fbf71;
            border-color: #2fbf71;
            color: #111111;
        }

        .btn-success:hover,
        .btn-success:focus {
            background: #45d381;
            border-color: #45d381;
            color: #111111;
        }

        .btn-danger {
            background: #ef4444;
            border-color: #ef4444;
            color: #ffffff;
        }

        .btn-danger:hover {
            background: #f55f5f;
            border-color: #f55f5f;
            color: #ffffff;
        }

        .card-admin {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--admin-border);
            border-radius: 1rem;
            overflow: hidden;
        }

        .card,
        .card-admin,
        .table-responsive,
        .table,
        .alert,
        .admin-page {
            background: rgba(18, 18, 18, 0.9);
            color: var(--admin-text);
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-striped-bg: rgba(255,255,255,0.02);
            --bs-table-hover-bg: rgba(201,168,76,0.06);
            --bs-table-color: var(--admin-text);
            --bs-table-bg-state: transparent;
            --bs-table-border-color: rgba(255,255,255,0.08);
            color: var(--admin-text);
        }

        .table thead th,
        .table tbody td,
        .table tbody th {
            color: var(--admin-text) !important;
            border-color: rgba(255,255,255,0.08);
            background: transparent;
        }

        .data-table thead th {
            background: rgba(255,255,255,0.03);
            color: var(--admin-text);
            border-bottom: 1px solid var(--admin-border);
            padding: 0.9rem 1rem;
            vertical-align: middle;
        }

        .table thead th,
        .table-light,
        .table-light > th,
        .table-light > td {
            background: rgba(255,255,255,0.03) !important;
            color: var(--admin-text) !important;
            border-color: rgba(255,255,255,0.08) !important;
        }

        .table tbody td,
        .table tbody th,
        .table td,
        .table th {
            color: var(--admin-text) !important;
            border-color: rgba(255,255,255,0.08) !important;
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
        .form-select:focus,
        textarea.form-control,
        select.form-select,
        input[type="date"],
        input[type="time"],
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="search"] {
            background: rgba(15,15,15,0.96);
            border: 1px solid rgba(255,255,255,0.12);
            color: var(--admin-text);
            box-shadow: none;
            border-radius: 0.8rem;
            color-scheme: dark;
        }

        .form-control::placeholder,
        input::placeholder {
            color: rgba(245,240,232,0.45);
        }

        .form-control option,
        .form-select option,
        select option {
            background: #121212;
            color: var(--admin-text);
        }

        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.9;
            cursor: pointer;
        }

        .form-check-input {
            background-color: rgba(255,255,255,0.02);
            border-color: rgba(255,255,255,0.18);
            accent-color: var(--admin-gold);
        }

        .form-check-label {
            color: var(--admin-text);
        }

        .alert {
            border-radius: 0.9rem;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.12) !important;
            border-color: rgba(34, 197, 94, 0.35) !important;
            color: #dfffee !important;
        }

        .alert-danger {
            background: rgba(220, 38, 38, 0.12) !important;
            border-color: rgba(248, 113, 113, 0.35) !important;
            color: #ffe5e5 !important;
        }

        .btn-primary {
            background: var(--admin-gold);
            border-color: var(--admin-gold);
            color: #111111;
            font-weight: 700;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: #e8c97a;
            border-color: #e8c97a;
            color: #111111;
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

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
</body>
</html>
