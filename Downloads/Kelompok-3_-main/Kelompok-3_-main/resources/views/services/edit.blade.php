@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pengabdian</h2>
    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" value="{{ $service->nama_kegiatan }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kegiatan</label>
            <input type="text" name="jenis_kegiatan" class="form-control" value="{{ $service->jenis_kegiatan }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $service->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ $service->lokasi }}">
        </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ $service->tanggal_mulai }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ $service->tanggal_selesai }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('services.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
