<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\KontrakSewaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ExportController;

// Route untuk Dashboard (halaman utama)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Resource routes untuk CRUD Kamar
Route::resource('kamar', KamarController::class);

// Resource routes untuk CRUD Penyewa
Route::resource('penyewa', PenyewaController::class);

// Resource routes untuk CRUD Kontrak Sewa
Route::resource('kontrak-sewa', KontrakSewaController::class);

// Resource routes untuk CRUD Pembayaran
Route::resource('pembayaran', PembayaranController::class);

// Routes untuk Export Laporan
Route::get('/export/pembayaran/excel', [ExportController::class, 'exportExcel'])->name('export.pembayaran.excel');
Route::get('/export/pembayaran/pdf', [ExportController::class, 'exportPdf'])->name('export.pembayaran.pdf');

// Routes untuk Generate tagiha
Route::post('/generate-tagihan', [PembayaranController::class, 'generateTagihan'])->name('pembayaran.generate');
