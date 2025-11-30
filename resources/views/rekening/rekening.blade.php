@extends('layouts.app')

@push('head')
<style>
  /* Reuse Hero Style dari Halaman About biar Konsisten */
  .inner-hero {
    background: linear-gradient(135deg, var(--brand-navy) 0%, #1e3a8a 100%);
    color: #fff;
    padding: 4rem 0 6rem;
    text-align: center;
    border-bottom-left-radius: 40px;
    border-bottom-right-radius: 40px;
    margin-bottom: -3rem; /* Biar kartu produk naik ke atas (overlap) */
  }

  /* --- PRODUCT CARD STYLING --- */
  .product-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 2rem;
    height: 100%;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px -10px rgba(0,0,0,0.08);
  }

  .product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px -10px rgba(0,0,0,0.15);
    border-color: var(--brand-blue);
  }

  /* Garis warna di atas kartu buat pembeda jenis */
  .product-card.type-regular { border-top: 5px solid var(--brand-blue); }
  .product-card.type-bisnis { border-top: 5px solid var(--brand-gold); }
  .product-card.type-pelajar { border-top: 5px solid #10b981; } /* Emerald Green */

  .icon-wrapper {
    width: 64px;
    height: 64px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    margin-bottom: 1.5rem;
  }

  .price-tag {
    background: #f8fafc;
    padding: 1rem;
    border-radius: 12px;
    text-align: center;
    margin: 1.5rem 0;
    border: 1px dashed #cbd5e1;
  }

  /* Custom List Checkmark */
  .feature-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .feature-list li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 0.8rem;
    font-size: 0.9rem;
    color: var(--text-muted);
  }
  .feature-list li i {
    color: var(--brand-blue);
    margin-top: 3px;
    flex-shrink: 0;
  }

  .lps-badge {
    font-size: 0.75rem;
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    margin-top: 1.5rem;
    border-top: 1px solid #f1f5f9;
    padding-top: 1rem;
  }
</style>
@endpush

@section('hero')
<div class="inner-hero">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-25 px-3 py-2 rounded-pill mb-3">
          Simpanan & Investasi
        </span>
        <h1 class="fw-bold mb-3">Produk Tabungan</h1>
        <p class="opacity-75 mb-4">
          Pilih jenis tabungan yang sesuai dengan kebutuhan finansial Anda. 
          Aman, transparan, dan dijamin oleh LPS.
        </p>
        
        <div class="d-flex justify-content-center gap-3">
          @auth
            @can('submit-applications')
              <a href="{{ route('rekening.create') }}" class="btn btn-light text-primary fw-bold shadow-sm rounded-pill px-4 py-2">
                <i class="bi bi-plus-circle me-1"></i> Buka Rekening Baru
              </a>
            @else
              <a href="{{ route('dashboard') }}" class="btn btn-light text-primary fw-bold shadow-sm rounded-pill px-4 py-2">
                <i class="bi bi-speedometer2 me-1"></i> Ke Dashboard
              </a>
            @endcan
          @else
            <a href="{{ route('login') }}" class="btn btn-light text-primary fw-bold shadow-sm rounded-pill px-4 py-2">
              <i class="bi bi-box-arrow-in-right me-1"></i> Login untuk Memulai
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
    
    <div class="col-lg-4 col-md-6">
      <div class="product-card type-regular">
        <div class="icon-wrapper bg-primary bg-opacity-10 text-primary">
          <i class="bi bi-wallet2"></i>
        </div>
        <h4 class="fw-bold">Tabungan Sarimadu</h4>
        <p class="text-muted small">Solusi simpanan harian untuk perorangan dengan fleksibilitas tinggi.</p>
        
        <div class="price-tag">
          <small class="text-muted d-block mb-1">Setoran Awal</small>
          <span class="fw-bold text-dark fs-5">Rp 50.000,-</span>
        </div>

        <ul class="feature-list">
          <li><i class="bi bi-check-circle-fill"></i> Transaksi Online di seluruh jaringan kantor.</li>
          <li><i class="bi bi-check-circle-fill"></i> Bisa transfer dari/ke Bank Umum lain.</li>
          <li><i class="bi bi-check-circle-fill"></i> Bebas biaya admin (tidak potong saldo).</li>
        </ul>

        <div class="lps-badge">
          <i class="bi bi-shield-check"></i> Dijamin oleh Lembaga Penjamin Simpanan
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6">
      <div class="product-card type-bisnis">
        <div class="icon-wrapper bg-warning bg-opacity-10 text-warning">
          <i class="bi bi-building"></i>
        </div>
        <h4 class="fw-bold">Tabungan Vista</h4>
        <p class="text-muted small">Didedikasikan untuk Instansi Pemerintah, Perusahaan, & Yayasan.</p>
        
        <div class="price-tag">
          <small class="text-muted d-block mb-1">Keunggulan Utama</small>
          <span class="fw-bold text-dark fs-6">Bunga Kompetitif (Setara Giro)</span>
        </div>

        <ul class="feature-list">
          <li><i class="bi bi-check-circle-fill"></i> Fasilitas antar-jemput dana (Pick-up Service).</li>
          <li><i class="bi bi-check-circle-fill"></i> Support Auto-debet penggajian (Payroll).</li>
          <li><i class="bi bi-check-circle-fill"></i> Transaksi Real-time Online.</li>
        </ul>

        <div class="lps-badge">
          <i class="bi bi-shield-check"></i> Dijamin oleh Lembaga Penjamin Simpanan
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6">
      <div class="product-card type-pelajar">
        <div class="icon-wrapper bg-success bg-opacity-10 text-success">
          <i class="bi bi-backpack"></i>
        </div>
        <h4 class="fw-bold">Simpanan Pelajar</h4>
        <p class="text-muted small">Membangun budaya menabung sejak dini untuk siswa PAUD s/d SMA.</p>
        
        <div class="price-tag">
          <small class="text-muted d-block mb-1">Setoran Awal Ringan</small>
          <span class="fw-bold text-dark fs-5">Rp 5.000,-</span>
        </div>

        <ul class="feature-list">
          <li><i class="bi bi-check-circle-fill"></i> Setoran selanjutnya mulai Rp 1.000,-.</li>
          <li><i class="bi bi-check-circle-fill"></i> <strong>Gratis</strong> biaya administrasi bulanan.</li>
          <li><i class="bi bi-check-circle-fill"></i> Layanan jemput bola ke sekolah.</li>
        </ul>

        <div class="lps-badge">
          <i class="bi bi-shield-check"></i> Dijamin oleh Lembaga Penjamin Simpanan
        </div>
      </div>
    </div>

  </div>

  {{-- INFO TAMBAHAN --}}
  <div class="row mt-5 justify-content-center">
    <div class="col-lg-8 text-center">
      <p class="text-muted mb-4">
        Masih bingung produk mana yang cocok? Hubungi layanan pelanggan kami untuk konsultasi gratis.
      </p>
      <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
      </a>
    </div>
  </div>

</div>
@endsection