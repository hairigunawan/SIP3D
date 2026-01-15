@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-2xl p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Data Mahasiswa</h2>
            <a href="{{ route('mahasiswa.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                + Tambah Mahasiswa
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">NIM</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Prodi</th>
                        <th class="px-4 py-2 text-left">Angkatan</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswa as $mhs)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $mhs->nim }}</td>
                            <td class="px-4 py-2">{{ $mhs->nama }}</td>
                            <td class="px-4 py-2">{{ $mhs->email }}</td>
                            <td class="px-4 py-2">{{ $mhs->prodi }}</td>
                            <td class="px-4 py-2">{{ $mhs->angkatan }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-lg text-sm 
                                    {{ $mhs->status == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $mhs->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('mahasiswa.edit', $mhs) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('mahasiswa.destroy', $mhs) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline"
                                            onclick="return confirm('Yakin hapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data mahasiswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
