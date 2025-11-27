<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    /** @use HasFactory<\Database\Factories\WargaFactory> */
    use HasFactory;

    protected $table = 'warga';

    protected $fillable = [
        'nik',
        'no_kk',
        'nama_lengkap',
        'alamat',
        'rt',
        'rw',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telp',
        'agama'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
