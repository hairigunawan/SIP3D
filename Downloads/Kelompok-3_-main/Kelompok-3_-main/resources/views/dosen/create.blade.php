@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-100 via-white to-indigo-50 flex items-center justify-center py-10 px-4">
    <div class="w-full max-w-3xl bg-white/70 backdrop-blur-lg shadow-2xl rounded-3xl border border-indigo-100 p-8 transition-transform hover:scale-[1.01] duration-300">
        
        <h2 class="text-center text-3xl font-extrabold text-indigo-700 mb-8">
            ✨ Tambah Data Dosen ✨
        </h2>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700">
                <ul class="list-disc list-inside mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Tampilkan pesan sukses --}}
        @if (session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('dosen.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">NIDN</label>
                    <input type="text" name="nidn" value="{{ old('nidn') }}" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan NIDN dosen" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                    {{-- Ganti name menjadi "nama" agar sesuai validasi/controller --}}
                    <input type="text" name="nama" value="{{ old('nama') }}" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan nama lengkap dosen" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan email aktif" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Fakultas</label>
                    <input type="text" name="fakultas" value="{{ old('fakultas') }}" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan fakultas">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Program Studi</label>
                    {{-- Ganti name menjadi "prodi" agar sesuai validasi/controller --}}
                    <input type="text" name="prodi" value="{{ old('prodi') }}" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan program studi">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Jabatan Akademik</label>
                    <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan jabatan akademik">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Tahun Masuk</label>
                    {{-- Ganti name menjadi "tahun" --}}
                    <input type="number" name="tahun" value="{{ old('tahun') }}" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Contoh: 2020">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Status</label>
                    <select name="status" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400">
                        <option value="">Pilih status</option>
                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-between pt-6">
                <a href="{{ route('dosen.index') }}" class="px-5 py-2 rounded-xl bg-gray-200 text-gray-700 hover:bg-gray-300 transition-all duration-200">
                    ← Kembali
                </a>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 text-white font-semibold shadow-md hover:bg-indigo-700 transition-all duration-200">
                    💾 Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
