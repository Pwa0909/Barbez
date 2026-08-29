


<header class="site-navbar site-navbar-target">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-3">
                <div class="site-logo">
                    <a href="{{ route('welcome')}}">BarberPoint</a>
                </div>
            </div>

            <div class="col-9 text-right">
                <nav class="site-navigation d-none d-lg-block">
                    <ul class="site-menu main-menu ml-auto">

                        <li><a href="{{ route('servicos') }}">Serviços</a></li>

                        @if(auth()->guard('cliente')->check())
                            <li><a href="{{ route('agendamentos') }}">Agendamentos</a></li>
                        @else
                            <li><a href="{{ route('cliente.login') }}">Agendamentos</a></li>
                        @endif

                        @if(auth()->guard('web')->check())
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link p-0">Sair</button>
                                </form>
                            </li>
                        @elseif(auth()->guard('cliente')->check())
                            <li>
                                <form action="{{ route('cliente.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link p-0">Sair</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('cliente.login') }}">Login Cliente</a></li>
                            <li><a href="{{ route('cliente.register') }}">Cadastrar</a></li>
                        @endif

                    </ul>
                </nav>
            </div>

        </div>
    </div>
</header>