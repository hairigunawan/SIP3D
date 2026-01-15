{{-- resources/views/TPK/index.blade.php --}}
@extends('layouts.app')

@section('title', 'TPK - Count (SAW)')

@section('content')
<div class="container py-4">

    {{-- Breadcrumb/header --}}
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h5 class="mb-0">TPK - Count (SAW)</h5>
            <small class="text-muted">Manage Alternatives · Manage CSV · Export · Criteria</small>
        </div>
        <div class="btn-group">
            <a href="{{ route('tpk.alternatif.index') }}" class="btn btn-outline-secondary btn-sm">Manage Alternatives</a>
            <a href="{{ route('tpk.kriteria.index') }}" class="btn btn-outline-secondary btn-sm">Manage Criteria</a>
            <a href="{{ route('tpk.export') }}" class="btn btn-primary btn-sm">Export CSV</a>
        </div>
    </div>

    {{-- 1) Data TPK (table) --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Data TPK</h6>
                <form class="d-flex" method="GET" action="{{ route('tpk.index') }}">
                    <input name="q" class="form-control form-control-sm me-2" placeholder="Cari nama dosen..." value="{{ request('q') }}">
                    <a href="{{ route('tpk.alternatif.create') }}" class="btn btn-primary btn-sm">+ Tambah Data</a>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px">No.</th>
                            <th>Nama Dosen</th>
                            <th class="text-center" style="width:120px">Skor Sinta</th>
                            <th class="text-center" style="width:130px">Skor Sinta 3Yr</th>
                            <th class="text-center" style="width:110px">Jumlah Buku</th>
                            <th class="text-center" style="width:110px">Jumlah Hibah</th>
                            <th class="text-center" style="width:170px">Publikasi Scholar (1Yr)</th>
                            <th class="text-center" style="width:120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prestasisTable as $i => $p)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $p->nama ?? $p->nama_prestasi ?? '-' }}</td>
                            <td class="text-center">{{ number_format($p->skor_sinta ?? 0) }}</td>
                            <td class="text-center">{{ number_format($p->skor_sinta_3yr ?? 0) }}</td>
                            <td class="text-center">{{ $p->jumlah_buku ?? 0 }}</td>
                            <td class="text-center">{{ $p->jumlah_hibah ?? 0 }}</td>
                            <td class="text-center">{{ $p->publikasi_scholar ?? 0 }}</td>
                            <td class="text-center">
                                <a href="{{ route('tpk.alternatif.edit', $p->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('tpk.alternatif.destroy', $p->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">Belum ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 2) Bobot Kriteria (BARU: tampilannya sama persis) --}}
    @php
        // Pastikan $weights tersedia; jika tidak, fallback ke array kosong
        $weightsArr = $weights ?? [];
        // jika keys C1..C4 tidak ada, buat default 0
        $wC1 = $weightsArr['C1'] ?? ($weightsArr['c1'] ?? ($weightsArr[0] ?? 0));
        $wC2 = $weightsArr['C2'] ?? ($weightsArr['c2'] ?? ($weightsArr[1] ?? 0));
        $wC3 = $weightsArr['C3'] ?? ($weightsArr['c3'] ?? ($weightsArr[2] ?? 0));
        $wC4 = $weightsArr['C4'] ?? ($weightsArr['c4'] ?? ($weightsArr[3] ?? 0));
        $total_bobot = $weightsArr ? array_sum(array_values($weightsArr)) : ($total_bobot ?? ($wC1+$wC2+$wC3+$wC4));
    @endphp

    <div class="card mb-4">
        <div class="card-header bg-white border-0 px-4 pt-4 pb-2 d-flex justify-content-between align-items-center">
            <h6 class="mb-0" style="font-weight:700;">Bobot Kriteria</h6>

            <div class="d-flex gap-2">
                <a href="{{ route('tpk.kriteria.hitung') ?? '#' }}" class="btn btn-outline-primary btn-sm d-flex align-items-center px-3">
                    <i class="bi bi-calculator me-2"></i> Hitung Bobot Otomatis
                </a>

                <a href="{{ route('tpk.kriteria.index') }}" class="btn btn-primary btn-sm d-flex align-items-center px-3">
                    <i class="bi bi-pencil-square me-2"></i> Edit Bobot
                </a>
            </div>
        </div>

        <div class="card-body px-4 pb-4">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">C1</th>
                            <th class="text-center">C2</th>
                            <th class="text-center">C3</th>
                            <th class="text-center">C4</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr style="border-top: 1px solid #eef2f6;">
                            <td class="text-center fw-semibold">{{ number_format($wC1, 2) }}</td>
                            <td class="text-center fw-semibold">{{ number_format($wC2, 2) }}</td>
                            <td class="text-center fw-semibold">{{ number_format($wC3, 2) }}</td>
                            <td class="text-center fw-semibold">{{ number_format($wC4, 2) }}</td>
                            <td class="text-center fw-bold text-primary">{{ number_format($total_bobot, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 3) Normalization --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header"><strong>Normalization</strong></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Alternative</th>
                            @foreach($criteria_labels as $label)
                                <th class="text-center">{{ $label }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($normalized as $row)
                        <tr>
                            <td>{{ $row['label'] }}</td>
                            @foreach($criteria as $col)
                                <td class="text-center">{{ number_format($row[$col] ?? 0, 3) }}</td>
                            @endforeach
                        </tr>
                        @empty
                        <tr><td colspan="{{ count($criteria)+1 }}" class="text-center p-4">Tidak ada data untuk normalisasi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 4) Weighted matrix --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header"><strong>Weighted Matrix (r<sub>ij</sub> × w<sub>j</sub>)</strong></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            @foreach($criteria_labels as $label)
                                <th class="text-center">{{ $label }}</th>
                            @endforeach
                            <th class="text-center">Score (V)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($weighted as $row)
                        <tr>
                            <td>{{ $row['label'] }}</td>
                            @foreach($criteria as $col)
                                <td class="text-center">{{ number_format($row[$col] ?? 0, 3) }}</td>
                            @endforeach
                            <td class="text-center fw-bold">{{ number_format($row['score'], 3) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="{{ count($criteria)+2 }}" class="text-center p-4">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 5) Final Results & Ranking --}}
    <div class="card mb-5 shadow-sm">
        <div class="card-header"><strong>Final Results & Ranking</strong></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:80px">Rank</th>
                            <th>Code</th>
                            <th class="text-end" style="width:140px">Score (V)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $r)
                        <tr>
                            <td><span class="badge bg-primary">{{ $r['rank'] }}</span></td>
                            <td>{{ $r['label'] }}</td>
                            <td class="text-end">{{ number_format($r['score'], 3) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center p-4">Belum ada hasil.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-muted small">* Values rounded to 3 decimals. Adjust weights in controller or Manage Criteria.</div>
</div>
@endsection

@push('styles')
<style>
/* small visual tweaks to match screenshot look */
.card { border-radius: .6rem !important; }
.table thead th { font-weight: 600 !important; color: #495057 !important; }
.table tbody td { border-top: 1px solid #eef2f6 !important; }
.btn-outline-primary { border-radius: .5rem !important; }
.btn-primary { border-radius: .5rem !important; }
</style>
@endpush
