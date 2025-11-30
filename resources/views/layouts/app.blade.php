<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'PT BPR Sarimadu' }}</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <style>
    :root {
      /* Palette Selaras dengan Landing Page */
      --brand-navy: #0f172a;       /* Dark Blue/Slate */
      --brand-blue: #2563eb;       /* Primary Blue */
      --brand-gold: #fbbf24;       /* Accent Gold */
      --text-main: #334155;        /* Body Text */
      --text-muted: #64748b;
      --bg-light: #f8fafc;
      --surface: #ffffff;
      
      --navbar-height: 80px;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-light);
      color: var(--text-main);
      -webkit-font-smoothing: antialiased;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* --- NAVBAR MODERN --- */
    .navbar-sarimadu {
      background-color: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(0,0,0,0.05);
      padding: 1rem 0;
      transition: all 0.3s ease;
    }

    .navbar-brand img {
      height: 45px;
      width: auto;
      object-fit: contain;
    }

    .nav-link {
      font-weight: 500;
      color: var(--text-main);
      margin: 0 0.5rem;
      font-size: 0.95rem;
      transition: color 0.2s ease;
    }

    .nav-link:hover, .nav-link.active {
      color: var(--brand-blue);
      font-weight: 600;
    }

    /* Button Login di Navbar */
    .btn-nav-login {
      background-color: var(--brand-navy);
      color: #fff !important;
      padding: 0.5rem 1.5rem;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.3s;
    }
    .btn-nav-login:hover {
      background-color: var(--brand-blue);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    /* Dropdown Menu */
    .dropdown-menu {
      border: none;
      box-shadow: 0 10px 30px -5px rgba(0,0,0,0.1);
      border-radius: 12px;
      padding: 0.5rem;
      margin-top: 1rem; /* Biar gak nempel banget */
    }
    .dropdown-item {
      border-radius: 8px;
      padding: 0.6rem 1rem;
      font-weight: 500;
      color: var(--text-main);
    }
    .dropdown-item:hover {
      background-color: #f1f5f9; /* Slate 100 */
      color: var(--brand-blue);
    }
    .dropdown-item.active, .dropdown-item:active {
      background-color: var(--brand-blue);
      color: white;
    }

    /* --- FOOTER CORPORATE --- */
    footer {
      margin-top: auto; /* Push footer to bottom */
      background-color: var(--brand-navy);
      color: #cbd5e1; /* Light Slate */
      padding-top: 4rem;
      font-size: 0.9rem;
    }
    footer h5 {
      color: #fff;
      font-weight: 700;
      margin-bottom: 1.5rem;
    }
    footer a {
      color: #cbd5e1;
      text-decoration: none;
      transition: color 0.2s;
      display: block;
      margin-bottom: 0.75rem;
    }
    footer a:hover {
      color: var(--brand-gold);
      padding-left: 5px; /* Efek geser dikit pas hover */
    }
    .footer-bottom {
      background-color: #020617; /* Lebih gelap dari navy */
      padding: 1.5rem 0;
      margin-top: 3rem;
    }
  </style>

  @stack('head')
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-sarimadu sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('assets/LOGO_PANJANG_OK.png') }}" alt="BPR Sarimadu">
      </a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navContent">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">Tentang Kami</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is('kredit*') || request()->is('deposito*') || request()->is('rekening*') ? 'active' : '' }}" 
               href="#" role="button" data-bs-toggle="dropdown">
               Layanan
            </a>
            <ul class="dropdown-menu dropdown-menu-end animate slideIn">
              <li><h6 class="dropdown-header text-uppercase small fw-bold text-muted">Simpanan</h6></li>
              <li><a class="dropdown-item" href="{{ route('rekening') }}"><i class="bi bi-wallet2 me-2"></i>Rekening</a></li>
              <li><a class="dropdown-item" href="{{ route('deposito') }}"><i class="bi bi-safe me-2"></i>Deposito</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><h6 class="dropdown-header text-uppercase small fw-bold text-muted">Pinjaman</h6></li>
              <li><a class="dropdown-item" href="{{ route('kredit') }}"><i class="bi bi-cash-stack me-2"></i>Kredit</a></li>
            </ul>
          </li>

          @auth
            <li class="nav-item dropdown ms-lg-2">
              <a class="nav-link dropdown-toggle btn-light rounded-pill px-3 border" href="#" role="button" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Pengaturan Akun</a></li>
                @if(auth()->user()->role === 'admin')
                  <li><a class="dropdown-item" href="{{ route('dashboard') }}">Panel Admin</a></li>
                @else
                  <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard Saya</a></li>
                @endif
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger">
                      <i class="bi bi-box-arrow-right me-2"></i>Keluar
                    </button>
                  </form>
                </li>
              </ul>
            </li>
          @endauth

          @guest
            <li class="nav-item ms-lg-3">
              <a href="{{ route('login') }}" class="btn btn-nav-login">
                Masuk / Daftar
              </a>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  @hasSection('hero')
    @yield('hero')
  @endif

  <main class="flex-grow-1">
    {{-- Container hanya dipakai jika tidak didefinisikan di child view --}}
    @if (!trim($slot ?? '')) 
        {{-- Jika pakai Section Content biasa --}}
        <div class="@if(request()->is('/')) @else container my-5 @endif">
          @include('partials.alert')
          @yield('content')
        </div>
    @else
        {{-- Jika pakai slot (Layout Breeze/Jetstream style) --}}
        <div class="container my-5">
            @include('partials.alert')
            {{ $slot }}
        </div>
    @endif
  </main>

  <footer>
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <img src="{{ asset('assets/LOGO_PANJANG_OK.png') }}" alt="Logo" class="mb-4 bg-white p-2 rounded" style="height: 50px;">
          <p class="mb-4 pe-lg-4">
            PT BPR Sarimadu adalah lembaga perbankan terpercaya yang berkomitmen mendukung pertumbuhan ekonomi masyarakat melalui layanan keuangan yang aman dan mudah.
          </p>
          <div class="d-flex gap-3">
            <a href="#" class="text-white"><i class="bi bi-facebook fs-5"></i></a>
            <a href="#" class="text-white"><i class="bi bi-instagram fs-5"></i></a>
            <a href="#" class="text-white"><i class="bi bi-linkedin fs-5"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-6">
          <h5>Perusahaan</h5>
          <ul class="list-unstyled">
            <li><a href="{{ route('about') }}">Tentang Kami</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6">
          <h5>Produk</h5>
          <ul class="list-unstyled">
            <li><a href="{{ route('rekening') }}">Tabungan</a></li>
            <li><a href="{{ route('deposito') }}">Deposito</a></li>
            <li><a href="{{ route('kredit') }}">Kredit Modal Kerja</a></li>
            <li><a href="{{ route('kredit') }}">Kredit Konsumtif</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6">
          <h5>Hubungi Kami</h5>
          <ul class="list-unstyled">
            <li class="mb-3 d-flex gap-3">
              <i class="bi bi-geo-alt text-warning mt-1"></i>
              <span>Jl. Jend. Sudirman No. 123, Pekanbaru,<br>Riau, Indonesia</span>
            </li>
            <li class="mb-3 d-flex gap-3">
              <i class="bi bi-telephone text-warning mt-1"></i>
              <span>(0761) 1234567</span>
            </li>
            <li class="mb-3 d-flex gap-3">
              <i class="bi bi-envelope text-warning mt-1"></i>
              <span>cs@bprsarimadu.co.id</span>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="footer-bottom text-center">
      <div class="container">
        <div class="d-md-flex justify-content-between align-items-center">
          <span class="small">&copy; {{ date('Y') }} PT BPR Sarimadu. All rights reserved.</span>
          <span class="small mt-2 mt-md-0 d-block">Terdaftar dan Diawasi oleh <strong>Otoritas Jasa Keuangan (OJK)</strong></span>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>