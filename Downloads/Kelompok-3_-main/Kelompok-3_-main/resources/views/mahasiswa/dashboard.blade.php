@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @php
        // Supaya tidak error kalau controller belum kirim
        $penelitians = $penelitians ?? collect();
        $pengabdians = $pengabdians ?? collect();
    @endphp

    {{-- Heading --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">SIP3D - Dashboard Mahasiswa</h3>
            <small class="text-muted">
                Upload dokumentasi foto dan video kegiatan penelitian serta pengabdian masyarakat.
            </small>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
            Kembali
        </a>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Kartu statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="rounded-circle mx-auto mb-3" style="width:90px;height:90px;background:#e9f9ef;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-image" style="font-size:2rem;"></i>
                    </div>
                    <h3 class="mb-0">{{ $fotoCount ?? 0 }}</h3>
                    <small class="text-muted">Foto Dokumentasi</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="rounded-circle mx-auto mb-3" style="width:90px;height:90px;background:#f3e9ff;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-camera-video" style="font-size:2rem;"></i>
                    </div>
                    <h3 class="mb-0">{{ $videoCount ?? 0 }}</h3>
                    <small class="text-muted">Video Dokumentasi</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="rounded-circle mx-auto mb-3" style="width:90px;height:90px;background:#e9f1ff;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-file-earmark-text" style="font-size:2rem;"></i>
                    </div>
                    <h3 class="mb-0">{{ ($fotoCount ?? 0) + ($videoCount ?? 0) }}</h3>
                    <small class="text-muted">Total Dokumentasi</small>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== --}}
    {{-- PENELITIAN --}}
    {{-- ===================== --}}
    <h4 class="mb-2">Penelitian yang Ditugaskan</h4>
    <small class="text-muted d-block mb-2">
        Daftar penelitian di mana Anda menjadi penanggung jawab dokumentasi.
    </small>

    <div class="card shadow-sm border-0 mb-4">
        @if($penelitians->isEmpty())
            <div class="card-body">
                <div class="alert alert-info mb-0">
                    Belum ada penelitian yang menugaskan Anda sebagai mahasiswa dokumentasi.
                </div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Penelitian</th>
                            <th>Ketua</th>
                            <th>Bidang</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penelitians as $penelitian)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $penelitian->judul }}</td>
                                <td>{{ optional($penelitian->dosen)->nama ?? $penelitian->ketua_manual ?? '-' }}</td>
                                <td>{{ $penelitian->bidang ?? '-' }}</td>
                                <td>{{ $penelitian->tahun ?? '-' }}</td>
                                <td>{{ $penelitian->status ?? '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('mahasiswa.dokumentasi.create', $penelitian->id) }}"
                                       class="btn btn-sm btn-primary">
                                        Upload Dokumentasi
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- ===================== --}}
    {{-- 🔥 PENGABDIAN --}}
    {{-- ===================== --}}
    <h4 class="mb-2">Pengabdian yang Ditugaskan</h4>
    <small class="text-muted d-block mb-2">
        Daftar pengabdian di mana Anda menjadi penanggung jawab dokumentasi.
    </small>

    <div class="card shadow-sm border-0">
        @if($pengabdians->isEmpty())
            <div class="card-body">
                <div class="alert alert-info mb-0">
                    Belum ada pengabdian yang menugaskan Anda sebagai mahasiswa dokumentasi.
                </div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Pengabdian</th>
                            <th>Ketua</th>
                            <th>Bidang</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengabdians as $pengabdian)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $pengabdian->judul }}</td>
                                <td>{{ $pengabdian->ketua_pengabdian }}</td>
                                <td>{{ $pengabdian->bidang }}</td>
                                <td>{{ $pengabdian->tahun }}</td>
                                <td>{{ $pengabdian->status }}</td>
                                <td class="text-end">
                                    <a href="{{ route('mahasiswa.dokumentasi.create', $pengabdian->id) }}"
                                       class="btn btn-sm btn-primary">
                                        Upload Dokumentasi
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection
