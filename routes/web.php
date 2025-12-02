<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PBBController; // <-- tambahkan ini

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('warga', WargaController::class);

    // **ROUTE PBB FINAL**
    Route::resource('pbb', PBBController::class);

    // Laporan
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::post('/report/export-pdf', [ReportController::class, 'exportPDF'])->name('report.export-pdf');
    Route::post('/report/export-excel', [ReportController::class, 'exportExcel'])->name('report.export-excel');
});

// Redirect jika belum login
Route::get('/home', function () {
    return redirect()->route('dashboard');
});
