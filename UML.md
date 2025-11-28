# UML (Unified Modeling Language) Diagrams

## Class Diagram

### System Architecture Overview

The projectUKK system consists of three main classes representing the core business entities and their relationships.

```
┌─────────────────────────────────────┐
│           User                      │
├─────────────────────────────────────┤
│ - id: int (PK)                      │
│ - name: string                      │
│ - email: string (UNIQUE)            │
│ - email_verified_at: timestamp      │
│ - password: string (hashed)         │
│ - role: enum(admin|user)            │
│ - remember_token: string            │
│ - created_at: timestamp             │
│ - updated_at: timestamp             │
├─────────────────────────────────────┤
│ + create(): void                    │
│ + update(): void                    │
│ + delete(): void                    │
│ + authenticate(): boolean           │
│ + authorize(role): boolean          │
└─────────────────────────────────────┘
         ▲
         │ authenticates
         │
         │ (1:N)
         │


┌──────────────────────────────────────┐
│         Warga                        │
├──────────────────────────────────────┤
│ - id: int (PK)                       │
│ - nik: string (UNIQUE)               │
│ - no_kk: string (UNIQUE)             │
│ - nama_lengkap: string               │
│ - alamat: string                     │
│ - rt: int                            │
│ - rw: int                            │
│ - jenis_kelamin: enum                │
│ - tempat_lahir: string               │
│ - tanggal_lahir: date                │
│ - no_telp: string (nullable)         │
│ - agama: string                      │
│ - created_at: timestamp              │
│ - updated_at: timestamp              │
├──────────────────────────────────────┤
│ + create(): void                     │
│ + read(): Warga                      │
│ + update(): void                     │
│ + delete(): void                     │
│ + getPBBRecords(): Collection<PBB>   │
│ + validateNIK(): boolean             │
│ + calculateAge(): int                │
└──────────────────────────────────────┘
         ▲
         │
         │ is owner of (1:N)
         │
         │
┌──────────────────────────────────────┐
│          PBB                         │
├──────────────────────────────────────┤
│ - id: int (PK)                       │
│ - nop: string (UNIQUE)               │
│ - nik_pemilik: string (FK)           │
│ - nama_pemilik: string               │
│ - alamat_objek: string               │
│ - rt: int                            │
│ - rw: int                            │
│ - kelurahan: string                  │
│ - kecamatan: string                  │
│ - kabupaten: string                  │
│ - provinsi: string                   │
│ - luas_tanah: int                    │
│ - luas_bangunan: int                 │
│ - status_tanah: string               │
│ - status_bangunan: string            │
│ - jenis_bangunan: string             │
│ - tahun_perolehan: int               │
│ - nilai_pajak_tahun_ini: bigint      │
│ - status_pembayaran: string          │
│ - keterangan: string (nullable)      │
│ - created_at: timestamp              │
│ - updated_at: timestamp              │
├──────────────────────────────────────┤
│ + create(): void                     │
│ + read(): PBB                        │
│ + update(): void                     │
│ + delete(): void                     │
│ + getOwner(): Warga                  │
│ + calculateTaxAmount(): bigint       │
│ + updatePaymentStatus(status): void  │
│ + generateReport(): string           │
└──────────────────────────────────────┘
```

## Use Case Diagram

```
                              ┌─────────────────────┐
                              │   System Pengguna   │
                              │      (projectUKK)   │
                              └─────────────────────┘
                                      │
                        ┌───────────────┼───────────────┐
                        │               │               │
                    ┌────────┐      ┌────────┐     ┌──────────┐
                    │  Admin │      │  User  │     │ Residen  │
                    └────────┘      └────────┘     └──────────┘
                        │               │               │
        ┌───────────────┼───────────┐   │               │
        │               │           │   │               │
   ┌─────────────┐ ┌─────────┐ ┌─────────────┐    ┌──────────────┐
   │Manage Users │ │ Lihat   │ │ Manage Warga│    │View Own Data │
   │  (Create,   │ │  Data   │ │  (CRUD)     │    │  (PBB, Info) │
   │  Read,      │ │ (Export,│ │             │    │              │
   │  Update,    │ │ Report) │ │             │    │              │
   │  Delete)    │ │         │ │             │    │              │
   └─────────────┘ └─────────┘ └─────────────┘    └──────────────┘
        │               │           │                   │
        └───────────────┼───────────┴───────────────────┘
                        │
        ┌───────────────┼───────────┐
        │               │           │
   ┌──────────┐  ┌──────────────┐  ┌──────────────┐
   │Manage PBB│  │Authentication│  │Generate Data │
   │ (CRUD)   │  │  & Login     │  │  Export      │
   │          │  │              │  │  (Excel, PDF)│
   └──────────┘  └──────────────┘  └──────────────┘
```

## Sequence Diagram: Create PBB Record

```
User        System       Controller      Model       Database
  │           │              │            │            │
  │─Register Data─────────────>│            │            │
  │           │              │            │            │
  │           │         Validate Input    │            │
  │           │              │            │            │
  │           │<─Response OK─│            │            │
  │           │              │            │            │
  │           │─Create Record──────────>│            │
  │           │              │            │            │
  │           │              │         Check NIK       │
  │           │              │         Exists in       │
  │           │              │         Warga           │
  │           │              │            │            │
  │           │              │         If Valid:       │
  │           │              │            │    Create  │
  │           │              │            ├───Record──>│
  │           │              │            │            │
  │           │              │            │<──Return──│
  │           │              │    Model Valid          │
  │           │              │            │            │
  │           │<─Return Created Record─┤            │
  │           │              │            │            │
  │<─Success Response─│            │            │
  │           │              │            │            │
```

## State Diagram: PBB Payment Status

```
                    ┌─────────────────────┐
                    │   Belum Lunas       │
                    │ (Not Yet Paid)      │
                    └──────────┬──────────┘
                               │
                         Create Record
                               │
                        ┌──────▼──────┐
                        │    Start    │
                        └──────┬──────┘
                               │
                    ┌──────────┴──────────┐
                    │                     │
                    │ Pay Full Amount     │ Pay Partially
                    │                     │
            ┌───────▼────────┐    ┌──────▼───────────┐
            │  Lunas          │    │  Cicilan         │
            │ (Paid)          │    │  (Installment)   │
            └────────┬────────┘    └─────┬────────────┘
                     │                   │
                     │ Another Payment   │ Complete All
                     │                   │ Installments
                     │                   │
                     │                   │
                     └────────┬──────────┘
                              │
                       ┌──────▼───────┐
                       │    Lunas     │
                       │   (Settled)  │
                       └──────────────┘
```

## Component Diagram

```
┌─────────────────────────────────────────────────────────────┐
│                    Application Layer                        │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────────┐ │
│  │  Controller  │  │   Service    │  │    Middleware   │ │
│  │              │  │              │  │                  │ │
│  │ - Handle     │  │ - Business   │  │ - Authentication│ │
│  │   Request    │  │   Logic      │  │ - Authorization │ │
│  │ - Response   │  │ - Validation │  │ - Logging       │ │
│  └──────────────┘  └──────────────┘  └──────────────────┘ │
│                                                             │
└────────────────────┬────────────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────────────┐
│                    Model Layer (Eloquent ORM)               │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  ┌─────────┐  ┌──────────┐  ┌──────┐  ┌─────────────────┐ │
│  │  User   │  │  Warga   │  │ PBB  │  │  Relationships  │ │
│  │ Model   │  │  Model   │  │Model │  │  & Factories    │ │
│  └─────────┘  └──────────┘  └──────┘  └─────────────────┘ │
│                                                             │
└────────────────────┬────────────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────────────┐
│              Database Abstraction Layer (Migrations)        │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  Schema Definition & Migrations                            │
│                                                             │
└────────────────────┬────────────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────────────┐
│                    Database Layer (MySQL)                   │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  ┌────────┐  ┌────────┐  ┌────────┐  ┌──────────────────┐ │
│  │ Users  │  │ Warga  │  │  PBB   │  │ Supporting Tables│ │
│  │ Table  │  │ Table  │  │ Table  │  │ (Cache, Sessions)│ │
│  └────────┘  └────────┘  └────────┘  └──────────────────┘ │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

## Deployment Diagram

```
┌──────────────────────────────────────────────────┐
│           User's Computer (Client)              │
│                                                  │
│  ┌──────────────────────────────────────────┐  │
│  │   Web Browser                            │  │
│  │   (Laravel Blade Templates)              │  │
│  └────────────┬─────────────────────────────┘  │
│               │ HTTP/HTTPS                     │
└───────────────┼──────────────────────────────────┘
                │
    ┌───────────┴──────────┐
    │                      │
┌───▼──────────────────────▼────────────────────────────┐
│          Web Server (Laragon/Apache)                 │
│                                                      │
│  ┌────────────────────────────────────────────────┐ │
│  │ Laravel Application                           │ │
│  │                                                │ │
│  │  ┌──────────────┐ ┌──────────────────────┐   │ │
│  │  │ Controllers  │ │ Routes (web.php)     │   │ │
│  │  ├──────────────┤ ├──────────────────────┤   │ │
│  │  │ Request      │ │ GET /warga           │   │ │
│  │  │ Handling     │ │ POST /pbb            │   │ │
│  │  │ Response     │ │ DELETE /user/{id}    │   │ │
│  │  └──────────────┘ └──────────────────────┘   │ │
│  │                                                │ │
│  │  ┌──────────────┐ ┌──────────────────────┐   │ │
│  │  │ Models       │ │ Views (Blade)        │   │ │
│  │  ├──────────────┤ ├──────────────────────┤   │ │
│  │  │ User         │ │ Livewire Components  │   │ │
│  │  │ Warga        │ │ Dashboard            │   │ │
│  │  │ PBB          │ │ Reports              │   │ │
│  │  └──────────────┘ └──────────────────────┘   │ │
│  │                                                │ │
│  └────────────────────────────────────────────────┘ │
│                         │                           │
└─────────────────────────┼───────────────────────────┘
                          │ Database Connection
                          │ (PDO/MySQL)
                          │
        ┌─────────────────┴─────────────────┐
        │                                   │
┌───────▼────────────────────────────────────▼────────┐
│          Database Server (MySQL)                   │
│                                                    │
│  ┌──────────────┬──────────────┬───────────────┐  │
│  │ users        │ warga        │ pbb           │  │
│  ├──────────────┼──────────────┼───────────────┤  │
│  │ id (PK)      │ id (PK)      │ id (PK)       │  │
│  │ name         │ nik (UNIQUE) │ nop (UNIQUE)  │  │
│  │ email        │ no_kk        │ nik_pemilik   │  │
│  │ password     │ nama_lengkap │ nama_pemilik  │  │
│  │ role         │ alamat       │ alamat_objek  │  │
│  │ timestamps   │ timestamps   │ timestamps    │  │
│  └──────────────┴──────────────┴───────────────┘  │
│                                                    │
│  ┌──────────────────────────────────────────────┐ │
│  │ Supporting Tables                           │ │
│  │ (cache, sessions, migrations, jobs, etc)    │ │
│  └──────────────────────────────────────────────┘ │
│                                                    │
└────────────────────────────────────────────────────┘
```

## Class Relationships

### User Model
```php
class User extends Authenticatable
{
    // Manages authentication and authorization
    // Roles: admin (full access), user (limited access)
    
    // Relationships
    // - None currently (independent entity)
}
```

### Warga Model
```php
class Warga extends Model
{
    // Represents resident information
    
    // Relationships
    public function pbb()
    {
        return $this->hasMany(PBB::class, 'nik_pemilik', 'nik');
    }
}
```

### PBB Model
```php
class PBB extends Model
{
    // Represents property tax information
    
    // Relationships
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'nik_pemilik', 'nik');
    }
}
```

## System Features Matrix

| Feature | Admin | User | Resident |
|---------|-------|------|----------|
| View All Users | ✓ | ✗ | ✗ |
| Create User | ✓ | ✗ | ✗ |
| Edit User | ✓ | ✗ | ✗ |
| Delete User | ✓ | ✗ | ✗ |
| View Warga | ✓ | ✓ | View Own |
| Create Warga | ✓ | ✓ | ✗ |
| Edit Warga | ✓ | ✓ | Edit Own |
| Delete Warga | ✓ | ✗ | ✗ |
| View PBB | ✓ | ✓ | View Own |
| Create PBB | ✓ | ✓ | ✗ |
| Edit PBB | ✓ | ✓ | ✗ |
| Delete PBB | ✓ | ✗ | ✗ |
| Export Data | ✓ | ✓ | ✗ |
| Generate Reports | ✓ | ✓ | ✗ |

## Technology Stack Diagram

```
┌─────────────────────────────────────┐
│   Frontend Layer                    │
├─────────────────────────────────────┤
│ - HTML/Blade Templates              │
│ - CSS/Tailwind CSS                  │
│ - JavaScript/Alpine.js              │
│ - Vite (Build Tool)                 │
└─────────────────────────────────────┘
           │
           ▼
┌─────────────────────────────────────┐
│   Laravel Framework                 │
├─────────────────────────────────────┤
│ - Routing (web.php)                 │
│ - Controllers (HTTP Logic)          │
│ - Models (Eloquent ORM)             │
│ - Migrations (Schema)               │
│ - Authentication (Auth Facade)      │
│ - Authorization (Policies)          │
└─────────────────────────────────────┘
           │
           ▼
┌─────────────────────────────────────┐
│   Database Layer                    │
├─────────────────────────────────────┤
│ - MySQL Database                    │
│ - Connection Pooling                │
│ - Query Optimization                │
└─────────────────────────────────────┘
```
