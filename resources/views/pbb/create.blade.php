<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data PBB</title>
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

        .sidebar nav a.active {
            background-color: #e74c3c;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #e74c3c;
            color: white;
            padding: 15px 30px;
        }

        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 900px;
        }

        .form-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="date"],
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
            border-color: #e74c3c;
            box-shadow: 0 0 5px rgba(231, 76, 60, 0.3);
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 3px;
        }

        .error-box {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .error-box ul {
            margin-left: 20px;
            margin-top: 10px;
        }

        .error-box li {
            margin-bottom: 5px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn-submit {
            background-color: #27ae60;
            color: white;
            flex: 1;
        }

        .btn-submit:hover {
            background-color: #229954;
        }

        .btn-cancel {
            background-color: #95a5a6;
            color: white;
            flex: 1;
        }

        .btn-cancel:hover {
            background-color: #7f8c8d;
        }

        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #ecf0f1;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                📊 Kependudukan Raka
            </div>
            <nav>
                <a href="{{ route('dashboard') }}">📈 Dashboard</a>
                <a href="{{ route('warga.create') }}">👥 Input Data Warga</a>
                <a href="{{ route('warga.index') }}">👁️ Lihat Data Warga</a>
                <a href="{{ route('pbb.create') }}" class="active">➕ Input Data PBB</a>
                <a href="{{ route('pbb.index') }}">🏠 Lihat Data PBB</a>
                <a href="{{ route('report.index') }}">📄 Laporan</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>➕ Tambah Data PBB Baru</h1>
            </div>

            <div class="content">
                @if ($errors->any())
                    <div class="error-box">
                        <strong>❌ Validasi Gagal:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-container">
                    <form method="POST" action="{{ route('pbb.store') }}">
                        @csrf

                        <!-- Data Objek Pajak -->
                        <div class="form-section">
                            <div class="section-title">📌 Data Objek Pajak</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nop">NOP (Nomor Objek Pajak) *</label>
                                    <input type="text" id="nop" name="nop" value="{{ old('nop') }}" placeholder="Contoh: 123456123456123456" required>
                                    @error('nop')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nik_pemilik">NIK Pemilik *</label>
                                    <select id="nik_pemilik" name="nik_pemilik" required>
                                        <option value="">-- Pilih Pemilik --</option>
                                        @foreach ($warga as $w)
                                            <option value="{{ $w->nik }}" {{ old('nik_pemilik') == $w->nik ? 'selected' : '' }}>
                                                {{ $w->nik }} - {{ $w->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nik_pemilik')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nama_pemilik">Nama Pemilik *</label>
                                    <input type="text" id="nama_pemilik" name="nama_pemilik" value="{{ old('nama_pemilik') }}" placeholder="Nama lengkap pemilik" required>
                                    @error('nama_pemilik')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis_bangunan">Jenis Bangunan *</label>
                                    <select id="jenis_bangunan" name="jenis_bangunan" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Rumah Tinggal" {{ old('jenis_bangunan') == 'Rumah Tinggal' ? 'selected' : '' }}>Rumah Tinggal</option>
                                        <option value="Gedung" {{ old('jenis_bangunan') == 'Gedung' ? 'selected' : '' }}>Gedung</option>
                                        <option value="Pabrik" {{ old('jenis_bangunan') == 'Pabrik' ? 'selected' : '' }}>Pabrik</option>
                                        <option value="Toko" {{ old('jenis_bangunan') == 'Toko' ? 'selected' : '' }}>Toko</option>
                                        <option value="Gudang" {{ old('jenis_bangunan') == 'Gudang' ? 'selected' : '' }}>Gudang</option>
                                        <option value="Pertanian" {{ old('jenis_bangunan') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                        <option value="Lainnya" {{ old('jenis_bangunan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('jenis_bangunan')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Alamat Objek -->
                        <div class="form-section">
                            <div class="section-title">📍 Alamat Objek Pajak</div>
                            <div class="form-group">
                                <label for="alamat_objek">Alamat Lengkap *</label>
                                <textarea id="alamat_objek" name="alamat_objek" placeholder="Masukkan alamat lengkap" required>{{ old('alamat_objek') }}</textarea>
                                @error('alamat_objek')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="rt">RT *</label>
                                    <input type="number" id="rt" name="rt" value="{{ old('rt') }}" min="1" max="99" required>
                                    @error('rt')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="rw">RW *</label>
                                    <input type="number" id="rw" name="rw" value="{{ old('rw') }}" min="1" max="99" required>
                                    @error('rw')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan *</label>
                                    <input type="text" id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}" required>
                                    @error('kelurahan')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan *</label>
                                    <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}" required>
                                    @error('kecamatan')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten/Kota *</label>
                                    <input type="text" id="kabupaten" name="kabupaten" value="{{ old('kabupaten') }}" required>
                                    @error('kabupaten')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="provinsi">Provinsi *</label>
                                    <input type="text" id="provinsi" name="provinsi" value="{{ old('provinsi') }}" required>
                                    @error('provinsi')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Data Ukuran -->
                        <div class="form-section">
                            <div class="section-title">📏 Data Ukuran</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="luas_tanah">Luas Tanah (m²) *</label>
                                    <input type="number" id="luas_tanah" name="luas_tanah" value="{{ old('luas_tanah') }}" min="1" required>
                                    @error('luas_tanah')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="luas_bangunan">Luas Bangunan (m²) *</label>
                                    <input type="number" id="luas_bangunan" name="luas_bangunan" value="{{ old('luas_bangunan', 0) }}" min="0" required>
                                    @error('luas_bangunan')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Status Kepemilikan -->
                        <div class="form-section">
                            <div class="section-title">🔑 Status Kepemilikan</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="status_tanah">Status Tanah *</label>
                                    <select id="status_tanah" name="status_tanah" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Milik Sendiri" {{ old('status_tanah') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                        <option value="Sewa" {{ old('status_tanah') == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                                        <option value="Hibah" {{ old('status_tanah') == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                                    </select>
                                    @error('status_tanah')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status_bangunan">Status Bangunan *</label>
                                    <select id="status_bangunan" name="status_bangunan" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Milik Sendiri" {{ old('status_bangunan') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                        <option value="Sewa" {{ old('status_bangunan') == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                                        <option value="Hibah" {{ old('status_bangunan') == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                                    </select>
                                    @error('status_bangunan')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Data Pajak -->
                        <div class="form-section">
                            <div class="section-title">💰 Data Pajak</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="tahun_perolehan">Tahun Perolehan *</label>
                                    <input type="number" id="tahun_perolehan" name="tahun_perolehan" value="{{ old('tahun_perolehan', date('Y')) }}" min="1900" max="{{ date('Y') }}" required>
                                    @error('tahun_perolehan')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nilai_pajak_tahun_ini">Nilai Pajak Tahun Ini (Rp) *</label>
                                    <input type="number" id="nilai_pajak_tahun_ini" name="nilai_pajak_tahun_ini" value="{{ old('nilai_pajak_tahun_ini', 0) }}" min="0" required>
                                    @error('nilai_pajak_tahun_ini')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="status_pembayaran">Status Pembayaran *</label>
                                    <select id="status_pembayaran" name="status_pembayaran" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Lunas" {{ old('status_pembayaran') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                        <option value="Belum Lunas" {{ old('status_pembayaran') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                        <option value="Cicilan" {{ old('status_pembayaran') == 'Cicilan' ? 'selected' : '' }}>Cicilan</option>
                                    </select>
                                    @error('status_pembayaran')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" placeholder="Keterangan tambahan (opsional)">
                                    @error('keterangan')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="button-group">
                            <a href="{{ route('pbb.index') }}" class="btn btn-cancel">❌ Batal</a>
                            <button type="submit" class="btn btn-submit">✅ Simpan Data PBB</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
