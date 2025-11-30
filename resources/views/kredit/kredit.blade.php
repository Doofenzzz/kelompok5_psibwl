@extends('layouts.app')

@push('head')
<style>
  /* --- HERO STYLE (Konsisten) --- */
  .inner-hero {
    background: linear-gradient(135deg, var(--brand-navy) 0%, #1e3a8a 100%);
    color: #fff;
    padding: 4rem 0 7rem;
    text-align: center;
    border-bottom-left-radius: 40px;
    border-bottom-right-radius: 40px;
    margin-bottom: -4rem; /* Efek overlap */
  }

  /* --- LOAN CARD DESIGN --- */
  .loan-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 2rem;
    height: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
    position: relative;
    overflow: hidden;
  }

  .loan-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
  }

  /* Warna border atas untuk identitas produk */
  .loan-card.wirausaha { border-top: 5px solid var(--brand-blue); }
  .loan-card.agri { border-top: 5px solid #10b981; }      /* Emerald Green */
  .loan-card.investasi { border-top: 5px solid var(--brand-gold); }
  .loan-card.bakulan { border-top: 5px solid #ef4444; }   /* Red */

  .icon-box {
    width: 60px; height: 60px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.75rem;
    margin-bottom: 1.5rem;
  }

  .sector-list {
    list-style: none;
    padding: 0;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px dashed #e2e8f0;
  }
  .sector-list li {
    display: flex;
    align-items: start;
    gap: 10px;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
    color: var(--text-muted);
  }
  .sector-list li i {
    flex-shrink: 0;
    margin-top: 3px;
  }
</style>
@endpush

@section('hero')
<div class="inner-hero">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-25 px-3 py-2 rounded-pill mb-3">
          Solusi Permodalan
        </span>
        <h1 class="fw-bold mb-3">Kredit Sarimadu</h1>
        <p class="opacity-75 mb-4">
          Dukungan finansial fleksibel untuk berbagai sektor usaha. 
          Mulai dari UMKM, pertanian, hingga pedagang mikro.
        </p>

        <div class="d-flex justify-content-center gap-3">
          @auth
            @can('submit-applications')
              <a href="{{ route('kredit.create') }}" class="btn btn-light text-primary fw-bold shadow-sm rounded-pill px-4 py-2">
                <i class="bi bi-pencil-square me-1"></i> Ajukan Sekarang
              </a>
            @else
              <a href="{{ route('dashboard') }}" class="btn btn-light text-primary fw-bold shadow-sm rounded-pill px-4 py-2">
                <i class="bi bi-speedometer2 me-1"></i> Dashboard
              </a>
            @endcan
          @else
            <a href="{{ route('login') }}" class="btn btn-light text-primary fw-bold shadow-sm rounded-pill px-4 py-2">
              <i class="bi bi-box-arrow-in-right me-1"></i> Login untuk Mengajukan
            </a>
          @endauth
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="container pb-5" style="position: relative; z-index: 10;">
  <div class="row g-4">
    
    <div class="col-lg-6">
      <div class="loan-card wirausaha">
        <div class="d-flex justify-content-between align-items-start">
          <div class="icon-box bg-primary bg-opacity-10 text-primary">
            <i class="bi bi-shop"></i>
          </div>
          <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">UMKM</span>
        </div>
        
        <h4 class="fw-bold text-dark">Kredit Wirausaha</h4>
        <p class="text-muted small">
          Modal kerja tunai untuk pengembangan usaha perdagangan dan jasa.
        </p>

        <ul class="sector-list">
          <li><i class="bi bi-check-circle-fill text-primary"></i> <strong>Perdagangan:</strong> Grosir, Eceran, Kelontong.</li>
          <li><i class="bi bi-check-circle-fill text-primary"></i> <strong>Industri:</strong> Konveksi, Perabot, Home Industry.</li>
          <li><i class="bi bi-check-circle-fill text-primary"></i> <strong>Jasa:</strong> Bengkel, Klinik, Transportasi, Laundry.</li>
          <li><i class="bi bi-check-circle-fill text-primary"></i> <strong>Kuliner:</strong> Rumah Makan & Restoran.</li>
        </ul>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="loan-card agri">
        <div class="d-flex justify-content-between align-items-start">
          <div class="icon-box bg-success bg-opacity-10 text-success">
            <i class="bi bi-tree"></i>
          </div>
          <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Agro</span>
        </div>

        <h4 class="fw-bold text-dark">Kredit Agri Bisnis</h4>
        <p class="text-muted small">
          Pembiayaan khusus sektor pertanian, peternakan, dan perikanan.
        </p>

        <ul class="sector-list">
          <li><i class="bi bi-check-circle-fill text-success"></i> <strong>Perkebunan:</strong> Kelapa Sawit, Karet, dll.</li>
          <li><i class="bi bi-check-circle-fill text-success"></i> <strong>Peternakan:</strong> Ayam Potong, Sapi, Kambing.</li>
          <li><i class="bi bi-check-circle-fill text-success"></i> <strong>Perikanan:</strong> Pembibitan & Pembesaran Ikan.</li>
          <li><i class="bi bi-check-circle-fill text-success"></i> Support untuk pupuk & pakan.</li>
        </ul>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="loan-card investasi">
        <div class="d-flex justify-content-between align-items-start">
          <div class="icon-box bg-warning bg-opacity-10 text-warning">
            <i class="bi bi-graph-up-arrow"></i>
          </div>
          <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill">Jangka Panjang</span>
        </div>

        <h4 class="fw-bold text-dark">Kredit Investasi Usaha</h4>
        <p class="text-muted small">
          Solusi pembelian aset tetap atau ekspansi fisik usaha Anda.
        </p>

        <ul class="sector-list">
          <li><i class="bi bi-check-circle-fill text-warning"></i> Pembelian Mesin & Peralatan Produksi.</li>
          <li><i class="bi bi-check-circle-fill text-warning"></i> Renovasi/Pembangunan Toko & Kios.</li>
          <li><i class="bi bi-check-circle-fill text-warning"></i> Pembelian Lahan Pertanian (Kebun/Kolam).</li>
        </ul>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="loan-card bakulan">
        <div class="d-flex justify-content-between align-items-start">
          <div class="icon-box bg-danger bg-opacity-10 text-danger">
            <i class="bi bi-basket"></i>
          </div>
          <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill">Ekonomi Mikro</span>
        </div>

        <h4 class="fw-bold text-dark">Kredit Bakulan</h4>
        <p class="text-muted small">
          Modal cepat dan ringan untuk pengusaha ekonomi lemah/mikro.
        </p>

        <ul class="sector-list">
          <li><i class="bi bi-check-circle-fill text-danger"></i> Pedagang Kaki Lima & Warung Harian.</li>
          <li><i class="bi bi-check-circle-fill text-danger"></i> Pedagang Eceran di Pasar.</li>
          <li><i class="bi bi-check-circle-fill text-danger"></i> Jasa Pangkas Rambut & Usaha Rumahan.</li>
        </ul>
      </div>
    </div>

  </div>

  {{-- CTA BOTTOM --}}
  <div class="row justify-content-center mt-5">
    <div class="col-lg-8 text-center">
      <div class="bg-light p-4 rounded-4 border">
        <h5 class="fw-bold">Butuh Bantuan Memilih?</h5>
        <p class="text-muted small mb-3">Tim kami siap membantu menghitung simulasi angsuran sesuai kemampuan Anda.</p>
        <a href="{{ url('/') }}" class="btn btn-outline-dark rounded-pill btn-sm px-4">
          <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
        </a>
      </div>
    </div>
  </div>

</div>
@endsection