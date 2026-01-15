@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pengabdian</h2>
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Tambah Pengabdian</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kegiatan</th>
                <th>Jenis Kegiatan</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->nama_kegiatan }}</td>
                <td>{{ $service->jenis_kegiatan }}</td>
                <td>{{ $service->deskripsi }}</td>
                <td>{{ $service->lokasi }}</td>
                <td>{{ $service->tanggal_mulai }}</td>
                <td>{{ $service->tanggal_selesai }}</td>
                <td>
                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada data pengabdian.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
