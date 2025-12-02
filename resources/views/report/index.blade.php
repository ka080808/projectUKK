<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Kependudukan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .sidebar .logo {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 8px;
        }

        .sidebar .user-info {
            background-color: rgba(255,255,255,0.15);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .sidebar .user-info strong {
            display: block;
            font-size: 14px;
        }

        .sidebar .status {
            font-size: 12px;
            margin-top: 5px;
            opacity: 0.9;
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sidebar nav a {
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            font-size: 14px;
        }

        .sidebar nav a:hover {
            background-color: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }

        .sidebar nav a.active {
            background-color: rgba(255,255,255,0.3);
            font-weight: bold;
            border-left: 3px solid white;
            padding-left: 12px;
        }

        .logout-btn {
            margin-top: 20px;
            width: 100%;
            background-color: #e74c3c !important;
            color: white !important;
            padding: 10px !important;
            border: none !important;
            border-radius: 6px !important;
            cursor: pointer !important;
            font-size: 14px !important;
            transition: background-color 0.3s !important;
        }

        .logout-btn:hover {
            background-color: #c0392b !important;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .report-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-left: 4px solid #667eea;
        }

        .report-card h3 {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .report-card .value {
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .report-card .detail {
            font-size: 12px;
            color: #95a5a6;
        }

        .status-section {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .status-section h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .status-box {
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .status-box.lunas {
            background-color: #d4edda;
            border-left: 4px solid #28a745;
        }

        .status-box.belum {
            background-color: #f8d7da;
            border-left: 4px solid #dc3545;
        }

        .status-box.cicilan {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
        }

        .status-box .label {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .status-box .count {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .status-box .amount {
            font-size: 14px;
            font-weight: bold;
        }

        .status-box.lunas .label { color: #155724; }
        .status-box.lunas .count { color: #155724; }
        .status-box.lunas .amount { color: #155724; }

        .status-box.belum .label { color: #721c24; }
        .status-box.belum .count { color: #721c24; }
        .status-box.belum .amount { color: #721c24; }

        .status-box.cicilan .label { color: #856404; }
        .status-box.cicilan .count { color: #856404; }
        .status-box.cicilan .amount { color: #856404; }

        .export-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .export-section h2 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .export-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-pdf {
            background-color: #e74c3c;
            color: white;
        }

        .btn-pdf:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
        }

        .btn-excel {
            background-color: #27ae60;
            color: white;
        }

        .btn-excel:hover {
            background-color: #229954;
            transform: translateY(-2px);
        }

        .btn-print {
            background-color: #3498db;
            color: white;
        }

        .btn-print:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            background-color: #e8f4f8;
            border-left: 4px solid #3498db;
            color: #0c5460;
        }

        h2 {
            font-size: 20px;
            margin: 20px 0 15px 0;
            color: #2c3e50;
        }

        @media print {
            .sidebar, .header, .export-section, .logout-btn {
                display: none;
            }
            .content {
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">📊 Kependudukan dan PBB</div>
            <div class="user-info">
                <strong>{{ Auth::user()->name }}</strong>
                <div class="status">🟢 Online</div>
            </div>
            <nav>
                <a href="{{ route('dashboard') }}">📈 Dashboard</a>
                <a href="{{ route('warga.create') }}">➕ Input Data Warga</a>
                <a href="{{ route('warga.index') }}">👥 Lihat Data Warga</a>
                <a href="{{ route('pbb.create') }}">➕ Input Data PBB</a>
                <a href="{{ route('pbb.index') }}">🏠 Lihat Data PBB</a>
                <a href="{{ route('report.index') }}" class="active">📄 Laporan</a>
            </nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">🔓 Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>📄 Laporan Kependudukan</h1>
                <p>Laporan data warga dan pajak bumi & bangunan</p>
            </div>

            <div class="content">
                @if ($message = Session::get('info'))
                    <div class="alert">
                        ℹ️ {{ $message }}
                    </div>
                @endif

                <!-- Summary Cards -->
                <h2>📊 Ringkasan Data</h2>
                <div class="report-grid">
                    <div class="report-card">
                        <h3>Total Data Warga</h3>
                        <div class="value">{{ $totalWarga }}</div>
                        <div class="detail">Jumlah seluruh warga terdaftar</div>
                    </div>

                    <div class="report-card">
                        <h3>Total Data PBB</h3>
                        <div class="value">{{ $totalPBB }}</div>
                        <div class="detail">Jumlah seluruh objek pajak</div>
                    </div>

                    <div class="report-card">
                        <h3>Total Pajak Tahun Ini</h3>
                        <div class="value">Rp{{ number_format($totalPajakTahunIni, 0, ',', '.') }}</div>
                        <div class="detail">Nilai pajak dari semua objek</div>
                    </div>
                </div>

                <!-- Payment Status Report -->
                <div class="status-section">
                    <h2>💳 Laporan Status Pembayaran PBB</h2>
                    <div class="status-grid">
                        <div class="status-box lunas">
                            <div class="label">✅ Lunas</div>
                            <div class="count">{{ $statusLunas }}</div>
                            <div class="amount">Rp{{ number_format($pajakLunas, 0, ',', '.') }}</div>
                        </div>

                        <div class="status-box belum">
                            <div class="label">❌ Belum Lunas</div>
                            <div class="count">{{ $statusBelumLunas }}</div>
                            <div class="amount">Rp{{ number_format($pajakBelumLunas, 0, ',', '.') }}</div>
                        </div>

                        <div class="status-box cicilan">
                            <div class="label">⏳ Cicilan</div>
                            <div class="count">{{ $statusCicilan }}</div>
                            <div class="amount">Rp{{ number_format($pajakCicilan, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="status-section">
                    <h2>📈 Statistik Pembayaran</h2>
                    <div class="status-grid">
                        <div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #667eea;">
                            <div style="color: #7f8c8d; font-size: 12px; margin-bottom: 10px;">Persentase Pembayaran Lunas</div>
                            <div style="font-size: 28px; font-weight: bold; color: #667eea;">
                                {{ $totalPBB > 0 ? round(($statusLunas / $totalPBB) * 100) : 0 }}%
                            </div>
                        </div>

                        <div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #764ba2;">
                            <div style="color: #7f8c8d; font-size: 12px; margin-bottom: 10px;">Rata-rata Nilai Pajak Per Objek</div>
                            <div style="font-size: 28px; font-weight: bold; color: #764ba2;">
                                Rp{{ $totalPBB > 0 ? number_format($totalPajakTahunIni / $totalPBB, 0, ',', '.') : 0 }}
                            </div>
                        </div>

                        <div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #e74c3c;">
                            <div style="color: #7f8c8d; font-size: 12px; margin-bottom: 10px;">Objek Pajak Menunggu Pembayaran</div>
                            <div style="font-size: 28px; font-weight: bold; color: #e74c3c;">
                                {{ $statusBelumLunas }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Export Section -->
                <div class="export-section">
                    <h2>📥 Ekspor Laporan</h2>
                    <div class="export-buttons">
                        <button class="btn btn-print" onclick="window.print();">
                            🖨️ Cetak (Print)
                        </button>
                        <form method="POST" action="{{ route('report.export-pdf') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-pdf">
                                📄 Download PDF
                            </button>
                        </form>
                        <form method="POST" action="{{ route('report.export-excel') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-excel">
                                📊 Download Excel
                            </button>
                        </form>
                    </div>
                </div>

                <div class="alert" style="margin-top: 20px;">
                    💡 <strong>Tips:</strong> Klik tombol "Cetak (Print)" untuk mencetak laporan atau gunakan Ctrl+P. Tombol Download PDF dan Excel bisa digunakan untuk mengekspor laporan ke format lain.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
