<?php

namespace App\Http\Controllers;

use App\Models\Pengabdian;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class PengabdianController extends Controller
{
    public function index()
    {
        $pengabdians = Pengabdian::with(['ketuaDosen', 'mahasiswa'])->latest()->get();
        return view('pengabdian.index', compact('pengabdians'));
    }

    public function create()
    {
        return view('pengabdian.create', [
            'dosens' => Dosen::all(),
            'mahasiswas' => Mahasiswa::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ketua_dosen_id' => 'required|exists:dosens,id',
            'judul' => 'required|string',
            'bidang' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date',
            'status' => 'required',
            'tahun' => 'required|integer',
            'mahasiswa_id' => 'nullable|exists:mahasiswas,id',
            'anggota_dosen' => 'nullable|array',
        ]);

        $pengabdian = Pengabdian::create($validated);

        if ($request->filled('anggota_dosen')) {
            $pengabdian->anggotaDosens()->sync($request->anggota_dosen);
        }

        return redirect()->route('pengabdian.index')
            ->with('success', 'Data pengabdian berhasil ditambahkan');
    }

    public function edit(Pengabdian $pengabdian)
    {
        return view('pengabdian.edit', [
            'pengabdian' => $pengabdian,
            'dosens' => Dosen::all(),
            'mahasiswas' => Mahasiswa::all(),
            'anggota' => $pengabdian->anggotaDosens->pluck('id')->toArray(),
        ]);
    }

    public function update(Request $request, Pengabdian $pengabdian)
    {
        $validated = $request->validate([
            'ketua_dosen_id' => 'required|exists:dosens,id',
            'judul' => 'required|string',
            'bidang' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date',
            'status' => 'required',
            'tahun' => 'required|integer',
            'mahasiswa_id' => 'nullable|exists:mahasiswas,id',
            'anggota_dosen' => 'nullable|array',
        ]);

        $pengabdian->update($validated);
        $pengabdian->anggotaDosens()->sync($request->anggota_dosen ?? []);

        return redirect()->route('pengabdian.index')
            ->with('success', 'Data pengabdian berhasil diperbarui');
    }

    public function destroy(Pengabdian $pengabdian)
    {
        $pengabdian->delete();
        return redirect()->route('pengabdian.index')
            ->with('success', 'Data pengabdian berhasil dihapus');
    }
}
