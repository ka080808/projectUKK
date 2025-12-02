<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data PBB</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f0f0f0; }
        .container { display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: 280px; background-color: #2c3e50; color: white; padding: 20px;
        }
        .sidebar .logo {
            font-size: 20px; font-weight: bold; margin-bottom: 30px;
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar nav { display: flex; flex-direction: column; gap: 10px; }
        .sidebar nav a {
            color: white; text-decoration: none; padding: 12px; border-radius: 5px;
            display: flex; align-items: center; gap: 10px; transition: background-color .3s;
        }
        .sidebar nav a:hover { background-color: #34495e; }
        .sidebar nav a.active { background-color: #e74c3c; }

        /* Main Layout */
        .main-content { flex: 1; display: flex; flex-direction: column; }
        .header { background-color: #e74c3c; color: white; padding: 15px 30px; }
        .content { flex: 1; padding: 30px; overflow-y: auto; }

        /* Form */
        .form-container {
            background-color: white; padding: 30px; border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 900px;
        }
        .form-title { font-size: 24px; margin-bottom: 20px; color: #333; }

        .form-group { margin-bottom: 15px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        label {
            display: block; margin-bottom: 5px; color: #333;
            font-weight: 600; font-size: 14px;
        }

        input, select, textarea {
            width: 100%; padding: 10px; border: 1px solid #ddd;
            border-radius: 4px; font-size: 14px;
        }
        input:focus, select:focus, textarea:focus {
            outline: none; border-color: #e74c3c;
            box-shadow: 0 0 5px rgba(231,76,60,0.3);
        }
        textarea { resize: vertical; min-height: 80px; }

        /* Errors */
        .form-error { color: #e74c3c; font-size: 12px; margin-top: 3px; }
        .error-box {
            background-color: #f8d7da; color: #721c24; padding: 15px;
            border-radius: 4px; margin-bottom: 20px; border: 1px solid #f5c6cb;
        }

        /* Buttons */
        .button-group { display: flex; gap: 10px; margin-top: 30px; }
        .btn {
            padding: 12px 25px; border: none; border-radius: 4px;
            cursor: pointer; font-size: 14px; font-weight: 600;
            transition: background-color .3s; text-align: center;
        }
        .btn-submit { background-color: #27ae60; color: white; flex: 1; }
        .btn-submit:hover { background-color: #229954; }
        .btn-cancel { background-color: #95a5a6; color: white; flex: 1; }
        .btn-cancel:hover { background-color: #7f8c8d; }

        .form-section {
            margin-bottom: 30px; padding-bottom: 20px;
            border-bottom: 2px solid #ecf0f1;
        }
        .section-title {
            font-size: 16px; font-weight: bold; color: #e74c3c; margin-bottom: 15px;
        }
    </style>
</head>

<body>
<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">📊 Kependudukan Raka</div>

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

                    <!-- SECTION: OBJEK PAJAK -->
                    <div class="form-section">
                        <div class="section-title">📌 Data Objek Pajak</div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>NOP *</label>
                                <input type="text" name="nop" value="{{ old('nop') }}" required>
                                @error('nop') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>NIK Pemilik *</label>
                                <select name="nik_pemilik" required>
                                    <option value="">-- Pilih Pemilik --</option>
                                    @foreach ($warga as $w)
                                        <option value="{{ $w->nik }}" {{ old('nik_pemilik') == $w->nik ? 'selected' : '' }}>
                                            {{ $w->nik }} - {{ $w->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('nik_pemilik') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Nama Pemilik *</label>
                                <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik') }}" required>
                                @error('nama_pemilik') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Jenis Bangunan *</label>
                                <select name="jenis_bangunan" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="Rumah Tinggal">Rumah Tinggal</option>
                                    <option value="Gedung">Gedung</option>
                                    <option value="Pabrik">Pabrik</option>
                                    <option value="Toko">Toko</option>
                                    <option value="Gudang">Gudang</option>
                                    <option value="Pertanian">Pertanian</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                @error('jenis_bangunan') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: ALAMAT -->
                    <div class="form-section">
                        <div class="section-title">📍 Alamat Objek Pajak</div>

                        <div class="form-group">
                            <label>Alamat Lengkap *</label>
                            <textarea name="alamat_objek" required>{{ old('alamat_objek') }}</textarea>
                            @error('alamat_objek') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>RT *</label>
                                <input type="number" name="rt" value="{{ old('rt') }}" required>
                                @error('rt') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>RW *</label>
                                <input type="number" name="rw" value="{{ old('rw') }}" required>
                                @error('rw') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Kelurahan *</label>
                                <input type="text" name="kelurahan" value="{{ old('kelurahan') }}" required>
                                @error('kelurahan') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Kecamatan *</label>
                                <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" required>
                                @error('kecamatan') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Kabupaten/Kota *</label>
                                <input type="text" name="kabupaten" value="{{ old('kabupaten') }}" required>
                                @error('kabupaten') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Provinsi *</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi') }}" required>
                                @error('provinsi') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: UKURAN -->
                    <div class="form-section">
                        <div class="section-title">📏 Data Ukuran</div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Luas Tanah (m²) *</label>
                                <input type="number" name="luas_tanah" value="{{ old('luas_tanah') }}" required>
                                @error('luas_tanah') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Luas Bangunan (m²) *</label>
                                <input type="number" name="luas_bangunan" value="{{ old('luas_bangunan') }}" required>
                                @error('luas_bangunan') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: KEPEMILIKAN -->
                    <div class="form-section">
                        <div class="section-title">🔑 Status Kepemilikan</div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Status Tanah *</label>
                                <select name="status_tanah" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Milik Sendiri">Milik Sendiri</option>
                                    <option value="Sewa">Sewa</option>
                                    <option value="Hibah">Hibah</option>
                                </select>
                                @error('status_tanah') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Status Bangunan *</label>
                                <select name="status_bangunan" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Milik Sendiri">Milik Sendiri</option>
                                    <option value="Sewa">Sewa</option>
                                    <option value="Hibah">Hibah</option>
                                </select>
                                @error('status_bangunan') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: PAJAK -->
                    <div class="form-section">
                        <div class="section-title">💰 Data Pajak</div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Tahun Perolehan *</label>
                                <input type="number" name="tahun_perolehan" value="{{ old('tahun_perolehan', date('Y')) }}" required>
                                @error('tahun_perolehan') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Nilai Pajak Tahun Ini (Rp) *</label>
                                <input type="number" name="nilai_pajak_tahun_ini" value="{{ old('nilai_pajak_tahun_ini', 0) }}" required>
                                @error('nilai_pajak_tahun_ini') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Status Pembayaran *</label>
                                <select name="status_pembayaran" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Lunas">Lunas</option>
                                    <option value="Belum Lunas">Belum Lunas</option>
                                    <option value="Cicilan">Cicilan</option>
                                </select>
                                @error('status_pembayaran') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" value="{{ old('keterangan') }}">
                                @error('keterangan') <div class="form-error">{{ $message }}</div> @enderror
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
