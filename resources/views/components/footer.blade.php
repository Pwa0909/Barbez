<footer class="site-footer bg-dark text-white pt-5 pb-4">
    <div class="container">

        <div class="row">

            <!-- Sobre -->
            <div class="col-md-4">
                <h5 class="mb-3">Barbearia</h5>
               
            </div>

            <!-- Links -->
            <div class="col-md-4">
                <h5 class="mb-3">Links rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('welcome') }}" class="text-white">Home</a></li>
                    <li><a href="{{ route('servicos') }}" class="text-white">Serviços</a></li>
                    <li><a href="{{ route('agendamentos') }}" class="text-white">Agendar</a></li>
                </ul>
            </div>

            <!-- Contato -->
            <div class="col-md-4">
                <h5 class="mb-3">Contato</h5>
                <p>Email: contato@barbearia.com</p>
                <p>Telefone: (37) 99999-9999</p>
            </div>

        </div>

        <hr class="bg-light">

        <div class="text-center">
            <p class="mb-0">
                © {{ date('Y') }} Barbearia - Todos os direitos reservados
            </p>
        </div>

    </div>
</footer>