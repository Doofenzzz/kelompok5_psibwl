@extends('layouts.app')

@push('head')
<style>
  :root {
    --brand-navy: #0f172a;
    --brand-blue: #2563eb;
    --brand-gold: #fbbf24;
    --text-light: #f8fafc;
  }

  /* --- HERO SECTION --- */
  .hero-wrapper {
    background: linear-gradient(160deg, var(--brand-navy) 0%, #1e3a8a 100%);
    color: var(--text-light);
    padding-top: 5rem;
    padding-bottom: 8rem; /* Extra padding bawah untuk space kartu */
    position: relative;
    overflow: hidden;
    text-align: center;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
  }

  /* Hiasan background abstrak */
  .hero-wrapper::before {
    content: '';
    position: absolute;
    top: -50px; left: -50px;
    width: 300px; height: 300px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
    filter: blur(60px);
  }
  .hero-wrapper::after {
    content: '';
    position: absolute;
    bottom: -50px; right: -50px;
    width: 400px; height: 400px;
    background: rgba(37, 99, 235, 0.2);
    border-radius: 50%;
    filter: blur(80px);
  }

  .hero-title {
    font-size: clamp(2.2rem, 4vw, 3.5rem);
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1.5rem;
  }

  .hero-subtitle {
    font-size: 1.1rem;
    color: #cbd5e1;
    max-width: 700px;
    margin: 0 auto 2.5rem;
    font-weight: 300;
  }

  .btn-light-brand {
    background: #fff;
    color: var(--brand-blue);
    font-weight: 600;
    border-radius: 8px;
    padding: 12px 28px;
    transition: all 0.3s;
  }
  .btn-light-brand:hover {
    background: #f1f5f9;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }

  .btn-outline-light-brand {
    border: 1px solid rgba(255,255,255,0.3);
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 12px 28px;
    transition: all 0.3s;
  }
  .btn-outline-light-brand:hover {
    background: rgba(255,255,255,0.1);
    border-color: #fff;
  }

  /* --- FLOATING SERVICE CARDS --- */
  .floating-container {
    margin-top: -6rem; /* Menarik kartu ke atas menimpa hero */
    position: relative;
    z-index: 10;
  }

  .service-card {
    background: #fff;
    border: none;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
    height: 100%;
    transition: transform 0.3s ease;
    text-align: left;
    border-top: 4px solid transparent;
  }

  .service-card:hover {
    transform: translateY(-10px);
    border-top-color: var(--brand-blue);
  }

  .icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
  }

  /* --- FEATURES & STEPS --- */
  .section-header {
    margin-bottom: 3rem;
    text-align: center;
  }
  .section-title {
    font-weight: 700;
    color: var(--brand-navy);
    margin-bottom: 0.5rem;
  }

  .feature-box {
    padding: 1.5rem;
    border-radius: 12px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    height: 100%;
  }
  
  .step-timeline {
    position: relative;
    padding-left: 2rem;
    border-left: 2px solid #e2e8f0;
  }
  .step-item {
    position: relative;
    margin-bottom: 2.5rem;
  }
  .step-dot {
    position: absolute;
    left: -2.6rem;
    top: 0;
    width: 20px;
    height: 20px;
    background: var(--brand-blue);
    border: 4px solid #fff;
    border-radius: 50%;
    box-shadow: 0 0 0 2px #e2e8f0;
  }
</style>
@endpush

@section('hero')
<div class="hero-wrapper">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-25 px-3 py-2 rounded-pill mb-3 fw-normal">
          <i class="bi bi-shield-check me-1"></i> Terdaftar & Diawasi OJK
        </span>
        <h1 class="hero-title">
          Mitra Keuangan Digital <br> untuk Masa Depan Anda
        </h1>
        <p class="hero-subtitle">
          PT BPR Sarimadu menghadirkan layanan perbankan yang aman, transparan, dan mudah diakses. 
          Solusi finansial terintegrasi untuk kebutuhan personal maupun bisnis.
        </p>
        <div class="d-flex justify-content-center gap-3">
          <a href="{{ route('register') }}" class="btn btn-light-brand">
            Buka Rekening Sekarang
          </a>
          <a href="{{ route('login') }}" class="btn btn-outline-light-brand">
            Masuk Akun
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="container floating-container">
  <div class="row g-4">
    <div class="col-md-4">
      <div class="service-card">
        <div class="icon-circle bg-primary bg-opacity-10 text-primary">
          <i class="bi bi-wallet2"></i>
        </div>
        <h4 class="fw-bold mb-2">Simpanan & Tabungan</h4>
        <p class="text-muted small mb-4">
          Buka rekening tabungan dengan bunga kompetitif dan bebas biaya administrasi bulanan.
        </p>
        <a href="{{ route('rekening.create') }}" class="text-decoration-none fw-semibold">
          Ajukan Pembukaan <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>
    </div>

    <div class="col-md-4">
      <div class="service-card">
        <div class="icon-circle bg-warning bg-opacity-10 text-warning">
          <i class="bi bi-cash-coin"></i>
        </div>
        <h4 class="fw-bold mb-2">Fasilitas Kredit</h4>
        <p class="text-muted small mb-4">
          Solusi pembiayaan cepat dengan tenor fleksibel dan transparansi bunga angsuran.
        </p>
        <a href="{{ route('kredit.create') }}" class="text-decoration-none fw-semibold text-warning">
          Simulasi Kredit <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>
    </div>

    <div class="col-md-4">
      <div class="service-card">
        <div class="icon-circle bg-danger bg-opacity-10 text-danger">
          <i class="bi bi-graph-up-arrow"></i>
        </div>
        <h4 class="fw-bold mb-2">Deposito Berjangka</h4>
        <p class="text-muted small mb-4">
          Optimalkan aset Anda dengan investasi rendah risiko dan imbal hasil yang pasti.
        </p>
        <a href="{{ route('deposito.create') }}" class="text-decoration-none fw-semibold text-danger">
          Lihat Suku Bunga <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<section class="py-5 mt-4">
  <div class="container">
    <div class="row align-items-center g-5">
      
      <div class="col-lg-6">
        <h6 class="text-primary fw-bold text-uppercase ls-1">Tentang Kami</h6>
        <h2 class="section-title">Komitmen Pelayanan Prima</h2>
        <p class="text-muted mb-4">
          Kami memahami bahwa kepercayaan adalah aset terbesar. Oleh karena itu, BPR Sarimadu selalu mengedepankan keamanan dan kenyamanan nasabah.
        </p>

        <div class="row g-3">
          <div class="col-sm-6">
            <div class="feature-box">
              <i class="bi bi-shield-lock text-primary fs-4 mb-2 d-block"></i>
              <h6 class="fw-bold">Keamanan Data</h6>
              <p class="small text-muted mb-0">Enkripsi data nasabah standar perbankan.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="feature-box">
              <i class="bi bi-clock-history text-primary fs-4 mb-2 d-block"></i>
              <h6 class="fw-bold">Proses Efisien</h6>
              <p class="small text-muted mb-0">Verifikasi berkas cepat tanpa antre.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="bg-white p-4 rounded-4 shadow-sm border">
          <h4 class="fw-bold mb-4">Langkah Pengajuan</h4>
          
          <div class="step-timeline ms-2">
            <div class="step-item">
              <div class="step-dot"></div>
              <h6 class="fw-bold">Registrasi Akun</h6>
              <p class="text-muted small">Daftarkan diri Anda melalui portal digital kami.</p>
              <a href="{{ route('register') }}" class="btn btn-sm btn-outline-primary rounded-pill">Daftar</a>
            </div>
            
            <div class="step-item">
              <div class="step-dot"></div>
              <h6 class="fw-bold">Verifikasi Identitas (KYC)</h6>
              <p class="text-muted small">Lengkapi profil nasabah untuk validasi data.</p>
              <a href="{{ route('nasabah.create') }}" class="btn btn-sm btn-outline-secondary rounded-pill">Lengkapi Data</a>
            </div>
            
            <div class="step-item mb-0">
              <div class="step-dot"></div>
              <h6 class="fw-bold">Nikmati Layanan</h6>
              <p class="text-muted small">Rekening siap digunakan untuk transaksi.</p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
@endsection