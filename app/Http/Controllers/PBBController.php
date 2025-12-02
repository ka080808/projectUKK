<?php

namespace App\Http\Controllers;

use App\Models\PBB;
use App\Models\Warga;
use Illuminate\Http\Request;

class PBBController extends Controller
{
    public function index()
    {
        $pbb = PBB::paginate(10);
        return view('pbb.index', compact('pbb'));
    }

    public function create()
    {
        $warga = Warga::all();
        return view('pbb.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nop' => 'required|string|size:18|unique:pbb',
            'nik_pemilik' => 'required|string|size:16|exists:warga,nik',
            'nama_pemilik' => 'required|string|max:100',
            'alamat_objek' => 'required|string|max:255',
            'rt' => 'required|integer|min:1|max:99',
            'rw' => 'required|integer|min:1|max:99',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'luas_tanah' => 'required|integer|min:1',
            'luas_bangunan' => 'required|integer|min:0',
            'status_tanah' => 'required',
            'status_bangunan' => 'required',
            'jenis_bangunan' => 'required',
            'tahun_perolehan' => 'required|integer|min:1900|max:' . date('Y'),
            'nilai_pajak_tahun_ini' => 'required|integer|min:0',
            'status_pembayaran' => 'required',
            'keterangan' => 'nullable|string|max:255',
        ]);

        PBB::create($validated);

        return redirect()->route('pbb.index')->with('success', 'Data PBB berhasil ditambahkan.');
    }

    public function edit(PBB $pbb)
    {
        $warga = Warga::all();
        return view('pbb.edit', compact('pbb', 'warga'));
    }

    public function update(Request $request, PBB $pbb)
    {
        $validated = $request->validate([
            'nop' => 'required|string|size:18|unique:pbb,nop,' . $pbb->id,
            'nik_pemilik' => 'required|string|size:16|exists:warga,nik',
            'nama_pemilik' => 'required|string|max:100',
            'alamat_objek' => 'required|string|max:255',
            'rt' => 'required|integer|min:1|max:99',
            'rw' => 'required|integer|min:1|max:99',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'luas_tanah' => 'required|integer|min:1',
            'luas_bangunan' => 'required|integer|min:0',
            'status_tanah' => 'required',
            'status_bangunan' => 'required',
            'jenis_bangunan' => 'required',
            'tahun_perolehan' => 'required|integer|min:1900|max:' . date('Y'),
            'nilai_pajak_tahun_ini' => 'required|integer|min:0',
            'status_pembayaran' => 'required',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $pbb->update($validated);

        return redirect()->route('pbb.index')->with('success', 'Data PBB berhasil diperbarui.');
    }

    public function destroy(PBB $pbb)
    {
        $pbb->delete();
        return redirect()->route('pbb.index')->with('success', 'Data berhasil dihapus.');
    }
}
