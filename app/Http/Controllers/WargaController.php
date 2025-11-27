<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warga = Warga::paginate(10);
        return view('warga.index', compact('warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nik' => 'required|string|unique:warga|size:16',
                'no_kk' => 'required|string|unique:warga|size:16',
                'nama_lengkap' => 'required|string|max:100',
                'alamat' => 'required|string|max:255',
                'rt' => 'required|integer|min:1|max:99',
                'rw' => 'required|integer|min:1|max:99',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'tempat_lahir' => 'required|string|max:100',
                'tanggal_lahir' => 'required|date|before:today',
                'no_telp' => 'nullable|string|max:20',
                'agama' => 'required|in:Islam,Kristen,Hindu,Buddha,Kong Hu Cu',
            ]);

            Warga::create($validated);

            return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Warga $warga)
    {
        return view('warga.show', compact('warga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warga $warga)
    {
        try {
            $validated = $request->validate([
                'nik' => 'required|string|unique:warga,nik,' . $warga->nik . ',nik|size:16',
                'no_kk' => 'required|string|unique:warga,no_kk,' . $warga->no_kk . ',no_kk|size:16',
                'nama_lengkap' => 'required|string|max:100',
                'alamat' => 'required|string|max:255',
                'rt' => 'required|integer|min:1|max:99',
                'rw' => 'required|integer|min:1|max:99',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'tempat_lahir' => 'required|string|max:100',
                'tanggal_lahir' => 'required|date|before:today',
                'no_telp' => 'nullable|string|max:20',
                'agama' => 'required|in:Islam,Kristen,Hindu,Buddha,Kong Hu Cu',
            ]);

            $warga->update($validated);

            return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus');
    }
}
