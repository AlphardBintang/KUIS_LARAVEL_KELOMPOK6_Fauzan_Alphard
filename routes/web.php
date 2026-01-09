<?php

use Illuminate\Support\Facades\Route;
// TODO: Import controllers yang sudah dibuat

// TODO: Route untuk Dashboard (halaman utama)
Route::get('/', function () {
    return view('welcome');
});

// TODO: Resource routes untuk CRUD Kamar
// Route::resource('kamar', KamarController::class);

// TODO: Resource routes untuk CRUD Penyewa
// Route::resource('penyewa', PenyewaController::class);

// TODO: Resource routes untuk CRUD Kontrak Sewa
// Route::resource('kontrak-sewa', KontrakSewaController::class);

// TODO: Resource routes untuk CRUD Pembayaran
// Route::resource('pembayaran', PembayaranController::class);
