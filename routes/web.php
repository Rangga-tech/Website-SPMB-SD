<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendaftarController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\PersyaratanController;
use App\Http\Controllers\Admin\LaporanController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/informasi', [HomeController::class, 'informasi'])->name('informasi');
Route::get('/pengumuman', [HomeController::class, 'pengumuman'])->name('pengumuman');


Route::get('/daftar', [PendaftaranController::class, 'create'])->name('daftar');
Route::post('/daftar', [PendaftaranController::class, 'store'])->name('daftar.store');


Route::get('/bukti/{no_pendaftaran}', [PendaftaranController::class, 'bukti'])->name('bukti');
Route::get('/bukti/{no_pendaftaran}/pdf', [PendaftaranController::class, 'downloadPdf'])->name('bukti.pdf');


Route::get('/cek-status', [PendaftaranController::class, 'cekStatusForm'])->name('cek-status');
Route::post('/cek-status', [PendaftaranController::class, 'cekStatus'])->name('cek-status.proses');

Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('register.store');
Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login.store');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.proses');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
});


Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    Route::get('/pendaftar', [PendaftarController::class, 'index'])->name('pendaftar.index');
    Route::get('/pendaftar/{pendaftar}', [PendaftarController::class, 'show'])->name('pendaftar.show');
    Route::post('/pendaftar/{pendaftar}/verifikasi', [PendaftarController::class, 'verifikasi'])->name('pendaftar.verifikasi');
    Route::post('/pendaftar/{pendaftar}/status', [PendaftarController::class, 'ubahStatus'])->name('pendaftar.status');
    Route::delete('/pendaftar/{pendaftar}', [PendaftarController::class, 'destroy'])->name('pendaftar.destroy');

    
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::put('/jadwal/{jadwal}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

    
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::put('/pengumuman/{pengumuman}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

    
    Route::get('/persyaratan', [PersyaratanController::class, 'index'])->name('persyaratan.index');
    Route::post('/persyaratan', [PersyaratanController::class, 'store'])->name('persyaratan.store');
    Route::put('/persyaratan/{persyaratan}', [PersyaratanController::class, 'update'])->name('persyaratan.update');
    Route::delete('/persyaratan/{persyaratan}', [PersyaratanController::class, 'destroy'])->name('persyaratan.destroy');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [LaporanController::class, 'downloadPdf'])->name('laporan.pdf');
});
