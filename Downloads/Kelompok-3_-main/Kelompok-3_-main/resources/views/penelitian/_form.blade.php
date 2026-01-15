@php
    $isEdit = isset($penelitian);
@endphp

<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-4">
            {{ $isEdit ? 'Edit Data Penelitian' : 'Tambah Data Penelitian' }}
        </h5>

        {{-- Ketua Penelitian --}}
        <div class="mb-3">
            <label class="form-label">Ketua Penelitian (Dosen)</label>

            {{-- Mode input: pilih atau ketik manual --}}
            <select id="pi_mode" class="form-select mb-2" onchange="togglePIMode()">
                <option value="select">Pilih dari Daftar Dosen</option>
                <option value="manual"
                    {{ old('ketua_manual', $isEdit && !empty($penelitian->ketua_manual) ? 'x' : '') ? 'selected' : '' }}>
                    Ketik Manual
                </option>
            </select>

            {{-- Pilih dosen --}}
            <select name="dosen_id" id="pi_select" class="form-select">
                <option value="">-- Pilih Dosen --</option>
                @foreach($dosens as $dosen)
                    <option value="{{ $dosen->id }}"
                        {{ old('dosen_id', $isEdit ? $penelitian->dosen_id : null) == $dosen->id ? 'selected' : '' }}>
                        {{ $dosen->nama }}
                    </option>
                @endforeach
            </select>

            {{-- Ketik manual --}}
            <input type="text" name="ketua_manual" id="pi_manual"
                   class="form-control mt-2 d-none"
                   placeholder="Tulis nama ketua penelitian"
                   value="{{ old('ketua_manual', $isEdit ? ($penelitian->ketua_manual ?? '') : '') }}">

            @error('dosen_id')
                <small class="text-danger">{{ $message }}</small><br>
            @enderror
            @error('ketua_manual')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Judul Penelitian --}}
        <div class="mb-3">
            <label class="form-label">Judul Penelitian</label>
            <input type="text" name="judul" class="form-control"
                   placeholder="Masukkan judul penelitian"
                   value="{{ old('judul', $isEdit ? $penelitian->judul : '') }}" required>
        </div>

        {{-- Bidang --}}
        <div class="mb-3">
            <label class="form-label">Bidang Penelitian</label>
            <input type="text" name="bidang" class="form-control"
                   placeholder="Contoh: Sistem Informasi"
                   value="{{ old('bidang', $isEdit ? $penelitian->bidang : '') }}">
        </div>

        {{-- Tanggal --}}
        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control"
                       value="{{ old('tanggal_mulai', $isEdit ? $penelitian->tanggal_mulai : '') }}">
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control"
                       value="{{ old('tanggal_selesai', $isEdit ? $penelitian->tanggal_selesai : '') }}">
            </div>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label">Status Penelitian</label>
            @php
                $statusList = ['Perencanaan', 'Sedang Berjalan', 'Selesai', 'Dibatalkan'];
            @endphp

            <select name="status" class="form-select">
                <option value="">-- Pilih Status --</option>
                @foreach($statusList as $st)
                    <option value="{{ $st }}"
                        {{ old('status', $isEdit ? $penelitian->status : '') == $st ? 'selected' : '' }}>
                        {{ $st }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Anggota Peneliti --}}
        <div class="mb-3">
            <label class="form-label">Anggota Peneliti (Selain Ketua)</label>
            <textarea name="peneliti" class="form-control" rows="2"
                      placeholder="Contoh: Budi Setiawan, Sari Mawar, Joko Pratama">{{ old('peneliti', $isEdit ? $penelitian->peneliti : '') }}</textarea>
        </div>

        {{-- Mahasiswa Dokumentasi --}}
        <div class="mb-3">
            <label class="form-label">Mahasiswa Penanggung Jawab Dokumentasi</label>
            <input type="text" name="mahasiswa_dok" class="form-control"
                   placeholder="Nama mahasiswa yang mengunggah dokumentasi"
                   value="{{ old('mahasiswa_dok', $isEdit ? ($penelitian->mahasiswa_dok ?? '') : '') }}">
        </div>

        {{-- Tahun --}}
        <div class="mb-3 col-md-4">
            <label class="form-label">Tahun Penelitian</label>
            <input type="number" name="tahun" class="form-control"
                   placeholder="Masukkan tahun"
                   value="{{ old('tahun', $isEdit ? $penelitian->tahun : now()->year) }}">
        </div>

        {{-- Tombol --}}
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('penelitian.index') }}" class="btn btn-outline-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Perbarui' : 'Simpan' }}
            </button>
        </div>

    </div>
</div>

<script>
    function togglePIMode() {
        const mode = document.getElementById('pi_mode').value;
        const selectBox = document.getElementById('pi_select');
        const manualInput = document.getElementById('pi_manual');

        if (mode === 'manual') {
            selectBox.classList.add('d-none');
            manualInput.classList.remove('d-none');
        } else {
            selectBox.classList.remove('d-none');
            manualInput.classList.add('d-none');
        }
    }

    document.addEventListener('DOMContentLoaded', togglePIMode);
</script>
