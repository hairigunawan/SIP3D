<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penelitian;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\StreamedResponse;

/* =======================
   TAMBAHAN UNTUK EXCEL
   ======================= */
use App\Exports\PenelitianExport;
use Maatwebsite\Excel\Facades\Excel;

class PenelitianController extends Controller
{
    /* =======================
       INDEX
       ======================= */
    public function index()
    {
        $penelitians = Penelitian::with([
                'dosen',        // ketua
                'mahasiswa',    // mahasiswa dokumentasi
                'anggotaDosens' // anggota dosen
            ])
            ->latest()
            ->paginate(10);

        return view('penelitian.index', compact('penelitians'));
    }

    /* =======================
       CREATE
       ======================= */
    public function create()
    {
        $dosens = Dosen::orderBy('nama')->get();
        $mahasiswas = Mahasiswa::orderBy('nama')->get();

        return view('penelitian.create', compact('dosens', 'mahasiswas'));
    }

    /* =======================
       STORE (VERSI FINAL FIX)
       ======================= */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ketua_dosen_id' => 'required|exists:dosens,id',
            'judul'          => 'required|string|max:255',
            'bidang'         => 'required|string|max:255',
            'tanggal_mulai'  => 'required|date',
            'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
            'status'         => 'required|string|max:50',
            'tahun'          => 'required|integer',
            'mahasiswa_id'   => 'nullable|exists:mahasiswas,id',
            'anggota_dosen'  => 'nullable|array',
            'anggota_dosen.*'=> 'exists:dosens,id',
        ]);

        // 🔹 Simpan data utama
        $penelitian = Penelitian::create([
            'ketua_dosen_id' => $validated['ketua_dosen_id'],
            'judul'          => $validated['judul'],
            'bidang'         => $validated['bidang'],
            'tanggal_mulai'  => $validated['tanggal_mulai'],
            'tanggal_selesai'=> $validated['tanggal_selesai'] ?? null,
            'status'         => $validated['status'],
            'tahun'          => $validated['tahun'],
            'mahasiswa_id'   => $validated['mahasiswa_id'] ?? null,
        ]);

        // 🔹 Simpan anggota dosen (pivot)
        if ($request->filled('anggota_dosen')) {
            $penelitian->anggotaDosens()->sync($request->anggota_dosen);
        }

        return redirect()
            ->route('penelitian.index')
            ->with('success', 'Data penelitian berhasil disimpan.');
    }

    /* =======================
       SHOW
       ======================= */
    public function show(Penelitian $penelitian)
    {
        $penelitian->load(['dosen', 'mahasiswa', 'anggotaDosens']);
        return view('penelitian.show', compact('penelitian'));
    }

    /* =======================
       EDIT
       ======================= */
    public function edit(Penelitian $penelitian)
    {
        $dosens = Dosen::orderBy('nama')->get();
        $mahasiswas = Mahasiswa::orderBy('nama')->get();

        $penelitian->load('anggotaDosens');

        return view(
            'penelitian.edit',
            compact('penelitian', 'dosens', 'mahasiswas')
        );
    }

    /* =======================
       UPDATE
       ======================= */
    public function update(Request $request, Penelitian $penelitian)
    {
        $validated = $request->validate([
            'ketua_dosen_id' => 'required|exists:dosens,id',
            'judul'          => 'required|string|max:255',
            'bidang'         => 'required|string|max:255',
            'tanggal_mulai'  => 'required|date',
            'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
            'status'         => 'required|string|max:50',
            'tahun'          => 'required|integer',
            'mahasiswa_id'   => 'nullable|exists:mahasiswas,id',
            'anggota_dosen'  => 'nullable|array',
            'anggota_dosen.*'=> 'exists:dosens,id',
        ]);

        $penelitian->update([
            'ketua_dosen_id' => $validated['ketua_dosen_id'],
            'judul'          => $validated['judul'],
            'bidang'         => $validated['bidang'],
            'tanggal_mulai'  => $validated['tanggal_mulai'],
            'tanggal_selesai'=> $validated['tanggal_selesai'] ?? null,
            'status'         => $validated['status'],
            'tahun'          => $validated['tahun'],
            'mahasiswa_id'   => $validated['mahasiswa_id'] ?? null,
        ]);

        if ($request->filled('anggota_dosen')) {
            $penelitian->anggotaDosens()->sync($request->anggota_dosen);
        } else {
            $penelitian->anggotaDosens()->detach();
        }

        return redirect()
            ->route('penelitian.index')
            ->with('success', 'Data penelitian berhasil diperbarui.');
    }

    /* =======================
       DELETE
       ======================= */
    public function destroy(Penelitian $penelitian)
    {
        $penelitian->anggotaDosens()->detach();
        $penelitian->delete();

        return redirect()
            ->route('penelitian.index')
            ->with('success', 'Data penelitian berhasil dihapus.');
    }

    /* =======================
       EXPORT EXCEL
       ======================= */
    public function exportExcel()
    {
        return Excel::download(
            new PenelitianExport,
            'data_penelitian.xlsx'
        );
    }

    /* =======================
       EXPORT CSV (LEGACY)
       ======================= */
    public function export(): StreamedResponse
    {
        $table = (new Penelitian())->getTable();
        $columns = Schema::getColumnListing($table);
        $filename = 'penelitian-' . now()->format('Ymd_His') . '.csv';

        $callback = function () use ($columns) {
            $out = fopen('php://output', 'w');
            fputcsv($out, $columns);

            Penelitian::chunk(200, function ($rows) use ($out, $columns) {
                foreach ($rows as $row) {
                    $line = [];
                    foreach ($columns as $col) {
                        $line[] = data_get($row, $col);
                    }
                    fputcsv($out, $line);
                }
            });

            fclose($out);
        };

        return response()->stream($callback, 200, [
            'Content-Type'        => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
