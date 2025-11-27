<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PBB extends Model
{
    use HasFactory;

    protected $table = 'pbb';

    protected $fillable = [
        'nop',
        'nik_pemilik',
        'nama_pemilik',
        'alamat_objek',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'luas_tanah',
        'luas_bangunan',
        'status_tanah',
        'status_bangunan',
        'jenis_bangunan',
        'tahun_perolehan',
        'nilai_pajak_tahun_ini',
        'status_pembayaran',
        'keterangan',
    ];

    protected $casts = [
        'tahun_perolehan' => 'integer',
        'nilai_pajak_tahun_ini' => 'integer',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'nik_pemilik', 'nik');
    }
}
