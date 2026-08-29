<!doctype html>
<html lang="pt-BR">
<head>
  <title>BarberPoint — Barbearia Premium</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <style>
    :root {
      --gold: #C9A84C;
      --gold-light: #E8C97A;
      --dark: #0F0F0F;
      --dark-2: #1A1A1A;
      --dark-3: #242424;
      --off-white: #F5F0E8;
      --text-muted: #8A8A8A;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Outfit', sans-serif;
      background: var(--dark);
      color: var(--off-white);
      overflow-x: hidden;
    }

    /* ── NAVBAR ── */
    .navbar-bp {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      padding: 1.25rem 0;
      background: transparent;
      transition: background 0.4s, padding 0.4s;
    }
    .navbar-bp.scrolled {
      background: rgba(10,10,10,0.95);
      backdrop-filter: blur(12px);
      padding: 0.75rem 0;
      border-bottom: 1px solid rgba(201,168,76,0.15);
    }
    .navbar-bp .container {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .nav-logo {
      font-family: 'Playfair Display', serif;
      font-size: 1.6rem;
      font-weight: 900;
      color: var(--gold);
      letter-spacing: 2px;
      text-decoration: none;
    }
    .nav-links {
      display: flex;
      gap: 2.5rem;
      list-style: none;
    }
    .nav-links a {
      font-size: 0.82rem;
      font-weight: 500;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--off-white);
      text-decoration: none;
      position: relative;
      opacity: 0.8;
      transition: opacity 0.2s, color 0.2s;
    }
    .nav-links a::after {
      content: '';
      position: absolute;
      bottom: -4px; left: 0;
      width: 0; height: 1px;
      background: var(--gold);
      transition: width 0.3s;
    }
    .nav-links a:hover { opacity: 1; color: var(--gold); }
    .nav-links a:hover::after { width: 100%; }
    .nav-cta {
      font-size: 0.8rem;
      font-weight: 500;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--dark);
      background: var(--gold);
      padding: 0.6rem 1.5rem;
      border-radius: 2px;
      text-decoration: none;
      transition: background 0.2s, transform 0.2s;
    }
    .nav-cta:hover { background: var(--gold-light); transform: translateY(-1px); }

    /* ── HERO ── */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
      background: var(--dark);
    }
    .hero-bg {
      position: absolute;
      inset: 0;
      background-image: url('images/hero_1.jpg');
      background-size: cover;
      background-position: center;
      opacity: 0.25;
    }
    .hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(10,10,10,0.7) 0%, rgba(10,10,10,0.2) 100%);
    }
    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 680px;
    }
    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      font-size: 0.75rem;
      font-weight: 500;
      letter-spacing: 4px;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 1.5rem;
    }
    .hero-eyebrow::before {
      content: '';
      display: block;
      width: 40px; height: 1px;
      background: var(--gold);
    }
    .hero h1 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(3rem, 7vw, 5.5rem);
      font-weight: 900;
      line-height: 1.05;
      color: var(--off-white);
      margin-bottom: 1.5rem;
    }
    .hero h1 em {
      font-style: italic;
      color: var(--gold);
    }
    .hero p {
      font-size: 1.1rem;
      font-weight: 300;
      color: rgba(245,240,232,0.65);
      line-height: 1.7;
      max-width: 480px;
      margin-bottom: 2.5rem;
    }
    .hero-actions {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      flex-wrap: wrap;
    }
    .btn-gold {
      font-size: 0.8rem;
      font-weight: 500;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--dark);
      background: var(--gold);
      padding: 0.85rem 2.2rem;
      border-radius: 2px;
      text-decoration: none;
      transition: background 0.2s, transform 0.2s;
    }
    .btn-gold:hover { background: var(--gold-light); transform: translateY(-2px); color: var(--dark); }
    .btn-outline {
      font-size: 0.8rem;
      font-weight: 500;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--off-white);
      border: 1px solid rgba(245,240,232,0.3);
      padding: 0.85rem 2.2rem;
      border-radius: 2px;
      text-decoration: none;
      transition: border-color 0.2s, color 0.2s;
    }
    .btn-outline:hover { border-color: var(--gold); color: var(--gold); }
    .hero-scroll {
      position: absolute;
      bottom: 2.5rem; left: 50%;
      transform: translateX(-50%);
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      opacity: 0.5;
    }
    .hero-scroll span {
      font-size: 0.65rem;
      letter-spacing: 3px;
      text-transform: uppercase;
    }
    .scroll-line {
      width: 1px; height: 50px;
      background: linear-gradient(to bottom, var(--gold), transparent);
      animation: scrollPulse 2s ease-in-out infinite;
    }
    @keyframes scrollPulse {
      0%, 100% { opacity: 0.4; transform: scaleY(1); }
      50% { opacity: 1; transform: scaleY(0.7); }
    }

    /* ── ABOUT ── */
    .section-about {
      padding: 7rem 0;
      background: var(--dark-2);
    }
    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 5rem;
      align-items: center;
    }
    .about-img-wrap {
      position: relative;
    }
    .about-img-wrap img {
      width: 100%;
      border-radius: 2px;
      display: block;
      filter: brightness(0.85) contrast(1.1);
    }
    .about-badge {
      position: absolute;
      bottom: -1.5rem; right: -1.5rem;
      width: 110px; height: 110px;
      background: var(--gold);
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    .about-badge strong {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      font-weight: 900;
      color: var(--dark);
      line-height: 1;
    }
    .about-badge span {
      font-size: 0.62rem;
      font-weight: 500;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: var(--dark);
      opacity: 0.75;
      line-height: 1.3;
      padding: 0 8px;
    }
    .section-label {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      font-size: 0.72rem;
      font-weight: 500;
      letter-spacing: 4px;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 1.25rem;
    }
    .section-label::before {
      content: '';
      display: block;
      width: 30px; height: 1px;
      background: var(--gold);
    }
    .about-text h2 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 700;
      line-height: 1.15;
      color: var(--off-white);
      margin-bottom: 1.5rem;
    }
    .about-text p {
      font-size: 1rem;
      font-weight: 300;
      color: rgba(245,240,232,0.6);
      line-height: 1.8;
      margin-bottom: 2rem;
    }

    /* ── SERVICES ── */
    .section-services {
      padding: 7rem 0;
      background: var(--dark);
    }
    .section-header {
      text-align: center;
      margin-bottom: 4rem;
    }
    .section-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 700;
      color: var(--off-white);
      margin-bottom: 1rem;
    }
    .section-header p {
      font-size: 1rem;
      font-weight: 300;
      color: rgba(245,240,232,0.5);
      max-width: 480px;
      margin: 0 auto;
      line-height: 1.7;
    }
    .divider-gold {
      width: 50px; height: 2px;
      background: var(--gold);
      margin: 1.25rem auto 0;
    }
    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5px;
      background: rgba(201,168,76,0.12);
      border: 1px solid rgba(201,168,76,0.12);
    }
    .service-card {
      background: var(--dark);
      padding: 2.5rem 2rem;
      position: relative;
      overflow: hidden;
      transition: background 0.3s;
    }
    .service-card::before {
      content: '';
      position: absolute;
      bottom: 0; left: 0;
      width: 0; height: 2px;
      background: var(--gold);
      transition: width 0.4s;
    }
    .service-card:hover { background: var(--dark-3); }
    .service-card:hover::before { width: 100%; }
    .service-icon {
      width: 48px; height: 48px;
      border: 1px solid rgba(201,168,76,0.3);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.5rem;
      color: var(--gold);
      font-size: 1.2rem;
    }
    .service-card h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--off-white);
      margin-bottom: 0.75rem;
    }
    .service-card p {
      font-size: 0.9rem;
      font-weight: 300;
      color: rgba(245,240,232,0.5);
      line-height: 1.7;
    }

    /* ── PRICING ── */
    .section-pricing {
      padding: 7rem 0;
      background: var(--dark-2);
    }
    .pricing-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
    }
    .pricing-card {
      border: 1px solid rgba(201,168,76,0.15);
      border-radius: 2px;
      overflow: hidden;
    }
    .pricing-card-header {
      position: relative;
      height: 180px;
      overflow: hidden;
    }
    .pricing-card-header img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(0.5);
      transition: transform 0.6s;
    }
    .pricing-card:hover .pricing-card-header img { transform: scale(1.05); }
    .pricing-card-header-title {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: flex-end;
      padding: 1.5rem;
    }
    .pricing-card-header-title h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--off-white);
    }
    .pricing-card-body {
      padding: 1.5rem;
      background: var(--dark-3);
    }
    .pricing-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.75rem 0;
      border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    .pricing-item:last-child { border-bottom: none; }
    .pricing-item span:first-child {
      font-size: 0.9rem;
      font-weight: 300;
      color: rgba(245,240,232,0.7);
    }
    .pricing-item .price {
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--gold);
      letter-spacing: 0.5px;
    }

    /* ── TESTIMONIALS ── */
    .section-testimonials {
      padding: 7rem 0;
      background: var(--dark);
    }
    .testimonials-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 1.5rem;
    }
    .testimonial-card {
      border: 1px solid rgba(201,168,76,0.12);
      border-radius: 2px;
      padding: 2rem;
      background: var(--dark-2);
      position: relative;
    }
    .testimonial-card::before {
      content: '"';
      position: absolute;
      top: 1rem; right: 1.5rem;
      font-family: 'Playfair Display', serif;
      font-size: 5rem;
      color: rgba(201,168,76,0.1);
      line-height: 1;
    }
    .testimonial-card p {
      font-size: 0.92rem;
      font-weight: 300;
      color: rgba(245,240,232,0.65);
      line-height: 1.8;
      margin-bottom: 1.5rem;
      font-style: italic;
    }
    .testimonial-author {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .testimonial-avatar {
      width: 42px; height: 42px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid rgba(201,168,76,0.3);
    }
    .testimonial-name {
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--off-white);
    }
    .testimonial-stars {
      color: var(--gold);
      font-size: 0.65rem;
      letter-spacing: 2px;
    }

    /* ── CTA BANNER ── */
    .section-cta {
      padding: 6rem 0;
      position: relative;
      overflow: hidden;
      background: var(--dark-2);
    }
    .section-cta::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image: url('images/hero_2.jpg');
      background-size: cover;
      background-position: center;
      opacity: 0.1;
    }
    .cta-content {
      position: relative;
      z-index: 2;
      text-align: center;
    }
    .cta-content h2 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 5vw, 3.5rem);
      font-weight: 700;
      color: var(--off-white);
      margin-bottom: 1rem;
    }
    .cta-content p {
      font-size: 1rem;
      font-weight: 300;
      color: rgba(245,240,232,0.5);
      margin-bottom: 2.5rem;
    }
    .cta-line {
      width: 1px; height: 60px;
      background: linear-gradient(to bottom, transparent, var(--gold));
      margin: 0 auto 2rem;
    }

    /* ── FOOTER ── */
    footer {
      background: #080808;
      padding: 4rem 0 2rem;
      border-top: 1px solid rgba(201,168,76,0.1);
    }
    .footer-grid {
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr;
      gap: 3rem;
      margin-bottom: 3rem;
    }
    .footer-logo {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      font-weight: 900;
      color: var(--gold);
      letter-spacing: 2px;
      margin-bottom: 1rem;
      display: block;
    }
    .footer-about {
      font-size: 0.88rem;
      font-weight: 300;
      color: rgba(245,240,232,0.4);
      line-height: 1.8;
    }
    .footer-heading {
      font-size: 0.72rem;
      font-weight: 500;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 1.25rem;
    }
    .footer-links {
      list-style: none;
    }
    .footer-links li { margin-bottom: 0.6rem; }
    .footer-links a {
      font-size: 0.88rem;
      font-weight: 300;
      color: rgba(245,240,232,0.45);
      text-decoration: none;
      transition: color 0.2s;
    }
    .footer-links a:hover { color: var(--gold); }
    .footer-newsletter {
      display: flex;
      gap: 8px;
    }
    .footer-newsletter input {
      flex: 1;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 2px;
      padding: 0.6rem 1rem;
      font-family: 'Outfit', sans-serif;
      font-size: 0.85rem;
      color: var(--off-white);
      outline: none;
      transition: border-color 0.2s;
    }
    .footer-newsletter input:focus { border-color: rgba(201,168,76,0.5); }
    .footer-newsletter input::placeholder { color: rgba(245,240,232,0.25); }
    .footer-newsletter button {
      background: var(--gold);
      border: none;
      border-radius: 2px;
      padding: 0.6rem 1.25rem;
      font-family: 'Outfit', sans-serif;
      font-size: 0.75rem;
      font-weight: 500;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: var(--dark);
      cursor: pointer;
      transition: background 0.2s;
    }
    .footer-newsletter button:hover { background: var(--gold-light); }
    .footer-bottom {
      border-top: 1px solid rgba(255,255,255,0.06);
      padding-top: 2rem;
      text-align: center;
      font-size: 0.8rem;
      font-weight: 300;
      color: rgba(245,240,232,0.25);
    }
    .footer-bottom a { color: var(--gold); text-decoration: none; }

    /* ── RESPONSIVE ── */
    @media (max-width: 768px) {
      .about-grid, .pricing-grid, .footer-grid { grid-template-columns: 1fr; }
      .about-badge { display: none; }
      .nav-links, .nav-cta { display: none; }
    }
  </style>
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar-bp" id="navbar">
    <div class="container">
      <a href="{{ route('welcome') }}" class="nav-logo">BarberPoint</a>
      <ul class="nav-links">
        <li><a href="{{ route('servicos') }}">Serviços</a></li>
        @if(auth()->guard('cliente')->check())
          <li><a href="{{ route('agendamentos') }}">Agendamentos</a></li>
        @else
          <li><a href="{{ route('cliente.login') }}">Agendamentos</a></li>
        @endif
        <li><a href="{{ route('cliente.register') }}">Cadastrar</a></li>
        <li><a href="{{ route('admin.login') }}">Admin</a></li>
      </ul>
      @if(auth()->guard('cliente')->check())
        <a href="{{ route('agendamentos') }}" class="nav-cta">Agendar</a>
      @else
        <a href="{{ route('cliente.login') }}" class="nav-cta">Agendar</a>
      @endif
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="container">
      <div class="hero-content">
        <div class="hero-eyebrow">Barbearia Premium</div>
        <h1>Mais do que<br>um <em>corte</em>,<br>uma experiência.</h1>
        <p>Tradição, estilo e cuidado em cada detalhe. Seu visual, nossa arte.</p>
        <div class="hero-actions">
          @if(auth()->guard('cliente')->check())
            <a href="{{ route('agendamentos') }}" class="btn-gold">Agendar Horário</a>
          @else
            <a href="{{ route('cliente.login') }}" class="btn-gold">Agendar Horário</a>
          @endif
          <a href="{{ route('servicos') }}" class="btn-outline">Ver Serviços</a>
        </div>
      </div>
    </div>
    <div class="hero-scroll">
      <span>Scroll</span>
      <div class="scroll-line"></div>
    </div>
  </section>

  <!-- ABOUT -->
  <section class="section-about">
    <div class="container">
      <div class="about-grid">
        <div class="about-img-wrap">
          <img src="assets/img/logo.png" alt="Barbearia BarberPoint">
          <div class="about-badge">
            <strong>3</strong>
            <span>Anos de excelência</span>
          </div>
        </div>
        <div class="about-text">
          <div class="section-label">Sobre nós</div>
          <h2>Bem-vindo à BarberPoint</h2>
          <p>Somos mais do que uma barbearia. Somos um espaço onde tradição e modernidade se encontram para criar uma experiência única de cuidado masculino.</p>
          <p>Cada cliente é tratado com atenção e dedicação, porque acreditamos que um bom corte vai além da tesoura — é sobre como você se sente ao sair daqui.</p>
          
        </div>
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="section-services">
    <div class="container">
      <div class="section-header">
        <div class="section-label" style="justify-content: center;">O que oferecemos</div>
        <h2>Nossos Serviços</h2>
        <p>Do corte clássico ao tratamento completo, temos tudo que você precisa.</p>
        <div class="divider-gold"></div>
      </div>
      <div class="services-grid">
        <div class="service-card">
          <div class="service-icon"><span class="flaticon-bald"></span></div>
          <h3>Corte de Cabelo</h3>
          <p>Degradê, social ou na tesoura. Técnica impecável para qualquer estilo.</p>
        </div>
        <div class="service-card">
          <div class="service-icon"><span class="flaticon-beard"></span></div>
          <h3>Barba</h3>
          <p>Modelagem e aparagem com navalha para um acabamento perfeito.</p>
        </div>
        <div class="service-card">
          <div class="service-icon"><span class="flaticon-scissors"></span></div>
          <h3>Combos</h3>
          <p>Corte + Barba, Corte + Sobrancelha e pacotes completos com economia.</p>
        </div>
        <div class="service-card">
          <div class="service-icon"><span class="flaticon-hair-spray"></span></div>
          <h3>Hidratação</h3>
          <p>Tratamentos capilares que nutrem e fortalecem os fios.</p>
        </div>
        <div class="service-card">
          <div class="service-icon"><span class="flaticon-hair"></span></div>
          <h3>Sobrancelha</h3>
          <p>Design e aparagem para um olhar mais definido e expressivo.</p>
        </div>
        <div class="service-card">
          <div class="service-icon"><span class="flaticon-barber-shop"></span></div>
          <h3>Pigmentação</h3>
          <p>Cobertura de falhas na barba e couro cabeludo com resultado natural.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- PRICING -->
  <section class="section-pricing">
    <div class="container">
      <div class="section-header">
        <div class="section-label" style="justify-content: center;">Tabela</div>
        <h2>Serviços & Preços</h2>
        <p>Preços transparentes, sem surpresas.</p>
        <div class="divider-gold"></div>
      </div>
      <div class="pricing-grid">
        <div class="pricing-card">
          <div class="pricing-card-header">
            <img src="images/img_1.jpg" alt="Cortes">
            <div class="pricing-card-header-title"><h3>Corte de Cabelo</h3></div>
          </div>
          <div class="pricing-card-body">
            <div class="pricing-item">
              <span>Corte Degradê</span>
              <span class="price">R$ 30,00</span>
            </div>
            <div class="pricing-item">
              <span>Corte Social</span>
              <span class="price">R$ 25,00</span>
            </div>
            <div class="pricing-item">
              <span>Corte na Tesoura</span>
              <span class="price">R$ 35,00</span>
            </div>
          </div>
        </div>
        <div class="pricing-card">
          <div class="pricing-card-header">
            <img src="images/img_3.jpg" alt="Combos">
            <div class="pricing-card-header-title"><h3>Combos</h3></div>
          </div>
          <div class="pricing-card-body">
            <div class="pricing-item">
              <span>Corte + Barba</span>
              <span class="price">R$ 45,00</span>
            </div>
            <div class="pricing-item">
              <span>Corte + Sobrancelha</span>
              <span class="price">R$ 40,00</span>
            </div>
            <div class="pricing-item">
              <span>Barba + Sobrancelha</span>
              <span class="price">R$ 35,00</span>
            </div>
            <div class="pricing-item">
              <span>Corte + Barba + Sobrancelha</span>
              <span class="price">R$ 50,00</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="section-testimonials">
    <div class="container">
      <div class="section-header">
        <div class="section-label" style="justify-content: center;">Depoimentos</div>
        <h2>O que nossos clientes dizem</h2>
        <div class="divider-gold"></div>
      </div>
      <div class="testimonials-grid">
        <div class="testimonial-card">
          <p>Melhor barbearia da cidade, sem dúvida. Atendimento impecável e o corte ficou exatamente do jeito que eu pedi. Já sou cliente fiel há mais de dois anos.</p>
          <div class="testimonial-author">
            <img src="images/person_1.jpg" alt="Mike Fisher" class="testimonial-avatar">
            <div>
              <div class="testimonial-name">Mike Fisher</div>
              <div class="testimonial-stars">★★★★★</div>
            </div>
          </div>
        </div>
        <div class="testimonial-card">
          <p>O ambiente é incrível, o atendimento é excelente e o resultado é sempre perfeito. Recomendo a todos que buscam qualidade de verdade.</p>
          <div class="testimonial-author">
            <img src="images/person_2.jpg" alt="Jean Stanley" class="testimonial-avatar">
            <div>
              <div class="testimonial-name">Jean Stanley</div>
              <div class="testimonial-stars">★★★★★</div>
            </div>
          </div>
        </div>
        <div class="testimonial-card">
          <p>Profissionais que realmente entendem do que fazem. A barba ficou impecável e o corte perfeito. Já indiquei para toda a família.</p>
          <div class="testimonial-author">
            <img src="images/person_3.jpg" alt="Katie Rose" class="testimonial-avatar">
            <div>
              <div class="testimonial-name">Katie Rose</div>
              <div class="testimonial-stars">★★★★★</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-cta">
    <div class="cta-content">
      <div class="container">
        <div class="cta-line"></div>
        <h2>Pronto para uma<br>nova experiência?</h2>
        <p>Agende agora e garanta seu horário com nossos especialistas.</p>
        <a href="{{ route('agendamentos') }}" class="btn-gold">Agendar Meu Horário</a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="container">
      <div class="footer-grid">
        <div>
          <span class="footer-logo">BarberPoint</span>
          <p class="footer-about">Tradição e qualidade em cada atendimento. Seu estilo é nossa missão.</p>
        </div>
        <div>
          <div class="footer-heading">Links Rápidos</div>
          <ul class="footer-links">
            <li><a href="about.html">Sobre Nós</a></li>
            <li><a href="{{ route('servicos') }}">Serviços</a></li>
            <li><a href="{{ route('agendamentos') }}">Agendamentos</a></li>
            <li><a href="#">Contato</a></li>
            <li><a href="#">Privacidade</a></li>
          </ul>
        </div>
        <div>
          <div class="footer-heading">Newsletter</div>
          <div class="footer-newsletter">
            <input type="email" placeholder="seu@email.com">
            <button>Enviar</button>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; <script>document.write(new Date().getFullYear())</script> BarberPoint. Feito com cuidado por <a href="https://colorlib.com" target="_blank">Colorlib</a>.</p>
      </div>
    </div>
  </footer>

  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script>
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 60);
    });
  </script>
</body>
</html>