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
        <h1 class="fw-bold mb-2">Edit Pengajuan Rekening</h1>
        <p class="opacity-75">
          Perbarui data pengajuan tabunganmu. Jika profil nasabah sudah lengkap, data identitas terisi otomatis.
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

        @php($nas = $rekening->nasabah ?? auth()->user()->nasabah ?? null)

        <form method="POST" action="{{ route('rekening.update', $rekening) }}" enctype="multipart/form-data" novalidate>
          @csrf
          @method('PATCH')

          <div class="form-card">
            {{-- Ringkasan Nasabah --}}
            @if($nas)
              <input type="hidden" name="nasabah_id" value="{{ $nas->id }}">
              <div class="alert alert-primary bg-primary bg-opacity-10 border-0 text-primary d-flex align-items-center gap-3 mb-4 rounded-3">
                <div class="bg-white p-2 rounded-circle shadow-sm">
                  <i class="bi bi-person-check-fill fs-5"></i>
                </div>
                <div>
                  <small class="d-block text-uppercase fw-bold opacity-75" style="font-size: 0.7rem;">Data Pemohon</small>
                  <div class="fw-bold">{{ $nas->nama }}</div>
                  @if(!empty($nas->nik))<small>NIK: {{ $nas->nik }}</small>@endif
                </div>
              </div>
            @endif

            {{-- Produk Rekening --}}
            <div class="form-section-title mt-2">
              <div class="form-section-icon"><i class="bi bi-wallet2"></i></div>
              <span>Rincian Produk</span>
            </div>
            <div class="row g-4">
              <div class="col-md-6">
                <label class="form-label">Jenis Tabungan</label>
                <select name="jenis_tabungan" class="form-select" required>
                  <option value="" disabled> Pilih jenis</option>
                  <option value="Tabungan Sarimadu" @selected(old('jenis_tabungan', $rekening->jenis_tabungan)==='Tabungan Sarimadu')>Tabungan Sarimadu</option>
                  <option value="Tabungan Vista" @selected(old('jenis_tabungan', $rekening->jenis_tabungan)==='Tabungan Vista')>Tabungan Vista</option>
                  <option value="Simpanan Pelajar (SimPel)" @selected(old('jenis_tabungan', $rekening->jenis_tabungan)==='Simpanan Pelajar (SimPel)')>Simpanan Pelajar (SimPel)</option>
                  <option value="Tabungan Qurban" @selected(old('jenis_tabungan', $rekening->jenis_tabungan)==='Tabungan Qurban')>Tabungan Qurban</option>
                  <option value="Tabungan Umrah" @selected(old('jenis_tabungan', $rekening->jenis_tabungan)==='Tabungan Umrah')>Tabungan Umrah</option>
                  <option value="Tabungan Kredit" @selected(old('jenis_tabungan', $rekening->jenis_tabungan)==='Tabungan Kredit')>Tabungan Kredit</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Unit Kerja Pembukaan</label>
                <select name="unit_kerja_pembukaan_tabungan" class="form-select" required>
                  <option value="" disabled>Unit Kerja</option>
                  @php($unit = old('unit_kerja_pembukaan_tabungan', $rekening->unit_kerja_pembukaan_tabungan))
                  @foreach ([
                    'Pusat Bangkinang','Cabang Ujungbatu','Cabang Pekanbaru','Cabang Lipatkain','Cabang Flamboyan',
                    'Kas Pasir Pengaraian','Kas Dalu-dalu','Kas Kabun','Kas Kota Lama','Kas Sukaramai','Kas Tambang'
                  ] as $u)
                    <option value="{{ $u }}" {{ $unit===$u ? 'selected' : '' }}>{{ $u }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Setoran Awal (Rp)</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input
                    type="number"
                    name="setoran_awal"
                    class="form-control"
                    value="{{ old('setoran_awal', $rekening->setoran_awal) }}"
                    min="50000"
                    placeholder="Minimal 50000"
                    required>
                </div>
                <small class="text-muted">Minimal setoran awal Rp 50.000</small>
              </div>

              <div class="col-md-6">
                <label class="form-label">Kartu ATM</label>
                <select name="kartu_atm" class="form-select">
                  @php($atm = old('kartu_atm', $rekening->kartu_atm))
                  <option value="ya" {{ $atm==='ya' ? 'selected' : '' }}>Ya, saya ingin kartu ATM</option>
                  <option value="tidak" {{ $atm==='tidak' ? 'selected' : '' }}>Tidak sekarang</option>
                </select>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
              <a href="{{ route('dashboard') }}" class="btn btn-light text-muted fw-semibold rounded-pill px-4">
                <i class="bi bi-arrow-left me-1"></i> Batal
              </a>
              <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">
                Simpan Perubahan <i class="bi bi-check-circle ms-1"></i>
              </button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</section>
@endsection
