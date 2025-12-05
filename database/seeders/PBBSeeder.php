<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PBB;

class PBBSeeder extends Seeder
{
    public function run(): void
    {
        // Get first warga for testing
        $warga = \App\Models\Warga::first();
        
        if ($warga) {
            PBB::firstOrCreate(
                ['nop' => '123456789012345678'],
                [
                    'nik_pemilik' => $warga->nik,
                    'nama_pemilik' => $warga->nama_lengkap ?? 'Test Owner',
                    'alamat_objek' => 'Jl. Raya No. 123',
                    'rt' => 5,
                    'rw' => 3,
                    'Desa' => 'Rancabango',
                    'kecamatan' => 'Tarogong Kaler',
                    'kabupaten' => 'Garut',
                    'provinsi' => 'Jawa Barat',
                    'luas_tanah' => 200,
                    'luas_bangunan' => 150,
                    'status_tanah' => 'Milik Sendiri',
                    'status_bangunan' => 'Milik Sendiri',
                    'jenis_bangunan' => 'Rumah Tinggal',
                    'tahun_perolehan' => 2020,
                    'nilai_pajak_tahun_ini' => 5000000,
                    'status_pembayaran' => 'Lunas',
                    'keterangan' => 'Data test PBB',
                ]
            );

            PBB::firstOrCreate(
                ['nop' => '234567890123456789'],
                [
                    'nik_pemilik' => $warga->nik,
                    'nama_pemilik' => 'Test Owner 2',
                    'alamat_objek' => 'Jl. Sudirman No. 456',
                    'rt' => 2,
                    'rw' => 4,
                    'desa' => 'Rancabango',
                    'kecamatan' => 'Tarogong Kaler',
                    'kabupaten' => 'Garut',
                    'provinsi' => 'Jawa Barat',
                    'luas_tanah' => 300,
                    'luas_bangunan' => 200,
                    'status_tanah' => 'Sewa',
                    'status_bangunan' => 'Sewa',
                    'jenis_bangunan' => 'Toko',
                    'tahun_perolehan' => 2021,
                    'nilai_pajak_tahun_ini' => 8000000,
                    'status_pembayaran' => 'Belum Lunas',
                    'keterangan' => 'Data test PBB kedua',
                ]
            );
        }
    }
}
