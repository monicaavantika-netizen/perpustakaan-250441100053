<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

// Halaman Utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard Berdasarkan Role
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->hasRole('petugas')) {
        return redirect()->route('petugas.dashboard');
    }

    return redirect()->route('siswa.dashboard');
})->middleware('auth')->name('dashboard');


// Dashboard Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/pengguna', [UserController::class, 'index'])
            ->name('pengguna.index');

        Route::patch('/pengguna/{user}/role', [UserController::class, 'updateRole'])
            ->name('pengguna.updateRole');

        // Data Peminjaman
        Route::get('/peminjaman', [
            \App\Http\Controllers\Petugas\PeminjamanController::class,
            'adminIndex'
        ])->name('peminjaman.index');

        // Data Pengembalian
        Route::get('/pengembalian', [
            \App\Http\Controllers\Petugas\PeminjamanController::class,
            'pengembalian'
        ])->name('pengembalian.index');

        // Laporan Perpustakaan
        Route::get('/laporan', [
            \App\Http\Controllers\Admin\LaporanController::class,
            'index'
        ])->name('laporan.index');
    });


// Dashboard Petugas
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('petugas.dashboard');
        })->name('dashboard');

        Route::get('/peminjaman', [
            \App\Http\Controllers\Petugas\PeminjamanController::class,
            'index'
        ])->name('peminjaman.index');

        Route::patch('/peminjaman/{peminjaman}/status', [
            \App\Http\Controllers\Petugas\PeminjamanController::class,
            'updateStatus'
        ])->name('peminjaman.updateStatus');

        Route::patch('/peminjaman/{peminjaman}/kembalikan', [
            \App\Http\Controllers\Petugas\PeminjamanController::class,
            'kembalikan'
        ])->name('peminjaman.kembalikan');

        // Laporan Petugas
        Route::get('/laporan', [
            \App\Http\Controllers\Admin\LaporanController::class,
            'index'
        ])->name('laporan.index');
    });


// Dashboard Siswa
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('siswa.dashboard');
        })->name('dashboard');

        Route::get('/peminjaman', [
            \App\Http\Controllers\Siswa\PeminjamanController::class,
            'index'
        ])->name('peminjaman.index');

        Route::post('/peminjaman', [
            \App\Http\Controllers\Siswa\PeminjamanController::class,
            'store'
        ])->name('peminjaman.store');
    });

// SOAL 1 - A2: SQL INJECTION
// Route pencarian buku menggunakan middleware auth.
Route::middleware('auth')->group(function () {

    Route::get('/buku', [BukuController::class, 'index'])
        ->name('buku.index');

    Route::get('/buku-cari', [BukuController::class, 'cari'])
        ->name('buku.cari');
});


// SOAL 3: PENGUATAN GATE KELola-BUKU
// KODE SEBELUM PERBAIKAN:
// Pemeriksaan role dilakukan langsung pada route.
Route::middleware(['auth', 'role:admin|petugas'])->group(function () {
    Route::get('/buku/create', [BukuController::class, 'create'])
        ->name('buku.create');
});


// KODE SESUDAH PERBAIKAN:
// Pemeriksaan akses pengelolaan buku dipusatkan pada Gate.
// Admin dan petugas yang boleh mengelola buku.
Route::middleware(['auth', 'can:kelola-buku'])->group(function () {

    // Tambah Buku
    Route::get('/buku/create', [BukuController::class, 'create'])
        ->name('buku.create');

    Route::post('/buku', [BukuController::class, 'store'])
        ->name('buku.store');

    // Edit Buku
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])
        ->whereNumber('id')
        ->name('buku.edit');

    Route::put('/buku/{id}', [BukuController::class, 'update'])
        ->whereNumber('id')
        ->name('buku.update');

    // Penghapusan buku menggunakan metode DELETE
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])
        ->whereNumber('id')
        ->name('buku.destroy');
});


// Detail Buku
Route::middleware('auth')->group(function () {

    Route::get('/buku/{id}', [BukuController::class, 'show'])
        ->whereNumber('id')
        ->name('buku.show');
});

// SOAL 1 - A3: KODE SEBELUM PERBAIKAN (RENTAN CSRF)
// Route GET dapat menghapus buku.

// Route::middleware('auth')->group(function () {
//     Route::get('/buku/{buku}/hapus', [
//         BukuController::class,
//         'destroy'
//     ])->whereNumber('buku')->name('buku.hapus.get');
// });

// SOAL 1 - A4: IDOR DAN PENERAPAN POLICY
// Route detail peminjaman menggunakan middleware auth.
Route::middleware('auth')->group(function () {

    Route::get('/peminjaman/{id}', [
        \App\Http\Controllers\PeminjamanController::class,
        'show'
    ])->whereNumber('id')->name('peminjaman.show');
});


// Profil Pengguna
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
Route::get('/tes-laravel', function () {
    return 'Laravel Bookavy berhasil berjalan di Vercel!';
});

// SOAL 5a: PENGUJIAN APP_DEBUG=false
// Route sementara hanya untuk pengujian.
// Setelah diuji, route harus dihapus atau dikomentari.
// Route::get('/uji-error', function () {
//     throw new RuntimeException('Pengujian error aplikasi');
// });

// SOAL 5c: PENGGANTIAN PASSWORD ADMIN
// Perintah dijalankan melalui php artisan tinker,
// bukan dimasukkan sebagai kode aktif di web.php.
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;

// User::where('email', 'admin@bookavy.com')->update([
//     'password' => Hash::make('adminbookavy')
// ]);

require __DIR__ . '/auth.php';
