<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // <- wajib untuk Str::before()
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Prestasi;

class DashboardController extends Controller
{
    // Note: routes already use 'auth' middleware, so we don't require constructor middleware here.

    public function index()
    {
        $user = Auth::user();

        // Default name = ambil dari Google (jika tersedia)
        $displayName = $user->name ?? null;

        // Jika tidak ada name, maka coba cari di tabel mahasiswa berdasarkan email (ambil NIM sebelum @)
        if (!$displayName && !empty($user->email)) {
            $nim = Str::before($user->email, '@');

            // Pastikan field NIM di tabel mahasiswa bernama 'nim'. Sesuaikan jika berbeda.
            $mhs = Mahasiswa::where('nim', $nim)->first();

            if ($mhs && !empty($mhs->nama)) {
                // Pakai nama mahasiswa yang sebenarnya
                $displayName = $mhs->nama;
            }
        }

        // Jika masih tidak ada nama → pakai bagian sebelum @ dari email
        if (!$displayName && !empty($user->email)) {
            $displayName = Str::before($user->email, '@');
        }

        // Pastikan minimal ada satu kata, ambil kata pertama lalu kapitalisasi pertama huruf
        $displayName = trim((string) $displayName);
        if ($displayName === '') {
            $displayName = 'Pengguna';
        } else {
            $displayName = explode(' ', $displayName)[0];
            $displayName = ucfirst(mb_strtolower($displayName));
        }

        // Ambil data statistik
        $data = [
            'lecturers'   => Dosen::count(),
            'students'    => Mahasiswa::count(),
            'research'    => Penelitian::count(),
            'service'     => Pengabdian::count(),
            'achievement' => Prestasi::count(),
        ];

        // Kirim data + user + displayName ke view
        return view('admin.dashboard', compact('data', 'user', 'displayName'));
    }
}
