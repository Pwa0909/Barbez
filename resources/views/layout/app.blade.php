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

<body>

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