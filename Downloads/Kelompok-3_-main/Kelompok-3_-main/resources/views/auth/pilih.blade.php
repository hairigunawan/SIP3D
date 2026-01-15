<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SIP3D | Select Login</title>

    {{-- Vite / Tailwind --}}
    @vite('resources/css/app.css')

    <style>
        /* Tambahan kecil: fallback animation duration / minor tweak */
        .fade-in { animation: fadeIn .9s ease-in-out both; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Jika butuh ring ringan pada kartu di focus (aksesibilitas keyboard) */
        .card-focus:focus-within { box-shadow: 0 10px 30px rgba(99,102,241,0.12); transform: translateY(-6px); }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-200 via-sky-100 to-pink-100 min-h-screen flex flex-col items-center justify-center relative">

    {{-- Background glowing circles --}}
    <div class="absolute w-[480px] h-[480px] bg-pink-300/40 rounded-full blur-3xl top-[-100px] left-[-120px] animate-pulse -z-10" aria-hidden="true"></div>
    <div class="absolute w-[480px] h-[480px] bg-indigo-300/40 rounded-full blur-3xl bottom-[-120px] right-[-120px] animate-pulse -z-10" aria-hidden="true"></div>

    {{-- Container utama --}}
    <div class="w-full max-w-6xl px-6">
      <div class="mx-auto container-login fade-in bg-white/60 backdrop-blur-md rounded-2xl shadow-xl py-10 px-6 md:px-12">
        {{-- Logo & Judul --}}
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-politala.png') }}" class="w-20 h-20 mx-auto mb-4 rounded-full shadow-lg ring-4 ring-white/60" alt="Logo Politala">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 tracking-wide">SIP3D</h1>
            <p class="text-gray-600 mt-2 text-sm md:text-base">Information System for Lecturer Community Service, Research, and Achievements</p>
            <p class="text-gray-500 mt-4 text-sm">Select the account type to log in to the system</p>
        </div>

        {{-- Grid kartu: items-stretch supaya semua kartu punya tinggi sama --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
            {{-- CARD (komponen ulang untuk tiga role) --}}
            <div class="card-focus flex flex-col justify-between p-6 md:p-8 rounded-3xl shadow-2xl text-center transform transition-all duration-300 hover:scale-105 bg-white/70 border border-white/50">
                <div>
                    <div class="bg-red-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4">
                        {{-- SVG icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4s-4 1.79-4 4 1.79 4 4 4zM6 20v-2a4 4 0 018 0v2" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800">Admin</h2>
                    <p class="text-gray-500 mt-2 text-sm">Manage all system and user data</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('login.admin') }}" class="inline-block w-full md:w-auto px-6 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-full shadow-md hover:shadow-xl hover:from-red-600 hover:to-pink-600 transition text-center font-semibold">Admin Login</a>
                </div>
            </div>

            <div class="card-focus flex flex-col justify-between p-6 md:p-8 rounded-3xl shadow-2xl text-center transform transition-all duration-300 hover:scale-105 bg-white/70 border border-white/50">
                <div>
                    <div class="bg-blue-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14v7m0 0l-3-3m3 3l3-3" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800">Lecturer</h2>
                    <p class="text-gray-500 mt-2 text-sm">Manage research, service, and achievements</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('login.dosen') }}" class="inline-block w-full md:w-auto px-6 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-full shadow-md hover:shadow-xl hover:from-blue-600 hover:to-indigo-600 transition text-center font-semibold">Lecturer Login</a>
                </div>
            </div>

            <div class="card-focus flex flex-col justify-between p-6 md:p-8 rounded-3xl shadow-2xl text-center transform transition-all duration-300 hover:scale-105 bg-white/70 border border-white/50">
                <div>
                    <div class="bg-green-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5zM12 4v16" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800">Student</h2>
                    <p class="text-gray-500 mt-2 text-sm">View research and community service information</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('login.mahasiswa') }}" class="inline-block w-full md:w-auto px-6 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-full shadow-md hover:shadow-xl hover:from-green-600 hover:to-emerald-600 transition text-center font-semibold">Student Login</a>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="mt-8 text-center text-gray-500 text-sm">
          &copy; {{ date('Y') }} Politeknik Negeri Tanah Laut. All rights reserved.
        </div>
      </div>
    </div>

</body>
</html>
