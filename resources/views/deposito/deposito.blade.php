@extends('layouts.app')

@push('head')
<style>
  /* --- HERO STYLE (Konsisten) --- */
  .inner-hero {
    background: linear-gradient(135deg, var(--brand-navy) 0%, #1e3a8a 100%);
    color: #fff;
    padding: 4rem 0 7rem; /* Padding bawah extra untuk overlap */
    text-align: center;
    border-bottom-left-radius: 40px;
    border-bottom-right-radius: 40px;
    margin-bottom: -4rem; /* Tarik konten ke atas */
  }

  /* --- CONTENT BOXES --- */
  .main-content-wrap {
    position: relative;
    z-index: 10;
  }

  .deposito-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 15px 40px -5px rgba(0,0,0,0.1);
    border: 1px solid #f1f5f9;
    padding: 2.5rem;
    height: 100%;
  }

  /* --- FEATURE ICONS (Grid Kanan) --- */
  .feature-grid-item {
    background: #f8fafc;
    border-radius: 12px;
    padding: 1.5rem;
    transition: all 0.3s ease;
    border: 1px solid transparent;
  }
  .feature-grid-item:hover {
    background: #fff;
    border-color: var(--brand-blue);
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transform: translateY(-3px);
  }
  .feature-icon {
    width: 48px; height: 48px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }

  /* --- TENOR BADGES --- */
  .tenor-wrap {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 1rem;
  }
  .tenor-badge {
    background: #fff;
    border: 1px solid #cbd5e1;
    color: var(--brand-navy);
    padding: 0.5rem 1.2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .tenor-badge i { color: var(--brand-gold); }

  /* --- SPECIAL HIGHLIGHT --- */
  .highlight-box {
    background: linear-gradient(90deg, #fffbeb 0%, #fff 100%);
    border-left: 4px solid var(--brand-gold);
    padding: 1rem 1.5rem;
    border-radius: 8px;
    margin-top: 2rem;
  }
</style>
@endpush

@section('hero')
<div class="inner-hero">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-25 px-3 py-2 rounded-pill mb-3">
          Investasi Berjangka
        </span>
        <h1 class="fw-bold mb-3">Deposito Sarimadu</h1>
        <p class="opacity-75 mb-4">
          Optimalkan aset keuangan Anda dengan instrumen investasi yang aman, 
          menguntungkan, dan fleksibel.
        </p>
        
        <div class="d-flex justify-content-center gap-3">
          @auth
            @can('submit-applications')
              <a href="{{ route('deposito.create') }}" class="btn btn-light text-primary fw-bold shadow-sm rounded-pill px-4 py-2">
                <i class="bi bi-piggy-bank me-1"></i> Mulai Investasi
              </a>
            @else
              <a href="{{ route('dashboard') }}" class="btn btn-light text-primary fw-bold shadow-sm rounded-pill px-4 py-2">
                <i class="bi bi-speedometer2 me-1"></i> Dashboard
              </a>
            @endcan
          @else
            <a href="{{ route('login') }}" class="btn btn-light text-primary fw-bold shadow-sm rounded-pill px-4 py-2">
              <i class="bi bi-box-arrow-in-right me-1"></i> Login Akun
            </a>
          @endauth
        </div>

      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="container pb-5 main-content-wrap">
  <div class="row g-4">
    
    <div class="col-lg-6">
      <div class="deposito-card">
        <h3 class="fw-bold text-dark mb-3">Pertumbuhan Nilai Aset</h3>
        <p class="text-muted text-justify mb-4">
          Deposito Sarimadu adalah produk simpanan berjangka yang memberikan imbal hasil optimal dibandingkan tabungan reguler. Pilihan tepat bagi Anda yang ingin mengamankan dana jangka menengah hingga panjang dengan risiko minim.
        </p>

        <h6 class="fw-bold text-uppercase text-primary small ls-1 mb-3">Pilihan Jangka Waktu (Tenor)</h6>
        <div class="tenor-wrap">
          <div class="tenor-badge"><i class="bi bi-calendar-check"></i> 1 Bulan</div>
          <div class="tenor-badge"><i class="bi bi-calendar-check"></i> 3 Bulan</div>
          <div class="tenor-badge"><i class="bi bi-calendar-check"></i> 6 Bulan</div>
          <div class="tenor-badge"><i class="bi bi-calendar-check"></i> 12 Bulan</div>
        </div>

        <div class="highlight-box">
          <div class="d-flex gap-3">
            <i class="bi bi-stars text-warning fs-4"></i>
            <div>
              <h6 class="fw-bold text-dark m-0">Penawaran Spesial</h6>
              <small class="text-muted">
                Untuk penempatan dana di atas <strong>Rp 100.000.000,-</strong>, suku bunga dapat dinegosiasikan (Negotiable Rate) sesuai ketentuan yang berlaku.
              </small>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="col-lg-6">
      <div class="row g-3 h-100">
        
        <div class="col-md-6">
          <div class="feature-grid-item h-100">
            <div class="feature-icon bg-success bg-opacity-10 text-success">
              <i class="bi bi-graph-up-arrow"></i>
            </div>
            <h6 class="fw-bold">Bunga Kompetitif</h6>
            <p class="small text-muted mb-0">
              Menawarkan suku bunga <i>counter</i> yang lebih tinggi dibandingkan rata-rata Bank Umum.
            </p>
          </div>
        </div>

        <div class="col-md-6">
          <div class="feature-grid-item h-100">
            <div class="feature-icon bg-primary bg-opacity-10 text-primary">
              <i class="bi bi-file-earmark-lock"></i>
            </div>
            <h6 class="fw-bold">Agunan Kredit</h6>
            <p class="small text-muted mb-0">
              Sertifikat deposito Anda dapat dijadikan jaminan untuk pengajuan kredit proses cepat (Back-to-Back).
            </p>
          </div>
        </div>

        <div class="col-md-6">
          <div class="feature-grid-item h-100">
            <div class="feature-icon bg-info bg-opacity-10 text-info">
              <i class="bi bi-shield-check"></i>
            </div>
            <h6 class="fw-bold">Dijamin LPS</h6>
            <p class="small text-muted mb-0">
              Dana Anda aman karena dijamin sepenuhnya oleh Pemerintah melalui Lembaga Penjamin Simpanan.
            </p>
          </div>
        </div>

        <div class="col-md-6">
          <div class="feature-grid-item h-100">
            <div class="feature-icon bg-warning bg-opacity-10 text-warning">
              <i class="bi bi-arrow-repeat"></i>
            </div>
            <h6 class="fw-bold">Automatic Roll Over</h6>
            <p class="small text-muted mb-0">
              Opsi perpanjangan otomatis (ARO) saat jatuh tempo tanpa perlu konfirmasi ulang.
            </p>
          </div>
        </div>

      </div>
    </div>

  </div>

  {{-- INFO FOOTER --}}
  <div class="row justify-content-center mt-5">
    <div class="col-md-8 text-center">
      <a href="{{ url('/') }}" class="text-decoration-none text-muted small fw-semibold">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Utama
      </a>
    </div>
  </div>
</div>
@endsection