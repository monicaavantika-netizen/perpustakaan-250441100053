<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\Gate;

class PeminjamanController extends Controller
{
    // Menampilkan detail peminjaman
    public function show($id)
    {
        $peminjaman = Peminjaman::with([
            'anggota.user',
            'buku'
        ])->findOrFail($id);

        // soal 1 KODE SEBELUM PERBAIKAN (PEMERIKSAAN MANUAL MODUL 5):
        if (
            !auth()->user()->hasRole(['admin', 'petugas']) &&
            $peminjaman->anggota?->user_id !== auth()->id()
        ) {
            abort(403, 'Anda tidak memiliki akses ke peminjaman ini.');
        }

        // Soal 3 KODE SESUDAH PERBAIKAN (MENGGUNAKAN POLICY):
        Gate::authorize('view', $peminjaman);

        return view('peminjaman.show', compact('peminjaman'));
    }
}