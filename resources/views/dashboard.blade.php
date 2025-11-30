@extends('layouts.app')

@push('head')
<style>
  /* --- VARS (Inherit dari App tapi didefinisikan ulang biar aman) --- */
  :root {
    --brand-navy: #0f172a;
    --brand-blue: #2563eb;
    --brand-gold: #fbbf24;
    --surface: #ffffff;
    --bg-light: #f8fafc;
  }

  /* --- DASHBOARD HERO --- */
  .dashboard-hero {
    background: linear-gradient(135deg, var(--brand-navy) 0%, #1e3a8a 100%);
    color: #fff;
    padding: 2.5rem 2rem;
    border-radius: 20px;
    margin-bottom: 2.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.3);
  }
  
  /* Hiasan background abstrak */
  .dashboard-hero::after {
    content: '';
    position: absolute;
    right: 0; top: 0; bottom: 0;
    width: 30%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05));
    transform: skewX(-20deg);
  }

  /* --- DATA CARDS --- */
  .data-card {
    background: var(--surface);
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
    overflow: hidden;
    margin-bottom: 2rem;
    transition: transform 0.2s;
  }
  
  .card-header-clean {
    background: #fff;
    padding: 1.5rem 1.5rem 0.5rem;
    border-bottom: 1px solid transparent;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  
  .header-icon {
    width: 36px; height: 36px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
  }

  /* --- TABLE STYLING --- */
  .table-custom th {
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
    font-weight: 700;
    background: #f8fafc;
    border-top: 1px solid #f1f5f9;
    border-bottom: 1px solid #f1f5f9;
    padding: 1rem 1.5rem;
  }
  
  .table-custom td {
    padding: 1.25rem 1.5rem;
    vertical-align: middle;
    color: #334155;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.95rem;
  }

  .table-custom tr:last-child td {
    border-bottom: none;
  }

  .table-hover tbody tr:hover {
    background-color: #fcfcfc;
  }

  /* --- STATUS BADGES (dipakai di x-status-badge) --- */
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

  /* --- EMPTY STATE --- */
  .empty-state-box {
    text-align: center;
    padding: 4rem 2rem;
  }
  .empty-icon {
    font-size: 3.5rem;
    color: #cbd5e1;
    margin-bottom: 1rem;
    display: block;
  }

  /* --- BUTTONS & ACTIONS --- */
  .btn-action-light {
    background: #f1f5f9;
    color: var(--brand-navy);
    border: none;
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.2s;
  }
  .btn-action-light:hover {
    background: #e2e8f0;
    color: var(--brand-blue);
  }

  .btn-create-new {
    background: var(--brand-blue);
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }
  .btn-create-new:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
    color: white;
  }

  /* --- OFFCANVAS --- */
  .offcanvas-modern {
    border-radius: 20px 0 0 20px;
    border: none;
  }
  .offcanvas-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
  }
</style>
@endpush

@section('content')
  
  <div class="dashboard-hero">
    <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
      <div>
        <h2 class="fw-bold mb-1">Halo, {{ auth()->user()->name }}! 👋</h2>
        <p class="mb-0 opacity-75">Selamat datang kembali di Dashboard Nasabah PT BPR Sarimadu.</p>
      </div>
      <div class="d-none d-md-block text-end">
        <small class="d-block opacity-75 text-uppercase ls-1" style="font-size: 0.7rem;">Tanggal Hari Ini</small>
        <span class="fw-bold fs-5">{{ now()->isoFormat('D MMMM Y') }}</span>
      </div>
    </div>
  </div>

  <div class="data-card">
    <div class="card-header-clean d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-3">
        <div class="header-icon bg-primary bg-opacity-10 text-primary">
          <i class="bi bi-wallet2"></i>
        </div>
        <div>
          <h5 class="fw-bold m-0 text-dark">Rekening Tabungan</h5>
          <small class="text-muted">Riwayat pengajuan pembukaan rekening</small>
        </div>
      </div>
      @if(!$rekenings->isEmpty())
        <a href="{{ route('rekening.create') }}" class="btn btn-sm btn-outline-primary rounded-pill">
          <i class="bi bi-plus-lg"></i> Tambah
        </a>
      @endif
    </div>

    @if($rekenings->isEmpty())
      <div class="empty-state-box">
        <i class="bi bi-wallet2 empty-icon"></i>
        <h6 class="fw-bold text-dark">Belum ada Tabungan</h6>
        <p class="text-muted small mb-3">Mulai menabung untuk masa depan yang lebih cerah.</p>
        <a href="{{ route('rekening.create') }}" class="btn-create-new">
          <i class="bi bi-plus-circle"></i> Buka Rekening
        </a>
      </div>
    @else
      <div class="table-responsive mt-2">
        <table class="table table-custom table-hover mb-0">
          <thead>
            <tr>
              <th>Jenis Produk</th>
              <th>Setoran Awal</th>
              <th>Status Pengajuan</th>
              <th>Tanggal</th>
              <th class="text-end">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($rekenings as $r)
              <tr>
                <td>
                  <span class="fw-semibold text-dark">{{ $r->jenis_tabungan }}</span>
                </td>
                <td class="fw-bold text-dark">
                  Rp {{ number_format($r->setoran_awal, 0, ',', '.') }}
                </td>
                <td><x-status-badge :status="$r->status" /></td>
                <td>
                  <span class="text-muted small">{{ $r->created_at->format('d M Y') }}</span>
                </td>
                <td class="text-end">
                  <button type="button" class="btn-action-light me-1" 
                          data-bs-toggle="offcanvas" 
                          data-bs-target="#detailOffcanvas" 
                          data-url="{{ route('nasabah.detail', ['rekening', $r->id]) }}">
                    Detail
                  </button>
                  @if($r->status === 'pending')
                    <a href="{{ route('rekening.edit', $r) }}" class="btn-action-light text-warning">
                      <i class="bi bi-pencil"></i>
                    </a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

  <div class="data-card">
    <div class="card-header-clean d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-3">
        <div class="header-icon bg-warning bg-opacity-10 text-warning">
          <i class="bi bi-cash-stack"></i>
        </div>
        <div>
          <h5 class="fw-bold m-0 text-dark">Fasilitas Kredit</h5>
          <small class="text-muted">Status pengajuan pinjaman modal</small>
        </div>
      </div>
      @if(!$kredits->isEmpty())
        <a href="{{ route('kredit.create') }}" class="btn btn-sm btn-outline-primary rounded-pill">
          <i class="bi bi-plus-lg"></i> Ajukan
        </a>
      @endif
    </div>

    @if($kredits->isEmpty())
      <div class="empty-state-box">
        <i class="bi bi-cash-coin empty-icon"></i>
        <h6 class="fw-bold text-dark">Belum ada Pengajuan Kredit</h6>
        <p class="text-muted small mb-3">Butuh modal usaha? Ajukan pinjaman dengan mudah.</p>
        <a href="{{ route('kredit.create') }}" class="btn-create-new">
          <i class="bi bi-pencil-square"></i> Ajukan Kredit
        </a>
      </div>
    @else
      <div class="table-responsive mt-2">
        <table class="table table-custom table-hover mb-0">
          <thead>
            <tr>
              <th>Nominal Pengajuan</th>
              <th>Tenor</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th class="text-end">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($kredits as $k)
              <tr>
                <td>
                  <span class="fw-bold text-primary">Rp {{ number_format($k->jumlah_pinjaman, 0, ',', '.') }}</span>
                </td>
                <td>{{ $k->tenor }} Bulan</td>
                <td><x-status-badge :status="$k->status" /></td>
                <td><span class="text-muted small">{{ $k->created_at->format('d M Y') }}</span></td>
                <td class="text-end">
                  <button type="button" class="btn-action-light me-1" 
                          data-bs-toggle="offcanvas" 
                          data-bs-target="#detailOffcanvas" 
                          data-url="{{ route('nasabah.detail', ['kredit', $k->id]) }}">
                    Detail
                  </button>
                  @if($k->status === 'pending')
                    <a href="{{ route('kredit.edit', $k) }}" class="btn-action-light text-warning">
                      <i class="bi bi-pencil"></i>
                    </a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

  <div class="data-card">
    <div class="card-header-clean d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-3">
        <div class="header-icon bg-success bg-opacity-10 text-success">
          <i class="bi bi-piggy-bank"></i>
        </div>
        <div>
          <h5 class="fw-bold m-0 text-dark">Deposito Berjangka</h5>
          <small class="text-muted">Investasi simpanan berjangka Anda</small>
        </div>
      </div>
      @if(!$depositos->isEmpty())
        <a href="{{ route('deposito.create') }}" class="btn btn-sm btn-outline-primary rounded-pill">
          <i class="bi bi-plus-lg"></i> Buka Baru
        </a>
      @endif
    </div>

    @if($depositos->isEmpty())
      <div class="empty-state-box">
        <i class="bi bi-safe empty-icon"></i>
        <h6 class="fw-bold text-dark">Belum ada Deposito</h6>
        <p class="text-muted small mb-3">Kembangkan aset dengan bunga kompetitif.</p>
        <a href="{{ route('deposito.create') }}" class="btn-create-new">
          <i class="bi bi-graph-up-arrow"></i> Buka Deposito
        </a>
      </div>
    @else
      <div class="table-responsive mt-2">
        <table class="table table-custom table-hover mb-0">
          <thead>
            <tr>
              <th>Nominal Penempatan</th>
              <th>Jangka Waktu</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th class="text-end">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($depositos as $d)
              <tr>
                <td>
                  <span class="fw-bold text-success">Rp {{ number_format($d->nominal, 0, ',', '.') }}</span>
                </td>
                <td>{{ $d->jangka_waktu }} Bulan</td>
                <td><x-status-badge :status="$d->status" /></td>
                <td><span class="text-muted small">{{ $d->created_at->format('d M Y') }}</span></td>
                <td class="text-end">
                  <button type="button" class="btn-action-light me-1" 
                          data-bs-toggle="offcanvas" 
                          data-bs-target="#detailOffcanvas" 
                          data-url="{{ route('nasabah.detail', ['deposito', $d->id]) }}">
                    Detail
                  </button>
                  @if($d->status === 'pending')
                    <a href="{{ route('deposito.edit', $d) }}" class="btn-action-light text-warning">
                      <i class="bi bi-pencil"></i>
                    </a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

  <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="detailOffcanvas" style="width: 500px; max-width: 90vw;">
    <div class="offcanvas-header p-4">
      <h5 class="offcanvas-title fw-bold text-dark">
        <i class="bi bi-file-earmark-text me-2 text-primary"></i> Detail Pengajuan
      </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-4" id="detailBody">
      <div class="d-flex flex-column align-items-center justify-content-center h-50">
        <div class="spinner-border text-primary mb-3" role="status"></div>
        <span class="text-muted">Sedang memuat data...</span>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
  <script>
    // AJAX Loader untuk Offcanvas (Sama seperti sebelumnya tapi styling loading diperbaiki di HTML)
    document.querySelectorAll('[data-bs-target="#detailOffcanvas"]').forEach(btn => {
      btn.addEventListener('click', async () => {
        const url = btn.getAttribute('data-url');
        const body = document.getElementById('detailBody');

        // Reset state ke loading
        body.innerHTML = `
          <div class="d-flex flex-column align-items-center justify-content-center h-50 pt-5">
            <div class="spinner-border text-primary mb-3" role="status"></div>
            <span class="text-muted">Sedang memuat data...</span>
          </div>
        `;

        try {
          const response = await fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
          });
          
          if(!response.ok) throw new Error('Network response was not ok');
          
          const html = await response.text();
          body.innerHTML = html;
        } catch (error) {
          body.innerHTML = `
            <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center gap-2">
              <i class="bi bi-exclamation-octagon fs-5"></i>
              <div>
                <strong>Gagal memuat data.</strong><br>
                <small>Silakan periksa koneksi internet Anda atau coba lagi nanti.</small>
              </div>
            </div>
          `;
        }
      });
    });
  </script>
@endpush
