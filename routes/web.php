<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PBBController; // <-- tambahkan ini

// Public Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Root route - redirect based on auth status
Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        if (\Illuminate\Support\Facades\Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
    return redirect()->route('login');
});

// Protected Routes untuk ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Warga Management (Admin Full Access)
    Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
    Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
    Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
    Route::get('/warga/{warga}/edit', [WargaController::class, 'edit'])->name('warga.edit');
    Route::put('/warga/{warga}', [WargaController::class, 'update'])->name('warga.update');
    Route::delete('/warga/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');
    Route::get('/warga/print/all', [WargaController::class, 'printAll'])->name('warga.print');
    Route::get('/warga/export/pdf', [WargaController::class, 'exportPDF'])->name('warga.export-pdf');

    // PBB Management (Admin Full Access)
    Route::get('/pbb', [PBBController::class, 'index'])->name('pbb.index');
    Route::get('/pbb/create', [PBBController::class, 'create'])->name('pbb.create');
    Route::post('/pbb', [PBBController::class, 'store'])->name('pbb.store');
    Route::get('/pbb/{pbb}/edit', [PBBController::class, 'edit'])->name('pbb.edit');
    Route::put('/pbb/{pbb}', [PBBController::class, 'update'])->name('pbb.update');
    Route::delete('/pbb/{pbb}', [PBBController::class, 'destroy'])->name('pbb.destroy');
    Route::get('/pbb/print/all', [PBBController::class, 'printAll'])->name('pbb.print');
    Route::get('/pbb/export/pdf', [PBBController::class, 'exportPDF'])->name('pbb.export-pdf');

    // Laporan & Cetak Dokumen (Admin Only)
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::post('/report/export-pdf', [ReportController::class, 'exportPDF'])->name('report.export-pdf');
    Route::post('/report/export-excel', [ReportController::class, 'exportExcel'])->name('report.export-excel');
});

// Protected Routes untuk USER
Route::middleware(['auth', 'role:user'])->group(function () {
    // User dashboard/home
    Route::get('/user-dashboard', function () {
        return view('dashboard.user');
    })->name('user.dashboard');
    
    // User hanya bisa input data warga dan PBB (create & store)
    Route::get('/warga-create', [WargaController::class, 'create'])->name('warga.create-user');
    Route::post('/warga-store', [WargaController::class, 'store'])->name('warga.store-user');

    Route::get('/pbb-create', [PBBController::class, 'create'])->name('pbb.create-user');
    Route::post('/pbb-store', [PBBController::class, 'store'])->name('pbb.store-user');
});

// Redirect jika belum login
Route::get('/home', function () {
    if (\Illuminate\Support\Facades\Auth::user()->role === 'admin') {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
});

