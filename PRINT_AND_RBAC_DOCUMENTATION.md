# 📚 Dokumentasi Fitur Print & Role-Based Access

## Update: Desember 5, 2025

Dokumentasi lengkap untuk fitur-fitur terbaru yang sudah diimplementasikan.

---

## 🖨️ Fitur Print & Export

### Fitur yang Tersedia

#### 1. Print Data Warga
- **Route**: `/warga/print/all`
- **Akses**: Admin Only
- **Fungsi**: Menampilkan laporan cetak untuk semua data penduduk
- **Fitur**:
  - Tabel data warga dengan formatting profesional
  - Tombol print di halaman (Ctrl+P atau cetak langsung)
  - Header dengan timestamp dan total data
  - Footer dengan informasi dokumen
  - Responsive design untuk semua ukuran kertas

#### 2. Export PDF Data Warga
- **Route**: `/warga/export/pdf`
- **Akses**: Admin Only
- **Fungsi**: Download laporan warga dalam format PDF
- **File**: `Data_Warga_[timestamp].pdf`
- **Konten**:
  - Tabel lengkap dengan semua kolom warga
  - Header profesional dengan gradient
  - Informasi tanggal cetak

#### 3. Print Data PBB
- **Route**: `/pbb/print/all`
- **Akses**: Admin Only
- **Fungsi**: Menampilkan laporan cetak untuk semua data PBB
- **Fitur**:
  - Tabel data PBB dengan formatting profesional
  - Summary cards dengan statistik pembayaran:
    - ✅ Lunas (Data + Nilai Pajak)
    - ❌ Belum Lunas (Data + Nilai Pajak)
    - ⏳ Cicilan (Data + Nilai Pajak)
  - Status badge dengan warna berbeda
  - Total nilai pajak tahun ini

#### 4. Export PDF Data PBB
- **Route**: `/pbb/export/pdf`
- **Akses**: Admin Only
- **Fungsi**: Download laporan PBB dalam format PDF
- **File**: `Data_PBB_[timestamp].pdf`
- **Konten**:
  - Tabel lengkap dengan semua kolom PBB
  - Summary cards dengan statistik
  - Format Rupiah untuk nilai pajak

### Mengakses Fitur Print

**Dari halaman "Lihat Data Warga" atau "Lihat Data PBB":**
1. Klik tombol **🖨️ Cetak/Print** - Buka halaman print
2. Gunakan Ctrl+P untuk print ke printer atau save as PDF
3. Klik tombol **📥 Export PDF** - Download langsung file PDF

---

## 👥 Role-Based Access Control (RBAC)

### Implementasi

- **File Middleware**: `app/Http/Middleware/CheckRole.php`
- **Registrasi**: `bootstrap/app.php`
- **Routes**: `routes/web.php` dengan middleware `['auth', 'role:admin']` atau `role:user`

### Struktur Role

#### 🔑 ADMIN - Akses Penuh
```
✅ Login
✅ Dashboard (/dashboard)
✅ Input Data Warga (/warga/create)
✅ Lihat Data Warga (/warga)
✅ Edit/Hapus Data Warga
✅ Input Data PBB (/pbb/create)
✅ Lihat Data PBB (/pbb)
✅ Edit/Hapus Data PBB
✅ Laporan (/report)
✅ Cetak/Print Data
✅ Export PDF/Excel
```

#### 👤 USER - Akses Terbatas
```
✅ Login
✅ Dashboard User (/user-dashboard)
✅ Input Data Warga (/warga-create)
✅ Input Data PBB (/pbb-create)
❌ Lihat/Edit/Hapus Data (Tidak bisa)
❌ Akses Laporan
❌ Cetak/Print
```

### Routes dengan Role Protection

```php
// Admin Only Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', ...);
    Route::get('/warga', ...);
    Route::get('/pbb', ...);
    Route::get('/report', ...);
    Route::get('/warga/print/all', ...);
    Route::get('/pbb/print/all', ...);
});

// User Only Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user-dashboard', ...);
    Route::get('/warga-create', ...);  // Input form only
    Route::post('/warga-store', ...);  // Save only
});
```

### Sidebar Dinamis

Sidebar di setiap halaman akan menyesuaikan berdasarkan role:

**Admin View:**
```
📋 Kependudukan
  📈 Dashboard
  👥 Input Data Warga
  👁️ Lihat Data Warga
  📝 Input Data PBB
  👁️ Lihat Data PBB
  📄 Laporan
```

**User View:**
```
📋 Kependudukan
  🏠 Dashboard
  👥 Input Data Warga
  📝 Input Data PBB
```

### Middleware CheckRole Logic

```php
public function handle(Request $request, Closure $next, ...$roles): Response
{
    if (!$request->user()) {
        return redirect()->route('login');
    }

    if (in_array($request->user()->role, $roles)) {
        return $next($request);
    }

    // Redirect sesuai role jika ditolak
    if ($request->user()->role === 'user') {
        return redirect()->route('user.dashboard')->with('error', ...);
    }
    
    return redirect()->route('dashboard')->with('error', ...);
}
```

---

## 🔐 Akun Test

| Email | Password | Role |
|-------|----------|------|
| admin@example.com | password | Admin |
| operator@example.com | password | User |
| katyxeight@gmail.com | Vinividi1933 | Admin |

---

## 📋 Testing Checklist

### Fitur Print
- [ ] Login sebagai admin
- [ ] Buka "Lihat Data Warga"
- [ ] Klik tombol "Cetak/Print"
- [ ] Halaman print muncul dengan data
- [ ] Tekan Ctrl+P untuk print/save
- [ ] Klik tombol "Export PDF"
- [ ] File PDF terdownload

### Role-Based Access
- [ ] Login sebagai admin → Akses semua menu
- [ ] Login sebagai user → Hanya 3 menu terlihat
- [ ] User coba akses `/warga` → Error/redirect
- [ ] Admin input warga → Redirect ke warga.index
- [ ] User input warga → Redirect ke user.dashboard dengan pesan "Terima kasih"
- [ ] Logout → Redirect ke login

---

## 📚 File-File Relevan

### Controllers
- `app/Http/Controllers/WargaController.php` - `printAll()`, `exportPDF()`
- `app/Http/Controllers/PBBController.php` - `printAll()`, `exportPDF()`

### Views
- `resources/views/warga/print.blade.php` - Print view warga
- `resources/views/pbb/print.blade.php` - Print view PBB
- `resources/views/dashboard/user.blade.php` - User dashboard

### Middleware & Config
- `app/Http/Middleware/CheckRole.php` - Role checking
- `bootstrap/app.php` - Middleware registration

### Routes
- `routes/web.php` - All routes dengan middleware

---

**Generated**: December 5, 2025
**Version**: 1.0.0
