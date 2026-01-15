<div class="card shadow-sm p-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="nidn" class="form-label">NIDN</label>
            <input type="text" name="nidn" id="nidn" class="form-control" value="{{ old('nidn', $dosen->nidn ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $dosen->nama ?? '') }}" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $dosen->email ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label for="fakultas" class="form-label">Fakultas</label>
            <input type="text" name="fakultas" id="fakultas" class="form-control" value="{{ old('fakultas', $dosen->fakultas ?? '') }}" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="prodi" class="form-label">Program Studi</label>
            <input type="text" name="prodi" id="prodi" class="form-control" value="{{ old('prodi', $dosen->prodi ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ old('jabatan', $dosen->jabatan ?? '') }}" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="tahun" class="form-label">Tahun Bergabung</label>
            <input type="number" name="tahun" id="tahun" class="form-control" value="{{ old('tahun', $dosen->tahun ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Pilih Status --</option>
                <option value="Aktif" {{ old('status', $dosen->status ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ old('status', $dosen->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
    </div>
</div>
