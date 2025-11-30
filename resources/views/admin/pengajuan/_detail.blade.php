@php($nas = $item->nasabah)

<div class="detail-wrapper p-4">
  
  {{-- Info Nasabah --}}
  <div class="info-card mb-4">
    <div class="info-header">
      <div class="header-icon-box bg-primary bg-opacity-10 text-primary">
        <i class="bi bi-person-fill"></i>
      </div>
      <div>
        <h6 class="fw-bold mb-0 text-dark">Informasi Nasabah</h6>
        <small class="text-muted">Data pemohon pengajuan</small>
      </div>
    </div>
    <div class="info-body">
      <div class="info-row">
        <span class="info-label">Nama Lengkap</span>
        <span class="info-value">{{ $nas->nama ?? '-' }}</span>
      </div>
      <div class="info-row">
        <span class="info-label">NIK</span>
        <span class="info-value">{{ $nas->nik ?? '-' }}</span>
      </div>
      <div class="info-row">
        <span class="info-label">No. HP</span>
        <span class="info-value">{{ $nas->no_hp ?? '-' }}</span>
      </div>
    </div>
  </div>

  {{-- Alasan Kredit (khusus pengajuan kredit) --}}
  @if($type === 'kredit' && isset($item->alasan_kredit))
    <div class="info-card mb-4">
      <div class="info-header">
        <div class="header-icon-box bg-warning bg-opacity-10 text-warning">
          <i class="bi bi-chat-left-text-fill"></i>
        </div>
        <div>
          <h6 class="fw-bold mb-0 text-dark">Alasan Pengajuan Kredit</h6>
          <small class="text-muted">Tujuan penggunaan dana</small>
        </div>
      </div>
      <div class="info-body">
        <p class="mb-0 text-dark">{{ $item->alasan_kredit }}</p>
      </div>
    </div>
  @endif

  {{-- Lampiran Dokumen --}}
  @if(isset($item->foto_ktp) && $item->foto_ktp)
    <div class="info-card mb-4">
      <div class="info-header">
        <div class="header-icon-box bg-info bg-opacity-10 text-info">
          <i class="bi bi-card-image"></i>
        </div>
        <div>
          <h6 class="fw-bold mb-0 text-dark">Foto KTP</h6>
          <small class="text-muted">Kartu Tanda Penduduk</small>
        </div>
      </div>
      <div class="info-body">
        <img src="{{ asset('storage/' . $item->foto_ktp) }}" class="img-fluid rounded shadow-sm">
      </div>
    </div>
  @endif

  @if(isset($item->bukti_transfer) && $item->bukti_transfer)
    <div class="info-card mb-4">
      <div class="info-header">
        <div class="header-icon-box bg-success bg-opacity-10 text-success">
          <i class="bi bi-file-earmark-check"></i>
        </div>
        <div>
          <h6 class="fw-bold mb-0 text-dark">Bukti Transfer</h6>
          <small class="text-muted">{{ basename($item->bukti_transfer) }}</small>
        </div>
      </div>
      <div class="info-body">
        <div class="d-flex gap-2">
          <a target="_blank"
             href="{{ route('admin.pengajuan.preview', [$type, $item->id]) }}?doc=bukti_transfer"
             class="btn btn-outline-primary btn-sm rounded-pill px-3">
            <i class="bi bi-eye me-1"></i> Lihat
          </a>
          <a href="{{ route('admin.pengajuan.download', [$type, $item->id]) }}?doc=bukti_transfer"
             class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-download me-1"></i> Unduh
          </a>
        </div>
      </div>
    </div>
  @endif

  @if(isset($item->jaminan_dokumen) && $item->jaminan_dokumen)
    <div class="info-card mb-4">
      <div class="info-header">
        <div class="header-icon-box bg-danger bg-opacity-10 text-danger">
          <i class="bi bi-shield-lock"></i>
        </div>
        <div>
          <h6 class="fw-bold mb-0 text-dark">Dokumen Jaminan</h6>
          <small class="text-muted">{{ basename($item->jaminan_dokumen) }}</small>
        </div>
      </div>
      <div class="info-body">
        <div class="d-flex gap-2">
          <a target="_blank"
             href="{{ route('admin.pengajuan.preview', [$type, $item->id]) }}?doc=jaminan"
             class="btn btn-outline-primary btn-sm rounded-pill px-3">
            <i class="bi bi-eye me-1"></i> Lihat
          </a>
          <a href="{{ route('admin.pengajuan.download', [$type, $item->id]) }}?doc=jaminan"
             class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-download me-1"></i> Unduh
          </a>
        </div>
      </div>
    </div>
  @endif

  @if(isset($item->dokumen_pendukung) && $item->dokumen_pendukung)
    <div class="info-card mb-4">
      <div class="info-header">
        <div class="header-icon-box bg-secondary bg-opacity-10 text-secondary">
          <i class="bi bi-paperclip"></i>
        </div>
        <div>
          <h6 class="fw-bold mb-0 text-dark">Dokumen Pendukung</h6>
          <small class="text-muted">{{ basename($item->dokumen_pendukung) }}</small>
        </div>
      </div>
      <div class="info-body">
        <div class="d-flex gap-2">
          <a target="_blank"
             href="{{ route('admin.pengajuan.preview', [$type, $item->id]) }}?doc=pendukung"
             class="btn btn-outline-primary btn-sm rounded-pill px-3">
            <i class="bi bi-eye me-1"></i> Lihat
          </a>
          <a href="{{ route('admin.pengajuan.download', [$type, $item->id]) }}?doc=pendukung"
             class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-download me-1"></i> Unduh
          </a>
        </div>
      </div>
    </div>
  @endif

  {{-- Update Status --}}
  <div class="info-card mb-4">
    <div class="info-header">
      <div class="header-icon-box bg-primary bg-opacity-10 text-primary">
        <i class="bi bi-sliders"></i>
      </div>
      <div>
        <h6 class="fw-bold mb-0 text-dark">Update Status</h6>
        <small class="text-muted">Ubah status pengajuan</small>
      </div>
    </div>
    <div class="info-body">
      <form method="post" action="{{ route('admin.pengajuan.status', [$type, $item->id]) }}">
        @csrf
        <div class="mb-3">
          <label class="form-label small fw-bold text-muted text-uppercase">Status Pengajuan</label>
          <select name="to" class="form-select">
            @foreach(['pending', 'diterima', 'ditolak'] as $st)
              <option value="{{ $st }}" @selected($item->status === $st)>{{ ucfirst($st) }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label small fw-bold text-muted text-uppercase">Alasan (Wajib saat ditolak)</label>
          <input name="reason" class="form-control" placeholder="Tuliskan alasan jika ditolak...">
        </div>
        <button class="btn btn-primary rounded-pill px-4 w-100">
          <i class="bi bi-check-circle me-2"></i>Update Status
        </button>
      </form>
      @if($item->rejection_reason)
        <div class="alert alert-light border mt-3 mb-0">
          <small class="text-muted"><strong>Alasan terakhir:</strong> {{ $item->rejection_reason }}</small>
        </div>
      @endif
    </div>
  </div>

  {{-- Assignment --}}
  <div class="info-card mb-4">
    <div class="info-header">
      <div class="header-icon-box bg-success bg-opacity-10 text-success">
        <i class="bi bi-person-check"></i>
      </div>
      <div>
        <h6 class="fw-bold mb-0 text-dark">Penugasan</h6>
        <small class="text-muted">Tentukan petugas yang menangani</small>
      </div>
    </div>
    <div class="info-body">
      <form method="post" action="{{ route('admin.pengajuan.assign', [$type, $item->id]) }}">
        @csrf
        <div class="mb-3">
          <label class="form-label small fw-bold text-muted text-uppercase">Ditangani oleh</label>
          <select name="processed_by" class="form-select">
            @foreach(\App\Models\User::query()->orderBy('name')->get() as $u)
              <option value="{{ $u->id }}" @selected(optional($item->processor)->id === $u->id)>
                {{ $u->name }} ({{ $u->role ?? 'user' }})
              </option>
            @endforeach
          </select>
        </div>
        <button class="btn btn-outline-primary rounded-pill px-4 w-100">
          <i class="bi bi-person-plus me-2"></i>Assign Petugas
        </button>
      </form>
    </div>
  </div>

  {{-- Riwayat Status --}}
  <div class="info-card mb-4">
    <div class="info-header">
      <div class="header-icon-box bg-info bg-opacity-10 text-info">
        <i class="bi bi-clock-history"></i>
      </div>
      <div>
        <h6 class="fw-bold mb-0 text-dark">Riwayat Status</h6>
        <small class="text-muted">Timeline perubahan status</small>
      </div>
    </div>
    <div class="info-body p-0">
      @forelse($item->statusHistories->sortByDesc('created_at') as $h)
        <div class="timeline-item">
          <div class="timeline-badge">
            <i class="bi bi-arrow-right-circle-fill"></i>
          </div>
          <div class="timeline-content">
            <div class="d-flex justify-content-between align-items-start mb-1">
              <span class="fw-bold text-dark">
                {{ ucfirst($h->from) }} → <span class="text-primary">{{ ucfirst($h->to) }}</span>
              </span>
              <small class="text-muted">{{ $h->created_at->format('d M Y H:i') }}</small>
            </div>
            <small class="text-muted d-block">Oleh: {{ $h->changedBy->name ?? 'Admin' }}</small>
            @if($h->reason)
              <div class="alert alert-light border-0 mt-2 mb-0 py-2">
                <small><strong>Alasan:</strong> {{ $h->reason }}</small>
              </div>
            @endif
          </div>
        </div>
      @empty
        <div class="p-4 text-center">
          <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25 text-muted"></i>
          <p class="text-muted small mb-0">Belum ada riwayat perubahan status.</p>
        </div>
      @endforelse
    </div>
  </div>

  {{-- Catatan Internal --}}
  <div class="info-card">
    <div class="info-header">
      <div class="header-icon-box bg-warning bg-opacity-10 text-warning">
        <i class="bi bi-sticky"></i>
      </div>
      <div>
        <h6 class="fw-bold mb-0 text-dark">Catatan Internal</h6>
        <small class="text-muted">Note untuk tim internal</small>
      </div>
    </div>
    <div class="info-body">
      <form method="post" action="{{ route('admin.pengajuan.notes', [$type, $item->id]) }}">
        @csrf
        <div class="mb-3">
          <input name="body" class="form-control" placeholder="Tulis catatan singkat...">
        </div>
        <button class="btn btn-outline-warning rounded-pill px-4 w-100">
          <i class="bi bi-plus-circle me-2"></i>Tambah Catatan
        </button>
      </form>
      
      <div class="notes-list mt-3">
        @forelse($item->notes->sortByDesc('created_at') as $n)
          <div class="note-item">
            <div class="note-content">{{ $n->body }}</div>
            <div class="note-meta">
              <i class="bi bi-clock me-1"></i>{{ $n->created_at->diffForHumans() }} • 
              <i class="bi bi-person me-1"></i>{{ $n->user->name }}
            </div>
          </div>
        @empty
          <div class="text-center py-3">
            <i class="bi bi-chat-left-dots fs-3 d-block mb-2 opacity-25 text-muted"></i>
            <small class="text-muted">Belum ada catatan internal.</small>
          </div>
        @endforelse
      </div>
    </div>
  </div>

</div>

<style>
  .detail-wrapper {
    background-color: #f8fafc;
  }

  .info-card {
    background: #ffffff;
    border: none;
    border-radius: 16px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.04);
    overflow: hidden;
  }

  .info-header {
    padding: 1.25rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 12px;
    border-bottom: 1px solid #f1f5f9;
    background: #fff;
  }

  .header-icon-box {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
  }

  .info-body {
    padding: 1.5rem;
  }

  .info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f1f5f9;
  }

  .info-row:last-child {
    border-bottom: none;
  }

  .info-label {
    font-size: 0.875rem;
    color: #64748b;
    font-weight: 600;
  }

  .info-value {
    font-size: 0.875rem;
    color: #1e293b;
    font-weight: 500;
  }

  .timeline-item {
    display: flex;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #f1f5f9;
  }

  .timeline-item:last-child {
    border-bottom: none;
  }

  .timeline-badge {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #eff6ff;
    color: #2563eb;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .timeline-content {
    flex: 1;
  }

  .notes-list {
    max-height: 300px;
    overflow-y: auto;
  }

  .note-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 0.75rem;
  }

  .note-item:last-child {
    margin-bottom: 0;
  }

  .note-content {
    color: #1e293b;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
  }

  .note-meta {
    font-size: 0.75rem;
    color: #64748b;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.1);
  }

  .btn-primary {
    background: #2563eb;
    border: none;
  }

  .btn-primary:hover {
    background: #1d4ed8;
  }

  .btn-outline-primary:hover {
    background: #2563eb;
    border-color: #2563eb;
  }
</style>