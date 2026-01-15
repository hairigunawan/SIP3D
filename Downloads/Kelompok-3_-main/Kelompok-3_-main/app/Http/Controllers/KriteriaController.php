<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * TAMPILKAN HALAMAN + KIRIM DATA KE MODAL
     */
    public function index()
    {
        // WAJIB: kirim semua kriteria ke view
        $kriterias = Kriteria::all();

        return view('admin.tpk.kriteria.index', compact('kriterias'));
    }

    /**
     * SIMPAN BOBOT DARI MODAL
     */
    public function updateBobot(Request $request)
    {
        // CEGAH ERROR kalau form kosong
        if (!$request->has('bobot')) {
            return back();
        }

        // HITUNG TOTAL BOBOT
        $total = array_sum($request->bobot);

        // VALIDASI: total HARUS 1.0
        if (round($total, 3) != 1.000) {
            return back()->with('error', 'Total bobot harus 1.0');
        }

        // SIMPAN KE DATABASE
        foreach ($request->bobot as $id => $nilai) {
            Kriteria::where('id', $id)->update([
                'bobot' => $nilai
            ]);
        }

        return back()->with('success', 'Bobot berhasil diperbarui');
    }
}
