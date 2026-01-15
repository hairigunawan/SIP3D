@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Detail Pengabdian</div>
        <div class="card-body">
            <h4>{{ $pengabdian->judul }}</h4>
            <p><strong>Ketua:</strong> {{ $pengabdian->ketua->nama ?? '-' }}</p>
            <p><strong>Bidang:</strong> {{ $pengabdian->bidang }}</p>
            <p><strong>Tanggal:</strong> {{ $pengabdian->tanggal_mulai }} - {{ $pengabdian->tanggal_selesai }}</p>
            <p><strong>Status:</strong> {{ $pengabdian->status }}</p>
            <p><strong>Anggota:</strong> {{ $pengabdian->anggota }}</p>
            <p><strong>Mahasiswa PJ:</strong> {{ $pengabdian->mahasiswa_penanggung_jawab }}</p>
            <p><strong>Tahun:</strong> {{ $pengabdian->tahun }}</p>
            <a href="{{ route('pengabdians.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
