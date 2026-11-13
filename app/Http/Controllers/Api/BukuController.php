<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BukuResource;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori')
            ->withCount('peminjaman')
            ->latest();

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                  ->orWhere('penulis', 'like', "%{$cari}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_terbit', $request->tahun);
        }

        $buku = $query->paginate(10)->withQueryString();

        return BukuResource::collection($buku);
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'kategori_id' => 'required|exists:kategoris,id',
        'judul' => 'required|string|min:3|max:150',
        'penulis' => 'required|string|min:3|max:100',
        'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
    ], [
        'kategori_id.required' => 'Kategori wajib dipilih.',
        'kategori_id.exists' => 'Kategori tidak ditemukan.',
        'judul.required' => 'Judul buku wajib diisi.',
        'judul.min' => 'Judul buku minimal 3 karakter.',
        'penulis.required' => 'Nama penulis wajib diisi.',
        'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
        'tahun_terbit.integer' => 'Tahun terbit harus berupa angka.',
    ]);

    $buku = Buku::create($validated);

    return response()->json([
        'message' => 'Buku berhasil ditambahkan',
        'data' => new BukuResource($buku->load('kategori')),
    ], 201);
}

    public function show(string $id)
    {
        $buku = Buku::with('kategori', 'peminjaman')->find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Buku tidak ditemukan',
            ], 404);
        }

        return new BukuResource($buku);
    }
public function update(Request $request, string $id)
{
    $buku = Buku::find($id);

    if (!$buku) {
        return response()->json([
            'message' => 'Buku tidak ditemukan',
        ], 404);
    }

    $validated = $request->validate([
        'kategori_id' => ['sometimes', 'required', 'exists:kategoris,id'],
        'judul' => ['sometimes', 'required', 'string', 'min:3', 'max:150'],
        'penulis' => ['sometimes', 'required', 'string', 'min:3', 'max:100'],
        'tahun_terbit' => [
            'sometimes',
            'required',
            'integer',
            'between:1900,' . date('Y'),
        ],
    ]);

    $buku->update($validated);

    return response()->json([
        'message' => 'Buku berhasil diperbarui',
        'data' => new BukuResource($buku->fresh()->load('kategori')),
    ], 200);
}

    public function destroy(string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Buku tidak ditemukan',
            ], 404);
        }

        $buku->delete();

        return response()->json([
            'message' => 'Buku berhasil dihapus',
        ], 200);
    }
}
