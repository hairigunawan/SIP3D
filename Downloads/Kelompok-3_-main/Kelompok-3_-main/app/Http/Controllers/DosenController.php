<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Exports\DosenExport;
use Maatwebsite\Excel\Facades\Excel;

class DosenController extends Controller
{
    // Dashboard (opsional)
    public function dashboard()
    {
        $dosens = Dosen::all();
        return view('dosen.dashboard', compact('dosens'));
    }

    // Index: tampilkan data
    public function index()
    {
        // gunakan paginate jika dataset besar: Dosen::orderBy('nama')->paginate(10)
        $dosen = Dosen::orderBy('nama')->get();
        return view('dosen.index', compact('dosen'));
    }

    // Form tambah
    public function create()
    {
        $dosen = new Dosen();
        $button = 'Simpan';
        return view('dosen.create', compact('dosen', 'button'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => 'required|unique:dosens,nidn',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:dosens,email',
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'status' => 'required|string',
        ]);

        Dosen::create($validated);

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    // Form edit
    public function edit(Dosen $dosen)
    {
        $button = 'Update';
        return view('dosen.create', compact('dosen', 'button')); // reuse form
    }

    // Update data
    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nidn' => 'required|unique:dosens,nidn,' . $dosen->id,
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:dosens,email,' . $dosen->id,
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'status' => 'required|string',
        ]);

        $dosen->update($validated);

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    // Hapus data
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus.');
    }

    // Export Excel
    public function export()
    {
        $fileName = 'Data_Dosen_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new DosenExport, $fileName);
    }
}
