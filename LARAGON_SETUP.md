# Setup Aplikasi di Laragon

## 📋 Persyaratan
- Laragon sudah terinstall
- PHP 8.2 atau lebih tinggi
- MySQL/MariaDB running di Laragon
- Composer terinstall

## 🚀 Langkah-langkah Setup

### 1. Copy Project ke Laragon
```bash
cp -r c:\Users\smkn1garut\kependudukanraka c:\laragon\www\kependudukanraka
cd c:\laragon\www\kependudukanraka
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment File
```bash
cp .env.example .env
# atau gunakan yang sudah ada
```

### 4. Generate App Key (jika belum ada)
```bash
php artisan key:generate
```

### 5. Run Database Migration
```bash
php artisan migrate
```

### 6. Seed Database (Optional - untuk data dummy)
```bash
php artisan db:seed
```

### 7. Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### 8. Start Laragon
- Buka Laragon.exe
- Klik "Start All" button
- Buat entry domain di Laragon:
  - Edit hosts: Laragon Menu > Tools > Generate Virtual Hosts > Add
  - Atau manual add di C:\Windows\System32\drivers\etc\hosts:
    ```
    127.0.0.1 kependudukanraka.test
    ```

### 9. Akses Aplikasi
- Browser: `http://kependudukanraka.test`
- atau `http://localhost/kependudukanraka/public`

## 📊 Database Configuration

File `.env` sudah dikonfigurasi untuk Laragon:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kependudukanraka_db
DB_USERNAME=root
DB_PASSWORD=
```

## ✅ Verifikasi Setup

```bash
# Check migration status
php artisan migrate:status

# Check data
php artisan tinker
>>> App\Models\Warga::count()
>>> exit
```

## 🔧 Troubleshooting

### Error: Table not found
```bash
# Jalankan migration ulang
php artisan migrate:refresh --seed
```

### Error: Route not defined
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Error: Model not found
```bash
# Update composer autoload
composer dump-autoload
```

## 📝 Features

✅ CRUD Data Warga
- Create: Tambah data warga baru
- Read: Lihat daftar semua warga
- Update: Edit data warga
- Delete: Hapus data warga

✅ Input Validation
- NIK: 16 digit, unique
- No KK: 16 digit, unique
- Tanggal Lahir: Harus sebelum hari ini
- Agama: Pilihan terbatas

✅ Error Handling
- Try-catch untuk semua operasi database
- Error message yang user-friendly
- Form validation dengan message yang jelas

## 🗄️ Database Structure

Tabel: `warga`

Kolom:
- id (Primary Key)
- nik (VARCHAR 16, UNIQUE)
- no_kk (VARCHAR 16, UNIQUE)
- nama_lengkap (VARCHAR 255)
- alamat (TEXT)
- rt (INTEGER)
- rw (INTEGER)
- jenis_kelamin (ENUM: 'Laki-laki', 'Perempuan')
- tempat_lahir (VARCHAR 100)
- tanggal_lahir (DATE)
- no_telp (VARCHAR 20, nullable)
- agama (VARCHAR 50)
- timestamps (created_at, updated_at)

## 🎯 Next Steps

1. Setup virtual host di Laragon
2. Akses aplikasi melalui browser
3. Test semua fitur CRUD
4. Monitor logs di `storage/logs/laravel.log`
