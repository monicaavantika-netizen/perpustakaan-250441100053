@extends('layouts.bookavy')

@section('title', 'Bookavy - Tambah Buku')

@section('content')

<div class="min-h-screen px-4 py-10 sm:px-8"
     style="background: linear-gradient(135deg, #fff8ef, #fce8ee);">

    <div class="mx-auto max-w-3xl">

        <!-- Banner -->
        <div class="mb-8 rounded-3xl p-7 text-white shadow-xl"
             style="background: linear-gradient(120deg, #4b1029, #8e294d, #c45b7c);">

            <p class="mb-2 text-xs font-bold uppercase tracking-widest"
               style="color: #f8cbd8;">
                BOOKAVY COLLECTION
            </p>

            <h1 class="text-3xl font-extrabold">
                Tambah Buku
            </h1>

            <p class="mt-2 text-sm text-pink-100">
                Masukkan informasi buku yang ingin ditambahkan
                ke koleksi perpustakaan Bookavy.
            </p>
        </div>

        <!-- Form -->
        <div class="rounded-3xl border border-pink-100 bg-white p-6 shadow-lg sm:p-8">

            <h2 class="mb-6 text-xl font-extrabold"
                style="color: #4b1029;">
                Informasi Buku
            </h2>

            <!-- Pesan Validasi -->
            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('buku.store') }}" method="POST">
                @csrf

                <!-- Kategori -->
                <div class="mb-5">
                    <label for="kategori_id"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Kategori Buku
                    </label>

                    <select name="kategori_id" id="kategori_id"
                            class="w-full rounded-xl border border-pink-200 px-4 py-3 focus:border-pink-500 focus:ring-pink-300"
                            required>

                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $item)
                        <option value="{{ $item->id }}"
                        {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kategori ?? $item->nama ?? $item->name }}
                    </option>
                    @endforeach
                    </select>
                </div>

                <!-- Judul -->
                <div class="mb-5">
                    <label for="judul"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Judul Buku
                    </label>

                    <input type="text"
                           name="judul"
                           id="judul"
                           value="{{ old('judul') }}"
                           placeholder="Masukkan judul buku"
                           class="w-full rounded-xl border border-pink-200 px-4 py-3 focus:border-pink-500 focus:ring-pink-300"
                           required>
                </div>

                <!-- Penulis -->
                <div class="mb-5">
                    <label for="penulis"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Penulis
                    </label>

                    <input type="text"
                           name="penulis"
                           id="penulis"
                           value="{{ old('penulis') }}"
                           placeholder="Masukkan nama penulis"
                           class="w-full rounded-xl border border-pink-200 px-4 py-3 focus:border-pink-500 focus:ring-pink-300"
                           required>
                </div>

                <!-- Tahun Terbit -->
                <div class="mb-6">
                    <label for="tahun_terbit"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Tahun Terbit
                    </label>

                    <input type="number"
                           name="tahun_terbit"
                           id="tahun_terbit"
                           value="{{ old('tahun_terbit') }}"
                           placeholder="Contoh: 2024"
                           min="1900"
                           max="{{ date('Y') }}"
                           class="w-full rounded-xl border border-pink-200 px-4 py-3 focus:border-pink-500 focus:ring-pink-300"
                           required>
                </div>

                <!-- Tombol -->
                <div class="flex flex-wrap gap-3">

                    <button type="submit"
                            class="rounded-xl px-6 py-3 text-sm font-bold text-white shadow transition hover:opacity-90"
                            style="background: #741d3c;">
                        Simpan Buku
                    </button>

                    <a href="{{ route('buku.index') }}"
                       class="rounded-xl border border-pink-200 px-6 py-3 text-sm font-bold transition hover:bg-pink-50"
                       style="color: #741d3c;">
                        Kembali
                    </a>

                </div>
            </form>

        </div>

        <!-- Footer -->
        <p class="mt-8 text-center text-sm"
           style="color: #8e294d;">
            BOOKAVY — Perpustakaan Digital
        </p>

    </div>
</div>

@endsection