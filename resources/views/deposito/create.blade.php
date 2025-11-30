@extends('layouts.app')

@push('head')
<style>
  /* --- HERO STYLE (Sama dengan Kredit) --- */
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

  /* --- UPLOAD AREA (Modern Box) --- */
  .file-upload-wrapper {
    position: relative;
    width: 100%;
    height: 120px;
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
    margin-top: 5px;
    display: none;
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
            Investasi
          </span>
          <h1 class="fw-bold mb-2">Pengajuan Deposito</h1>
          <p class="opacity-75">
            Simpan dana Anda dengan aman dan nikmati imbal hasil kompetitif dari BPR Sarimadu.
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

          <form method="POST" action="{{ route('deposito.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="form-card">

              {{-- LOGIC CEK NASABAH --}}
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
                {{-- FORM DATA DIRI SINGKAT (JIKA BELUM JADI NASABAH) --}}
                <div class="alert alert-warning border-0 shadow-sm mb-4">
                  <i class="bi bi-exclamation-triangle-fill me-2"></i>
                  Anda belum memiliki profil nasabah. Silakan lengkapi data berikut.
                </div>

                <div class="form-section-title mt-2">
                  <div class="form-section-icon"><i class="bi bi-person-badge"></i></div>
                  <span>Data Diri Pemohon</span>
                </div>

                <div class="row g-4 mb-5">
                  <div class="col-md-6">
                    <label class="form-label">Nama Lengkap (Sesuai KTP)</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', auth()->user()->name) }}" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">NIK (16 Digit)</label>
                    <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" maxlength="16" placeholder="16 digit" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control" rows="2" placeholder="Jalan, RT/RW, Kelurahan..." required>{{ old('alamat') }}</textarea>
                  </div>
                  
                  {{-- UPLOAD KTP (BOX STYLE) --}}
                  <div class="col-12">
                    <label class="form-label">Foto KTP <span class="text-danger">*</span></label>
                    <div class="file-upload-wrapper" id="wrapper-ktp">
                      <input type="file" name="foto_ktp" accept="image/*" required onchange="updateFileName(this, 'ktp')">
                      <div class="upload-content" id="content-ktp">
                        <i class="bi bi-person-vcard text-muted fs-3"></i>
                        <p class="small text-muted mb-0 mt-2">Upload Foto KTP</p>
                        <small class="text-muted" style="font-size: 0.7rem;">(JPG/PNG - Max 2MB)</small>
                      </div>
                      <div class="file-name-display" id="name-ktp"></div>
                    </div>
                  </div>
                </div>
              @endif

              {{-- BAGIAN: RINCIAN DEPOSITO --}}
              <div class="form-section-title mt-3">
                <div class="form-section-icon"><i class="bi bi-piggy-bank"></i></div>
                <span>Rincian Deposito</span>
              </div>

              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label">Nominal Deposito</label>
                  <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="nominal" class="form-control" value="{{ old('nominal') }}"
                      placeholder="Min: 1.000.000" min="1000000" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Jangka Waktu</label>
                  <div class="input-group">
                    <select name="jangka_waktu" class="form-select" required>
                      <option value="" selected disabled>Pilih tenor</option>
                      @foreach ([1, 3, 6, 12, 24] as $bulan)
                        <option value="{{ $bulan }}" @selected(old('jangka_waktu') == $bulan)>{{ $bulan }}</option>
                      @endforeach
                    </select>
                    <span class="input-group-text">Bulan</span>
                  </div>
                </div>

                <div class="col-12">
                  <label class="form-label">Jenis Perpanjangan</label>
                  <select name="jenis_deposito" class="form-select">
                    @php
                      $opsi = ['Deposito Berjangka', 'Deposito ARO (Otomatis Perpanjang)', 'Deposito Non-ARO'];
                    @endphp
                    @foreach ($opsi as $opt)
                      <option value="{{ $opt }}" @selected(old('jenis_deposito') === $opt)>{{ $opt }}</option>
                    @endforeach
                  </select>
                  <small class="text-muted ms-1">Pilih "ARO" jika ingin deposito diperpanjang otomatis saat jatuh tempo.</small>
                </div>

                {{-- UPLOAD BUKTI TRANSFER (BOX STYLE) --}}
                <div class="col-12 mt-4">
                  <label class="form-label">Bukti Transfer <span class="text-muted fw-normal">(Opsional)</span></label>
                  <div class="file-upload-wrapper" id="wrapper-transfer">
                    <input type="file" name="bukti_transfer" accept=".jpg,.jpeg,.png,.pdf" onchange="updateFileName(this, 'transfer')">
                    <div class="upload-content" id="content-transfer">
                      <i class="bi bi-receipt text-muted fs-3"></i>
                      <p class="small text-muted mb-0 mt-2">Upload Bukti Setoran</p>
                      <small class="text-muted" style="font-size: 0.7rem;">(JPG, PNG, PDF)</small>
                    </div>
                    <div class="file-name-display" id="name-transfer"></div>
                  </div>
                  <small class="text-muted mt-1 d-block">Lewati jika Anda akan menyetor tunai ke kantor cabang.</small>
                </div>
              </div>

              <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                <a href="{{ route('deposito') }}" class="btn btn-light text-muted fw-semibold rounded-pill px-4">
                  <i class="bi bi-arrow-left me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">
                  Ajukan Deposito <i class="bi bi-send-check ms-1"></i>
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
          <i class="bi bi-check-circle-fill text-success fs-5 d-block mb-1"></i>
          ${input.files[0].name}
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