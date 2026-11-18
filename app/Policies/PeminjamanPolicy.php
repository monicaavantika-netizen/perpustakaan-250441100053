<?php

namespace App\Policies;

use App\Models\Peminjaman;
use App\Models\User;

class PeminjamanPolicy
{
    /**
     * Menentukan siapa yang boleh melihat data peminjaman.
     */
    // SOAL 1 - A4: PERBAIKAN IDOR MENGGUNAKAN POLICY
    public function view(User $user, Peminjaman $peminjaman): bool
    {
        // Admin dan petugas dapat melihat semua peminjaman
        if ($user->hasAnyRole(['admin', 'petugas'])) {
            return true;
        }

        // Siswa hanya dapat melihat peminjamannya sendiri
        return $user->hasRole('siswa')
            && $peminjaman->anggota?->user_id === $user->id;
    } 
}
