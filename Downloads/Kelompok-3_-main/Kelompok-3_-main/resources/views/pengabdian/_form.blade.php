{{-- resources/views/pengabdians/_form.blade.php --}}
@csrf

<div class="form-group">
    <label>Ketua Penelitian (Dosen)</label>
    <select name="ketua_dosen_id" class="form-control">
        <option value="">-- Pilih Dosen --</option>
        @foreach($dosens as $d)
            <option value="{{ $d->id }}" {{ (old('ketua_dosen_id', $pengabdian->ketua_dosen_id ?? '') == $d->id) ? 'selected' : '' }}>
                {{ $d->nama }}
            </option>
        @endforeach
    </select>
    @error('ketua_dosen_id') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="form-group">
    <label>Judul Pengabdian</label>
    <input type="text" name="judul" class="form-control" value="{{ old('judul', $pengabdian->judul ?? '') }}" placeholder="Masukkan judul pengabdian">
    @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="form-group">
    <label>Bidang</label>
    <input type="text" name="bidang" class="form-control" value="{{ old('bidang', $pengabdian->bidang ?? '') }}" placeholder="Contoh: Pemberdayaan Masyarakat">
    @error('bidang') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label>Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', isset($pengabdian->tanggal_mulai) ? $pengabdian->tanggal_mulai->format('Y-m-d') : '') }}">
        @error('tanggal_mulai') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="form-group col-md-6">
        <label>Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', isset($pengabdian->tanggal_selesai) ? $pengabdian->tanggal_selesai->format('Y-m-d') : '') }}">
        @error('tanggal_selesai') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>

<div class="form-group">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="">-- Pilih Status --</option>
        @foreach(['Diusulkan','Berjalan','Selesai','Dibatalkan'] as $s)
            <option value="{{ $s }}" {{ (old('status', $pengabdian->status ?? '') == $s) ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
    </select>
    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="form-group">
    <label>Anggota Peneliti (Selain Ketua)</label>
    <textarea name="anggota" class="form-control" placeholder="Contoh: Budi Setiawan, Sari Mawar">{{ old('anggota', $pengabdian->anggota ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>Mahasiswa Penanggung Jawab Dokumentasi</label>
    <input type="text" name="mahasiswa_penanggung_jawab" class="form-control" value="{{ old('mahasiswa_penanggung_jawab', $pengabdian->mahasiswa_penanggung_jawab ?? '') }}" placeholder="Nama mahasiswa yang mengunggah dokumentasi">
</div>

<div class="form-group">
    <label>Tahun</label>
    <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $pengabdian->tahun ?? date('Y')) }}">
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('pengabdians.index') }}" class="btn btn-secondary">Kembali</a>
