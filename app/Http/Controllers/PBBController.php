<?php

namespace App\Http\Controllers;

use App\Models\PBB;
use App\Models\Warga;
use Illuminate\Http\Request;

class PBBController extends Controller
{
    /**
     * Display a listing of PBB records
     */
    public function index()
    {
        $pbb = PBB::paginate(10);
        return view('pbb.index', compact('pbb'));
    }

    /**
     * Show the form for creating a new PBB record
     */
    public function create()
    {
        $warga = Warga::all();
        return view('pbb.create', compact('warga'));
    }

    /**
     * Store a newly created PBB record
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nop' => 'required|string|unique:pbb|size:18',
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
                'status_tanah' => 'required|in:Milik Sendiri,Sewa,Hibah',
                'status_bangunan' => 'required|in:Milik Sendiri,Sewa,Hibah',
                'jenis_bangunan' => 'required|in:Rumah Tinggal,Gedung,Pabrik,Toko,Gudang,Pertanian,Lainnya',
                'tahun_perolehan' => 'required|integer|min:1900|max:' . date('Y'),
                'nilai_pajak_tahun_ini' => 'required|integer|min:0',
                'status_pembayaran' => 'required|in:Lunas,Belum Lunas,Cicilan',
                'keterangan' => 'nullable|string|max:255',
            ], [
                'nop.required' => 'NOP harus diisi',
                'nop.unique' => 'NOP sudah terdaftar',
                'nop.size' => 'NOP harus 18 digit',
                'nik_pemilik.required' => 'NIK Pemilik harus diisi',
                'nik_pemilik.exists' => 'NIK Pemilik tidak ditemukan di data warga',
                'luas_tanah.required' => 'Luas tanah harus diisi',
                'nilai_pajak_tahun_ini.required' => 'Nilai pajak harus diisi',
            ]);

            PBB::create($validated);
            return redirect()->route('pbb.index')->with('success', 'Data PBB berhasil ditambahkan ✅');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing PBB record
     */
    public function edit(PBB $pbb)
    {
        $warga = Warga::all();
        return view('pbb.edit', compact('pbb', 'warga'));
    }

    /**
     * Update the PBB record
     */
    public function update(Request $request, PBB $pbb)
    {
        try {
            $validated = $request->validate([
                'nop' => 'required|string|unique:pbb,nop,' . $pbb->id . '|size:18',
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
                'status_tanah' => 'required|in:Milik Sendiri,Sewa,Hibah',
                'status_bangunan' => 'required|in:Milik Sendiri,Sewa,Hibah',
                'jenis_bangunan' => 'required|in:Rumah Tinggal,Gedung,Pabrik,Toko,Gudang,Pertanian,Lainnya',
                'tahun_perolehan' => 'required|integer|min:1900|max:' . date('Y'),
                'nilai_pajak_tahun_ini' => 'required|integer|min:0',
                'status_pembayaran' => 'required|in:Lunas,Belum Lunas,Cicilan',
                'keterangan' => 'nullable|string|max:255',
            ]);

            $pbb->update($validated);
            return redirect()->route('pbb.index')->with('success', 'Data PBB berhasil diperbarui ✅');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Delete PBB record
     */
    public function destroy(PBB $pbb)
    {
        $pbb->delete();
        return redirect()->route('pbb.index')->with('success', 'Data PBB berhasil dihapus ✅');
    }
}
