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

  /* Existing File Badge Style */
  .existing-file-badge {
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.5rem 0.75rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.85rem;
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

  /* Remove number spinners */
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  input[type=number] {
    -moz-appearance: textfield;
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
          <h1 class="fw-bold mb-2">Edit Pengajuan Kredit</h1>
          <p class="opacity-75">
            Perbarui data pengajuan kreditmu. Pastikan data yang diunggah valid dan terbaru.
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

          @php($nas = $kredit->nasabah ?? auth()->user()->nasabah ?? null)

          <form action="{{ route('kredit.update', $kredit) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="form-card">
              
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
              @else
                <div class="alert alert-warning border-0 shadow-sm mb-4">
                  <i class="bi bi-exclamation-triangle-fill me-2"></i>
                  Profil nasabah belum lengkap. <a href="{{ route('nasabah.create') }}" class="alert-link">Lengkapi di sini</a> sebelum mengajukan kredit.
                </div>
              @endif

              <div class="form-section-title mt-2">
                <div class="form-section-icon"><i class="bi bi-cash-stack"></i></div>
                <span>Rincian Pengajuan</span>
              </div>

              @php($opsiJenis = [
                'Kredit Wirausaha',
                'Kredit Agri Bisnis',
                'Kredit Investasi Usaha',
                'Kredit Bakulan',
              ])

              <div class="row g-4 mb-4">
                <div class="col-12">
                  <label class="form-label">Jenis Kredit</label>
                  <select name="jenis_kredit" class="form-select" required>
                    <option value="" disabled>-- Pilih Produk Kredit --</option>
                    @php($jenisVal = old('jenis_kredit', $kredit->jenis_kredit))
                    @foreach($opsiJenis as $o)
                      <option value="{{ $o }}" {{ $jenisVal===$o ? 'selected' : '' }}>{{ $o }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Jumlah Pinjaman</label>
                  <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="jumlah_pinjaman" class="form-control" placeholder="0" value="{{ old('jumlah_pinjaman', $kredit->jumlah_pinjaman) }}" required min="100000">
                  </div>
                  <small class="text-muted">Minimal Rp 100.000</small>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Jangka Waktu (Tenor)</label>
                  <div class="input-group">
                    <input type="number" name="tenor" class="form-control" placeholder="Contoh: 12" value="{{ old('tenor', $kredit->tenor) }}" required>
                    <span class="input-group-text">Bulan</span>
                  </div>
                </div>

                <div class="col-12">
                  <label class="form-label">Tujuan Penggunaan Dana</label>
                  <textarea name="alasan_kredit" rows="3" class="form-control" placeholder="Jelaskan secara singkat untuk apa dana ini digunakan..." required>{{ old('alasan_kredit', $kredit->alasan_kredit) }}</textarea>
                </div>
              </div>

              <div class="form-section-title mt-5">
                <div class="form-section-icon"><i class="bi bi-file-earmark-lock"></i></div>
                <span>Agunan & Dokumen</span>
              </div>

              <div class="mb-4">
                <label class="form-label">Deskripsi Jaminan (Agunan)</label>
                <input type="text" name="jaminan_deskripsi" class="form-control" placeholder="Contoh: BPKB Motor Honda Beat 2022 a.n Sendiri" value="{{ old('jaminan_deskripsi', $kredit->jaminan_deskripsi) }}" required>
              </div>

              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label">Foto/Scan Jaminan</label>
                  
                  <div class="file-upload-wrapper" id="wrapper-jaminan">
                    <input type="file" name="jaminan_dokumen" accept=".jpg,.jpeg,.png,.pdf" onchange="updateFileName(this, 'jaminan')">
                    <div class="upload-content" id="content-jaminan">
                      <i class="bi bi-image text-muted fs-3"></i>
                      <p class="small text-muted mb-0 mt-2">Klik untuk ganti file</p>
                      <small class="text-muted" style="font-size: 0.7rem;">(JPG, PNG, PDF)</small>
                    </div>
                    <div class="file-name-display" id="name-jaminan"></div>
                  </div>

                  {{-- Info File Eksisting --}}
                  @if($kredit->jaminan_dokumen)
                    <div class="existing-file-badge">
                      <div class="text-truncate me-2" style="max-width: 150px;">
                        <i class="bi bi-check-circle-fill text-success me-1"></i>
                        <span class="text-muted small">File saat ini: {{ basename($kredit->jaminan_dokumen) }}</span>
                      </div>
                      <a href="{{ route('kredit.preview', $kredit->id) }}" target="_blank" class="text-primary small fw-bold text-decoration-none">
                        Lihat <i class="bi bi-box-arrow-up-right ms-1"></i>
                      </a>
                    </div>
                  @endif
                </div>

                <div class="col-md-6">
                  <label class="form-label">Dokumen Pendukung <span class="text-muted fw-normal">(Opsional)</span></label>
                  
                  <div class="file-upload-wrapper" id="wrapper-pendukung">
                    <input type="file" name="dokumen_pendukung" accept=".pdf,.jpg,.jpeg,.png" onchange="updateFileName(this, 'pendukung')">
                    <div class="upload-content" id="content-pendukung">
                      <i class="bi bi-file-earmark-plus text-muted fs-3"></i>
                      <p class="small text-muted mb-0 mt-2">Klik untuk ganti file</p>
                      <small class="text-muted" style="font-size: 0.7rem;">(JPG, PNG, PDF)</small>
                    </div>
                    <div class="file-name-display" id="name-pendukung"></div>
                  </div>

                  {{-- Info File Eksisting --}}
                  @if($kredit->dokumen_pendukung)
                    <div class="existing-file-badge">
                      <div class="text-truncate me-2" style="max-width: 150px;">
                        <i class="bi bi-check-circle-fill text-success me-1"></i>
                        <span class="text-muted small">File saat ini: {{ basename($kredit->dokumen_pendukung) }}</span>
                      </div>
                      <a href="{{ route('kredit.preview', $kredit->id) }}?type=pendukung" target="_blank"
                         class="text-primary small fw-bold text-decoration-none">
                        Lihat <i class="bi bi-box-arrow-up-right ms-1"></i>
                      </a>
                    </div>
                  @endif
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
          <i class="bi bi-cloud-arrow-up-fill text-primary fs-5 d-block mb-1"></i>
          <span class="text-dark fw-semibold">File Baru:</span> <br>
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