# 📚 Dokumentasi Role-Based Access Control - Code Structure

## 🔐 Sistem Role

Aplikasi memiliki 2 role utama:
- **ADMIN** - Akses penuh ke semua fitur
- **USER** - Akses terbatas (hanya input data)

---

## 📂 Struktur File & Penjelasan

### 1️⃣ **Middleware: `app/Http/Middleware/CheckRole.php`**

**Fungsi:** Mengecek role user sebelum akses route

```php
public function handle(Request $request, Closure $next, ...$roles): Response
{
    // Jika user tidak authenticated
    if (!$request->user()) {
        return redirect()->route('login');
    }

    // Cek apakah role user ada di dalam roles yang diizinkan
    if (in_array($request->user()->role, $roles)) {
        return $next($request);
    }

    // Jika role tidak sesuai, reject
    return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
}
```

**Cara Pakai:**
```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Hanya admin yang bisa akses
});

Route::middleware(['auth', 'role:user,admin'])->group(function () {
    // User dan admin bisa akses
});
```

---

### 2️⃣ **Controller: `app/Http/Controllers/AuthController.php`**

**Bagian Penting - Login dengan Role Redirect:**

```php
public function login(Request $request)
{
    // Validasi & Auth attempt
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        // Redirect berdasarkan role
        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard')->with('success', 'Berhasil login! 😊');
        } else {
            return redirect()->route('user.dashboard')->with('success', 'Berhasil login! 😊');
        }
    }
    
    return back()->with('error', 'Email atau password salah ❌');
}
```

**Logika:**
- Admin login → `/dashboard` (halaman admin)
- User login → `/user-dashboard` (halaman user)

---

### 3️⃣ **Routes: `routes/web.php`**

#### **Struktur Route:**

```php
// 1. PUBLIC ROUTES (Tidak perlu login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// 2. ROOT ROUTE (Redirect berdasarkan role)
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
    return redirect()->route('login');
});

// 3. ADMIN ROUTES (Middleware: auth + role:admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin bisa akses semua operasi CRUD
    Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
    Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
    Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
    Route::get('/warga/{warga}/edit', [WargaController::class, 'edit'])->name('warga.edit');
    Route::put('/warga/{warga}', [WargaController::class, 'update'])->name('warga.update');
    Route::delete('/warga/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');
    
    // ... (PBB routes, Report routes)
});

// 4. USER ROUTES (Middleware: auth + role:user)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user-dashboard', function () {
        return view('dashboard.user');
    })->name('user.dashboard');
    
    // User hanya bisa CREATE, tidak bisa READ/UPDATE/DELETE
    Route::get('/warga-create', [WargaController::class, 'create'])->name('warga.create-user');
    Route::post('/warga-store', [WargaController::class, 'store'])->name('warga.store-user');
    
    Route::get('/pbb-create', [PBBController::class, 'create'])->name('pbb.create-user');
    Route::post('/pbb-store', [PBBController::class, 'store'])->name('pbb.store-user');
});
```

**Key Points:**
- Route dengan prefix `/warga` → Admin only
- Route dengan prefix `/warga-create` → User only
- Middleware `['auth', 'role:admin']` blok user
- Middleware `['auth', 'role:user']` blok admin

---

### 4️⃣ **Model: `app/Models/User.php`**

**Properti Role:**

```php
class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',  // ← Properti role
    ];
}
```

**Cara Akses:**
```php
$user = Auth::user();
echo $user->role;  // Output: 'admin' atau 'user'

// Cek di view
@if(Auth::user()->role === 'admin')
    <!-- Tampilkan untuk admin -->
@endif
```

---

### 5️⃣ **Database: `database/seeders/DatabaseSeeder.php`**

**Membuat User dengan Role:**

```php
public function run(): void
{
    User::firstOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',  // ← Role admin
        ]
    );

    User::firstOrCreate(
        ['email' => 'operator@example.com'],
        [
            'name' => 'Operator',
            'password' => Hash::make('password'),
            'role' => 'user',  // ← Role user
        ]
    );
}
```

---

### 6️⃣ **Bootstrap Config: `bootstrap/app.php`**

**Registrasi Middleware:**

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'role' => \App\Http\Middleware\CheckRole::class,
    ]);
})
```

---

## 🎯 Flow Diagram

```
┌─────────────────┐
│   Login Page    │
└────────┬────────┘
         │ POST /login
         ▼
┌─────────────────────────────┐
│  AuthController::login()    │
│  - Validasi credentials     │
│  - Auth::attempt()          │
└────────┬────────────────────┘
         │
         ├─── Check role ───┐
         │                  │
         ▼                  ▼
    ADMIN              USER
         │                  │
         ▼                  ▼
    /dashboard       /user-dashboard
         │                  │
         ▼                  ▼
    ✅ Admin View       ✅ User View
    (Full Access)       (Limited Access)
```

---

## 🔍 Cara Mengecek Role di Code

### **Di Controller:**
```php
if (Auth::user()->role === 'admin') {
    // Admin action
} elseif (Auth::user()->role === 'user') {
    // User action
}
```

### **Di Blade Template:**
```blade
@if(Auth::user()->role === 'admin')
    <p>Anda adalah Admin</p>
@else
    <p>Anda adalah User</p>
@endif

@role('admin')
    <!-- Admin content -->
@endrole
```

### **Di Route:**
```php
Route::middleware('role:admin')->group(function () {
    // Admin routes
});
```

---

## ✅ Testing Checklist

- [ ] Admin login → Redirect ke dashboard ✅
- [ ] User login → Redirect ke user-dashboard ✅
- [ ] Admin akses `/warga` → Berhasil ✅
- [ ] User akses `/warga` → Error 403 ✅
- [ ] User akses `/warga-create` → Berhasil ✅
- [ ] Admin logout → Redirect ke login ✅

---

## 📝 Akun Test

| Email | Password | Role |
|-------|----------|------|
| admin@example.com | password | Admin |
| operator@example.com | password | User |
| katyxeight@gmail.com | Vinividi1933 | Admin |

---

**Generated:** December 5, 2025
**Last Update:** Role-Based Access Control Implementation
