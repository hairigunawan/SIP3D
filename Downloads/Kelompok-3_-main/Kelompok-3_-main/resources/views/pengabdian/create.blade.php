@extends('layouts.app')

@section('title', 'Tambah Pengabdian')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-semibold">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data Pengabdian
                </div>

                <form method="POST" action="{{ route('pengabdian.store') }}">
                    @csrf

                    <div class="card-body">

                        {{-- Ketua Pengabdian --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Ketua Pengabdian (Dosen)
                            </label>
                            <select name="ketua_dosen_id" class="form-select" required>
                                <option value="">-- Pilih Ketua Dosen --</option>
                                @foreach ($dosens as $d)
                                    <option value="{{ $d->id }}">
                                        {{ $d->nama }} ({{ $d->nidn }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Pengabdian</label>
                            <input type="text" name="judul" class="form-control"
                                   placeholder="Masukkan judul pengabdian" required>
                        </div>

                        {{-- Bidang --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Bidang Pengabdian</label>
                            <input type="text" name="bidang" class="form-control"
                                   placeholder="Contoh: Sosial & Pendidikan" required>
                        </div>

                        {{-- Tanggal --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control">
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status Pengabdian</label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        {{-- ===============================
                             ANGGOTA PENGABDIAN (DOSEN)
                        =============================== --}}
                        <hr>
                        <h6 class="fw-semibold text-success mb-2">
                            <i class="bi bi-people me-1"></i> Anggota Pengabdian (Dosen)
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
                                    >
                                    <label class="form-check-label" for="anggota{{ $d->id }}">
                                        {{ $d->nama }} ({{ $d->nidn }})
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <small class="text-muted">
                            ✔ Centang satu atau lebih dosen sebagai anggota pengabdian
                        </small>

                        {{-- Mahasiswa Dokumentasi --}}
                        <div class="mt-4 mb-3">
                            <label class="form-label fw-semibold">
                                Mahasiswa Penanggung Jawab Dokumentasi
                            </label>
                            <select name="mahasiswa_id" class="form-select">
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach ($mahasiswas as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tahun --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tahun</label>
                            <input type="number" name="tahun" class="form-control"
                                   value="{{ date('Y') }}" required>
                        </div>

                    </div>

                    <div class="card-footer bg-white text-end">
                        <a href="{{ route('pengabdian.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button class="btn btn-success">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection
