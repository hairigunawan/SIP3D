@extends('layouts.app')

@section('content')
<div class="p-8 bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">SIP2D - Kelola Dosen</h1>
        <div class="flex items-center gap-3">
            <span class="text-gray-600 font-semibold">Administrator</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Statistik Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow text-center">
            <div class="text-blue-500 text-3xl mb-2"><i class="bi bi-calendar"></i></div>
            <h2 class="text-lg font-semibold">2</h2>
            <p class="text-gray-500">Dosen Tahun 2023</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow text-center">
            <div class="text-blue-500 text-3xl mb-2"><i class="bi bi-calendar"></i></div>
            <h2 class="text-lg font-semibold">2</h2>
            <p class="text-gray-500">Dosen Tahun 2024</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow text-center">
            <div class="text-blue-500 text-3xl mb-2"><i class="bi bi-calendar"></i></div>
            <h2 class="text-lg font-semibold">2</h2>
            <p class="text-gray-500">Dosen Tahun 2025</p>
        </div>
    </div>

    <!-- Data Dosen -->
    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-700">Data Dosen</h2>
            <div class="flex gap-2">
                <input type="text" placeholder="Cari dosen..." class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200">
                <select class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200">
                    <option>Semua Tahun</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
                </select>
                <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    + Tambah Dosen
                </a>
            </div>
        </div>

        <table class="w-full border-collapse text-sm">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="py-3 px-4 text-left">NIDN</th>
                    <th class="py-3 px-4 text-left">Nama</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Fakultas</th>
                    <th class="py-3 px-4 text-left">Prodi</th>
                    <th class="py-3 px-4 text-left">Jabatan</th>
                    <th class="py-3 px-4 text-left">Tahun</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">0123456789</td>
                    <td class="py-2 px-4">Dr. Ahmad Wijaya, M.Kom</td>
                    <td class="py-2 px-4">ahmad.wijaya@univ.ac.id</td>
                    <td class="py-2 px-4">Teknik</td>
                    <td class="py-2 px-4">Informatika</td>
                    <td class="py-2 px-4">Lektor</td>
                    <td class="py-2 px-4 text-blue-600 font-semibold">2023</td>
                    <td class="py-2 px-4">
                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs">Aktif</span>
                    </td>
                    <td class="py-2 px-4 text-center flex gap-2 justify-center">
                        <a href="#" class="text-blue-500 hover:text-blue-700"><i class="bi bi-pencil-square"></i></a>
                        <a href="#" class="text-red-500 hover:text-red-700"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>

                <!-- Tambahkan data dosen lain di sini -->
            </tbody>
        </table>
    </div>
</div>
@endsection
