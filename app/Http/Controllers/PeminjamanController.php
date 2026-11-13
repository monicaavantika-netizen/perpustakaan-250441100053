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

        return view('peminjaman.show', compact('peminjaman'));
    }
}