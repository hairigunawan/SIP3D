@extends('layouts.app')

@section('title', 'Tambah Penelitian')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- 🔴 TAMPILKAN ERROR VALIDASI (WAJIB) --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Gagal menyimpan data!</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-semibold">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data Penelitian
                </div>

                <form method="POST" action="{{ route('penelitian.store') }}">
                    @csrf

                    <div class="card-body">

                        {{-- Ketua Penelitian --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Ketua Penelitian (Dosen)
                            </label>
                            <select name="ketua_dosen_id" class="form-select" required>
                                <option value="">-- Pilih Ketua Dosen --</option>
                                @foreach ($dosens as $d)
                                    <option value="{{ $d->id }}"
                                        {{ old('ketua_dosen_id') == $d->id ? 'selected' : '' }}>
                                        {{ $d->nama }} ({{ $d->nidn }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Penelitian</label>
                            <input type="text"
                                   name="judul"
                                   class="form-control"
                                   value="{{ old('judul') }}"
                                   placeholder="Masukkan judul penelitian"
                                   required>
                        </div>

                        {{-- Bidang --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Bidang Penelitian</label>
                            <input type="text"
                                   name="bidang"
                                   class="form-control"
                                   value="{{ old('bidang') }}"
                                   placeholder="Contoh: Sistem Informasi"
                                   required>
                        </div>

                        {{-- Tanggal --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Mulai</label>
                                <input type="date"
                                       name="tanggal_mulai"
                                       class="form-control"
                                       value="{{ old('tanggal_mulai') }}"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Selesai</label>
                                <input type="date"
                                       name="tanggal_selesai"
                                       class="form-control"
                                       value="{{ old('tanggal_selesai') }}">
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status Penelitian</label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                        </div>

                        {{-- ===============================
                             ANGGOTA PENELITI (DOSEN)
                        =============================== --}}
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
                                        {{ is_array(old('anggota_dosen')) && in_array($d->id, old('anggota_dosen')) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="anggota{{ $d->id }}">
                                        {{ $d->nama }} ({{ $d->nidn }})
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <small class="text-muted">
                            ✔ Centang satu atau lebih dosen sebagai anggota peneliti (selain ketua)
                        </small>

                        {{-- Mahasiswa Dokumentasi --}}
                        <div class="mt-4 mb-3">
                            <label class="form-label fw-semibold">
                                Mahasiswa Penanggung Jawab Dokumentasi
                            </label>
                            <select name="mahasiswa_id" class="form-select">
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach ($mahasiswas as $m)
                                    <option value="{{ $m->id }}"
                                        {{ old('mahasiswa_id') == $m->id ? 'selected' : '' }}>
                                        {{ $m->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tahun --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tahun</label>
                            <input type="number"
                                   name="tahun"
                                   class="form-control"
                                   value="{{ old('tahun', date('Y')) }}"
                                   required>
                        </div>

                    </div>

                    <div class="card-footer bg-white text-end">
                        <a href="{{ route('penelitian.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection
