@extends('layouts.bookavy')

@section('title', 'Bookavy - Koleksi Buku')

@section('content')
<div class="min-h-screen px-4 py-8 sm:px-8"
     style="background: linear-gradient(135deg, #fff8ef, #fce8ee);">

    <div class="mx-auto max-w-7xl">

        <!-- Banner -->
        <div class="mb-8 rounded-3xl p-8 text-white shadow-xl"
             style="background: linear-gradient(120deg, #4b1029, #8e294d, #c45b7c);">

            <p class="mb-3 text-sm font-semibold uppercase tracking-widest"
               style="color: #f8cbd8;">
                BOOKAVY DIGITAL LIBRARY
            </p>

            <h1 class="mb-3 text-3xl font-extrabold sm:text-4xl">
                Temukan Buku Favoritmu
            </h1>

            <p class="max-w-2xl text-sm leading-relaxed text-pink-100">
                Jelajahi koleksi buku Bookavy dan temukan berbagai
                pengetahuan baru melalui setiap halaman.
            </p>

            <div class="mt-6 inline-block rounded-2xl px-6 py-4"
                 style="background: rgba(255,255,255,0.15);">

                <p class="text-xs font-semibold uppercase tracking-wider text-pink-100">
                    Jumlah Koleksi Buku
                </p>

                <p class="mt-1 text-2xl font-extrabold">
                    {{ $buku->total() }} Buku
                </p>
            </div>
        </div>

        <!-- Judul Koleksi -->
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">

            <div>
                <p class="text-xs font-bold uppercase tracking-widest"
                   style="color: #a83c60;">
                    LAYANAN PERPUSTAKAAN
                </p>

                <h2 class="mt-2 text-2xl font-extrabold"
                    style="color: #4b1029;">
                    Bookavy Library
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Daftar koleksi buku yang tersedia.
                </p>
            </div>

            <!-- Tambah Buku: hanya admin dan petugas -->
            @can('kelola-buku')
                <a href="{{ route('buku.create') }}"
                   class="rounded-xl px-5 py-3 text-sm font-bold text-white shadow transition hover:opacity-90"
                   style="background: #741d3c;">
                    + Tambah Buku
                </a>
            @endcan

        </div>

        <!-- Pesan Berhasil -->
        @if(session('success'))
            <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Pesan Error -->
        @if($errors->any())
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Tabel Buku -->
        <div class="overflow-hidden rounded-3xl border border-pink-100 bg-white shadow-lg">

            <div class="border-b border-pink-100 p-6">
                <h3 class="text-xl font-extrabold"
                    style="color: #4b1029;">
                    Koleksi Buku
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Koleksi buku yang tersedia di perpustakaan digital.
                </p>
            </div>

            <div class="overflow-x-auto p-6">

                <table class="w-full min-w-[850px] text-left">

                    <thead style="background: #741d3c; color: white;">
                        <tr>
                            <th class="rounded-l-xl px-4 py-4">No.</th>
                            <th class="px-4 py-4">Judul Buku</th>
                            <th class="px-4 py-4">Kategori</th>
                            <th class="px-4 py-4">Penulis</th>
                            <th class="px-4 py-4">Tahun Terbit</th>
                            <th class="rounded-r-xl px-4 py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($buku as $item)
                            <tr class="border-b border-pink-100 transition hover:bg-pink-50">

                                <td class="px-4 py-4">
                                    {{ $buku->firstItem() + $loop->index }}
                                </td>

                                <td class="px-4 py-4 font-semibold"
                                    style="color: #741d3c;">

                                    <!-- {{--
                                     KODE SEBELUM PERBAIKAN A1:
                                     {!! $item->judul !!}
                                    --}} -->

                                    {{-- KODE SESUDAH PERBAIKAN A1 --}}
                                    {{ $item->judul }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $item->kategori->nama ?? '-' }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $item->penulis }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $item->tahun_terbit }}
                                </td>

                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2">

                                        <!-- Detail -->
                                        <a href="{{ route('buku.show', $item->id) }}"
                                           class="rounded-lg px-3 py-2 text-xs font-bold text-white"
                                           style="background: #741d3c;">
                                            Detail
                                        </a>

                                        <!-- Edit dan Hapus -->
                                        @can('kelola-buku')

                                            <a href="{{ route('buku.edit', $item->id) }}"
                                               class="rounded-lg px-3 py-2 text-xs font-bold text-white"
                                               style="background: #a83c60;">
                                                Edit
                                            </a>

                                            <!-- {{--
                                            KODE SEBELUM PERBAIKAN A3:
                                            <a href="{{ route('buku.hapus.get', $item->id) }}"
                                                class="rounded-lg px-3 py-2 text-xs font-bold text-white"
                                                style="background: #b42335;">
                                                 Hapus
                                             </a>
                                            --}} -->

                                            {{-- KODE SETELAH PERBAIKAN A3 --}}
                                            <form action="{{ route('buku.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus buku ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="rounded-lg px-3 py-2 text-xs font-bold text-white"
                                                        style="background: #b42335;">
                                                    Hapus
                                                </button>
                                            </form>

                                        @endcan

                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="6"
                                    class="py-10 text-center text-gray-500">
                                    Belum ada koleksi buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $buku->links() }}
                </div>

            </div>
        </div>

        <!-- Footer -->
        <p class="mt-8 text-center text-sm"
           style="color: #8e294d;">
            BOOKAVY — Perpustakaan Digital
        </p>

    </div>
</div>
@endsection
