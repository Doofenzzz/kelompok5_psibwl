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

  /* --- UPLOAD AREA --- */
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
            Formulir Online
          </span>
          <h1 class="fw-bold mb-2">Pengajuan Kredit</h1>
          <p class="opacity-75">
            Isi data kebutuhan modal usaha Anda. Kami akan memproses pengajuan Anda secepat mungkin.
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
          
          <!-- Validation Errors -->
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

          <form action="{{ route('kredit.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-card">
              
              <!-- INFO NASABAH -->
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
                <div class="alert alert-warning border-0 shadow-sm mb-4">
                  <i class="bi bi-exclamation-triangle-fill me-2"></i>
                  Profil nasabah belum lengkap. <a href="{{ route('nasabah.create') }}" class="alert-link">Lengkapi di sini</a> sebelum mengajukan kredit.
                </div>
              @endif

              <!-- BAGIAN 1: RINCIAN KREDIT -->
              <div class="form-section-title mt-2">
                <div class="form-section-icon"><i class="bi bi-cash-stack"></i></div>
                <span>Rincian Pengajuan</span>
              </div>

              <div class="row g-4 mb-4">
                <div class="col-12">
                  <label class="form-label">Jenis Kredit</label>
                  <select name="jenis_kredit" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Produk Kredit --</option>
                    <option value="Kredit Wirausaha" {{ old('jenis_kredit') == 'Kredit Wirausaha' ? 'selected' : '' }}>Kredit Wirausaha (UMKM)</option>
                    <option value="Kredit Agri Bisnis" {{ old('jenis_kredit') == 'Kredit Agri Bisnis' ? 'selected' : '' }}>Kredit Agri Bisnis (Pertanian)</option>
                    <option value="Kredit Investasi Usaha" {{ old('jenis_kredit') == 'Kredit Investasi Usaha' ? 'selected' : '' }}>Kredit Investasi Usaha</option>
                    <option value="Kredit Bakulan" {{ old('jenis_kredit') == 'Kredit Bakulan' ? 'selected' : '' }}>Kredit Bakulan (Mikro)</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Jumlah Pinjaman</label>
                  <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="jumlah_pinjaman" class="form-control" placeholder="0" value="{{ old('jumlah_pinjaman') }}" required min="100000">
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Jangka Waktu (Tenor)</label>
                  <div class="input-group">
                    <input type="number" name="tenor" class="form-control" placeholder="Contoh: 12" value="{{ old('tenor') }}" required>
                    <span class="input-group-text">Bulan</span>
                  </div>
                </div>

                <div class="col-12">
                  <label class="form-label">Tujuan Penggunaan Dana</label>
                  <textarea name="alasan_kredit" rows="3" class="form-control" placeholder="Jelaskan secara singkat untuk apa dana ini digunakan..." required>{{ old('alasan_kredit') }}</textarea>
                </div>
              </div>

              <!-- BAGIAN 2: JAMINAN & DOKUMEN -->
              <div class="form-section-title mt-5">
                <div class="form-section-icon"><i class="bi bi-file-earmark-lock"></i></div>
                <span>Agunan & Dokumen</span>
              </div>

              <div class="mb-4">
                <label class="form-label">Deskripsi Jaminan (Agunan)</label>
                <input type="text" name="jaminan_deskripsi" class="form-control" placeholder="Contoh: BPKB Motor Honda Beat 2022 a.n Sendiri" value="{{ old('jaminan_deskripsi') }}" required>
              </div>

              <div class="row g-4">
                <!-- Upload Jaminan -->
                <div class="col-md-6">
                  <label class="form-label">Foto/Scan Jaminan <span class="text-danger">*</span></label>
                  <div class="file-upload-wrapper" id="wrapper-jaminan">
                    <input type="file" name="jaminan_dokumen" accept=".jpg,.jpeg,.png,.pdf" required onchange="updateFileName(this, 'jaminan')">
                    <div class="upload-content" id="content-jaminan">
                      <i class="bi bi-image text-muted fs-3"></i>
                      <p class="small text-muted mb-0 mt-2">Klik atau tarik file ke sini</p>
                      <small class="text-muted" style="font-size: 0.7rem;">(JPG, PNG, PDF - Max 2MB)</small>
                    </div>
                    <div class="file-name-display" id="name-jaminan"></div>
                  </div>
                </div>

                <!-- Upload Pendukung -->
                <div class="col-md-6">
                  <label class="form-label">Dokumen Pendukung <span class="text-muted fw-normal">(Opsional)</span></label>
                  <div class="file-upload-wrapper" id="wrapper-pendukung">
                    <input type="file" name="dokumen_pendukung" accept=".pdf,.jpg,.jpeg,.png" onchange="updateFileName(this, 'pendukung')">
                    <div class="upload-content" id="content-pendukung">
                      <i class="bi bi-file-earmark-plus text-muted fs-3"></i>
                      <p class="small text-muted mb-0 mt-2">Slip gaji / SKU / Laporan</p>
                      <small class="text-muted" style="font-size: 0.7rem;">(JPG, PNG, PDF)</small>
                    </div>
                    <div class="file-name-display" id="name-pendukung"></div>
                  </div>
                </div>
              </div>

              <!-- ACTION BUTTONS -->
              <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                <a href="{{ route('kredit') }}" class="btn btn-light text-muted fw-semibold rounded-pill px-4">
                  <i class="bi bi-arrow-left me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">
                  Kirim Pengajuan <i class="bi bi-send-check ms-1"></i>
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
    // Script sederhana buat nampilin nama file setelah upload (biar gak bingung user)
    function updateFileName(input, type) {
      const wrapper = document.getElementById('wrapper-' + type);
      const content = document.getElementById('content-' + type);
      const nameDisplay = document.getElementById('name-' + type);
      
      if (input.files && input.files[0]) {
        // Hide default icon text
        content.style.display = 'none';
        
        // Show file name with icon
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
