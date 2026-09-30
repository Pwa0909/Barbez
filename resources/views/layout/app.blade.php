<!doctype html>
<html lang="pt-BR">
<head>
    <title>BarberPoint</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon-scissors.svg') }}">

    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body style="background: #070707; color: #F5F0E8; font-family: 'DM Sans', sans-serif;">

<style>
    body { background: linear-gradient(180deg, #070707 0%, #0d0d0d 100%); }
    .alert {
        border-radius: 1rem;
        border: 1px solid rgba(201, 168, 76, 0.2);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    }
    .alert-danger {
        background: rgba(140, 28, 28, 0.12);
        border-color: rgba(220, 53, 69, 0.45);
        color: #ffe6e8;
    }
    .alert-warning {
        background: rgba(201, 168, 76, 0.08);
        border-color: rgba(201, 168, 76, 0.28);
        color: #f5e9c9;
    }
    .btn-gold {
        background: linear-gradient(135deg, #d7bb66 0%, #c9a84c 45%, #b9912e 100%);
        color: #0f0f0f !important;
        border: none;
        box-shadow: 0 12px 28px rgba(201, 168, 76, 0.22);
    }
    .btn-gold:hover {
        background: linear-gradient(135deg, #e5cc81 0%, #d3b257 45%, #c39a31 100%);
        color: #0f0f0f !important;
    }
    .btn-outline-light {
        border-color: rgba(255,255,255,0.18);
        color: #f5f0e8;
    }
    .btn-outline-light:hover {
        background: rgba(255,255,255,0.04);
        border-color: rgba(201,168,76,0.6);
        color: #fff;
    }
    .form-control:focus, .form-select:focus {
        border-color: rgba(201, 168, 76, 0.7) !important;
        box-shadow: 0 0 0 0.2rem rgba(201, 168, 76, 0.12) !important;
    }
</style>

<div class="site-wrap">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- CONTEÚDO DAS PÁGINAS --}}
    @yield('content')

    {{-- FOOTER --}}
    @include('components.footer')

</div>

<!-- JS -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-3.0.0.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.sticky.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function formatPhone(value) {
            var digits = (value || '').replace(/\D/g, '').slice(0, 11);

            if (digits.length <= 2) {
                return digits;
            }

            if (digits.length <= 7) {
                return '(' + digits.slice(0, 2) + ') ' + digits.slice(2);
            }

            return '(' + digits.slice(0, 2) + ') ' + digits.slice(2, 7) + '-' + digits.slice(7, 11);
        }

        document.querySelectorAll('input[name="telefone"], input[name="celular"]').forEach(function (input) {
            input.setAttribute('inputmode', 'numeric');
            input.setAttribute('maxlength', '15');

            input.addEventListener('input', function () {
                input.value = formatPhone(input.value);
            });
        });
    });
</script>

</body>
</html>