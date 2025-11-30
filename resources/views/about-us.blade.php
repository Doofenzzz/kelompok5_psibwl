@extends('layouts.app')

@push('head')
<style>
  /* --- HERO KHUSUS HALAMAN INNER --- */
  .inner-hero {
    background: linear-gradient(135deg, var(--brand-navy) 0%, #1e3a8a 100%);
    color: #fff;
    padding: 4rem 0 8rem; /* Padding bawah gede buat space gambar floating */
    text-align: center;
    border-bottom-left-radius: 40px;
    border-bottom-right-radius: 40px;
    position: relative;
    overflow: hidden;
  }
  
  /* Dekorasi background hero */
  .inner-hero::after {
    content: '';
    position: absolute;
    bottom: -20px; right: -20px;
    width: 200px; height: 200px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
  }

  /* --- FLOATING IMAGE --- */
  .floating-img-wrapper {
    margin-top: -5rem;
    position: relative;
    z-index: 2;
    padding: 0 1rem;
  }
  .floating-img {
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    border: 4px solid #fff;
    max-width: 100%;
    height: auto;
    object-fit: cover;
  }

  /* --- TIMELINE SEJARAH --- */
  .timeline-wrap {
    position: relative;
    padding-left: 2rem;
    border-left: 3px solid #e2e8f0;
    margin-top: 2rem;
  }
  .timeline-item {
    position: relative;
    margin-bottom: 2.5rem;
  }
  .timeline-marker {
    position: absolute;
    left: -2.7rem;
    top: 0;
    width: 20px;
    height: 20px;
    background: var(--brand-blue);
    border: 4px solid #fff;
    border-radius: 50%;
    box-shadow: 0 0 0 1px #cbd5e1;
  }
  .timeline-year {
    font-weight: 800;
    color: var(--brand-blue);
    margin-bottom: 0.25rem;
    display: block;
  }

  /* --- INFO CARDS --- */
  .info-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 2rem;
    height: 100%;
    transition: transform 0.2s;
  }
  .info-card:hover {
    transform: translateY(-5px);
    border-color: var(--brand-blue);
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  }
  .section-badge {
    display: inline-block;
    padding: 6px 12px;
    background: rgba(37, 99, 235, 0.1);
    color: var(--brand-blue);
    font-weight: 600;
    border-radius: 6px;
    font-size: 0.85rem;
    margin-bottom: 1rem;
  }
</style>
@endpush

@section('hero')
<div class="inner-hero">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h1 class="fw-bold display-5 mb-3">Profil Perusahaan</h1>
        <p class="lead opacity-75">
          Mengenal lebih dekat perjalanan <strong>PT BPR Sarimadu (Perseroda)</strong> sebagai mitra perbankan terpercaya masyarakat Kampar.
        </p>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="floating-img-wrapper text-center">
        <img src="{{ asset('assets/WEB-KANTOR.jpeg') }}" alt="Kantor BPR Sarimadu" class="floating-img" style="max-height: 400px; width: 100%; object-fit: cover;">
      </div>
    </div>
  </div>
</div>

<div class="container pb-5">
  <div class="row g-5">
    
    <div class="col-lg-7">
      <div class="pe-lg-4">
        <span class="section-badge">Jejak Langkah</span>
        <h3 class="fw-bold text-dark mb-4">Sejarah Perusahaan</h3>
        
        <div class="timeline-wrap">
          <div class="timeline-item">
            <div class="timeline-marker"></div>
            <span class="timeline-year">1988</span>
            <h5 class="fw-bold">Awal Pembentukan</h5>
            <p class="text-muted text-justify">
              Berawal dari BKK Ujungbatu yang dipersiapkan menjadi BPR pasca Pakto '88.
              Disahkan melalui Perda Kab. Kampar Nomor 03 Tahun 1989 sebagai Perusahaan Daerah (PD).
            </p>
          </div>

          <div class="timeline-item">
            <div class="timeline-marker"></div>
            <span class="timeline-year">1992</span>
            <h5 class="fw-bold">Izin Operasional Resmi</h5>
            <p class="text-muted text-justify">
              Menteri Keuangan memberikan izin operasional pada 16 Maret 1992 (SK No. Kep.067/KM.13/92). 
              Status resmi menjadi <strong>PD. BPR Ujungbatu</strong>.
            </p>
          </div>

          <div class="timeline-item">
            <div class="timeline-marker"></div>
            <span class="timeline-year">2003</span>
            <h5 class="fw-bold">Transformasi Nama</h5>
            <p class="text-muted text-justify">
              Berdasarkan Perda No. 9 Tahun 2003, nama perusahaan berubah menjadi <strong>PD. BPR Sarimadu</strong> yang kita kenal sekarang.
            </p>
          </div>

          <div class="timeline-item">
            <div class="timeline-marker"></div>
            <span class="timeline-year">2022 - Sekarang</span>
            <h5 class="fw-bold">Menjadi Perseroda</h5>
            <p class="text-muted text-justify">
              Resmi berubah bentuk badan hukum menjadi <strong>PT BPR Sarimadu (Perseroda)</strong> berdasarkan SK OJK Riau No. KEP-15/KO.053/2022.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="d-flex flex-column gap-4">
        
        <div class="info-card">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle">
              <i class="bi bi-pie-chart-fill fs-4"></i>
            </div>
            <h5 class="fw-bold m-0">Struktur Kepemilikan</h5>
          </div>
          <p class="text-muted mb-3">
            Saham PT BPR Sarimadu (Perseroda) dimiliki sepenuhnya oleh Pemerintah Daerah.
          </p>
          <div class="bg-light p-3 rounded border text-center">
            <h2 class="fw-bold text-primary mb-0">100%</h2>
            <small class="text-dark fw-semibold">Milik Pemda Kab. Kampar</small>
          </div>
          <p class="small text-muted mt-3 fst-italic">
            *Berdasarkan Perda Nomor 09 Tahun 2003.
          </p>
        </div>

        <div class="info-card bg-primary text-white border-0" style="background: linear-gradient(135deg, var(--brand-blue) 0%, #1d4ed8 100%);">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="bg-white bg-opacity-25 text-white p-3 rounded-circle">
              <i class="bi bi-briefcase-fill fs-4"></i>
            </div>
            <h5 class="fw-bold m-0">Fokus Bisnis</h5>
          </div>
          <p class="opacity-75 mb-4">
            Sebagai BUMD, kami fokus pada pengembangan ekonomi daerah melalui produk inklusi keuangan.
          </p>
          <ul class="list-unstyled mb-0">
            <li class="mb-2 d-flex gap-2 align-items-center">
              <i class="bi bi-check-circle-fill text-warning"></i> Kredit Usaha Mikro
            </li>
            <li class="mb-2 d-flex gap-2 align-items-center">
              <i class="bi bi-check-circle-fill text-warning"></i> Simpanan Masyarakat
            </li>
            <li class="d-flex gap-2 align-items-center">
              <i class="bi bi-check-circle-fill text-warning"></i> Layanan Perbankan Digital
            </li>
          </ul>
        </div>

      </div>
    </div>

  </div>
</div>

{{-- CTA Bottom --}}
<div class="container mb-5">
    <div class="bg-light rounded-4 p-5 text-center border">
        <h4 class="fw-bold text-dark">Siap Bermitra dengan Kami?</h4>
        <p class="text-muted mb-4">Nikmati layanan perbankan yang aman dan profesional sekarang juga.</p>
        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">Buka Rekening</a>
    </div>
</div>
@endsection