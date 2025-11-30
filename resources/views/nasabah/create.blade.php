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

  .form-control {
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.2s;
  }
  
  .form-control:focus {
    border-color: var(--brand-blue);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
  }

  /* --- UPLOAD AREA (MODERN) --- */
  .file-upload-wrapper {
    position: relative;
    width: 100%;
    height: 150px; /* Lebih tinggi dikit buat KTP */
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    background: #f8fafc;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    overflow: hidden;
  }
  
  .file-upload-wrapper:hover {
    border-color: var(--brand-blue);
    background: #eff6ff;
  }

  .file-upload-wrapper input[type="file"] {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
  }

  .upload-content {
    text-align: center;
    z-index: 1;
    pointer-events: none;
  }

  .file-name-display {
    font-size: 0.85rem;
    color: var(--brand-blue);
    font-weight: 600;
    margin-top: 10px;
    display: none;
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
</style>
@endpush

@section('hero')
<div class="form-hero">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-25 px-3 py-2 rounded-pill mb-3">
          Verifikasi Data
        </span>
        <h1 class="fw-bold mb-2">Lengkapi Profil Nasabah</h1>
        <p class="opacity-75">
          Data ini diperlukan untuk validasi (KYC) sebelum Anda dapat mengajukan pinjaman atau membuka rekening.
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

        <form method="POST" action="{{ route('nasabah.store') }}" enctype="multipart/form-data" novalidate>
          @csrf

          <div class="form-card">
            
            {{-- SEKSI 1: IDENTITAS UTAMA --}}
            <div class="form-section-title mt-1">
              <div class="form-section-icon"><i class="bi bi-person-vcard"></i></div>
              <span>Identitas Diri</span>
            </div>

            <div class="row g-4 mb-4">
              <div class="col-12">
                <label class="form-label">Nama Lengkap (Sesuai KTP)</label>
                <input type="text" name="nama" class="form-control"
                       value="{{ old('nama', auth()->user()->name) }}"
                       placeholder="Masukkan nama lengkap" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Nomor Induk Kependudukan (NIK)</label>
                <input type="text" name="nik" class="form-control"
                       value="{{ old('nik') }}" maxlength="16"
                       placeholder="16 digit angka" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Nomor HP / WhatsApp</label>
                <div class="input-group">
                  <span class="input-group-text bg-light text-muted">+62</span>
                  <input type="text" name="no_hp" class="form-control"
                         value="{{ old('no_hp') }}" placeholder="812xxxx" required>
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control"
                       value="{{ old('tempat_lahir') }}" placeholder="Contoh: Pekanbaru" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control"
                       value="{{ old('tanggal_lahir') }}" required>
              </div>

              <div class="col-12">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" class="form-control" rows="3"
                          placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan..." required>{{ old('alamat') }}</textarea>
              </div>
            </div>

            {{-- SEKSI 2: DOKUMEN --}}
            <div class="form-section-title mt-5">
              <div class="form-section-icon"><i class="bi bi-file-image"></i></div>
              <span>Dokumen Validasi</span>
            </div>

            <div class="mb-3">
              <label class="form-label">Foto KTP Elektronik <span class="text-danger">*</span></label>
              
              <div class="file-upload-wrapper" id="wrapper-ktp">
                <input type="file" name="foto_ktp" accept="image/*" required onchange="updateFileName(this, 'ktp')">
                <div class="upload-content" id="content-ktp">
                  <i class="bi bi-cloud-arrow-up text-primary fs-2 mb-2"></i>
                  <p class="fw-semibold text-dark mb-1">Klik atau seret foto KTP ke sini</p>
                  <small class="text-muted">Pastikan foto jelas, tidak buram, dan tulisan terbaca.</small>
                </div>
                <div class="file-name-display" id="name-ktp"></div>
              </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
              <a href="{{ route('dashboard') }}" class="btn btn-light text-muted fw-semibold rounded-pill px-4">
                <i class="bi bi-arrow-left me-1"></i> Batal
              </a>
              <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">
                Simpan & Lanjutkan <i class="bi bi-arrow-right ms-1"></i>
              </button>
            </div>

          </div>
        </form>

      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  function updateFileName(input, type) {
    const wrapper = document.getElementById('wrapper-' + type);
    const content = document.getElementById('content-' + type);
    const nameDisplay = document.getElementById('name-' + type);
    
    if (input.files && input.files[0]) {
      content.style.display = 'none';
      nameDisplay.style.display = 'block';
      nameDisplay.innerHTML = `
        <div class="d-flex flex-column align-items-center">
            <i class="bi bi-check-circle-fill text-success fs-3 mb-2"></i>
            <span class="text-success fw-bold">Foto Terpilih!</span>
            <span class="text-muted small mt-1">${input.files[0].name}</span>
        </div>
      `;
      wrapper.style.borderColor = '#2563eb';
      wrapper.style.backgroundColor = '#eff6ff';
    } else {
      content.style.display = 'block';
      nameDisplay.style.display = 'none';
      wrapper.style.borderColor = '#cbd5e1';
      wrapper.style.backgroundColor = '#f8fafc';
    }
  }
</script>
@endpush
@endsection