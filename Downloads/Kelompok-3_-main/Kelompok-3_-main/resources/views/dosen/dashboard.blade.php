@extends('layouts.app')

@section('title', 'SIP3D - Dashboard Dosen')

@section('content')
<div class="min-h-screen flex justify-center items-center bg-gradient-to-br from-indigo-50 to-blue-100 py-10">
    <div class="bg-white w-full max-w-5xl rounded-2xl shadow-xl p-10 border border-gray-100">

        <!-- Header -->
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-bold text-indigo-700 tracking-tight">
                <i class="fa-solid fa-graduation-cap mr-2"></i> SIP3D - Dashboard Dosen
            </h1>

            <button type="button"
                onclick="history.back()"
                class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg shadow transition duration-200">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </button>
        </div>

        <!-- Welcome Section -->
        <div class="text-center mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Selamat Datang di Dashboard Dosen 🎓</h2>
            <p class="text-gray-500 text-sm">Kelola penelitian, pengabdian, dan prestasi Anda dengan mudah & efisien.</p>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 border rounded-xl p-6 text-center hover:shadow-lg transition">
                <div class="flex justify-center mb-3">
                    <div class="bg-purple-600 text-white p-3 rounded-full shadow-md">
                        <i class="fa-solid fa-flask text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-4xl font-bold text-gray-800">{{ $data['penelitian'] ?? 0 }}</h3>
                <p class="text-gray-600 font-medium">Penelitian Aktif</p>
            </div>

            <div class="bg-gradient-to-br from-orange-50 to-yellow-100 border rounded-xl p-6 text-center hover:shadow-lg transition">
                <div class="flex justify-center mb-3">
                    <div class="bg-orange-500 text-white p-3 rounded-full shadow-md">
                        <i class="fa-solid fa-hands-holding-circle text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-4xl font-bold text-gray-800">{{ $data['pengabdian'] ?? 0 }}</h3>
                <p class="text-gray-600 font-medium">Pengabdian Aktif</p>
            </div>

            <div class="bg-gradient-to-br from-yellow-50 to-amber-100 border rounded-xl p-6 text-center hover:shadow-lg transition">
                <div class="flex justify-center mb-3">
                    <div class="bg-yellow-400 text-white p-3 rounded-full shadow-md">
                        <i class="fa-solid fa-trophy text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-4xl font-bold text-gray-800">{{ $data['prestasi'] ?? 0 }}</h3>
                <p class="text-gray-600 font-medium">Total Prestasi</p>
            </div>
        </div>

        <!-- Menu Utama -->
        <div>
            <h3 class="text-xl font-semibold text-gray-800 mb-6 text-center">📋 Menu Utama</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Penelitian -->
                <div class="bg-white border rounded-xl shadow-md p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center mb-3">
                        <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                            <i class="fa-solid fa-flask"></i>
                        </div>
                        <h4 class="ml-3 font-semibold text-gray-700">Penelitian</h4>
                    </div>
                    <p class="text-gray-500 text-sm mb-4">Kelola data penelitian Anda</p>
                    <a href="{{ route('dosen.penelitian') }}"
                       class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm shadow transition">
                       Kelola
                    </a>
                </div>

                <!-- Pengabdian -->
                <div class="bg-white border rounded-xl shadow-md p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center mb-3">
                        <div class="bg-orange-100 text-orange-500 p-3 rounded-full">
                            <i class="fa-solid fa-handshake-angle"></i>
                        </div>
                        <h4 class="ml-3 font-semibold text-gray-700">Pengabdian</h4>
                    </div>
                    <p class="text-gray-500 text-sm mb-4">Kelola data pengabdian masyarakat</p>
                    <a href="{{ route('dosen.pengabdian') }}"
                       class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm shadow transition">
                       Kelola
                    </a>
                </div>

                <!-- Prestasi -->
                <div class="bg-white border rounded-xl shadow-md p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center mb-3">
                        <div class="bg-yellow-100 text-yellow-500 p-3 rounded-full">
                            <i class="fa-solid fa-trophy"></i>
                        </div>
                        <h4 class="ml-3 font-semibold text-gray-700">Prestasi</h4>
                    </div>
                    <p class="text-gray-500 text-sm mb-4">Kelola data prestasi dan penghargaan</p>
                    <a href="{{ route('dosen.prestasi') }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm shadow transition">
                       Kelola
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
