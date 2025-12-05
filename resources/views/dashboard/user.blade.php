<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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

        .sidebar .user-info .name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .sidebar .user-info .role {
            font-size: 12px;
            opacity: 0.8;
            background-color: rgba(255,255,255,0.2);
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .sidebar nav ul {
            list-style: none;
        }

        .sidebar nav ul li {
            margin-bottom: 10px;
        }

        .sidebar nav ul li a {
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            display: block;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .sidebar nav ul li a:hover,
        .sidebar nav ul li a.active {
            background-color: rgba(255,255,255,0.2);
        }

        .main-content {
            flex: 1;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            font-size: 28px;
        }

        .logout-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .card h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn {
            background-color: #667eea;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #764ba2;
        }

        .btn-secondary {
            background-color: #95a5a6;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .feature-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .feature-card h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .feature-card p {
            color: rgba(255,255,255,0.9);
            margin-bottom: 15px;
        }

        .feature-card .btn {
            background-color: white;
            color: #667eea;
            width: 100%;
        }

        .feature-card .btn:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">📋 Kependudukan</div>
            <div class="user-info">
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="role">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
            <nav>
                <ul>
                    <li><a href="{{ route('user.dashboard') }}" class="active">🏠 Beranda</a></li>
                    <li><a href="{{ route('warga.create-user') }}">➕ Input Warga</a></li>
                    <li><a href="{{ route('pbb.create-user') }}">➕ Input PBB</a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">
            <div class="header">
                <h1>Selamat Datang, {{ Auth::user()->name }} 👋</h1>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>

            @if (session('success'))
                <div class="success-message">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <h2>Halo 👋</h2>
                <p>Anda login sebagai <strong>User</strong> dengan akses terbatas.</p>
                <p>Anda hanya dapat melakukan:</p>
                <ul style="margin-left: 20px; color: #666;">
                    <li>✅ Input Data Warga Baru</li>
                    <li>✅ Input Data PBB Baru</li>
                </ul>
            </div>

            <div class="feature-grid">
                <div class="feature-card">
                    <h3>📝 Input Data Warga</h3>
                    <p>Tambahkan data warga penduduk baru ke sistem</p>
                    <a href="{{ route('warga.create-user') }}" class="btn">Mulai Input</a>
                </div>

                <div class="feature-card">
                    <h3>💰 Input Data PBB</h3>
                    <p>Tambahkan data pajak bumi dan bangunan baru</p>
                    <a href="{{ route('pbb.create-user') }}" class="btn">Mulai Input</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
