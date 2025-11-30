@extends('layouts.app')

@push('head')
<style>
  /* Reuse styling modern */
  :root {
    --brand-navy: #0f172a;
    --brand-blue: #2563eb;
    --bg-light: #f8fafc;
  }

  .profile-hero {
    background: linear-gradient(135deg, var(--brand-navy) 0%, #1e3a8a 100%);
    color: #fff;
    padding: 3rem 2rem 5rem;
    border-radius: 20px;
    margin-bottom: -3rem;
    position: relative;
    overflow: hidden;
  }

  .profile-hero::after {
    content: '';
    position: absolute;
    right: -50px; bottom: -50px;
    width: 250px; height: 250px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
  }

  /* Kartu Profil */
  .profile-card {
    background: #fff;
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 30px -5px rgba(0,0,0,0.08);
    overflow: hidden;
    height: 100%;
    position: relative;
    z-index: 10;
  }

  .card-section-title {
    background: #f8fafc;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #e2e8f0;
    font-weight: 700;
    color: var(--brand-navy);
    display: flex;
    align-items: center;
    gap: 10px;
  }
  
  .section-icon {
    width: 32px; height: 32px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    background: rgba(37, 99, 235, 0.1);
    color: var(--brand-blue);
    font-size: 1rem;
  }

  .form-control {
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
  }
  .form-control:focus {
    border-color: var(--brand-blue);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
  }
  
  .form-label {
    font-weight: 600;
    color: #334155;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
  }

  /* KTP Upload Area */
  .upload-area {
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    background: #f8fafc;
    transition: all 0.2s;
    cursor: pointer;
  }
  .upload-area:hover {
    border-color: var(--brand-blue);
    background: #fff;
  }
  
  /* Danger Zone */
  .danger-zone {
    background: #fff5f5;
    border: 1px solid #fecaca;
    padding: 1.5rem;
    border-radius: 12px;
    margin-top: 2rem;
  }
</style>
@endpush

@section('content')
  <div class="profile-hero">
    <div class="d-flex align-items-center gap-3 position-relative" style="z-index: 2;">
      <div class="bg-white bg-opacity-25 p-1 rounded-circle">
        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold fs-3" 
             style="width: 64px; height: 64px;">
          {{ substr(auth()->user()->name, 0, 1) }}
        </div>
      </div>
      <div>
        <h2 class="fw-bold mb-0">Pengaturan Profil</h2>
        <p class="mb-0 opacity-75 small">Kelola informasi akun dan data nasabah Anda.</p>
      </div>
    </div>
  </div>

  <div class="row g-4 pb-5">
    
    <div class="col-lg-5">
      <div class="profile-card">
        <div class="card-section-title">
          <div class="section-icon"><i class="bi bi-shield-lock"></i></div>
          <span>Informasi Akun</span>
        </div>
        
        <div class="p-4">
          <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            
            <div class="mb-3">
              <label class="form-label">Nama Akun</label>
              <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            
            <div class="mb-4">
              <label class="form-label">Email Login</label>
              <input type="email" name="email" class="form-control bg-light" value="{{ old('email', $user->email) }}" required readonly>
              <small class="text-muted fst-italic">*Email tidak dapat diubah untuk keamanan.</small>
            </div>

            <button class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow-sm">
              <i class="bi bi-check-lg me-1"></i> Simpan Perubahan Akun
            </button>
          </form>

          <div class="danger-zone">
            <h6 class="text-danger fw-bold"><i class="bi bi-exclamation-triangle me-1"></i> Hapus Akun</h6>
            <p class="small text-muted mb-3">
              Tindakan ini permanen. Semua data riwayat pengajuan akan hilang.
            </p>
            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Yakin ingin menghapus akun permanen?');">
              @csrf
              @method('DELETE')
              <button class="btn btn-outline-danger btn-sm w-100 rounded-pill">
                Hapus Akun Saya
              </button>
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="col-lg-7">
      <div class="profile-card">
        <div class="card-section-title">
          <div class="section-icon"><i class="bi bi-person-vcard"></i></div>
          <span>Data Diri Nasabah (KYC)</span>
        </div>

        <div class="p-4">
          @php
            $nasabah = $nasabah ?? optional($user)->nasabah;
            $isNasabah = (bool) $nasabah;
          @endphp

            @if(!$isNasabah)
              {{-- Bukan nasabah (admin/teller) → ga wajib isi KYC --}}
              <div class="alert alert-info mb-3">
                Akun ini <strong>bukan profil nasabah</strong>, jadi data KYC tidak diperlukan.
                Kalau mau buat profil nasabah baru untuk akun ini, isi form di bawah (opsional).
              </div>
            @endif

          <form method="POST" 
                action="{{ $isNasabah ? route('nasabah.update', $nasabah->id) : route('nasabah.store') }}" 
                enctype="multipart/form-data">
            @csrf
            @if($isNasabah) @method('PUT') @endif
            @unless($isNasabah) <input type="hidden" name="user_id" value="{{ $user->id }}"> @endunless

            <div class="row g-3">
              <div class="col-12">
                <label class="form-label">Nama Lengkap (Sesuai KTP)</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $nasabah->nama ?? $user->name) }}" {{ $isNasabah ? 'required' : '' }}>
              </div>

              <div class="col-md-6">
                <label class="form-label">NIK (16 Digit)</label>
                <input type="text" name="nik" maxlength="16" pattern="\d{16}" class="form-control" value="{{ old('nik', $nasabah->nik ?? '') }}" {{ $isNasabah ? 'required' : '' }}>
              </div>
              
              <div class="col-md-6">
                <label class="form-label">Nomor HP</label>
                <input type="tel" name="no_hp" class="form-control" value="{{ old('no_hp', $nasabah->no_hp ?? '') }}" {{ $isNasabah ? 'required' : '' }}>
              </div>

              <div class="col-md-6">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $nasabah->tempat_lahir ?? '') }}" {{ $isNasabah ? 'required' : '' }}>
              </div>

              <div class="col-md-6">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', optional(optional($nasabah)->tanggal_lahir)->format('Y-m-d')) }}" {{ $isNasabah ? 'required' : '' }}>
              </div>

              <div class="col-12">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" rows="2" class="form-control" {{ $isNasabah ? 'required' : '' }}>{{ old('alamat', $nasabah->alamat ?? '') }}</textarea>
              </div>

              <div class="col-12 mt-4">
                <label class="form-label">Dokumen KTP</label>
                
                <div class="upload-area position-relative">
                  <input type="file" name="foto_ktp" accept=".jpg,.jpeg,.png" 
                         class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer" 
                         onchange="previewKTP(this)">
                  
                  <div class="text-center" id="uploadPlaceholder">
                    <i class="bi bi-cloud-arrow-up text-primary fs-3 mb-2"></i>
                    <p class="mb-1 fw-semibold text-dark">Klik untuk upload KTP baru</p>
                    <small class="text-muted">Format JPG/PNG, Max 2MB</small>
                  </div>
                </div>

                <div class="mt-3 row g-3">
                  @if(!empty($nasabah?->foto_ktp))
                    <div class="col-md-6">
                      <div class="card p-2 border-0 bg-light">
                        <small class="text-muted mb-2 d-block text-center">KTP Terdaftar</small>
                        <img src="{{ route('nasabah.preview', $nasabah->id) }}?v={{ $nasabah->updated_at?->timestamp }}" 
                             class="img-fluid rounded border w-100" style="height: 150px; object-fit: cover;">
                        <a href="{{ route('nasabah.bukti', $nasabah->id) }}" class="btn btn-sm btn-outline-primary w-100 mt-2">
                          <i class="bi bi-download"></i> Unduh
                        </a>
                      </div>
                    </div>
                  @endif

                  <div class="col-md-6" id="newPreviewBox" style="display: none;">
                    <div class="card p-2 border-primary border-opacity-25 bg-primary bg-opacity-10">
                      <small class="text-primary mb-2 d-block text-center fw-bold">Akan Diupload</small>
                      <img id="ktpPreviewImg" src="" class="img-fluid rounded border w-100" style="height: 150px; object-fit: cover;">
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="mt-4 pt-3 border-top">
              <button class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow-sm">
                <i class="bi bi-save me-1"></i> {{ $isNasabah ? 'Perbarui Data Nasabah' : 'Simpan Data Nasabah' }}
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>

  @push('scripts')
  <script>
    function previewKTP(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          document.getElementById('ktpPreviewImg').src = e.target.result;
          document.getElementById('newPreviewBox').style.display = 'block';
          
          // Ganti placeholder text biar user tau udah kepilih
          document.getElementById('uploadPlaceholder').innerHTML = `
            <i class="bi bi-check-circle-fill text-success fs-3 mb-2"></i>
            <p class="mb-1 fw-bold text-success">File Terpilih</p>
            <small class="text-muted">${input.files[0].name}</small>
          `;
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  @endpush

@endsection