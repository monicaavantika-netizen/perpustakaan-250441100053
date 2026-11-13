<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PeminjamanController extends Controller
{
    // Menampilkan peminjaman milik siswa yang login
    public function index()
    {
        $anggota = Anggota::where('user_id', auth()->id())
            ->firstOrFail();

        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->where('anggota_id', $anggota->id)
            ->latest()
            ->paginate(10);

        $bukus = Buku::all();

        return view('siswa.peminjaman.index', compact(
            'peminjamans',
            'bukus'
        ));
    }

    // Mengajukan peminjaman buku
    public function store(Request $request)
    {
        $anggota = Anggota::where('user_id', auth()->id())
            ->firstOrFail();

        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $peminjaman = Peminjaman::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $validated['buku_id'],
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => null,
            'status' => 'menunggu',
        ]);

        // Memastikan siswa hanya mengakses peminjamannya sendiri
        Gate::authorize('view', $peminjaman);

        return back()->with(
            'success',
            'Pengajuan peminjaman berhasil dikirim.'
        );
    }
}
