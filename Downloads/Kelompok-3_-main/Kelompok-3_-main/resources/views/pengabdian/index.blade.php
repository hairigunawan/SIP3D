@extends('layouts.app')

@section('content')
<div class="container">

    {{-- HEADER + TOMBOL --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-semibold">Daftar Pengabdian</h4>

        <div class="d-flex gap-2">
            {{-- ⬇️ UNDUH EXCEL --}}
            <a href="{{ route('pengabdian.export') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Unduh Excel
            </a>

            {{-- ➕ TAMBAH --}}
            <a href="{{ route('pengabdian.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Pengabdian
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Judul</th>
                        <th>Bidang</th>
                        <th>Ketua</th>
                        <th>Anggota</th>
                        <th>Mahasiswa</th>
                        <th>Tahun</th>
                        <th>Status</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($pengabdians as $p)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->bidang }}</td>
                        <td>{{ $p->ketua_pengabdian }}</td>
                        <td>{{ $p->anggota }}</td>
                        <td>{{ $p->mahasiswa_dokumentasi }}</td>
                        <td class="text-center">{{ $p->tahun }}</td>
                        <td class="text-center">
                            <span class="badge bg-{{ $p->status === 'Aktif' ? 'success' : 'secondary' }}">
                                {{ $p->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            {{-- ✏️ EDIT --}}
                            <a href="{{ route('pengabdian.edit', $p->id) }}"
                               class="btn btn-sm btn-warning mb-1">
                                <i class="bi bi-pencil"></i>
                            </a>

                            {{-- 🗑️ DELETE --}}
                            <form action="{{ route('pengabdian.destroy', $p->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus data pengabdian ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            Belum ada data pengabdian
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
