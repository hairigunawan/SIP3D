@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<style>
  /* Background & wrapper */
  .app-body, body {
    background: linear-gradient(180deg, #eaf7ff 0%, #f2f9ff 100%);
  }
  .page-wrap {
    max-width: 1300px;        /* diperbesar */
    margin: 36px auto;
    padding: 20px 20px 80px;  /* lebih lega */
  }

  /* Card */
  .card-box {
    background: #fff;
    border-radius: 18px;   /* lebih melengkung */
    box-shadow: 0 25px 55px rgba(18, 38, 63, 0.08); /* lebih premium */
    overflow: hidden;
    border: 1px solid #e6eefc;
  }

  /* Header */
  .card-head {
    background: linear-gradient(90deg,#1766d6,#3b82f6);
    color: #fff;
    padding: 22px 28px;    /* DIBESARKAN */
    display: flex;
    gap: 16px;
    align-items: center;
    justify-content: space-between;
  }
  .card-head .left {
    display:flex;
    gap:16px;
    align-items:center;
  }
  .card-head h4 {
    margin: 0;
    font-weight: 700;
    font-size: 1.35rem;
  }
  .card-head small { opacity: .95; display:block; margin-top:2px; font-weight:500; font-size:.95rem; }

  /* Controls (search + buttons) */
  .controls {
    display:flex;
    gap:14px;
    align-items:center;
    flex-wrap:wrap;
  }
  .search-input {
    width: 460px;            /* diperbesar */
    max-width: 55vw;
    padding: 12px 18px;      /* diperbesar */
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,0.25);
    background: rgba(255,255,255,0.14);
    color: #fff;
    font-size: 1rem;
  }
  .search-input::placeholder { color: rgba(255,255,255,0.9); }

  .btn-excel, .btn-add {
    border: none;
    padding: 12px 20px;     /* diperbesar */
    border-radius: 12px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:10px;
    box-shadow: 0 10px 25px rgba(16,24,40,0.10);
    font-size: 1rem;
  }
  .btn-excel { background: #10b981; color:#fff; }
  .btn-add   { background: #7c3aed; color:#fff; }

  /* Table area */
  .card-body {
    padding: 20px 22px;
  }
  .table-wrap {
    border-radius: 12px;
    border: 1px solid #e9f0fb;
    overflow: auto;
    background: #fff;
  }

  /* Table styles */
  table.custom-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    table-layout: fixed; /* consistent columns */
    font-size: 1rem;
  }

  table.custom-table thead th {
    background:#f7fbff;
    color: #0f172a;
    font-weight:700;
    padding: 14px 16px;
    border-right: 1px solid #eef4fb;
    vertical-align: middle;
    text-align: left;
  }
  table.custom-table thead th:last-child { border-right: none; text-align:center; }

  table.custom-table tbody td {
    padding: 14px 16px;
    border-top: 1px solid #f1f6fb;
    border-right: 1px solid #f1f6fb;
    vertical-align: middle;
    font-size: 1rem;
    color: #0b1220;
    background: #fff;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    height: 64px; /* lebih tinggi */
  }
  table.custom-table tbody td:last-child { border-right: none; text-align:center; }

  /* Email wrap */
  .td-email { white-space: normal; word-wrap: break-word; max-width:320px; }

  /* Narrow columns */
  .col-no { width:64px; text-align:center; }
  .col-action { width:120px; text-align:center; }
  .col-status { width:140px; text-align:center; }

  /* Status badge */
  .badge-active {
    display:inline-block;
    background:#10b981;
    color:#fff;
    padding:8px 14px;
    border-radius:10px;
    font-weight:700;
    font-size:.95rem;
  }

  /* Action icons */
  .action-btn {
    border: none;
    background: transparent;
    color: #475569;
    font-size: 1.18rem;
    padding: 8px;
    margin-left:10px;
    transition: transform .12s ease, color .12s ease;
  }
  .action-btn:hover { color:#0f172a; transform: scale(1.12); }

  /* Footer / pagination area */
  .card-foot {
    padding: 18px 22px;
    background: transparent;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:10px;
  }

  /* Empty row message more visible */
  .empty-row {
    padding: 30px 18px;
    color: #64748b;
    text-align: center;
  }

  /* Responsive tweaks */
  @media (max-width: 1100px) {
    .search-input { width: 360px; }
  }
  @media (max-width: 900px) {
    .search-input { width: 260px; }
    table.custom-table thead th, table.custom-table tbody td { font-size:.92rem; padding:10px 12px; height:auto; white-space:normal; }
    .td-email { max-width: none; }
  }
  @media (max-width: 580px) {
    .card-head { flex-direction: column; align-items:flex-start; gap:12px; padding:16px; }
    .controls { width:100%; justify-content:space-between; }
    .btn-excel, .btn-add { padding:10px 12px; font-size:.95rem; }
  }
</style>

<div class="page-wrap">
  <div class="card-box">

    {{-- header --}}
    <div class="card-head">
      <div class="left">
        <div style="font-size:1.35rem; margin-right:8px;">📚</div>
        <div>
          <h4>Lecturer Data</h4>
          <small>Manage lecturer data — SIP3D</small>
        </div>
      </div>

      <div class="controls">
        {{-- Search (GET) --}}
        <form action="{{ route('dosen.index') }}" method="GET" class="d-flex align-items-center">
          <input type="text" name="search" class="search-input" placeholder="Search for NIDN, name, or email..." value="{{ request('search') }}">
        </form>

        {{-- Buttons --}}
        <a href="{{ route('dosen.export') }}" class="btn-excel" title="Download Excel">
          <i class="bi bi-file-earmark-spreadsheet"></i> Excel
        </a>
        <a href="{{ route('dosen.create') }}" class="btn-add" title="Add Lecturer">
          <i class="bi bi-plus-lg"></i> Add Lecturer
        </a>
      </div>
    </div>

    {{-- body: table --}}
    <div class="card-body">
      <div class="table-wrap">
        <table class="custom-table">
          <thead>
            <tr>
              <th class="col-no">No</th>
              <th>NIDN</th>
              <th>Name</th>
              <th>E-mail</th>
              <th>Faculty</th>
              <th>Study Program</th>
              <th class="col-status">Status</th>
              <th class="col-action">Action</th>
            </tr>
          </thead>

          <tbody>
            @php
              $start = isset($dosen) && method_exists($dosen, 'firstItem') && $dosen->firstItem() ? $dosen->firstItem() : 1;
            @endphp

            @forelse($dosen as $i => $dsn)
              <tr>
                <td class="col-no">{{ isset($start) ? $start + $i : $loop->iteration }}</td>
                <td>{{ $dsn->nidn ?? '-' }}</td>
                <td style="font-weight:600">{{ $dsn->nama ?? $dsn->name ?? '-' }}</td>
                <td class="td-email text-muted">{{ $dsn->email ?? '-' }}</td>
                <td>{{ $dsn->fakultas ?? '-' }}</td>
                <td>{{ $dsn->prodi ?? $dsn->study_program ?? '-' }}</td>
                <td class="col-status">
                  @if(isset($dsn->status) && in_array(strtolower($dsn->status), ['aktif','active']))
                    <span class="badge-active">Active</span>
                  @else
                    <span class="badge bg-secondary" style="border-radius:8px;padding:.45rem .6rem">Inactive</span>
                  @endif
                </td>
                <td class="col-action">
                  <a href="{{ route('dosen.edit', $dsn->id) }}" title="Edit" class="action-btn">
                    <i class="bi bi-pencil"></i>
                  </a>

                  <form action="{{ route('dosen.destroy', $dsn->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn" title="Delete">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="empty-row">
                  Tidak ada data dosen. Tekan <strong>Add Lecturer</strong> untuk menambahkan.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    {{-- footer --}}
    <div class="card-foot">
      <div class="text-muted small">
        Showing {{ isset($dosen) && method_exists($dosen,'count') ? $dosen->count() : (count($dosen) ?? 0) }} entries
      </div>
      <div>
        @if(isset($dosen) && method_exists($dosen, 'links'))
          {{ $dosen->withQueryString()->links() }}
        @endif
      </div>
    </div>

  </div>
</div>

@endsection
