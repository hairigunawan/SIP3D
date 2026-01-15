<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIP3D')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

<!-- ================= NAVBAR ================= -->
<nav class="bg-indigo-600 shadow text-white">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- LOGO -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo-politala.png') }}"
                 alt="Logo Politeknik Negeri Tanah Laut"
                 class="h-12 w-12 rounded-full bg-white p-1 shadow-md">

            <div class="flex flex-col leading-tight">
                <span class="text-xl font-bold tracking-wide">SIP3D</span>
                <span class="text-sm font-medium text-gray-200 uppercase">
                    Politeknik Negeri Tanah Laut
                </span>
            </div>
        </div>

        <!-- MENU -->
        <div class="flex items-center space-x-8 text-base font-medium">

            {{-- 🔥 HOME ROLE-BASED (INI KUNCINYA) --}}
            @auth
                <a class="hover:underline"
                   href="
                   @if(auth()->user()->role === 'admin')
                       {{ url('/admin/dashboard') }}
                   @elseif(auth()->user()->role === 'dosen')
                       {{ url('/dosen/dashboard') }}
                   @else
                       {{ url('/mahasiswa/dashboard') }}
                   @endif
                   ">
                   Home
                </a>
            @else
                <a href="/" class="hover:underline">Home</a>
            @endauth

            {{-- MENU SESUAI ROLE --}}
            @auth
                @if(auth()->user()->role === 'mahasiswa')
                    <a href="{{ url('/mahasiswa/dashboard') }}" class="hover:underline">Mahasiswa</a>
                @endif

                @if(auth()->user()->role === 'dosen')
                    <a href="{{ url('/dosen/dashboard') }}" class="hover:underline">Dosen</a>
                @endif

                @if(auth()->user()->role === 'admin')
                    <a href="{{ url('/admin/dashboard') }}" class="hover:underline">Admin</a>
                @endif

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline flex items-center space-x-1">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<!-- ================= CONTENT ================= -->
<main class="flex-grow py-10 px-6">
    <div class="max-w-7xl mx-auto">
        @yield('content')
    </div>
</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-white border-t mt-16 py-6 text-center text-gray-500 text-sm">
    &copy; {{ date('Y') }}
    <strong>SIP3D</strong> | Sistem Informasi Penelitian & Pengabdian kepada Masyarakat<br>
    <span class="text-gray-400">Politeknik Negeri Tanah Laut</span>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
