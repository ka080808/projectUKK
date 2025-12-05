<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Warga</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background-color: #667eea;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .print-button button:hover {
            background-color: #764ba2;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }

        table td {
            padding: 10px 12px;
            border: 1px solid #ddd;
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

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-active {
            background-color: #d4edda;
            color: #155724;
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
            <h1>📋 Laporan Data Warga</h1>
            <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
            <p>Total Data: {{ $warga->count() }} Warga</p>
        </div>

        <!-- Table -->
        @if($warga->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>No KK</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>Agama</th>
                        <th>Alamat</th>
                        <th>RT/RW</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($warga as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $item->nik }}</strong></td>
                            <td>{{ $item->no_kk }}</td>
                            <td>{{ $item->nama_lengkap }}</td>
                            <td>
                                @if($item->jenis_kelamin === 'Laki-laki')
                                    👨 Laki-laki
                                @else
                                    👩 Perempuan
                                @endif
                            </td>
                            <td>{{ date('d-m-Y', strtotime($item->tanggal_lahir)) }}</td>
                            <td>{{ $item->tempat_lahir }}</td>
                            <td>{{ $item->agama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->rt }}/{{ $item->rw }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">
                <p>📭 Tidak ada data warga untuk ditampilkan</p>
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
