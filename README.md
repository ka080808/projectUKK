# ProjectUKK - Sistem Informasi Pajak Bumi dan Bangunan (PBB)

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-00758F?style=flat-square&logo=mysql)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)
![Status](https://img.shields.io/badge/Status-Active-brightgreen?style=flat-square)

**Aplikasi web untuk mengelola data Pajak Bumi dan Bangunan (PBB) dan informasi penduduk secara terpusat**

[Fitur](#fitur-utama) • [Instalasi](#instalasi) • [Dokumentasi](#dokumentasi) • [Kontribusi](#kontribusi)

</div>

---

## 📖 Daftar Isi

-   [Tentang Aplikasi](#tentang-aplikasi)
-   [Fitur Utama](#fitur-utama)
-   [Teknologi yang Digunakan](#teknologi-yang-digunakan)
-   [Persyaratan Sistem](#persyaratan-sistem)
-   [Instalasi](#instalasi)
-   [Konfigurasi](#konfigurasi)
-   [Penggunaan](#penggunaan)
-   [Struktur Proyek](#struktur-proyek)
-   [Database](#database)
-   [API Endpoints](#api-endpoints)
-   [Dokumentasi](#dokumentasi)
-   [Troubleshooting](#troubleshooting)
-   [Kontribusi](#kontribusi)
-   [Lisensi](#lisensi)

---

## 📋 Tentang Aplikasi

**ProjectUKK** adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola sistem Pajak Bumi dan Bangunan (PBB) di tingkat kelurahan/desa. Aplikasi ini memfasilitasi:

-   📊 Manajemen data penduduk (Warga)
-   🏠 Pencatatan objek pajak (properti/bangunan)
-   💰 Pengelolaan data PBB dan status pembayaran
-   👥 Manajemen pengguna dengan role-based access control
-   📈 Pelaporan dan ekspor data (PDF, Excel)
-   🔐 Sistem autentikasi dan otorisasi yang aman

Aplikasi ini cocok untuk digunakan oleh **Kelurahan/Desa**, **Kecamatan**, atau **Dinas Pajak Lokal** untuk mengelola data PBB secara efisien dan terorganisir.

---

## ✨ Fitur Utama

### 🔐 Autentikasi & Otorisasi

-   ✅ Sistem login dengan email dan password
-   ✅ Role-based access control (Admin & User)
-   ✅ Registrasi pengguna baru
-   ✅ Logout dan session management
-   ✅ Password hashing aman dengan bcrypt

### 👥 Manajemen Data Penduduk

-   ✅ CRUD lengkap untuk data Warga (penduduk)
-   ✅ Input NIK (Nomor Induk Kependudukan) dan KK (Kartu Keluarga)
-   ✅ Data personal: nama, alamat, tempat/tanggal lahir
-   ✅ Informasi kontak dan agama
-   ✅ Pencarian dan filter data penduduk
-   ✅ Validasi data otomatis

### 🏠 Manajemen Pajak Bumi & Bangunan

-   ✅ CRUD lengkap untuk data PBB
-   ✅ Input NOP (Nomor Objek Pajak)
-   ✅ Pemetaan properti ke pemilik (via NIK)
-   ✅ Informasi detail objek: lokasi, luas tanah/bangunan, jenis bangunan
-   ✅ Status tanah & bangunan (Milik Sendiri, Sewa, Hibah)
-   ✅ Tracking nilai pajak dan tahun perolehan
-   ✅ Manajemen status pembayaran: Lunas, Belum Lunas, Cicilan
-   ✅ Cascading validation terhadap data penduduk

### 📊 Dashboard & Analytics

-   ✅ Overview statistik real-time
-   ✅ Total jumlah penduduk terdaftar
-   ✅ Total jumlah objek pajak
-   ✅ Total nilai pajak tahun ini
-   ✅ Breakdown status pembayaran (Lunas, Belum Lunas, Cicilan)
-   ✅ Visualisasi data

### 📈 Pelaporan & Ekspor

-   ✅ Lihat data dalam format tabel dengan pagination
-   ✅ Export data ke format PDF
-   ✅ Export data ke format Excel (.xlsx)
-   ✅ Laporan terstruktur dengan header dan footer
-   ✅ Print-friendly report

### 👨‍💼 Manajemen Pengguna (Admin Only)

-   ✅ Daftar semua pengguna sistem
-   ✅ Create/Read/Update/Delete pengguna
-   ✅ Assign role (Admin/User)
-   ✅ Manage akses pengguna

---

## 🛠 Teknologi yang Digunakan

### Backend

| Teknologi         | Versi    | Fungsi                         |
| ----------------- | -------- | ------------------------------ |
| **Laravel**       | 12.0     | Web Framework PHP modern       |
| **PHP**           | 8.2+     | Bahasa pemrograman server-side |
| **MySQL/MariaDB** | 5.7+     | Database relasional            |
| **Eloquent ORM**  | Built-in | Object-relational mapping      |

### Frontend

| Teknologi           | Fungsi                      |
| ------------------- | --------------------------- |
| **Blade**           | Template engine Laravel     |
| **Tailwind CSS**    | Utility-first CSS framework |
| **Alpine.js**       | JavaScript framework ringan |
| **HTML5**           | Markup struktur             |
| **JavaScript ES6+** | Interaktivitas client-side  |

### Build & Development Tools

| Tool             | Fungsi                  |
| ---------------- | ----------------------- |
| **Vite**         | Build tool & dev server |
| **Composer**     | PHP dependency manager  |
| **NPM**          | Node package manager    |
| **Tailwind CSS** | CSS styling             |

### Additional Libraries

-   **Laravel Pint** - Code style formatter
-   **PHPUnit** - Unit testing framework
-   **Faker** - Fake data generator untuk testing
-   **Laravel Tinker** - REPL untuk Laravel

---

## 💻 Persyaratan Sistem

### Minimum Requirements

-   **PHP 8.2** atau lebih tinggi
-   **MySQL 5.7** atau **MariaDB 10.2** atau lebih tinggi
-   **Composer 2.0** atau lebih tinggi
-   **Node.js 18+** untuk build tools
-   **npm 9+** atau **yarn**

### Rekomendasi

-   **PHP 8.4** (latest stable)
-   **MySQL 8.0** atau **MariaDB 11.0**
-   **SSD Storage** untuk performa optimal
-   **RAM 4GB+** untuk development

### Server Requirements (Production)

-   **Dedicated Hosting atau VPS**
-   **SSL Certificate** (HTTPS)
-   **PHP-FPM atau Apache with mod_php**
-   **MySQL Server terpisah** (recommended)
-   **Backup system** yang reguler

---

## 🚀 Instalasi

### Prerequisite

Pastikan sudah ter-install:

-   Git
-   PHP 8.2+
-   MySQL/MariaDB
-   Composer
-   Node.js & npm

### Langkah 1: Clone Repository

```bash
git clone https://github.com/ka080808/projectUKK.git
cd projectUKK
```

### Langkah 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### Langkah 3: Setup Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Langkah 4: Konfigurasi Database

Edit file `.env` dan sesuaikan database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projectukk
DB_USERNAME=root
DB_PASSWORD=
```

### Langkah 5: Jalankan Migrations & Seeder

```bash
# Create database tables
php artisan migrate

# Optional: Seed sample data
php artisan db:seed
```

### Langkah 6: Build Frontend Assets

```bash
# Development build
npm run dev

# Production build
npm run build
```

### Langkah 7: Jalankan Aplikasi

```bash
# Start development server
php artisan serve

# App akan accessible di http://localhost:8000
```

---

## ⚙️ Konfigurasi

### Environment Variables (.env)

```env
# App Configuration
APP_NAME="ProjectUKK"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projectukk
DB_USERNAME=root
DB_PASSWORD=

# Mail Configuration (optional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password

# Cache & Session
CACHE_STORE=file
SESSION_DRIVER=file
```

### Konfigurasi Web Server (Apache)

Pastikan `.htaccess` di folder `public/` sudah ada dan benar. Untuk subfolder:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On
    RewriteCond %{HTTP:Authorization} .
    RewriteRule ^(.*)$ public/$1 [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ public/index.php?/$1 [QSA,L]
</IfModule>
```

---

## 📱 Penggunaan

### Login ke Aplikasi

1. Buka browser dan akses `http://localhost:8000`
2. Klik "Login" di halaman welcome
3. Masukkan email dan password
4. Sistem akan redirect ke dashboard

### Default Test Credentials

Jika menggunakan seeder, gunakan:

-   **Email**: `admin@example.com` (Admin)
-   **Password**: `password`

### Fitur Utama

#### Dashboard

-   Menampilkan overview statistik PBB
-   Ringkasan jumlah warga dan properti
-   Total nilai pajak tahun ini
-   Status pembayaran breakdown

#### Manajemen Warga

-   **Lihat Daftar**: `/warga` - Melihat semua data penduduk
-   **Tambah Warga**: `/warga/create` - Menambah penduduk baru
-   **Edit Warga**: `/warga/{id}/edit` - Mengubah data penduduk
-   **Hapus Warga**: Delete dari list (Admin only)

#### Manajemen PBB

-   **Lihat Daftar**: `/pbb` - Melihat semua data PBB
-   **Tambah PBB**: `/pbb/create` - Menambah objek pajak baru
-   **Edit PBB**: `/pbb/{id}/edit` - Mengubah data PBB
-   **Hapus PBB**: Delete dari list (Admin only)

#### Pelaporan

-   **Generate Report**: `/report` - Buat laporan
-   **Export PDF**: Ekspor data ke PDF
-   **Export Excel**: Ekspor data ke spreadsheet

---

## 📊 Struktur Proyek

```
projectUKK/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php          # Autentikasi
│   │   │   ├── DashboardController.php     # Dashboard
│   │   │   ├── WargaController.php         # Data Penduduk
│   │   │   ├── PBBController.php           # Data PBB
│   │   │   └── ReportController.php        # Pelaporan
│   │   └── Middleware/
│   │       └── Authenticate.php
│   ├── Models/
│   │   ├── User.php                        # Model User
│   │   ├── Warga.php                       # Model Penduduk
│   │   └── PBB.php                         # Model PBB
│   └── Exports/
│       └── PBBExport.php                   # Excel Export
│
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_warga_table.php
│   │   └── create_pbb_table.php
│   ├── factories/
│   │   ├── UserFactory.php
│   │   ├── WargaFactory.php
│   │   └── PBBFactory.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── PBBSeeder.php
│
├── resources/
│   ├── views/
│   │   ├── welcome.blade.php               # Halaman utama
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── dashboard/
│   │   │   └── index.blade.php
│   │   ├── warga/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── pbb/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── report/
│   │   │   └── index.blade.php
│   │   └── layouts/
│   │       └── app.blade.php
│   ├── css/
│   │   └── app.css                         # Tailwind CSS
│   └── js/
│       ├── app.js
│       └── bootstrap.js
│
├── routes/
│   ├── web.php                             # Web routes
│   └── api.php
│
├── config/
│   ├── app.php                             # App config
│   ├── database.php                        # Database config
│   ├── auth.php                            # Auth config
│   └── filesystems.php                     # File storage config
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
├── public/
│   ├── index.php                           # Entry point
│   └── ...
│
├── bootstrap/
├── storage/
├── vendor/
├── composer.json
├── package.json
├── vite.config.js
├── tailwind.config.js
├── .env.example
├── ERD.md                                  # Database diagram
├── UML.md                                  # System design
├── LARAGON_SETUP.md
└── README.md
```

---

## 🗄️ Database

### Diagram Entity Relationship (ERD)

#### 📊 Entity Relationship Diagram (Visual)

```
┌──────────────────────────────────┐
│            USERS                 │
├──────────────────────────────────┤
│ PK │ id                  (BIGINT)│
│    │ name               (STRING) │
│    │ email              (STRING) │◄──┐ UNIQUE
│    │ password           (STRING) │   │
│    │ role               (ENUM)   │   │
│    │ email_verified_at  (DATETIME)   │
│    │ remember_token     (STRING) │   │
│    │ created_at         (DATETIME)   │
│    │ updated_at         (DATETIME)   │
└──────────────────────────────────┘


┌──────────────────────────────────┐         ┌──────────────────────────────────┐
│            WARGA                 │  1:∞    │            PBB                   │
├──────────────────────────────────┤────────→├──────────────────────────────────┤
│ PK │ id                  (BIGINT)│         │ PK │ id                  (BIGINT)│
│    │ nik                (STRING) │◄────────┤ FK │ nik_pemilik        (STRING)│
│    │ no_kk              (STRING) │         │    │ nop                (STRING) │
│    │ nama_lengkap       (STRING) │         │    │ nama_pemilik       (STRING) │
│    │ alamat             (STRING) │         │    │ alamat_objek       (STRING) │
│    │ rt                (INTEGER) │         │    │ rt                (INTEGER) │
│    │ rw                (INTEGER) │         │    │ rw                (INTEGER) │
│    │ jenis_kelamin       (ENUM)  │         │    │ kelurahan          (STRING) │
│    │ tempat_lahir       (STRING) │         │    │ kecamatan          (STRING) │
│    │ tanggal_lahir        (DATE) │         │    │ kabupaten          (STRING) │
│    │ no_telp            (STRING) │         │    │ provinsi           (STRING) │
│    │ agama              (STRING) │         │    │ luas_tanah        (INTEGER) │
│    │ created_at        (DATETIME)│         │    │ luas_bangunan     (INTEGER) │
│    │ updated_at        (DATETIME)│         │    │ status_tanah       (STRING) │
│    │                             │         │    │ status_bangunan    (STRING) │
│    │ ◆ UNIQUE(nik)              │         │    │ jenis_bangunan     (STRING) │
│    │ ◆ UNIQUE(no_kk)            │         │    │ tahun_perolehan   (INTEGER) │
│    │ ◆ INDEXED                  │         │    │ nilai_pajak_tahun_ini(BIGINT)
└──────────────────────────────────┘         │    │ status_pembayaran  (STRING) │
                                              │    │ keterangan          (TEXT)  │
                                              │    │ created_at        (DATETIME)│
                                              │    │ updated_at        (DATETIME)│
                                              │    │                             │
                                              │    │ ◆ UNIQUE(nop)              │
                                              │    │ ◆ INDEXED(nik_pemilik)     │
                                              └──────────────────────────────────┘
```

#### 🔑 Penjelasan ERD

**Keterangan Simbol:**

-   `PK` = Primary Key (Kunci Utama)
-   `FK` = Foreign Key (Kunci Tamu/Asing)
-   `◆` = Constraint/Index
-   `1:∞` = Relasi One-to-Many

#### 📋 Identifikasi Entitas dan Atributnya

##### **ENTITAS 1: USERS (Pengguna Sistem)**

| Atribut             | Tipe Data    | Constraint         | Keterangan                    |
| ------------------- | ------------ | ------------------ | ----------------------------- |
| `id`                | BIGINT       | PK, AUTO_INCREMENT | Kunci utama user              |
| `name`              | VARCHAR(255) | NOT NULL           | Nama lengkap pengguna         |
| `email`             | VARCHAR(255) | UNIQUE, NOT NULL   | Email unik sebagai identifier |
| `email_verified_at` | TIMESTAMP    | NULLABLE           | Waktu verifikasi email        |
| `password`          | VARCHAR(255) | NOT NULL           | Password terenkripsi (hashed) |
| `role`              | ENUM         | DEFAULT 'user'     | Peran: admin atau user        |
| `remember_token`    | VARCHAR(100) | NULLABLE           | Token untuk remember me       |
| `created_at`        | TIMESTAMP    | CURRENT_TIMESTAMP  | Waktu pembuatan record        |
| `updated_at`        | TIMESTAMP    | CURRENT_TIMESTAMP  | Waktu update terakhir         |

**Fungsi:** Menyimpan data pengguna sistem untuk autentikasi dan manajemen akses

---

##### **ENTITAS 2: WARGA (Data Penduduk)**

| Atribut         | Tipe Data    | Constraint                | Keterangan                          |
| --------------- | ------------ | ------------------------- | ----------------------------------- |
| `id`            | BIGINT       | PK, AUTO_INCREMENT        | Kunci utama warga                   |
| `nik`           | VARCHAR(16)  | UNIQUE, NOT NULL, INDEXED | Nomor Induk Kependudukan (16 digit) |
| `no_kk`         | VARCHAR(16)  | UNIQUE, NOT NULL          | Nomor Kartu Keluarga                |
| `nama_lengkap`  | VARCHAR(255) | NOT NULL                  | Nama lengkap penduduk               |
| `alamat`        | TEXT         | NOT NULL                  | Alamat lengkap                      |
| `rt`            | INT          | NOT NULL                  | Nomor RT (Rukun Tetangga)           |
| `rw`            | INT          | NOT NULL                  | Nomor RW (Rukun Warga)              |
| `jenis_kelamin` | ENUM         | NOT NULL                  | Laki-laki / Perempuan               |
| `tempat_lahir`  | VARCHAR(255) | NOT NULL                  | Tempat lahir                        |
| `tanggal_lahir` | DATE         | NOT NULL                  | Tanggal lahir                       |
| `no_telp`       | VARCHAR(15)  | NULLABLE                  | Nomor telepon                       |
| `agama`         | VARCHAR(50)  | NOT NULL                  | Agama yang dianut                   |
| `created_at`    | TIMESTAMP    | CURRENT_TIMESTAMP         | Waktu pembuatan record              |
| `updated_at`    | TIMESTAMP    | CURRENT_TIMESTAMP         | Waktu update terakhir               |

**Fungsi:** Menyimpan data kependudukan/penduduk yang menjadi dasar untuk data PBB

---

##### **ENTITAS 3: PBB (Pajak Bumi dan Bangunan)**

| Atribut                 | Tipe Data    | Constraint                | Keterangan                           |
| ----------------------- | ------------ | ------------------------- | ------------------------------------ |
| `id`                    | BIGINT       | PK, AUTO_INCREMENT        | Kunci utama PBB                      |
| `nop`                   | VARCHAR(18)  | UNIQUE, NOT NULL, INDEXED | Nomor Objek Pajak (standar 18 digit) |
| `nik_pemilik`           | VARCHAR(16)  | FK, NOT NULL, INDEXED     | Referensi ke WARGA.nik               |
| `nama_pemilik`          | VARCHAR(100) | NOT NULL                  | Nama pemilik objek                   |
| `alamat_objek`          | TEXT         | NOT NULL                  | Alamat objek pajak                   |
| `rt`                    | INT          | NOT NULL                  | Nomor RT lokasi objek                |
| `rw`                    | INT          | NOT NULL                  | Nomor RW lokasi objek                |
| `kelurahan`             | VARCHAR(100) | NOT NULL                  | Kelurahan/Desa                       |
| `kecamatan`             | VARCHAR(100) | NOT NULL                  | Kecamatan                            |
| `kabupaten`             | VARCHAR(100) | NOT NULL                  | Kabupaten/Kota                       |
| `provinsi`              | VARCHAR(100) | NOT NULL                  | Provinsi                             |
| `luas_tanah`            | INT          | NOT NULL                  | Luas tanah dalam m²                  |
| `luas_bangunan`         | INT          | DEFAULT 0                 | Luas bangunan dalam m²               |
| `status_tanah`          | VARCHAR(50)  | NOT NULL                  | Milik Sendiri / Sewa / Hibah         |
| `status_bangunan`       | VARCHAR(50)  | NOT NULL                  | Milik Sendiri / Sewa / Hibah         |
| `jenis_bangunan`        | VARCHAR(100) | NOT NULL                  | Rumah / Gedung / Pabrik / Toko / dll |
| `tahun_perolehan`       | INT          | NOT NULL                  | Tahun perolehan/pembangunan          |
| `nilai_pajak_tahun_ini` | BIGINT       | NOT NULL                  | Nilai pajak tahun berjalan           |
| `status_pembayaran`     | VARCHAR(50)  | DEFAULT 'Belum Lunas'     | Lunas / Belum Lunas / Cicilan        |
| `keterangan`            | TEXT         | NULLABLE                  | Catatan tambahan                     |
| `created_at`            | TIMESTAMP    | CURRENT_TIMESTAMP         | Waktu pembuatan record               |
| `updated_at`            | TIMESTAMP    | CURRENT_TIMESTAMP         | Waktu update terakhir                |

**Fungsi:** Menyimpan data Pajak Bumi dan Bangunan beserta informasi properti dan pemiliknya

---

#### 🔗 Relasi Antar Entitas

##### **Relasi 1: WARGA ↔ PBB (One-to-Many)**

```
WARGA (1) ───────→ (∞) PBB
   ↓                    ↓
  nik ←─────FK─────── nik_pemilik
```

-   **Tipe Relasi:** One-to-Many (1:∞)
-   **Keterangan:**

    -   1 WARGA dapat memiliki banyak PBB (satu orang bisa memiliki beberapa objek pajak)
    -   Setiap PBB harus mereferensikan tepat 1 WARGA (setiap properti harus punya pemilik)

-   **Primary Key:** `WARGA.nik` (Nomor Induk Kependudukan)
-   **Foreign Key:** `PBB.nik_pemilik` → `WARGA.nik`
-   **Cascading Action:** `ON DELETE CASCADE` (Jika warga dihapus, semua PBB miliknya juga terhapus)

**Implementasi di Database:**

```sql
ALTER TABLE pbb
ADD CONSTRAINT fk_pbb_warga
FOREIGN KEY (nik_pemilik)
REFERENCES warga(nik)
ON DELETE CASCADE
ON UPDATE CASCADE;
```

---

#### ✅ Verifikasi Kebenaran ERD

##### **Checklist Verifikasi:**

| Aspek                    | Status | Penjelasan                                        |
| ------------------------ | ------ | ------------------------------------------------- |
| **Identifikasi Entitas** | ✅     | 3 entitas teridentifikasi: USERS, WARGA, PBB      |
| **Primary Key**          | ✅     | Setiap entitas memiliki PK unik (id)              |
| **Atribut Lengkap**      | ✅     | Semua atribut dari migration sudah terdokumentasi |
| **Foreign Key**          | ✅     | PBB.nik_pemilik → WARGA.nik sudah terdefinisi     |
| **Relasi Logical**       | ✅     | Relasi 1:∞ antara WARGA dan PBB sudah tepat       |
| **Constraints**          | ✅     | UNIQUE, NOT NULL, INDEXED sudah tercantum         |
| **Cascading**            | ✅     | ON DELETE CASCADE sudah ditetapkan                |
| **Tipe Data**            | ✅     | Semua tipe data sesuai kebutuhan dan efisien      |
| **Normalisasi**          | ✅     | Data sudah ternormalisasi minimal 3NF             |
| **Business Logic**       | ✅     | Semua requirement bisnis tercermin dalam schema   |

---

##### **Validasi Lanjutan:**

1. **NIK sebagai PK di WARGA**: ✅

    - NIK adalah identifier unik nasional untuk setiap warga negara
    - Lebih meaningful daripada menggunakan auto-increment id

2. **Foreign Key di PBB**: ✅

    - Menjamin data integrity (tidak ada PBB tanpa pemilik yang valid)
    - Cascading delete mencegah orphaned records

3. **Unique Constraint pada NOP**: ✅

    - NOP (Nomor Objek Pajak) adalah identitas unik untuk setiap properti
    - Mencegah duplikasi data pajak

4. **Tabel USERS**: ✅

    - Terpisah dari WARGA (user sistem bisa berbeda dengan data penduduk)
    - Memungkinkan multiple users dengan role-based access

5. **Status Fields**: ✅
    - Status pembayaran, status tanah, status bangunan diperlukan untuk tracking
    - Bisa diperbaiki dengan foreign key ke master table (future enhancement)

---

### Schema Utama

#### Tabel: `users`

Menyimpan data pengguna sistem

```sql
- id (Primary Key)
- name (String)
- email (Unique)
- password (Hashed)
- role (Enum: admin, user)
- email_verified_at (Timestamp)
- timestamps
```

#### Tabel: `warga`

Menyimpan data penduduk

```sql
- id (Primary Key)
- nik (String, Unique)          -- Nomor Induk Kependudukan
- no_kk (String, Unique)        -- Nomor Kartu Keluarga
- nama_lengkap (String)
- alamat (String)
- rt, rw (Integer)
- jenis_kelamin (Enum)
- tempat_lahir (String)
- tanggal_lahir (Date)
- no_telp (String)
- agama (String)
- timestamps
```

#### Tabel: `pbb`

Menyimpan data Pajak Bumi dan Bangunan

```sql
- id (Primary Key)
- nop (String, Unique)          -- Nomor Objek Pajak
- nik_pemilik (Foreign Key)     -- References warga.nik
- nama_pemilik (String)
- alamat_objek (String)
- rt, rw (Integer)
- kelurahan, kecamatan, kabupaten, provinsi (String)
- luas_tanah (Integer)          -- dalam m²
- luas_bangunan (Integer)       -- dalam m²
- status_tanah (String)         -- Milik Sendiri, Sewa, Hibah
- status_bangunan (String)      -- Milik Sendiri, Sewa, Hibah
- jenis_bangunan (String)
- tahun_perolehan (Integer)
- nilai_pajak_tahun_ini (Big Integer)
- status_pembayaran (String)    -- Lunas, Belum Lunas, Cicilan
- keterangan (Text)
- timestamps
```

### Relasi Database

```
Warga (1) ──────→ (∞) PBB
  |                  |
  ├─ nik (PK)        ├─ nik_pemilik (FK)
  └─ ...             └─ ...
```

---

## 🔌 API Endpoints

### Authentication Routes

| Method | Endpoint    | Deskripsi              |
| ------ | ----------- | ---------------------- |
| GET    | `/login`    | Tampil form login      |
| POST   | `/login`    | Process login          |
| GET    | `/register` | Tampil form registrasi |
| POST   | `/register` | Process registrasi     |
| POST   | `/logout`   | Logout user            |

### Protected Routes (Requires Authentication)

#### Dashboard

| Method | Endpoint     | Deskripsi      |
| ------ | ------------ | -------------- |
| GET    | `/`          | Dashboard home |
| GET    | `/dashboard` | Dashboard page |

#### Warga (Data Penduduk)

| Method | Endpoint           | Deskripsi         |
| ------ | ------------------ | ----------------- |
| GET    | `/warga`           | List semua warga  |
| GET    | `/warga/create`    | Form create warga |
| POST   | `/warga`           | Store warga baru  |
| GET    | `/warga/{id}`      | Show detail warga |
| GET    | `/warga/{id}/edit` | Form edit warga   |
| PUT    | `/warga/{id}`      | Update warga      |
| DELETE | `/warga/{id}`      | Delete warga      |

#### PBB (Pajak Bumi & Bangunan)

| Method | Endpoint         | Deskripsi       |
| ------ | ---------------- | --------------- |
| GET    | `/pbb`           | List semua PBB  |
| GET    | `/pbb/create`    | Form create PBB |
| POST   | `/pbb`           | Store PBB baru  |
| GET    | `/pbb/{id}`      | Show detail PBB |
| GET    | `/pbb/{id}/edit` | Form edit PBB   |
| PUT    | `/pbb/{id}`      | Update PBB      |
| DELETE | `/pbb/{id}`      | Delete PBB      |

#### Report & Export

| Method | Endpoint               | Deskripsi       |
| ------ | ---------------------- | --------------- |
| GET    | `/report`              | Halaman laporan |
| POST   | `/report/export-pdf`   | Export ke PDF   |
| POST   | `/report/export-excel` | Export ke Excel |

---

## 📚 Dokumentasi

### Dokumentasi Teknis

-   **[ERD.md](./ERD.md)** - Entity Relationship Diagram dan skema database
-   **[UML.md](./UML.md)** - UML diagrams, class diagram, dan arsitektur sistem
-   **[LARAGON_SETUP.md](./LARAGON_SETUP.md)** - Setup guide khusus Laragon
-   **[VERIFICATION_CHECKLIST.md](./VERIFICATION_CHECKLIST.md)** - Verification checklist

### Laravel Documentation

-   [Laravel 12 Documentation](https://laravel.com/docs)
-   [Eloquent ORM](https://laravel.com/docs/eloquent)
-   [Blade Templating](https://laravel.com/docs/blade)

### Frontend Documentation

-   [Tailwind CSS](https://tailwindcss.com/docs)
-   [Alpine.js](https://alpinejs.dev/)
-   [Vite](https://vitejs.dev/)

---

## 🔒 Security

### Best Practices Diterapkan

-   ✅ **Password Hashing**: Bcrypt untuk password storage
-   ✅ **CSRF Protection**: Middleware CSRF token untuk setiap form
-   ✅ **SQL Injection Prevention**: Eloquent ORM dengan parameter binding
-   ✅ **XSS Protection**: Blade templating dengan automatic escaping
-   ✅ **Authentication**: Session-based authentication
-   ✅ **Authorization**: Role-based access control (RBAC)
-   ✅ **Input Validation**: Server-side validation pada setiap input
-   ✅ **HTTPS**: Support HTTPS untuk production

### Rekomendasi Keamanan

1. **Change Default Credentials**: Ganti password default setelah setup
2. **Environment Variables**: Jangan commit `.env` file ke git
3. **Database Backups**: Regular backup database
4. **Update Dependencies**: Regular update composer dan npm packages
5. **SSL Certificate**: Gunakan HTTPS di production
6. **Rate Limiting**: Implementasikan rate limiting untuk API
7. **Access Logs**: Monitor file access logs untuk suspicious activity

---

## 🐛 Troubleshooting

### Masalah Umum

#### Error: "No application encryption key has been specified"

```bash
php artisan key:generate
```

#### Error: "Class not found"

```bash
composer dump-autoload
```

#### Error: "Table not found"

```bash
php artisan migrate
php artisan migrate:fresh # Untuk reset database
```

#### Error: "Permission denied" (Storage)

```bash
chmod -R 777 storage/
chmod -R 777 bootstrap/cache/
```

#### Vite Assets tidak loading

```bash
npm run build
# atau untuk development
npm run dev
```

#### Database connection error

-   Pastikan MySQL service running
-   Verify `.env` database credentials
-   Check DB_HOST (gunakan 127.0.0.1 bukan localhost untuk beberapa kasus)

#### Session/Cache issues

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

#### Memory exhausted

Increase PHP memory limit di `php.ini`:

```ini
memory_limit = 512M
```

### Debug Mode

Untuk development, aktifkan debug mode di `.env`:

```env
APP_DEBUG=true
```

Gunakan `dd()` atau `dump()` untuk debug:

```php
dd($variable);  // Dump and die
dump($variable); // Just dump
```

---

## 🤝 Kontribusi

### Cara Berkontribusi

1. Fork repository ini
2. Buat branch feature (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Development Guidelines

-   Follow PSR-12 coding standard
-   Gunakan Laravel conventions
-   Tambahkan unit tests untuk fitur baru
-   Update dokumentasi jika ada perubahan
-   Test di local sebelum push

### Code Style

```bash
# Run Laravel Pint untuk fix code style
php artisan pint

# atau
./vendor/bin/pint
```

### Testing

```bash
# Run unit tests
php artisan test

# Run dengan coverage report
php artisan test --coverage

# Run specific test
php artisan test tests/Feature/AuthTest.php
```

---

## 📄 Lisensi

ProjectUKK dilisensikan di bawah **MIT License**. Lihat file [LICENSE](LICENSE) untuk detail.

---

## 👨‍💻 Author

**ProjectUKK** dibuat oleh [ka080808](https://github.com/ka080808)

---

## 📞 Support & Contact

-   📧 Email: ka080808@example.com
-   🐛 Issues: [GitHub Issues](https://github.com/ka080808/projectUKK/issues)
-   💬 Discussions: [GitHub Discussions](https://github.com/ka080808/projectUKK/discussions)

---

## 🎯 Roadmap

### v1.0 (Current)

-   ✅ Authentication & Authorization
-   ✅ Manajemen Warga (CRUD)
-   ✅ Manajemen PBB (CRUD)
-   ✅ Dashboard & Statistics
-   ✅ Report & Export (PDF, Excel)

### v1.1 (Planned)

-   📋 Advanced Search & Filter
-   📊 Enhanced Analytics Dashboard
-   📧 Email Notification
-   📱 Mobile Responsive Optimization

### v2.0 (Future)

-   🔗 API REST untuk mobile app
-   📱 Mobile Application
-   🗺️ Map Integration (Pemetaan GIS)
-   💳 Payment Gateway Integration
-   📊 Advanced Reporting & Analytics

---

## 📈 Performance Tips

1. **Database Indexing**: Pastikan index pada kolom sering dicari (nik, nop, email)
2. **Query Optimization**: Gunakan eager loading dengan `with()` untuk menghindari N+1 queries
3. **Caching**: Implementasikan caching untuk data yang jarang berubah
4. **Asset Minification**: Gunakan `npm run build` untuk production
5. **Database Optimization**: Jalankan `ANALYZE` table secara berkala

---

## 🙏 Acknowledgments

-   Laravel framework team
-   Tailwind CSS team
-   Community kontributor
-   Semua yang telah support project ini

---

**Selamat menggunakan ProjectUKK! Semoga bermanfaat untuk mengelola data PBB di wilayah Anda.** 🚀

_Last Updated: November 28, 2025_
