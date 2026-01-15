@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Ubah Data Pengabdian</div>
        <div class="card-body">

            <form action="{{ route('pengabdians.update', $pengabdian->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Judul Pengabdian</label>
                    <input type="text" name="judul" class="form-control"
                           value="{{ $pengabdian->judul }}">
                </div>

                <div class="form-group mt-2">
                    <label>Bidang Pengabdian</label>
                    <input type="text" name="bidang" class="form-control"
                           value="{{ $pengabdian->bidang }}">
                </div>

                <div class="form-group mt-2">
                    <label>Ketua Pengabdian (Dosen)</label>
                    <select name="ketua_dosen_id" class="form-control">
                        @foreach($dosens as $d)
                            <option value="{{ $d->id }}"
                                {{ $pengabdian->ketua_dosen_id == $d->id ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label>Anggota Pengabdian</label>
                    <textarea name="anggota" class="form-control">{{ $pengabdian->anggota }}</textarea>
                </div>

                <div class="form-group mt-2">
                    <label>Mahasiswa Dokumentasi</label>
                    <input type="text" name="mahasiswa_dokumentasi"
                           class="form-control"
                           value="{{ $pengabdian->mahasiswa_dokumentasi }}">
                </div>

                <div class="form-group mt-2">
                    <label>Tahun</label>
                    <input type="text" name="tahun" class="form-control"
                           value="{{ $pengabdian->tahun }}">
                </div>

                <div class="form-group mt-2">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="Sedang Berjalan"
                            {{ $pengabdian->status == 'Sedang Berjalan' ? 'selected' : '' }}>
                            Sedang Berjalan
                        </option>
                        <option value="Selesai"
                            {{ $pengabdian->status == 'Selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>
                    </select>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('pengabdians.index') }}" class="btn btn-secondary">Batal</a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
