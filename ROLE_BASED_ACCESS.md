# Dokumentasi Role-Based Access Control

## Struktur Role

### 1. **ADMIN** - Akses Penuh
- ✅ Login
- ✅ Dashboard (halaman utama)
- ✅ Input Data Warga (Create)
- ✅ Lihat Data Warga (Read/List, View, Edit, Delete)
- ✅ Input Data PBB (Create)
- ✅ Lihat Data PBB (Read/List, View, Edit, Delete)
- ✅ Laporan (View & Export)
- ✅ Cetak Dokumen (PDF/Excel)

### 2. **USER** - Akses Terbatas
- ✅ Login
- ✅ Input Data Warga (Create Only)
- ✅ Input Data PBB (Create Only)
- ❌ Tidak bisa melihat/edit/delete data
- ❌ Tidak bisa akses dashboard
- ❌ Tidak bisa akses laporan & cetak dokumen

## Akun Test

| Email | Password | Role |
|-------|----------|------|
| katyxeight@gmail.com | Vinividi1933 | Admin |
| admin@example.com | password | Admin |
| operator@example.com | password | User |

## Implementasi Teknis

### 1. Middleware Role
File: `app/Http/Middleware/CheckRole.php`
- Middleware untuk mengecek role user sebelum akses route
- Menggunakan: `Route::middleware(['auth', 'role:admin'])` atau `role:user`

### 2. Database
- Kolom `role` di tabel `users` dengan enum: `['admin', 'user']`
- Default value: `'user'`

### 3. Routes
- Route admin: `/routes/web.php` - middleware `['auth', 'role:admin']`
- Route user: `/routes/web.php` - middleware `['auth', 'role:user']`

## Cara Menggunakan

### Menambah User Baru
```php
User::create([
    'name' => 'Nama User',
    'email' => 'user@example.com',
    'password' => Hash::make('password'),
    'role' => 'admin', // atau 'user'
]);
```

### Cek Role di View/Blade
```blade
@if(Auth::user()->role === 'admin')
    <!-- Konten untuk admin -->
@elseif(Auth::user()->role === 'user')
    <!-- Konten untuk user -->
@endif
```

### Cek Role di Controller
```php
if (Auth::user()->role === 'admin') {
    // Admin actions
}
```

## Testing

1. Login dengan akun admin → Akses semua fitur
2. Login dengan akun user → Hanya bisa input data warga & PBB
3. User mencoba akses dashboard → Redirect dengan error message

---

**Note**: Sistem ini sudah terintegrasi dengan Laravel authentication & middleware.
