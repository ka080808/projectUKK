<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Warga</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar .logo {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sidebar nav a {
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background-color 0.3s;
        }

        .sidebar nav a:hover {
            background-color: #34495e;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #3498db;
            color: white;
            padding: 15px 30px;
        }

        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .form-card {
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-card h1 {
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="tel"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            font-family: Arial, sans-serif;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #27ae60;
            color: white;
        }

        .btn-primary:hover {
            background-color: #229954;
        }

        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">📊 Data Kependudukan</div>
            <nav>
                <a href="{{ route('dashboard') }}">📈 Dashboard</a>
                <a href="{{ route('warga.create') }}" class="active">👥 Input Data Warga</a>
                <a href="{{ route('warga.index') }}">👁️ Lihat Data Warga</a>
                <a href="{{ route('pbb.create') }}">📝 Input Data PBB</a>
                <a href="{{ route('pbb.index') }}">👁️ Lihat Data PBB</a>
                <a href="{{ route('report.index') }}">📄 Laporan</a>
                
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h2>Tambah Data Warga</h2>
            </div>

            <div class="content">
                <div class="form-card">
                    <h1>Form Tambah Data Warga</h1>

                    @if ($message = Session::get('error'))
                        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                            <strong>⚠️ Kesalahan:</strong> {{ $message }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                            <strong>Terjadi kesalahan validasi:</strong>
                            <ul style="margin-top: 10px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('warga.store') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nik">NIK *</label>
                                <input type="text" id="nik" name="nik" maxlength="16" value="{{ old('nik') }}" required>
                                @error('nik')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_kk">No KK *</label>
                                <input type="text" id="no_kk" name="no_kk" maxlength="16" value="{{ old('no_kk') }}" required>
                                @error('no_kk')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-row full">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap *</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                @error('nama_lengkap')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-row full">
                            <div class="form-group">
                                <label for="alamat">Alamat *</label>
                                <textarea id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="rt">RT *</label>
                                <input type="number" id="rt" name="rt" min="1" value="{{ old('rt') }}" required>
                                @error('rt')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="rw">RW *</label>
                                <input type="number" id="rw" name="rw" min="1" value="{{ old('rw') }}" required>
                                @error('rw')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin *</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir *</label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                @error('tempat_lahir')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir *</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                @error('tanggal_lahir')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_telp">No Telp</label>
                                <input type="tel" id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
                                @error('no_telp')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-row full">
                            <div class="form-group">
                                <label for="agama">Agama *</label>
                                <select id="agama" name="agama" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Kong Hu Cu" {{ old('agama') == 'Kong Hu Cu' ? 'selected' : '' }}>Kong Hu Cu</option>
                                </select>
                                @error('agama')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">💾 Simpan</button>
                            <a href="{{ route('warga.index') }}" class="btn btn-secondary">❌ Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
