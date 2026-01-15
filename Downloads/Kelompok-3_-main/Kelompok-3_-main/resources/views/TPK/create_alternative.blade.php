{{-- resources/views/TPK/create_alternative.blade.php --}}
@extends('layouts.app')
@section('title','Tambah Alternatif')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Tambah Alternatif</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('tpk.alternatif.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Kode (opsional)</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Dosen</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="row g-3">
                    <div class="col">
                        <label class="form-label">Skor Sinta</label>
                        <input type="number" name="skor_sinta" class="form-control" value="{{ old('skor_sinta',0) }}">
                    </div>
                    <div class="col">
                        <label class="form-label">Skor Sinta 3Yr</label>
                        <input type="number" name="skor_sinta_3yr" class="form-control" value="{{ old('skor_sinta_3yr',0) }}">
                    </div>
                    <div class="col">
                        <label class="form-label">Jumlah Buku</label>
                        <input type="number" name="jumlah_buku" class="form-control" value="{{ old('jumlah_buku',0) }}">
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col">
                        <label class="form-label">Jumlah Hibah</label>
                        <input type="number" name="jumlah_hibah" class="form-control" value="{{ old('jumlah_hibah',0) }}">
                    </div>
                    <div class="col">
                        <label class="form-label">Publikasi Scholar (1Yr)</label>
                        <input type="number" name="publikasi_scholar" class="form-control" value="{{ old('publikasi_scholar',0) }}">
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('tpk.alternatif.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
