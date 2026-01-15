@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pengabdian</h2>
    <form action="{{ route('services.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kegiatan</label>
            <input type="text" name="jenis_kegiatan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('services.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
