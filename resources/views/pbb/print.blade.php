<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data PBB</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f5f5f5;
        }

        @media print {
            body {
                background: white;
            }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            border-radius: 8px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .print-button {
            margin-bottom: 20px;
            text-align: right;
        }

        .print-button button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .print-button button:hover {
            background-color: #c0392b;
        }

        @media print {
            .print-button {
                display: none;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        table thead {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
            font-size: 12px;
        }

        table td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            font-size: 12px;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #f0f0f0;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            border-top: 2px solid #ddd;
            font-size: 12px;
            color: #666;
        }

        @media print {
            .container {
                padding: 0;
            }
            table {
                box-shadow: none;
            }
        }

        .status-lunas {
            background-color: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            font-size: 11px;
        }

        .status-belum {
            background-color: #f8d7da;
            color: #721c24;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            font-size: 11px;
        }

        .status-cicilan {
            background-color: #fff3cd;
            color: #856404;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            font-size: 11px;
        }

        .rupiah {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Print Button -->
        <div class="print-button">
            <button onclick="window.print()">🖨️ Cetak / Print</button>
        </div>

        <!-- Header -->
        <div class="header">
            <h1>💰 Laporan Data Pajak Bumi dan Bangunan (PBB)</h1>
            <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
            <p>Total Data: {{ $pbb->count() }} Objek Pajak</p>
        </div>

        <!-- Summary Cards -->
        @if($pbb->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 30px;">
                <div style="background: white; padding: 15px; border-radius: 8px; border-left: 4px solid #27ae60;">
                    <p style="color: #666; font-size: 12px; margin-bottom: 5px;">✅ Lunas</p>
                    <p style="font-size: 18px; font-weight: bold;">{{ $pbb->where('status_pembayaran', 'Lunas')->count() }} Data</p>
                    <p style="color: #27ae60; font-size: 12px;">Rp {{ number_format($pbb->where('status_pembayaran', 'Lunas')->sum('nilai_pajak_tahun_ini'), 0, ',', '.') }}</p>
                </div>
                <div style="background: white; padding: 15px; border-radius: 8px; border-left: 4px solid #e74c3c;">
                    <p style="color: #666; font-size: 12px; margin-bottom: 5px;">❌ Belum Lunas</p>
                    <p style="font-size: 18px; font-weight: bold;">{{ $pbb->where('status_pembayaran', 'Belum Lunas')->count() }} Data</p>
                    <p style="color: #e74c3c; font-size: 12px;">Rp {{ number_format($pbb->where('status_pembayaran', 'Belum Lunas')->sum('nilai_pajak_tahun_ini'), 0, ',', '.') }}</p>
                </div>
                <div style="background: white; padding: 15px; border-radius: 8px; border-left: 4px solid #f39c12;">
                    <p style="color: #666; font-size: 12px; margin-bottom: 5px;">⏳ Cicilan</p>
                    <p style="font-size: 18px; font-weight: bold;">{{ $pbb->where('status_pembayaran', 'Cicilan')->count() }} Data</p>
                    <p style="color: #f39c12; font-size: 12px;">Rp {{ number_format($pbb->where('status_pembayaran', 'Cicilan')->sum('nilai_pajak_tahun_ini'), 0, ',', '.') }}</p>
                </div>
            </div>
        @endif

        <!-- Table -->
        @if($pbb->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NOP</th>
                        <th>NIK Pemilik</th>
                        <th>Nama Pemilik</th>
                        <th>Alamat Objek</th>
                        <th>Luas Tanah</th>
                        <th>Luas Bangunan</th>
                        <th>Nilai Pajak</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pbb as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $item->nop }}</strong></td>
                            <td>{{ $item->nik_pemilik }}</td>
                            <td>{{ $item->nama_pemilik }}</td>
                            <td>{{ $item->alamat_objek }}</td>
                            <td style="text-align: right;">{{ number_format($item->luas_tanah) }} m²</td>
                            <td style="text-align: right;">{{ number_format($item->luas_bangunan) }} m²</td>
                            <td class="rupiah">Rp {{ number_format($item->nilai_pajak_tahun_ini, 0, ',', '.') }}</td>
                            <td>
                                @if($item->status_pembayaran === 'Lunas')
                                    <span class="status-lunas">✅ Lunas</span>
                                @elseif($item->status_pembayaran === 'Belum Lunas')
                                    <span class="status-belum">❌ Belum Lunas</span>
                                @else
                                    <span class="status-cicilan">⏳ Cicilan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Summary Total -->
            <div style="background: white; padding: 15px; border-radius: 8px; text-align: right; margin-top: 20px;">
                <p style="font-size: 14px;"><strong>Total Nilai Pajak Tahun Ini:</strong> 
                    <span style="font-size: 18px; color: #e74c3c; font-weight: bold;">
                        Rp {{ number_format($pbb->sum('nilai_pajak_tahun_ini'), 0, ',', '.') }}
                    </span>
                </p>
            </div>
        @else
            <div class="no-data">
                <p>📭 Tidak ada data PBB untuk ditampilkan</p>
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p>Dokumen ini adalah laporan resmi dari Sistem Informasi Kependudukan</p>
            <p>&copy; {{ date('Y') }} - Semua hak dilindungi</p>
        </div>
    </div>
</body>
</html>
