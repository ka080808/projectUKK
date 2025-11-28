<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kependudukan Raka</title>
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

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        .card.warga {
            border-left: 4px solid #3498db;
        }

        .card.pbb {
            border-left: 4px solid #e74c3c;
        }

        .card.total {
            border-left: 4px solid #f39c12;
        }

        .card .icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .card .title {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 5px;
        }

        .card .value {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
        }

        .card .subtitle {
            font-size: 12px;
            color: #95a5a6;
            margin-top: 10px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 30px;
        }

        .menu-item {
            background: white;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
            background: #f0f0f0;
        }

        .menu-item .icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .menu-item .name {
            font-size: 14px;
            font-weight: bold;
            color: #2c3e50;
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .status-item {
            text-align: center;
            padding: 15px;
            border-radius: 6px;
        }

        .status-item.lunas {
            background-color: #d4edda;
            color: #155724;
        }

        .status-item.cicilan {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-item.belum {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-item .count {
            font-size: 28px;
            font-weight: bold;
        }

        .status-item .label {
            font-size: 12px;
            margin-top: 5px;
        }

        h2 {
            font-size: 20px;
            margin: 30px 0 15px 0;
            color: #2c3e50;
        }

        .alert {
            background-color: #e8f4f8;
            border-left: 4px solid #3498db;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            color: #0c5460;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo"> Data Kependudukan</div>
            <div class="user-info">
                <strong>{{ Auth::user()->name }}</strong>
                <div class="status">🟢 Online</div>
            </div>
            <nav>
                <a href="{{ route('dashboard') }}" class="active">Halaman utama</a>
                <a href="{{ route('warga.create') }}">➕ Input Data Warga</a>
                <a href="{{ route('warga.index') }}">👥 Lihat Data Warga</a>
                <a href="{{ route('pbb.create') }}">➕ Input Data PBB</a>
                <a href="{{ route('pbb.index') }}">🏠 Lihat Data PBB</a>
                <a href="{{ route('report.index') }}">📄 Laporan</a>
            </nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">🔓 Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>Kependudukan dan PBB</h1>
                <p>Sistem Manajemen Data Penduduk dan Pajak Bumi & Bangunan</p>
            </div>

            <div class="content">
                <div class="alert">
                    ✅ Selamat datang di dashboard! Anda dapat mengelola semua data kependudukan dari sini.
                </div>

                <!-- Statistics Cards -->
                <h2>📈 Statistik Umum</h2>
                <div class="dashboard-grid">
                    <a href="{{ route('warga.index') }}" class="card warga" style="text-decoration: none; color: inherit;">
                        <div class="icon">👥</div>
                        <div class="title">Total Data Warga</div>
                        <div class="value">{{ $totalWarga }}</div>
                        <div class="subtitle">Klik untuk lihat detail</div>
                    </a>

                    <a href="{{ route('pbb.index') }}" class="card pbb" style="text-decoration: none; color: inherit;">
                        <div class="icon">🏠</div>
                        <div class="title">Total Data PBB</div>
                        <div class="value">{{ $totalPBB }}</div>
                        <div class="subtitle">Klik untuk lihat detail</div>
                    </a>

                    <div class="card total" style="cursor: default;">
                        <div class="icon">💰</div>
                        <div class="title">Total Pajak Tahun Ini</div>
                        <div class="value">Rp{{ number_format($totalPajakTahunIni, 0, ',', '.') }}</div>
                        <div class="subtitle">Semua data PBB</div>
                    </div>
                </div>

                <!-- Payment Status -->
                @if($totalPBB > 0)
                <h2>💳 Status Pembayaran PBB</h2>
                <div class="status-grid">
                    <div class="status-item lunas">
                        <div class="count">{{ $statusLunas }}</div>
                        <div class="label">✅ Lunas</div>
                    </div>
                    <div class="status-item cicilan">
                        <div class="count">{{ $statusCicilan }}</div>
                        <div class="label">⏳ Cicilan</div>
                    </div>
                    <div class="status-item belum">
                        <div class="count">{{ $statusBelumLunas }}</div>
                        <div class="label">❌ Belum Lunas</div>
                    </div>
                </div>
                @endif

                <!-- Quick Menu -->
                <h2>🚀 Menu Cepat</h2>
                <div class="menu-grid">
                    <a href="{{ route('warga.create') }}" class="menu-item" style="text-decoration: none; color: inherit;">
                        <div class="icon">➕</div>
                        <div class="name">Input Warga Baru</div>
                    </a>

                    <a href="{{ route('pbb.create') }}" class="menu-item" style="text-decoration: none; color: inherit;">
                        <div class="icon">🏘️</div>
                        <div class="name">Input PBB Baru</div>
                    </a>

                    <a href="{{ route('warga.index') }}" class="menu-item" style="text-decoration: none; color: inherit;">
                        <div class="icon">👥</div>
                        <div class="name">Kelola Warga</div>
                    </a>

                    <a href="{{ route('pbb.index') }}" class="menu-item" style="text-decoration: none; color: inherit;">
                        <div class="icon">🏠</div>
                        <div class="name">Kelola PBB</div>
                    </a>

                    <a href="{{ route('report.index') }}" class="menu-item" style="text-decoration: none; color: inherit;">
                        <div class="icon">📄</div>
                        <div class="name">Laporan</div>
                    </a>

                    <a href="{{ route('report.index') }}" class="menu-item" style="text-decoration: none; color: inherit;">
                        <div class="icon">🖨️</div>
                        <div class="name">Cetak Dokumen</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
🖨️