<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    // Menampilkan halaman utama
    public function home()
    {
        $buku = Buku::all();

        return view('home', compact('buku'));
    }

    // Menampilkan daftar buku
    public function index()
    {
        $buku = Buku::with('kategori')
            ->latest()
            ->paginate(10);

        return view('buku.index', compact('buku'));
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);

        return view('buku.show', compact('buku'));
    }

    // A2: KODE SEBELUM PERBAIKAN (RENTAN SQL INJECTION)
    public function cari(Request $request)
    {
        $judul = $request->query('judul');

        $buku = DB::select(
            "SELECT * FROM bukus WHERE judul = '$judul'"
        );

        return response()->json($buku);
    }

    // Menampilkan form tambah buku
    public function create()
    {
        Gate::authorize('kelola-buku');

        $kategori = Kategori::all();

        return view('buku.create', compact('kategori'));
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        Gate::authorize('kelola-buku');

        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|min:3|max:150',
            'penulis' => 'required|string|min:3|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        Buku::create($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan form edit buku
    public function edit($id)
    {
        Gate::authorize('kelola-buku');

        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();

        return view('buku.edit', compact('buku', 'kategori'));
    }

    // Memperbarui data buku
    public function update(Request $request, $id)
    {
        Gate::authorize('kelola-buku');

        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|min:3|max:150',
            'penulis' => 'required|string|min:3|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy($id)
    {
        Gate::authorize('kelola-buku');

        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
