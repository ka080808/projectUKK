<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data PBB</title>
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

        .sidebar .user-info {
            background-color: #34495e;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .sidebar .user-info .status {
            font-size: 12px;
            color: #27ae60;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .brand {
            font-size: 16px;
            font-weight: bold;
        }

        .header .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .page-title {
            margin-bottom: 20px;
        }

        .page-title h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .controls .search {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .controls input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #27ae60;
            color: white;
        }

        .btn-primary:hover {
            background-color: #229954;
        }

        .btn-warning {
            background-color: #f39c12;
            color: white;
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-warning:hover {
            background-color: #e67e22;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .table-responsive {
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background-color: #ecf0f1;
            border-bottom: 2px solid #bdc3c7;
        }

        table thead th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            color: #333;
            font-size: 12px;
        }

        table tbody td {
            padding: 12px;
            border-bottom: 1px solid #ecf0f1;
            font-size: 13px;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            align-items: center;
        }

        .pagination a, .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #e74c3c;
        }

        .pagination a:hover {
            background-color: #ecf0f1;
        }

        .pagination span.current {
            background-color: #e74c3c;
            color: white;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal.show {
            display: block;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 400px;
            border-radius: 5px;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .close-modal {
            font-size: 28px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
        }

        .close-modal:hover {
            color: #000;
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
            <div class="user-info">
                <strong>{{ Auth::user()->name }}</strong>
                <div class="status">🟢 Online</div>
            </div>
            <nav>
                <a href="{{ route('dashboard') }}">📈 Dashboard</a>
                <a href="{{ route('warga.create') }}">➕ Input Data Warga</a>
                <a href="{{ route('warga.index') }}">👥 Lihat Data Warga</a>
                <a href="{{ route('pbb.create') }}">➕ Input Data PBB</a>
                <a href="{{ route('pbb.index') }}" class="active">🏠 Lihat Data PBB</a>
                <a href="{{ route('report.index') }}">📄 Laporan</a>
                <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
                    @csrf
                    <button type="submit" style="width: 100%; background-color: #c0392b; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">🔓 Logout</button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="brand">Data PBB (Pajak Bumi dan Bangunan)</div>
                <div class="admin-info">
                    👤 {{ Auth::user()->name }}
                </div>
            </div>

            <div class="content">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif

                <div class="page-title">
                    <h1>📋 Daftar Data PBB</h1>
                    <div style="margin-top: 10px; display: flex; gap: 10px;">
                        <a href="{{ route('pbb.print') }}" class="btn" style="background-color: #3498db; text-decoration: none; padding: 8px 15px; border-radius: 4px; color: white; font-size: 14px;">
                            🖨️ Cetak/Print
                        </a>
                        <a href="{{ route('pbb.export-pdf') }}" class="btn" style="background-color: #e74c3c; text-decoration: none; padding: 8px 15px; border-radius: 4px; color: white; font-size: 14px;">
                            📥 Export PDF
                        </a>
                    </div>
                </div>

                <div class="controls">
                    <div>
                        <a href="{{ route('pbb.create') }}" class="btn btn-primary">➕ Tambah Data PBB</a>
                    </div>

                    <div class="search">
                        <label>Cari:</label>
                        <input type="text" id="searchInput" placeholder="Cari NOP atau nama pemilik...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NOP</th>
                                <th>Nama Pemilik</th>
                                <th>Alamat Objek</th>
                                <th>Luas Tanah</th>
                                <th>Luas Bangunan</th>
                                <th>Jenis Bangunan</th>
                                <th>Status Pembayaran</th>
                                <th>Nilai Pajak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pbb as $index => $item)
                                <tr>
                                    <td>{{ ($pbb->currentPage() - 1) * $pbb->perPage() + $index + 1 }}</td>
                                    <td>{{ $item->nop }}</td>
                                    <td>{{ $item->nama_pemilik }}</td>
                                    <td>{{ $item->alamat_objek }}</td>
                                    <td>{{ $item->luas_tanah }} m²</td>
                                    <td>{{ $item->luas_bangunan }} m²</td>
                                    <td>{{ $item->jenis_bangunan }}</td>
                                    <td>
                                        @if ($item->status_pembayaran == 'Lunas')
                                            <span style="background-color: #d4edda; padding: 5px 10px; border-radius: 3px; color: #155724;">✅ {{ $item->status_pembayaran }}</span>
                                        @elseif ($item->status_pembayaran == 'Cicilan')
                                            <span style="background-color: #fff3cd; padding: 5px 10px; border-radius: 3px; color: #856404;">⏳ {{ $item->status_pembayaran }}</span>
                                        @else
                                            <span style="background-color: #f8d7da; padding: 5px 10px; border-radius: 3px; color: #721c24;">❌ {{ $item->status_pembayaran }}</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($item->nilai_pajak_tahun_ini, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('pbb.edit', $item) }}" class="btn btn-warning">✏️ Edit</a>
                                            <button onclick="confirmDelete({{ $item->id }})" class="btn btn-danger">🗑️ Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" style="text-align: center; padding: 20px;">Tidak ada data PBB</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    {{ $pbb->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Konfirmasi Hapus</h2>
                <span class="close-modal" onclick="closeModal()">&times;</span>
            </div>
            <p>Apakah Anda yakin ingin menghapus data PBB ini?</p>
            <div style="margin-top: 20px; display: flex; gap: 10px; justify-content: flex-end;">
                <button onclick="closeModal()" style="padding: 10px 20px; background-color: #95a5a6; color: white; border: none; border-radius: 4px; cursor: pointer;">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="padding: 10px 20px; background-color: #e74c3c; color: white; border: none; border-radius: 4px; cursor: pointer;">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            const form = document.getElementById('deleteForm');
            form.action = '/pbb/' + id;
            document.getElementById('deleteModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.remove('show');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                modal.classList.remove('show');
            }
        }

        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            const table = document.getElementById('dataTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            Array.from(rows).forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
