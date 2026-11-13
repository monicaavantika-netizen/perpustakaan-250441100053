<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPeminjaman = Peminjaman::count();

        $totalPengembalian = Peminjaman::where(
            'status',
            'dikembalikan'
        )->count();

        $totalMenunggu = Peminjaman::where(
            'status',
            'menunggu'
        )->count();

        $totalDisetujui = Peminjaman::where(
            'status',
            'disetujui'
        )->count();

        $totalDitolak = Peminjaman::where(
            'status',
            'ditolak'
        )->count();

        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->paginate(10);

        return view('admin.laporan.index', compact(
            'totalPeminjaman',
            'totalPengembalian',
            'totalMenunggu',
            'totalDisetujui',
            'totalDitolak',
            'peminjamans'
        ));
    }
}
