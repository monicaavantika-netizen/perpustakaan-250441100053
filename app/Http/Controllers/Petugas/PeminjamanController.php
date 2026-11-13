<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Halaman peminjaman Petugas
    public function index()
    {
        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->paginate(10);

        return view('petugas.peminjaman.index', compact('peminjamans'));
    }

    // Halaman peminjaman Admin
    public function adminIndex()
    {
        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->paginate(10);

        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    // Memproses persetujuan atau penolakan peminjaman
    public function updateStatus(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        // Memastikan pengajuan belum diproses
        if ($peminjaman->status !== 'menunggu') {
            return back()->with(
                'error',
                'Pengajuan sudah diproses.'
            );
        }

        $peminjaman->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            'Status peminjaman berhasil diperbarui.'
        );
    }

    // Memproses pengembalian buku
    public function kembalikan(Peminjaman $peminjaman)
    {
        // Hanya peminjaman yang disetujui dapat dikembalikan
        if ($peminjaman->status !== 'disetujui') {
            return back()->with(
                'error',
                'Hanya peminjaman yang disetujui yang dapat dikembalikan.'
            );
        }

        $peminjaman->update([
            'tanggal_kembali' => now()->toDateString(),
            'status' => 'dikembalikan',
        ]);

        return back()->with(
            'success',
            'Buku berhasil dikembalikan.'
        );
    }

    // Halaman pengembalian Admin
    public function pengembalian()
    {
        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->where('status', 'dikembalikan')
            ->latest()
            ->paginate(10);

        return view('admin.pengembalian.index', compact('peminjamans'));
    }
}
