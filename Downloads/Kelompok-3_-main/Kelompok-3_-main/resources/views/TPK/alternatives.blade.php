{{-- resources/views/TPK/alternatives.blade.php --}}
@extends('layouts.app')

@section('title','Data TPK')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm rounded-3 border-0">
        <div class="card-body">

            {{-- Header: title left, search + button right --}}
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h3 class="mb-0" style="font-weight:700; letter-spacing: -0.2px;">Data TPK</h3>
                    <small class="text-muted">Manage lecturer alternatives</small>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <form action="{{ route('tpk.alternatif.index') }}" method="GET" class="d-flex align-items-center">
                        <input name="q" type="search" class="form-control form-control-sm rounded-pill" placeholder="Cari nama dosen..." value="{{ request('q') }}" style="width:320px; padding:10px 14px;">
                    </form>

                    <a href="{{ route('tpk.alternatif.create') }}" class="btn btn-primary btn-sm d-flex align-items-center" style="padding:8px 14px;">
                        <i class="bi bi-plus-lg me-2"></i> Tambah Data
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:40px;"></th>
                            <th style="min-width:320px">Nama Dosen</th>
                            <th class="text-center" style="width:140px">Skor Sinta</th>
                            <th class="text-center" style="width:140px">Skor Sinta 3Yr</th>
                            <th class="text-center" style="width:120px">Jumlah Buku</th>
                            <th class="text-center" style="width:120px">Jumlah Hibah</th>
                            <th class="text-center" style="width:170px">Publikasi Scholar (1Yr)</th>
                            <th class="text-center" style="width:100px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($prestasis as $i => $p)
                            <tr class="align-middle" style="border-top:1px solid #eef2f6;">
                                <td class="text-muted">{{ ($prestasis->firstItem() ?? 0) + $i }}</td>
                                <td style="font-weight:500;">{{ $p->nama ?? $p->nama_prestasi ?? '-' }}</td>
                                <td class="text-center">{{ number_format($p->skor_sinta ?? 0) }}</td>
                                <td class="text-center">{{ number_format($p->skor_sinta_3yr ?? 0) }}</td>
                                <td class="text-center">{{ $p->jumlah_buku ?? 0 }}</td>
                                <td class="text-center">{{ $p->jumlah_hibah ?? 0 }}</td>
                                <td class="text-center">{{ $p->publikasi_scholar ?? 0 }}</td>
                                <td class="text-center action-icons">
                                    <a href="{{ route('tpk.alternatif.edit', $p->id) }}" class="text-decoration-none me-2" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('tpk.alternatif.destroy', $p->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button class="btn p-0 border-0 bg-transparent" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Belum ada data. Klik <strong>Tambah Data</strong> untuk menambahkan alternatif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- pagination area (right) --}}
            <div class="d-flex justify-content-end mt-3">
                @if(method_exists($prestasis,'links'))
                    {{ $prestasis->withQueryString()->links() }}
                @endif
            </div>

        </div>
    </div>
</div>

@push('styles')
<style>
/* ========== Layout base adjustments ========== */
.container { max-width:1180px !important; }
.card { background:#fff !important; border-radius:.6rem !important; box-shadow: 0 6px 18px rgba(30,45,90,0.04) !important; border: none !important; }

/* ========== TABLE HEADER (rapi, proporsional) ========== */
.table thead th {
    background-color: #F5F7FA !important;        /* very light gray header */
    color: #2f2f2f !important;                   /* darker text for better contrast */
    font-size: 14px !important;
    font-weight: 600 !important;
    text-transform: none !important;
    letter-spacing: 0.25px !important;

    padding-top: 14px !important;
    padding-bottom: 14px !important;
    padding-left: 14px !important;
    padding-right: 14px !important;

    border-bottom: none !important;
    vertical-align: middle !important;
    white-space: nowrap !important;
}

/* center shorter header labels to look balanced */
.table thead th.text-center { text-align: center !important; }

/* ========== TABLE BODY ========== */
.table tbody td {
    font-size: 14px !important;
    color: #444 !important;
    padding: 14px 14px !important;
    border-top: 1px solid #E7ECF2 !important;
    vertical-align: middle !important;
}

/* slightly reduce the gap between header and first row */
.table thead + tbody tr:first-child td {
    border-top: 1px solid #E7ECF2 !important;
}

/* hover */
.table tbody tr:hover td {
    background: #FAFCFF !important;
}

/* action icons */
.action-icons .bi {
    font-size: 17px !important;
    color: inherit !important;
    opacity: 0.95;
    transition: .12s ease;
}
.action-icons .bi:hover { transform: translateY(-1px); opacity: 1 !important; }

/* button & form controls */
.form-control { border-radius:.55rem !important; }
.form-control-sm { height:38px !important; padding: 6px 12px !important; }
.btn-primary { background-color:#2f6fe3 !important; border-color:#2f6fe3 !important; color:#fff !important; box-shadow:none !important; }
.btn-primary:hover { background-color:#255bd1 !important; border-color:#255bd1 !important; }

/* subtle responsive tweaks */
@media (max-width: 575px) {
    .d-flex.align-items-center.gap-3 { flex-direction: column; gap:.6rem !important; }
    .form-control { width: 100% !important; }
    .table thead th { font-size: 13px !important; padding:10px 10px !important; }
    .table tbody td { font-size: 13px !important; padding:10px 10px !important; }
}
</style>
@endpush

@endsection
