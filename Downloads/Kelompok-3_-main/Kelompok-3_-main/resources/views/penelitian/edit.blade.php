@extends('layouts.app')

@section('title', 'Edit Penelitian')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark fw-semibold">
                    <i class="bi bi-pencil-square me-1"></i> Edit Data Penelitian
                </div>

                <form method="POST" action="{{ route('penelitian.update', $penelitian->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- =======================
                            KETUA PENELITIAN
                        ======================= --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Ketua Penelitian (Dosen)
                            </label>
                            <select name="ketua_dosen_id" class="form-select" required>
                                <option value="">-- Pilih Ketua Dosen --</option>
                                @foreach ($dosens as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $penelitian->ketua_dosen_id == $d->id ? 'selected' : '' }}>
                                        {{ $d->nama }} ({{ $d->nidn }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- =======================
                            JUDUL
                        ======================= --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Penelitian</label>
                            <input type="text" name="judul" class="form-control"
                                   value="{{ old('judul', $penelitian->judul) }}" required>
                        </div>

                        {{-- =======================
                            BIDANG
                        ======================= --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Bidang Penelitian</label>
                            <input type="text" name="bidang" class="form-control"
                                   value="{{ old('bidang', $penelitian->bidang) }}">
                        </div>

                        {{-- =======================
                            TANGGAL
                        ======================= --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control"
                                       value="{{ old('tanggal_mulai', $penelitian->tanggal_mulai) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control"
                                       value="{{ old('tanggal_selesai', $penelitian->tanggal_selesai) }}">
                            </div>
                        </div>

                        {{-- =======================
                            STATUS
                        ======================= --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status Penelitian</label>
                            <select name="status" class="form-select" required>
                                <option value="Aktif"
                                    {{ $penelitian->status == 'Aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="Selesai"
                                    {{ $penelitian->status == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                        </div>

                        {{-- =======================
                            ANGGOTA DOSEN (CHECKBOX)
                        ======================= --}}
                        <hr>
                        <h6 class="fw-semibold text-primary mb-2">
                            <i class="bi bi-people me-1"></i> Anggota Peneliti (Dosen)
                        </h6>

                        <div class="border rounded p-3 mb-3" style="max-height: 220px; overflow-y: auto;">
                            @foreach ($dosens as $d)
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="anggota_dosen[]"
                                        value="{{ $d->id }}"
                                        id="anggota{{ $d->id }}"
                                        {{ $penelitian->anggotaDosens->contains($d->id) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="anggota{{ $d->id }}">
                                        {{ $d->nama }} ({{ $d->nidn }})
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <small class="text-muted">
                            ✔ Centang dosen yang menjadi anggota (selain ketua)
                        </small>

                        {{-- =======================
                            MAHASISWA DOKUMENTASI
                        ======================= --}}
                        <div class="mt-4 mb-3">
                            <label class="form-label fw-semibold">
                                Mahasiswa Penanggung Jawab Dokumentasi
                            </label>
                            <select name="mahasiswa_id" class="form-select">
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach ($mahasiswas as $m)
                                    <option value="{{ $m->id }}"
                                        {{ $penelitian->mahasiswa_id == $m->id ? 'selected' : '' }}>
                                        {{ $m->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- =======================
                            TAHUN
                        ======================= --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tahun</label>
                            <input type="number" name="tahun" class="form-control"
                                   value="{{ old('tahun', $penelitian->tahun) }}" required>
                        </div>

                    </div>

                    {{-- =======================
                        TOMBOL
                    ======================= --}}
                    <div class="card-footer bg-white text-end">
                        <a href="{{ route('penelitian.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button class="btn btn-warning">
                            <i class="bi bi-save"></i> Perbarui
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection
