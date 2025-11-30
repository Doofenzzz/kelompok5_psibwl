@extends('layouts.app')

@push('head')
<style>
  /* --- HERO STYLE --- */
  .form-hero {
    background: linear-gradient(135deg, var(--brand-navy) 0%, #1e3a8a 100%);
    color: #fff;
    padding: 3rem 0 5rem;
    text-align: center;
    border-bottom-left-radius: 40px;
    border-bottom-right-radius: 40px;
    margin-bottom: -3rem;
    position: relative;
    z-index: 0;
  }

  .form-card {
    background: #fff;
    border: none;
    border-radius: 20px;
    box-shadow: 0 15px 35px -5px rgba(0,0,0,0.1);
    padding: 2.5rem;
    position: relative;
    z-index: 10;
  }

  /* --- FORM ELEMENTS --- */
  .form-label {
    font-weight: 600;
    color: #334155;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
  }

  .form-control, .form-select {
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.2s;
  }
  
  .form-control:focus, .form-select:focus {
    border-color: var(--brand-blue);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
  }

  .input-group-text {
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    color: #64748b;
    font-weight: 600;
  }

  /* --- SECTION DIVIDER --- */
  .form-section-title {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 1.5rem;
    color: var(--brand-navy);
    font-weight: 700;
    font-size: 1.1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #e2e8f0;
  }
  .form-section-icon {
    width: 32px; height: 32px;
    background: rgba(37, 99, 235, 0.1);
    color: var(--brand-blue);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
  }

  /* Remove number spinners for cleaner look */
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  input[type=number] {
    -moz-appearance: textfield;
    appearance: textfield;
  }
</style>
@endpush

@section('hero')
<div class="form-hero">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-25 px-3 py-2 rounded-pill mb-3">
          Formulir Online
        </span>
        <h1 class="fw-bold mb-2">Pengajuan Rekening Tabungan</h1>
        <p class="opacity-75">
          Buka rekening Sarimadu dengan cepat dan mudah. Jika profil nasabah sudah lengkap, data identitas terisi otomatis.
        </p>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<section class="pb-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">

        @if ($errors->any())
          <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
            <div class="d-flex gap-3 align-items-center">
              <i class="bi bi-exclamation-octagon-fill fs-4"></i>
              <div>
                <h6 class="fw-bold mb-1">Ada yang perlu diperbaiki:</h6>
                <ul class="mb-0 ps-3 small">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @endif

        <form method="POST" action="{{ route('rekening.store') }}" enctype="multipart/form-data" novalidate>
          @csrf

          <div class="form-card">

            {{-- Jika user sudah punya profil nasabah, tampilkan ringkasan & hidden input --}}
            @if(auth()->user()->nasabah)
              <input type="hidden" name="nasabah_id" value="{{ auth()->user()->nasabah->id }}">
              <div class="alert alert-primary bg-primary bg-opacity-10 border-0 text-primary d-flex align-items-center gap-3 mb-4 rounded-3">
                <div class="bg-white p-2 rounded-circle shadow-sm">
                  <i class="bi bi-person-check-fill fs-5"></i>
                </div>
                <div>
                  <small class="d-block text-uppercase fw-bold opacity-75" style="font-size: 0.7rem;">Data Pemohon</small>
                  <div class="fw-bold">{{ auth()->user()->nasabah->nama }}</div>
                  <small>NIK: {{ auth()->user()->nasabah->nik }}</small>
                </div>
              </div>
            @else
              {{-- Kalau belum punya profil nasabah, minta data minimal (light mode) --}}
              <div class="alert alert-warning border-0 shadow-sm mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Kamu belum punya profil nasabah. Isi data singkat di bawah ini atau
                <a href="{{ route('nasabah.create') }}" class="fw-semibold">lengkapi profil lengkap</a>.
              </div>

              <div class="form-section-title mt-2">
                <div class="form-section-icon"><i class="bi bi-person-badge"></i></div>
                <span>Data Singkat Pemohon</span>
              </div>
              <div class="row g-3 mb-4">
                <div class="col-md-6">
                  <label class="form-label">Nama Lengkap (Sesuai KTP)</label>
                  <input type="text" name="nama" class="form-control" value="{{ old('nama', auth()->user()->name) }}" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                </div>

                <div class="col-12">
                  <label class="form-label">Alamat</label>
                  <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="col-md-6">
                  <label class="form-label">NIK</label>
                  <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" maxlength="16" placeholder="16 digit" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Foto KTP</label>
                  <input type="file" name="foto_ktp" class="form-control" accept="image/*" required>
                </div>
              </div>
            @endif

            {{-- Produk Rekening --}}
            <div class="form-section-title mt-3">
              <div class="form-section-icon"><i class="bi bi-wallet2"></i></div>
              <span>Rincian Produk</span>
            </div>
            <div class="row g-4">
              <div class="col-md-6">
                <label class="form-label">Jenis Tabungan</label>
                <select name="jenis_tabungan" class="form-select" required>
                  <option value="" selected disabled>Pilih jenis</option>
                  <option value="Tabungan Sarimadu" @selected(old('jenis_tabungan')==='Tabungan Sarimadu')>Tabungan Sarimadu</option>
                  <option value="Tabungan Vista" @selected(old('jenis_tabungan')==='Tabungan Vista')>Tabungan Vista</option>
                  <option value="Simpanan Pelajar (SimPel)" @selected(old('jenis_tabungan')==='Simpanan Pelajar (SimPel)')>Simpanan Pelajar (SimPel)</option>
                  <option value="Tabungan Qurban" @selected(old('jenis_tabungan')==='Tabungan Qurban')>Tabungan Qurban</option>
                  <option value="Tabungan Umrah" @selected(old('jenis_tabungan')==='Tabungan Umrah')>Tabungan Umrah</option>
                  <option value="Tabungan Kredit" @selected(old('jenis_tabungan')==='Tabungan Umrah')>Tabungan Kredit</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Unit Kerja Pembukaan</label>
                <select name="unit_kerja_pembukaan_tabungan" class="form-select" required>
                  <option value="" selected disabled>Unit Kerja</option>
                  <option value="Pusat Bangkinang" @selected(old('unit_kerja_pembukaan_tabungan')==='Pusat Bangkinang')>Pusat Bangkinang</option>
                  <option value="Cabang Ujungbatu" @selected(old('unit_kerja_pembukaan_tabungan')==='Cabang Ujungbatu')>Cabang Ujungbatu</option>
                  <option value="Cabang Pekanbaru" @selected(old('unit_kerja_pembukaan_tabungan')==='Cabang Pekanbaru')>Cabang Pekanbaru</option>
                  <option value="Cabang Lipatkain" @selected(old('unit_kerja_pembukaan_tabungan')==='Cabang Lipatkain')>Cabang Lipatkain</option>
                  <option value="Cabang Flamboyan" @selected(old('unit_kerja_pembukaan_tabungan')==='Cabang Flamboyan')>Cabang Flamboyan</option>
                  <option value="Kas Pasir Pengaraian" @selected(old('unit_kerja_pembukaan_tabungan')==='Kas Pasir Pengaraian')>Kas Pasir Pengaraian</option>
                  <option value="Kas Dalu-dalu" @selected(old('unit_kerja_pembukaan_tabungan')==='Kas Dalu-dalu')>Kas Dalu-dalu</option>
                  <option value="Kas Kabun" @selected(old('unit_kerja_pembukaan_tabungan')==='Kas Kabun')>Kas Kabun</option>
                  <option value="Kas Kota Lama" @selected(old('unit_kerja_pembukaan_tabungan')==='Kas Kota Lama')>Kas Kota Lama</option>
                  <option value="Kas Sukaramai" @selected(old('unit_kerja_pembukaan_tabungan')==='Kas Sukaramai')>Kas Sukaramai</option>
                  <option value="Kas Tambang" @selected(old('unit_kerja_pembukaan_tabungan')==='Kas Tambang')>Kas Tambang</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Setoran Awal (Rp)</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="number" name="setoran_awal" class="form-control" value="{{ old('setoran_awal') }}" placeholder="Contoh: 50000" required>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Kartu ATM</label>
                <select name="kartu_atm" class="form-select">
                  <option value="ya" @selected(old('kartu_atm')==='ya')>Ya, saya ingin kartu ATM</option>
                  <option value="tidak" @selected(old('kartu_atm')==='tidak')>Tidak sekarang</option>
                </select>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
              <a href="{{ route('dashboard') }}" class="btn btn-light text-muted fw-semibold rounded-pill px-4">
                <i class="bi bi-arrow-left me-1"></i> Batal
              </a>
              <button class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">
                Ajukan Rekening <i class="bi bi-send-check ms-1"></i>
              </button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</section>
@endsection
