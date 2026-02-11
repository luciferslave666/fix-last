<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\PelamarJobController;
use App\Http\Controllers\SeleksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/verify-otp', [OtpController::class, 'show'])->name('otp.verify');
    Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.check');    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata.index');
    Route::resource('lowongan', LowonganController::class);
    Route::get('/cari-kerja', [PelamarJobController::class, 'index'])->name('cari.kerja');
    Route::get('/lowongan/{lowongan}', [PelamarJobController::class, 'show'])->name('lowongan.show');
    Route::post('/lowongan/{lowongan}/lamar', [PelamarJobController::class, 'store'])->name('lowongan.lamar');

    // Route Riwayat Lamaran
    Route::get('/riwayat-lamaran', [PelamarJobController::class, 'history'])->name('lamaran.history');
    Route::get('/lowongan/{lowongan}/pelamar', [SeleksiController::class, 'index'])->name('seleksi.index');
    Route::get('/seleksi/{id}', [SeleksiController::class, 'show'])->name('seleksi.show');
    Route::put('/seleksi/{id}', [SeleksiController::class, 'update'])->name('seleksi.update');
    Route::patch('/biodata', [BiodataController::class, 'update'])->name('biodata.update');
});

Route::post('/check-email', [RegisteredUserController::class, 'checkEmail'])->name('check.email');

require __DIR__.'/auth.php';
