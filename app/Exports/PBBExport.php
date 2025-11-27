<?php

namespace App\Exports;

use App\Models\PBB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PBBExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    public function query()
    {
        return PBB::query();
    }

    public function headings(): array
    {
        return [
            'No',
            'NOP',
            'NIK Pemilik',
            'Nama Pemilik',
            'Alamat Objek',
            'RT',
            'RW',
            'Kelurahan',
            'Kecamatan',
            'Kabupaten',
            'Provinsi',
            'Luas Tanah',
            'Luas Bangunan',
            'Status Tanah',
            'Status Bangunan',
            'Jenis Bangunan',
            'Tahun Perolehan',
            'Nilai Pajak',
            'Status Pembayaran',
            'Keterangan',
        ];
    }

    public function map($row): array
    {
        static $number = 0;
        $number++;

        return [
            $number,
            $row->nop,
            $row->nik_pemilik,
            $row->nama_pemilik,
            $row->alamat_objek,
            $row->rt,
            $row->rw,
            $row->kelurahan,
            $row->kecamatan,
            $row->kabupaten,
            $row->provinsi,
            $row->luas_tanah,
            $row->luas_bangunan,
            $row->status_tanah,
            $row->status_bangunan,
            $row->jenis_bangunan,
            $row->tahun_perolehan,
            $row->nilai_pajak_tahun_ini,
            $row->status_pembayaran,
            $row->keterangan,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '667EEA']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            ],
        ];
    }
}
