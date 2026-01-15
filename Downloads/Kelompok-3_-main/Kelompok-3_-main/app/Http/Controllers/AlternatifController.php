<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;

class AlternatifController extends Controller
{
    // index: list + search + paginate
    public function index(Request $request)
    {
        $q = $request->get('q');
        $query = Prestasi::query();

        if ($q) {
            $query->where(function($w) use ($q) {
                $w->where('nama', 'like', "%{$q}%")
                  ->orWhere('nama_prestasi', 'like', "%{$q}%")
                  ->orWhere('code', 'like', "%{$q}%");
            });
        }

        $prestasis = $query->orderBy('id')->paginate(10);
        return view('TPK.alternatives', compact('prestasis'));
    }

    // show create form
    public function create()
    {
        return view('TPK.create_alternative');
    }

    // store new alternative
    public function store(Request $r)
    {
        $data = $r->validate([
            'code'=>'nullable|string|max:50',
            'nama'=>'required|string|max:255',
            'skor_sinta'=>'nullable|numeric',
            'skor_sinta_3yr'=>'nullable|numeric',
            'jumlah_buku'=>'nullable|integer',
            'jumlah_hibah'=>'nullable|integer',
            'publikasi_scholar'=>'nullable|integer',
            'nama_prestasi'=>'nullable|string|max:255',
            'tingkat'=>'nullable|string|max:255',
            'penyelenggara'=>'nullable|string|max:255',
            'tanggal'=>'nullable|date',
            'keterangan'=>'nullable|string',
        ]);

        // ---------- MAPPING: jika form mengirim 'nama' gunakan juga untuk 'nama_prestasi' ----------
        // ini mencegah error bila kolom nama_prestasi di DB wajib/nullable tetapi form hanya mengirim 'nama'
        if (isset($data['nama']) && (empty($data['nama_prestasi']) || !array_key_exists('nama_prestasi', $data))) {
            $data['nama_prestasi'] = $data['nama'];
            // optional: jika tidak ingin menyimpan kolom 'nama' juga, uncomment baris berikut:
            // unset($data['nama']);
        }
        // ------------------------------------------------------------------------------------------

        Prestasi::create($data);
        return redirect()->route('tpk.alternatif.index')->with('success','Alternatif ditambahkan.');
    }

    // show edit form
    public function edit($id)
    {
        $p = Prestasi::findOrFail($id);
        return view('TPK.edit_alternative', compact('p'));
    }

    // update
    public function update(Request $r, $id)
    {
        $data = $r->validate([
            'code'=>'nullable|string|max:50',
            'nama'=>'required|string|max:255',
            'skor_sinta'=>'nullable|numeric',
            'skor_sinta_3yr'=>'nullable|numeric',
            'jumlah_buku'=>'nullable|integer',
            'jumlah_hibah'=>'nullable|integer',
            'publikasi_scholar'=>'nullable|integer',
            'nama_prestasi'=>'nullable|string|max:255',
            'tingkat'=>'nullable|string|max:255',
            'penyelenggara'=>'nullable|string|max:255',
            'tanggal'=>'nullable|date',
            'keterangan'=>'nullable|string',
        ]);

        $p = Prestasi::findOrFail($id);
        $p->update($data);

        return redirect()->route('tpk.alternatif.index')->with('success','Alternatif diperbarui.');
    }

    // delete
    public function destroy($id)
    {
        Prestasi::findOrFail($id)->delete();
        return redirect()->route('tpk.alternatif.index')->with('success','Alternatif dihapus.');
    }
}
