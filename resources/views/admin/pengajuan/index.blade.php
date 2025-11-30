@extends('layouts.app')

@push('head')
<style>
  :root {
    --brand-navy: #0f172a;
    --brand-blue: #2563eb;
    --brand-surface: #ffffff;
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
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.4);
    position: relative;
    overflow: hidden;
  }
  
  .admin-hero::before {
    content: '';
    position: absolute;
    bottom: -20%; right: -5%;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
    border-radius: 50%;
  }

  /* --- FILTER CARD --- */
  .filter-card {
    background: #fff;
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);
    padding: 1.5rem;
    margin-bottom: 2rem;
  }
  
  .form-label-filter {
    font-size: 0.75rem;
    text-transform: uppercase;
    font-weight: 700;
    color: #64748b;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
  }

  /* --- TABS MODERN --- */
  .nav-pills-custom .nav-link {
    background: #fff;
    color: #64748b;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border: 1px solid #e2e8f0;
    border-radius: 50px;
    margin-right: 0.5rem;
    transition: all 0.2s;
  }
  .nav-pills-custom .nav-link.active {
    background: var(--brand-blue);
    color: #fff;
    border-color: var(--brand-blue);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
  }
  .nav-pills-custom .nav-link:hover:not(.active) {
    background: #f8fafc;
    border-color: #cbd5e1;
  }

  /* --- DATA CARD & TABLE --- */
  .data-card {
    background: #fff;
    border-radius: 16px;
    border: none;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    overflow: hidden;
  }

  .table-modern thead th {
    background: #f8fafc;
    color: #475569;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.75rem;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e2e8f0;
  }
  
  .table-modern tbody td {
    padding: 1rem 1.5rem;
    vertical-align: middle;
    color: #334155;
    border-bottom: 1px solid #f1f5f9;
  }
  
  .table-modern tbody tr:last-child td {
    border-bottom: none;
  }
  
  .table-modern tbody tr:hover {
    background-color: #f8fafc;
  }

  /* --- STATUS BADGES --- */
  .badge-status {
    font-weight: 700;
    border-radius: 999px;
    padding: .35rem .65rem;
    font-size: .775rem;
    letter-spacing: .2px;
    border: 1px solid transparent;
    display: inline-block;
  }
  .badge-pending  { color: #7a5d00; background: #fff5cc; border-color: #ffe89a; }
  .badge-diterima { color: #0b5d2b; background: #dcfce7; border-color: #baf7cf; }
  .badge-ditolak  { color: #7a1f1f; background: #ffe4e6; border-color: #ffc2c8; }

  /* --- BUTTONS --- */
  .btn-detail {
    background: #eff6ff;
    color: var(--brand-blue);
    border: none;
    font-weight: 600;
    font-size: 0.85rem;
    padding: 0.4rem 1rem;
    border-radius: 8px;
    transition: all 0.2s;
  }
  .btn-detail:hover {
    background: var(--brand-blue);
    color: #fff;
  }

  /* --- OFFCANVAS --- */
  .offcanvas-admin {
    border-radius: 20px 0 0 20px;
    box-shadow: -10px 0 40px rgba(0,0,0,0.15);
  }
  
  /* Pagination Styling */
  .pagination .page-item .page-link {
    border: none;
    margin: 0 2px;
    border-radius: 8px;
    color: #64748b;
  }
  .pagination .page-item.active .page-link {
    background: var(--brand-blue);
    color: #fff;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
  }
</style>
@endpush

@section('content')
<section class="py-4">
  
  <div class="admin-hero d-flex justify-content-between align-items-center">
    <div style="z-index: 2;">
      <h2 class="fw-bold mb-1">
        <i class="bi bi-collection-fill me-2 opacity-75"></i>Kelola Pengajuan
      </h2>
      <p class="mb-0 opacity-75">
        Filter, cari, dan kelola seluruh data pengajuan nasabah secara terpusat.
      </p>
    </div>
    <div style="z-index: 2;">
      <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light rounded-pill px-4 fw-bold">
        <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
      </a>
    </div>
  </div>

  <div class="filter-card">
    <form method="GET">
      <div class="row g-3 align-items-end">
        
        <div class="col-md-4">
          <label class="form-label-filter"><i class="bi bi-search me-1"></i> Pencarian</label>
          <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari Nama, NIK, atau ID...">
        </div>
        
        <div class="col-md-2">
          <label class="form-label-filter"><i class="bi bi-funnel me-1"></i> Status</label>
          <select name="status" class="form-select">
            <option value="">Semua Status</option>
            @foreach(['pending', 'diterima', 'ditolak'] as $st)
              <option value="{{ $st }}" @selected(request('status') === $st)>{{ ucfirst($st) }}</option>
            @endforeach
          </select>
        </div>
        
        <div class="col-md-2">
          <label class="form-label-filter">Dari Tanggal</label>
          <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
        </div>
        <div class="col-md-2">
          <label class="form-label-filter">Sampai Tanggal</label>
          <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
        </div>
        
        <div class="col-md-2">
          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 fw-bold">
              Filter
            </button>
            <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-light border" title="Reset Filter">
              <i class="bi bi-arrow-counterclockwise"></i>
            </a>
          </div>
        </div>

      </div>
    </form>
  </div>

  <ul class="nav nav-pills nav-pills-custom mb-4" id="pills-tab" role="tablist">
    <li class="nav-item">
      <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab-rekening" type="button">
        <i class="bi bi-wallet2 me-2"></i>Rekening Tabungan
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-kredit" type="button">
        <i class="bi bi-cash-stack me-2"></i>Kredit
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-deposito" type="button">
        <i class="bi bi-piggy-bank me-2"></i>Deposito
      </button>
    </li>
  </ul>

  <div class="tab-content">
    @foreach(['rekening', 'kredit', 'deposito'] as $tab)
      <div class="tab-pane fade @if($loop->first) show active @endif" id="tab-{{ $tab }}">
        
        <div class="data-card">
          <div class="table-responsive">
            <table class="table table-modern align-middle mb-0">
              <thead>
                <tr>
                  <th>Info Nasabah</th>
                  <th>Produk/Jenis</th>
                  <th>Nominal / Setoran</th>
                  <th>Status Pengajuan</th>
                  <th>Tanggal Masuk</th>
                  <th>Petugas</th>
                  <th class="text-end">Opsi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($tabs[$tab] as $row)
                  @php 
                    $nominal = $row->nominal ?? $row->setoran_awal ?? $row->jumlah_pinjaman ?? null; 
                    $jenis = $row->jenis_tabungan ?? $row->jenis_kredit ?? $row->jenis_deposito ?? '-';
                  @endphp
                  <tr>
                    <td>
                      <div class="fw-bold text-dark">{{ $row->nasabah->nama ?? '-' }}</div>
                      <div class="small text-muted">{{ $row->nasabah->nik ?? '-' }}</div>
                    </td>
                    <td>
                      <span class="badge bg-light text-dark border">{{ $jenis }}</span>
                    </td>
                    <td>
                      @if($nominal)
                        <span class="fw-bold text-dark">Rp {{ number_format($nominal, 0, ',', '.') }}</span>
                      @else
                        <span class="text-muted">-</span>
                      @endif
                    </td>
                    <td><x-status-badge :status="$row->status" /></td>
                    <td>
                      <div class="small">{{ $row->created_at->format('d M Y') }}</div>
                      <div class="small text-muted" style="font-size: 0.75rem;">{{ $row->created_at->format('H:i') }} WIB</div>
                    </td>
                    <td>
                      @if($row->processor)
                        <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">
                          {{ $row->processor->name }}
                        </span>
                      @else
                        <span class="text-muted small">-</span>
                      @endif
                    </td>
                    <td class="text-end">
                      <button class="btn btn-detail"
                         data-bs-toggle="offcanvas" 
                         data-bs-target="#detailOffcanvas"
                         data-url="{{ route('admin.pengajuan.show', [$tab, $row->id]) }}">
                        <i class="bi bi-file-earmark-text me-1"></i> Detail
                      </button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center py-5">
                      <div class="text-muted opacity-50 mb-2">
                        <i class="bi bi-inbox-fill" style="font-size: 3rem;"></i>
                      </div>
                      <p class="text-muted mb-0">Tidak ada data pengajuan {{ ucfirst($tab) }} ditemukan.</p>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          @if($tabs[$tab]->hasPages())
            <div class="d-flex justify-content-center py-4 border-top">
              {{ $tabs[$tab]->withQueryString()->links() }}
            </div>
          @endif
        </div>

      </div>
    @endforeach
  </div>

  <div class="offcanvas offcanvas-end offcanvas-admin" style="width: 600px; max-width: 90vw;" tabindex="-1" id="detailOffcanvas">
    <div class="offcanvas-header px-4 py-3 border-bottom bg-light">
      <h5 class="offcanvas-title fw-bold text-dark">
        <i class="bi bi-file-earmark-person-fill text-primary me-2"></i> Detail Pengajuan
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
  const offcanvasEl = document.getElementById('detailOffcanvas');
  const detailBody = document.getElementById('detailBody');

  // Reset loading saat offcanvas ditutup
  offcanvasEl.addEventListener('hidden.bs.offcanvas', () => {
    detailBody.innerHTML = `
      <div class="d-flex flex-column align-items-center justify-content-center h-100 pb-5">
        <div class="spinner-border text-primary mb-3" role="status"></div>
        <p class="text-muted small fw-semibold">Mengambil data dari server...</p>
      </div>
    `;
  });

  // Load content saat tombol diklik
  document.querySelectorAll('[data-bs-target="#detailOffcanvas"]').forEach(btn => {
    btn.addEventListener('click', async () => {
      const url = btn.getAttribute('data-url');
      
      try {
        const response = await fetch(url, {
          headers: {'X-Requested-With': 'XMLHttpRequest'}
        });
        
        if(!response.ok) throw new Error('Network response was not ok');
        
        const html = await response.text();
        detailBody.innerHTML = html;
      } catch (error) {
        detailBody.innerHTML = `
          <div class="p-5 text-center">
            <div class="alert alert-danger border-0 shadow-sm d-inline-block text-start">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>
              <strong>Gagal memuat data.</strong><br>
              Silakan periksa koneksi internet Anda atau coba lagi nanti.
            </div>
          </div>
        `;
      }
    });
  });
</script>
@endpush
