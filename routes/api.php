<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\RekapController;
use App\Http\Controllers\Api\AuthController;

// Login API
Route::post('/login', [AuthController::class, 'login']);

// API yang dapat diakses tanpa login
Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/{buku}', [BukuController::class, 'show']);

// API yang wajib login
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Melihat rekap
    Route::middleware('permission:lihat laporan perpustakaan')->group(function () {
        Route::get('/rekap/buku-per-kategori', [RekapController::class, 'bukuPerKategori']);
        Route::get('/rekap/peminjaman-per-buku', [RekapController::class, 'peminjamanPerBuku']);
    });

    // Mengelola buku
    Route::middleware('permission:kelola data buku')->group(function () {
        Route::post('/buku', [BukuController::class, 'store']);
        Route::put('/buku/{buku}', [BukuController::class, 'update']);
        Route::patch('/buku/{buku}', [BukuController::class, 'update']);
        Route::delete('/buku/{buku}', [BukuController::class, 'destroy']);
    });
});
