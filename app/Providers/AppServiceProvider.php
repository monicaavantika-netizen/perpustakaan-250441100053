<?php

namespace App\Providers;

use App\Models\Peminjaman;
use App\Policies\PeminjamanPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // SOAL 3: GATE UNTUK MENGELOLA BUKU
        // Hanya admin dan petugas yang boleh mengelola buku.
        Gate::define('kelola-buku', function ($user) {
            return $user->hasAnyRole(['admin', 'petugas']);
        });

        // SOAL 1 - A4: POLICY UNTUK PEMINJAMAN
        // Mendaftarkan PeminjamanPolicy agar aturan
        // hak akses peminjaman diperiksa melalui Policy.
        Gate::policy(Peminjaman::class, PeminjamanPolicy::class);
    }
}