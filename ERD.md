# Entity Relationship Diagram (ERD)

## Database Schema Overview

This project manages tax (PBB) data and resident (Warga) information with user authentication.

## Entities

### 1. **Users**
Stores system user credentials and roles for authentication and authorization.

| Column | Type | Constraint | Description |
|--------|------|-----------|-------------|
| id | BIGINT | PRIMARY KEY, AUTO INCREMENT | Unique user identifier |
| name | VARCHAR(255) | NOT NULL | User full name |
| email | VARCHAR(255) | UNIQUE, NOT NULL | User email address |
| email_verified_at | TIMESTAMP | NULLABLE | Email verification timestamp |
| password | VARCHAR(255) | NOT NULL | Hashed password |
| role | ENUM('admin','user') | DEFAULT 'user' | User role for authorization |
| remember_token | VARCHAR(100) | NULLABLE | Remember me token |
| created_at | TIMESTAMP | NOT NULL | Record creation timestamp |
| updated_at | TIMESTAMP | NOT NULL | Record update timestamp |

### 2. **Warga** (Residents)
Stores personal information of residents in the area.

| Column | Type | Constraint | Description |
|--------|------|-----------|-------------|
| id | BIGINT | PRIMARY KEY, AUTO INCREMENT | Unique resident identifier |
| nik | VARCHAR(16) | UNIQUE, NOT NULL | National Identity Number (Nomor Induk Kependudukan) |
| no_kk | VARCHAR(16) | UNIQUE, NOT NULL | Family Card Number (Nomor Kartu Keluarga) |
| nama_lengkap | VARCHAR(255) | NOT NULL | Full name |
| alamat | VARCHAR(255) | NOT NULL | Address |
| rt | INT | NOT NULL | Rukun Tetangga (neighborhood unit) |
| rw | INT | NOT NULL | Rukun Warga (community unit) |
| jenis_kelamin | ENUM('Laki-laki','Perempuan') | NOT NULL | Gender |
| tempat_lahir | VARCHAR(255) | NOT NULL | Place of birth |
| tanggal_lahir | DATE | NOT NULL | Date of birth |
| no_telp | VARCHAR(20) | NULLABLE | Phone number |
| agama | VARCHAR(50) | NOT NULL | Religion |
| created_at | TIMESTAMP | NOT NULL | Record creation timestamp |
| updated_at | TIMESTAMP | NOT NULL | Record update timestamp |

### 3. **PBB** (Property Tax)
Stores property tax information linked to residents.

| Column | Type | Constraint | Description |
|--------|------|-----------|-------------|
| id | BIGINT | PRIMARY KEY, AUTO INCREMENT | Unique tax record identifier |
| nop | VARCHAR(18) | UNIQUE, NOT NULL | Nomor Objek Pajak (Tax Object Number) |
| nik_pemilik | VARCHAR(16) | FOREIGN KEY | Owner's NIK (references warga.nik) |
| nama_pemilik | VARCHAR(100) | NOT NULL | Owner's name |
| alamat_objek | VARCHAR(255) | NOT NULL | Property address |
| rt | INT | NOT NULL | Rukun Tetangga |
| rw | INT | NOT NULL | Rukun Warga |
| kelurahan | VARCHAR(100) | NOT NULL | Sub-district |
| kecamatan | VARCHAR(100) | NOT NULL | District |
| kabupaten | VARCHAR(100) | NOT NULL | Regency |
| provinsi | VARCHAR(100) | NOT NULL | Province |
| luas_tanah | INT | NOT NULL | Land area (in square meters) |
| luas_bangunan | INT | DEFAULT 0 | Building area (in square meters) |
| status_tanah | VARCHAR(50) | NOT NULL | Land status (Milik Sendiri/Sewa/Hibah) |
| status_bangunan | VARCHAR(50) | NOT NULL | Building status (Milik Sendiri/Sewa/Hibah) |
| jenis_bangunan | VARCHAR(50) | NOT NULL | Building type |
| tahun_perolehan | INT | NOT NULL | Year of acquisition |
| nilai_pajak_tahun_ini | BIGINT | NOT NULL | Tax value this year |
| status_pembayaran | VARCHAR(50) | DEFAULT 'Belum Lunas' | Payment status (Lunas/Belum Lunas/Cicilan) |
| keterangan | VARCHAR(255) | NULLABLE | Additional notes |
| created_at | TIMESTAMP | NOT NULL | Record creation timestamp |
| updated_at | TIMESTAMP | NOT NULL | Record update timestamp |

## Relationships

### PBB → Warga (Many-to-One)
- **Foreign Key**: `pbb.nik_pemilik` → `warga.nik`
- **Relationship Type**: Many PBB records can belong to one Warga
- **On Delete**: CASCADE (when a resident is deleted, all their tax records are deleted)
- **Description**: Each property tax record must be associated with a registered resident

```
Warga (1) ──────→ (∞) PBB
  |                  |
  ├─ nik (PK)        ├─ nik_pemilik (FK)
  ├─ nama_lengkap    ├─ nop
  └─ ...             └─ ...
```

## ER Diagram (Text-based)

```
┌─────────────┐
│    Users    │
├─────────────┤
│ id (PK)     │
│ name        │
│ email       │
│ password    │
│ role        │
│ timestamps  │
└─────────────┘


┌──────────────────────┐
│      Warga           │
├──────────────────────┤
│ id (PK)              │
│ nik (UNIQUE)         │──┐
│ no_kk (UNIQUE)       │  │
│ nama_lengkap         │  │
│ alamat               │  │
│ rt, rw               │  │
│ jenis_kelamin        │  │
│ tempat_lahir         │  │
│ tanggal_lahir        │  │
│ no_telp              │  │
│ agama                │  │
│ timestamps           │  │
└──────────────────────┘  │
                          │ nik_pemilik (FK)
                          │
┌──────────────────────┐  │
│       PBB            │  │
├──────────────────────┤  │
│ id (PK)              │  │
│ nop (UNIQUE)         │  │
│ nik_pemilik (FK) ────┴──┘
│ nama_pemilik         │
│ alamat_objek         │
│ rt, rw               │
│ kelurahan            │
│ kecamatan            │
│ kabupaten            │
│ provinsi             │
│ luas_tanah           │
│ luas_bangunan        │
│ status_tanah         │
│ status_bangunan      │
│ jenis_bangunan       │
│ tahun_perolehan      │
│ nilai_pajak_tahun_ini│
│ status_pembayaran    │
│ keterangan           │
│ timestamps           │
└──────────────────────┘
```

## Database Statistics

- **Total Tables**: 3 main entities + 3 Laravel system tables
- **Total Columns**: 
  - Users: 9
  - Warga: 13
  - PBB: 20
- **Primary Keys**: 3 (id in each main table)
- **Foreign Keys**: 1 (PBB → Warga)
- **Unique Constraints**: 3 (email in users, nik & no_kk in warga, nop in pbb)

## Data Flow

1. **User Registration**: Admin or user registers in the system via the Users table
2. **Resident Registration**: Data is entered into the Warga table with unique NIK and KK numbers
3. **Tax Registration**: PBB data is created and linked to residents via their NIK
4. **Tax Management**: System manages tax status and payment information

## Notes

- The system uses cascade delete, so deleting a resident will remove all associated tax records
- NIK serves as the primary connection between residents and tax records
- All timestamps are automatically managed by Laravel
- The Users table is separate from Warga, allowing for administrative users who aren't residents
