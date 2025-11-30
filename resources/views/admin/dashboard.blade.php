@extends('layouts.app')

@push('head')
<style>
  :root {
    --brand-navy: #0f172a;
    --brand-blue: #2563eb;
    --brand-gold: #fbbf24;
    --brand-green: #10b981;
    --brand-red: #ef4444;
    --bg-surface: #ffffff;
    --bg-body: #f1f5f9;
  }

  body {
    background-color: var(--bg-body);
  }

  /* --- ADMIN HERO --- */
  .admin-hero {
    background: linear-gradient(135deg, var(--brand-navy) 0%, #1e3a8a 100%);
    color: #fff;
    padding: 2.5rem 2rem;
    border-radius: 20px;
    margin-bottom: 2.5rem;
    box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.4);
    position: relative;
    overflow: hidden;
  }
  
  .admin-hero::before {
    content: '';
    position: absolute;
    top: -50%; right: -10%;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
    border-radius: 50%;
  }

  /* --- DATA CARDS --- */
  .admin-card {
    background: var(--bg-surface);
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    margin-bottom: 2rem;
    overflow: hidden;
  }

  .card-header-styled {
    padding: 1.25rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 12px;
    border-bottom: 1px solid #f1f5f9;
    background: #fff;
  }

  .header-icon-box {
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
  }

  /* --- TABLE MODERN --- */
  .table-modern {
    margin-bottom: 0;
  }
  .table-modern thead th {
    background: #f8fafc;
    color: #64748b;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e2e8f0;
  }
  .table-modern tbody td {
    padding: 1.25rem 1.5rem;
    vertical-align: middle;
    color: #334155;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.9rem;
  }
  .table-modern tbody tr:last-child td {
    border-bottom: none;
  }
  .table-modern tbody tr:hover {
    background-color: #f8fafc;
  }

  /* --- BADGES & BUTTONS --- */
  .btn-icon-soft {
    width: 32px; height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: all 0.2s;
    border: none;
  }
  .btn-view { background: #eff6ff; color: var(--brand-blue); }
  .btn-view:hover { background: var(--brand-blue); color: #fff; }
  
  .btn-edit { background: #fffbeb; color: #d97706; }
  .btn-edit:hover { background: #d97706; color: #fff; }

  /* --- STATUS BADGES (x-status-badge) --- */
  .badge-status {
    font-weight: 700;
    border-radius: 999px;
    padding: .35rem .65rem;
    font-size: .775rem;
    letter-spacing: .2px;
    border: 1px solid transparent;
    display: inline-block;
  }
  .badge-pending {
    color: #7a5d00;
    background: #fff5cc;
    border-color: #ffe89a;
  }
  .badge-diterima {
    color: #0b5d2b;
    background: #dcfce7;
    border-color: #baf7cf;
  }
  .badge-ditolak {
    color: #7a1f1f;
    background: #ffe4e6;
    border-color: #ffc2c8;
  }

  /* --- MODAL --- */
  .modal-content {
    border: none;
    border-radius: 16px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.2);
  }
  .modal-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    border-radius: 16px 16px 0 0;
  }

  /* --- OFFCANVAS --- */
  .offcanvas-admin {
    border-radius: 20px 0 0 20px;
    box-shadow: -10px 0 40px rgba(0,0,0,0.1);
  }
</style>
@endpush

@section('content')
<section class="py-4">
  
  <div class="admin-hero d-flex justify-content-between align-items-center">
    <div style="z-index: 2;">
      <h2 class="fw-bold mb-1">
        <i class="bi bi-grid-fill me-2 opacity-75"></i>Admin Console
      </h2>
      <p class="mb-0 opacity-75">
        Pusat pengelolaan pengajuan nasabah PT BPR Sarimadu.
      </p>
    </div>
    <div style="z-index: 2;">
      <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-light text-primary fw-bold shadow-sm rounded-pill px-4">
        <i class="bi bi-list-check me-2"></i>Lihat Semua Data
      </a>
    </div>
  </div>

  <div class="alert alert-light border shadow-sm d-flex align-items-center gap-3 mb-4 rounded-4 px-4 py-3">
    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
      <i class="bi bi-bell-fill"></i>
    </div>
    <div class="small text-muted">
      <strong>Info Sistem:</strong> Notifikasi email dikirim otomatis ke nasabah saat status berubah. 
      Gunakan tombol <strong>Detail</strong> untuk melihat lampiran file.
    </div>
  </div>

  <div class="admin-card">
    <div class="card-header-styled">
      <div class="header-icon-box bg-primary bg-opacity-10 text-primary">
        <i class="bi bi-wallet2"></i>
      </div>
      <div>
        <h6 class="fw-bold m-0 text-dark">Pengajuan Rekening</h6>
        <small class="text-muted">Daftar permintaan pembukaan tabungan baru</small>
      </div>
    </div>
    
    <div class="table-responsive">
      <table class="table table-modern align-middle">
        <thead>
          <tr>
            <th>Nasabah</th>
            <th>Produk</th>
            <th>Unit Kerja</th>
            <th>Status</th>
            <th>Catatan</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($rekenings as $r)
            <tr>
              <td>
                <div class="fw-bold text-dark">{{ $r->nasabah->user->name ?? '-' }}</div>
                <small class="text-muted">NIK: {{ $r->nasabah->nik ?? '-' }}</small>
              </td>
              <td><span class="badge bg-light text-dark border">{{ $r->jenis_tabungan }}</span></td>
              <td>{{ $r->unit_kerja_pembukaan_tabungan ?? '-' }}</td>
              <td><x-status-badge :status="$r->status" /></td>
              <td><small class="text-muted fst-italic">{{ Str::limit($r->catatan ?? '-', 25) }}</small></td>
              <td class="text-end">
                <button class="btn btn-icon-soft btn-view me-1"
                   data-bs-toggle="offcanvas"
                   data-bs-target="#detailOffcanvas"
                   data-url="{{ route('admin.pengajuan.show',['rekening',$r->id]) }}"
                   title="Detail">
                  <i class="bi bi-eye-fill"></i>
                </button>
                <button type="button" class="btn btn-icon-soft btn-edit" 
                        data-bs-toggle="modal"
                        data-bs-target="#rekeningModal{{ $r->id }}"
                        title="Ubah Status">
                  <i class="bi bi-pencil-fill"></i>
                </button>
              </td>
            </tr>

            <div class="modal fade" id="rekeningModal{{ $r->id }}" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title fw-bold text-dark">
                      <i class="bi bi-sliders me-2"></i>Update Status
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form method="POST" action="{{ route('admin.rekening.update', $r) }}">
                    @csrf @method('PATCH')
                    <div class="modal-body p-4">
                      <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Status Pengajuan</label>
                        <select class="form-select" name="status" required>
                          <option value="pending" @selected($r->status === 'pending')>Pending</option>
                          <option value="diterima" @selected($r->status === 'diterima')>Diterima (Setujui)</option>
                          <option value="ditolak" @selected($r->status === 'ditolak')>Ditolak</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Catatan Admin</label>
                        <textarea class="form-control" name="catatan" rows="3" 
                                  placeholder="Berikan alasan jika ditolak...">{{ old('catatan', $r->catatan) }}</textarea>
                      </div>
                    </div>
                    <div class="modal-footer bg-light">
                      <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                Belum ada data pengajuan rekening.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="admin-card">
    <div class="card-header-styled">
      <div class="header-icon-box bg-warning bg-opacity-10 text-warning">
        <i class="bi bi-cash-stack"></i>
      </div>
      <div>
        <h6 class="fw-bold m-0 text-dark">Pengajuan Kredit</h6>
        <small class="text-muted">Permohonan pinjaman modal usaha</small>
      </div>
    </div>
    
    <div class="table-responsive">
      <table class="table table-modern align-middle">
        <thead>
          <tr>
            <th>Nasabah</th>
            <th>Nominal</th>
            <th>Tenor</th>
            <th>Bunga</th>
            <th>Status</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($kredits as $k)
            <tr>
              <td>
                <div class="fw-bold text-dark">{{ $k->nasabah->user->name ?? '-' }}</div>
                <small class="text-muted">Tujuan: {{ Str::limit($k->alasan_kredit, 15) }}</small>
              </td>
              <td><span class="fw-bold text-primary">Rp {{ number_format($k->jumlah_pinjaman, 0, ',', '.') }}</span></td>
              <td>{{ $k->tenor }} Bln</td>
              <td>{{ rtrim(rtrim(number_format($k->bunga, 2, ',', '.'), '0'), ',') }}%</td>
              <td><x-status-badge :status="$k->status" /></td>
              <td class="text-end">
                <button class="btn btn-icon-soft btn-view me-1"
                   data-bs-toggle="offcanvas"
                   data-bs-target="#detailOffcanvas"
                   data-url="{{ route('admin.pengajuan.show',['kredit',$k->id]) }}"
                   title="Detail">
                  <i class="bi bi-eye-fill"></i>
                </button>
                <button type="button" class="btn btn-icon-soft btn-edit" 
                        data-bs-toggle="modal"
                        data-bs-target="#kreditModal{{ $k->id }}">
                  <i class="bi bi-pencil-fill"></i>
                </button>
              </td>
            </tr>

            <div class="modal fade" id="kreditModal{{ $k->id }}" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title fw-bold">Update Kredit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form method="POST" action="{{ route('admin.kredit.update', $k) }}">
                    @csrf @method('PATCH')
                    <div class="modal-body p-4">
                      <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Status</label>
                        <select class="form-select" name="status" required>
                          <option value="pending" @selected($k->status === 'pending')>Pending</option>
                          <option value="diterima" @selected($k->status === 'diterima')>Diterima</option>
                          <option value="ditolak" @selected($k->status === 'ditolak')>Ditolak</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Catatan</label>
                        <textarea class="form-control" name="catatan" rows="3">{{ old('catatan', $k->catatan) }}</textarea>
                      </div>
                    </div>
                    <div class="modal-footer bg-light">
                      <button type="button" class="btn btn-link text-decoration-none text-muted" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i> Belum ada pengajuan kredit.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="admin-card">
    <div class="card-header-styled">
      <div class="header-icon-box bg-success bg-opacity-10 text-success">
        <i class="bi bi-piggy-bank"></i>
      </div>
      <div>
        <h6 class="fw-bold m-0 text-dark">Pengajuan Deposito</h6>
        <small class="text-muted">Investasi berjangka nasabah</small>
      </div>
    </div>
    
    <div class="table-responsive">
      <table class="table table-modern align-middle">
        <thead>
          <tr>
            <th>Nasabah</th>
            <th>Nominal</th>
            <th>Jangka Waktu</th>
            <th>Bunga</th>
            <th>Status</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($depositos as $d)
            <tr>
              <td>
                <div class="fw-bold text-dark">{{ $d->nasabah->user->name ?? '-' }}</div>
                <small class="text-muted">Tipe: {{ $d->jenis_deposito ?? 'Standar' }}</small>
              </td>
              <td><span class="fw-bold text-success">Rp {{ number_format($d->nominal, 0, ',', '.') }}</span></td>
              <td>{{ $d->jangka_waktu }} Bln</td>
              <td>{{ rtrim(rtrim(number_format($d->bunga, 2, ',', '.'), '0'), ',') }}%</td>
              <td><x-status-badge :status="$d->status" /></td>
              <td class="text-end">
                <button class="btn btn-icon-soft btn-view me-1"
                   data-bs-toggle="offcanvas"
                   data-bs-target="#detailOffcanvas"
                   data-url="{{ route('admin.pengajuan.show',['deposito',$d->id]) }}"
                   title="Detail">
                  <i class="bi bi-eye-fill"></i>
                </button>
                <button type="button" class="btn btn-icon-soft btn-edit" 
                        data-bs-toggle="modal"
                        data-bs-target="#depositoModal{{ $d->id }}">
                  <i class="bi bi-pencil-fill"></i>
                </button>
              </td>
            </tr>

            <div class="modal fade" id="depositoModal{{ $d->id }}" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title fw-bold">Update Deposito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form method="POST" action="{{ route('admin.deposito.update', $d) }}">
                    @csrf @method('PATCH')
                    <div class="modal-body p-4">
                      <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Status</label>
                        <select class="form-select" name="status" required>
                          <option value="pending" @selected($d->status === 'pending')>Pending</option>
                          <option value="diterima" @selected($d->status === 'diterima')>Diterima</option>
                          <option value="ditolak" @selected($d->status === 'ditolak')>Ditolak</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Catatan</label>
                        <textarea class="form-control" name="catatan" rows="3">{{ old('catatan', $d->catatan) }}</textarea>
                      </div>
                    </div>
                    <div class="modal-footer bg-light">
                      <button type="button" class="btn btn-link text-decoration-none text-muted" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i> Belum ada pengajuan deposito.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="offcanvas offcanvas-end offcanvas-admin" style="width: 600px; max-width: 90vw;" tabindex="-1" id="detailOffcanvas">
      <div class="offcanvas-header px-4 py-3 border-bottom">
        <h5 class="offcanvas-title fw-bold text-dark">
          <i class="bi bi-file-earmark-text-fill text-primary me-2"></i> Detail Data
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body p-0" id="detailBody">
        <div class="d-flex flex-column align-items-center justify-content-center h-100 pb-5">
          <div class="spinner-border text-primary mb-3" role="status"></div>
          <p class="text-muted small fw-semibold">Mengambil data dari server...</p>
        </div>
      </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
  // Script untuk load detail via AJAX
  const offcanvasDetail = document.getElementById('detailOffcanvas');
  
  // Reset loading state saat ditutup
  offcanvasDetail.addEventListener('hidden.bs.offcanvas', () => {
    document.getElementById('detailBody').innerHTML = `
      <div class="d-flex flex-column align-items-center justify-content-center h-100 pb-5">
        <div class="spinner-border text-primary mb-3" role="status"></div>
        <p class="text-muted small fw-semibold">Mengambil data dari server...</p>
      </div>
    `;
  });

  document.querySelectorAll('[data-bs-target="#detailOffcanvas"]').forEach(btn => {
    btn.addEventListener('click', async () => {
      const url = btn.getAttribute('data-url');
      const body = document.getElementById('detailBody');
      
      try {
        const response = await fetch(url, {
          headers: {'X-Requested-With': 'XMLHttpRequest'}
        });
        
        if(!response.ok) throw new Error('Failed to load');
        
        const html = await response.text();
        body.innerHTML = html;
      } catch (error) {
        body.innerHTML = `
          <div class="p-4 text-center">
            <div class="alert alert-danger border-0 shadow-sm">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>
              Gagal memuat data. Periksa koneksi internet Anda.
            </div>
          </div>
        `;
      }
    });
  });
</script>
@endpush
