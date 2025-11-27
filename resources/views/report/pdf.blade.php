<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kependudukan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .header p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }

        .date-info {
            text-align: right;
            font-size: 11px;
            margin-bottom: 20px;
            color: #666;
        }

        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .section-title {
            background-color: #667eea;
            color: white;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #f5f5f5;
            border-bottom: 2px solid #ddd;
        }

        table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
            border: 1px solid #ddd;
        }

        table td {
            padding: 8px;
            font-size: 11px;
            border: 1px solid #ddd;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .summary-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .summary-item {
            display: table-cell;
            width: 33.33%;
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
            background-color: #f5f5f5;
        }

        .summary-item.last {
            border-right: none;
        }

        .summary-label {
            font-size: 11px;
            color: #666;
            margin-bottom: 5px;
        }

        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .status-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .status-item {
            display: table-cell;
            width: 33.33%;
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .status-label {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .status-count {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .status-amount {
            font-size: 12px;
            color: #666;
        }

        .lunas { border-left: 4px solid #28a745; }
        .belum { border-left: 4px solid #dc3545; }
        .cicilan { border-left: 4px solid #ffc107; }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .page-break {
            page-break-after: always;
        }

        @media print {
            body { margin: 0; padding: 0; }
            .section { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📄 LAPORAN KEPENDUDUKAN RAKA</h1>
        <p>Sistem Manajemen Data Penduduk dan Pajak Bumi & Bangunan</p>
        <p style="font-size: 11px; margin-top: 10px;">Desa/Kelurahan - Kecamatan - Kabupaten</p>
    </div>

    <div class="date-info">
        Laporan dibuat: {{ date('d F Y H:i:s') }}
    </div>

    <!-- Section 1: Ringkasan Data -->
    <div class="section">
        <div class="section-title">📊 RINGKASAN DATA UMUM</div>
        
        <table>
            <tr>
                <td style="width: 50%;">Total Data Warga Terdaftar</td>
                <td style="width: 50%; font-weight: bold; font-size: 14px;">{{ $totalWarga }} Warga</td>
            </tr>
            <tr>
                <td>Total Data Objek Pajak (PBB)</td>
                <td style="font-weight: bold; font-size: 14px;">{{ $totalPBB }} Objek</td>
            </tr>
            <tr>
                <td>Total Nilai Pajak Tahun Ini</td>
                <td style="font-weight: bold; font-size: 14px;">Rp{{ number_format($totalPajakTahunIni, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <!-- Section 2: Status Pembayaran -->
    <div class="section">
        <div class="section-title">💳 STATUS PEMBAYARAN PBB</div>
        
        <div class="status-grid">
            <div class="status-item lunas">
                <div class="status-label">✅ LUNAS</div>
                <div class="status-count">{{ $statusLunas }}</div>
                <div class="status-amount">Rp{{ number_format($pajakLunas, 0, ',', '.') }}</div>
            </div>
            <div class="status-item belum">
                <div class="status-label">❌ BELUM LUNAS</div>
                <div class="status-count">{{ $statusBelumLunas }}</div>
                <div class="status-amount">Rp{{ number_format($pajakBelumLunas, 0, ',', '.') }}</div>
            </div>
            <div class="status-item cicilan">
                <div class="status-label">⏳ CICILAN</div>
                <div class="status-count">{{ $statusCicilan }}</div>
                <div class="status-amount">Rp{{ number_format($pajakCicilan, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <!-- Section 3: Statistik -->
    <div class="section">
        <div class="section-title">📈 STATISTIK PEMBAYARAN</div>
        
        <table>
            <tr>
                <td style="width: 50%;">Persentase Pembayaran Lunas</td>
                <td style="width: 50%; font-weight: bold;">{{ $totalPBB > 0 ? round(($statusLunas / $totalPBB) * 100) : 0 }}%</td>
            </tr>
            <tr>
                <td>Rata-rata Nilai Pajak Per Objek</td>
                <td style="font-weight: bold;">Rp{{ $totalPBB > 0 ? number_format($totalPajakTahunIni / $totalPBB, 0, ',', '.') : 0 }}</td>
            </tr>
            <tr>
                <td>Objek Pajak Menunggu Pembayaran</td>
                <td style="font-weight: bold;">{{ $statusBelumLunas }} Objek</td>
            </tr>
        </table>
    </div>

    <!-- Section 4: Detail PBB -->
    <div class="section page-break">
        <div class="section-title">📋 DETAIL SEMUA DATA PBB</div>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NOP</th>
                    <th>Nama Pemilik</th>
                    <th>Alamat</th>
                    <th>Luas Tanah</th>
                    <th>Luas Bangunan</th>
                    <th>Nilai Pajak</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pbbData as $index => $pbb)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pbb->nop }}</td>
                    <td>{{ $pbb->nama_pemilik }}</td>
                    <td>{{ $pbb->alamat_objek }}</td>
                    <td>{{ $pbb->luas_tanah }} m²</td>
                    <td>{{ $pbb->luas_bangunan }} m²</td>
                    <td>Rp{{ number_format($pbb->nilai_pajak_tahun_ini, 0, ',', '.') }}</td>
                    <td>{{ $pbb->status_pembayaran }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data PBB</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Laporan ini dihasilkan oleh Sistem Manajemen Kependudukan Raka</p>
        <p>{{ date('d F Y') }}</p>
    </div>
</body>
</html>
