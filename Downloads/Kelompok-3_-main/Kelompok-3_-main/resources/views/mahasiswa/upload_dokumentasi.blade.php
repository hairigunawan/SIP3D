@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Upload Dokumentasi Penelitian</h3>
            <small class="text-muted">
                Unggah foto / video atau tempelkan link Google Drive dokumentasi penelitian.
            </small>
        </div>
        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-secondary">
            Kembali ke Dashboard
        </a>
    </div>

    {{-- Info penelitian --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between">
                <div class="mb-3 mb-md-0">
                    <div class="fw-semibold mb-1">{{ $penelitian->judul }}</div>

                    <p class="mb-1">
                        <strong>Ketua Penelitian (Dosen):</strong><br>
                        {{ optional($penelitian->dosen)->nama ?? $penelitian->ketua_manual ?? '-' }}
                    </p>
                    <p class="mb-0">
                        <strong>Bidang:</strong><br>
                        {{ $penelitian->bidang ?? '-' }}
                    </p>
                </div>

                <div class="text-md-end">
                    <p class="mb-1">
                        <strong>Tahun:</strong><br>
                        {{ $penelitian->tahun ?? '-' }}
                    </p>
                    <p class="mb-1">
                        <strong>Status:</strong><br>
                        {{ $penelitian->status ?? '-' }}
                    </p>
                    <p class="mb-0 text-muted small">
                        Mahasiswa Dok.: {{ $penelitian->mahasiswa_dok ?? '-' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Form upload --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 pb-0">
            <h5 class="mb-1">Form Upload Dokumentasi</h5>
            <small class="text-muted">
                Anda boleh mengupload file langsung, menempelkan link Google Drive, atau keduanya.
            </small>
        </div>
        <div class="card-body">

            <form action="{{ route('mahasiswa.dokumentasi.store', $penelitian->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- Row jenis & file upload --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jenis Dokumentasi</label>
                        <select name="jenis" class="form-select" required>
                            <option value="">-- Pilih Jenis Dokumentasi --</option>
                            <option value="foto" {{ old('jenis') == 'foto' ? 'selected' : '' }}>Foto</option>
                            <option value="video" {{ old('jenis') == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                        @error('jenis')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <label class="form-label">File Dokumentasi (Opsional jika pakai link)</label>
                        <input type="file" name="file" class="form-control">
                        <small class="text-muted d-block">
                            Format: <strong>JPG, JPEG, PNG, MP4</strong>, maksimal <strong>20 MB</strong>.
                        </small>
                        @error('file')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Link Google Drive --}}
                <div class="mb-3">
                    <label class="form-label">
                        Link Google Drive (Opsional)
                    </label>
                    <input type="url"
                           name="drive_link"
                           class="form-control"
                           placeholder="Tempel link Google Drive di sini, contoh: https://drive.google.com/..."
                           value="{{ old('drive_link') }}">
                    <small class="text-muted">
                        Jika file sudah diunggah ke Google Drive, cukup tempel tautannya di sini.
                    </small>
                    @error('drive_link')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Catatan --}}
                <div class="alert alert-info small mb-4">
                    <strong>Catatan:</strong> Minimal salah satu harus diisi:
                    upload file dokumentasi <em>atau</em> link Google Drive.
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Upload Dokumentasi
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
