<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penelitian;
// use App\Models\Dokumentasi; // kalau kamu sudah punya model dokumentasi

class MahasiswaDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Penelitian yang ditugaskan ke mahasiswa ini
        $penelitians = Penelitian::where('mahasiswa_dok', $user->name)
            ->orderBy('tahun', 'desc')
            ->get();

        // Contoh hitung dokumentasi (sesuaikan dengan tabelmu)
        // $fotoCount  = Dokumentasi::where('mahasiswa_id', $user->id)->where('tipe', 'foto')->count();
        // $videoCount = Dokumentasi::where('mahasiswa_id', $user->id)->where('tipe', 'video')->count();
        // $totalCount = Dokumentasi::where('mahasiswa_id', $user->id)->count();

        // sementara biar tidak error
        $fotoCount = $videoCount = $totalCount = 0;

        return view('mahasiswa.dashboard', compact(
            'penelitians',
            'fotoCount',
            'videoCount',
            'totalCount'
        ));
    }
}
