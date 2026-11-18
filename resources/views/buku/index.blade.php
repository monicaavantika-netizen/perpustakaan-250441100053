@extends('layouts.bookavy')

@section('title', 'Bookavy - Koleksi Buku')

@section('content')
<div class="min-h-screen px-4 py-8 sm:px-8"
     style="background: linear-gradient(135deg, #fff8ef, #fce8ee);">

    <div class="mx-auto max-w-7xl">

        <!-- Banner -->
        <div class="mb-8 rounded-3xl p-8 text-white shadow-xl"
             style="background: linear-gradient(135deg, #741d3c, #a8325a);">

            <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">
                <div>
                    <p class="mb-2 text-sm font-medium tracking-wider text-pink-100">
                        BOOKAVY LIBRARY
                    </p>

                    <h1 class="text-3xl font-bold sm:text-4xl">
                        Koleksi Buku
                    </h1>

                    <p class="mt-3 text-sm text-pink-100">
                        Temukan dan kelola berbagai koleksi buku di Bookavy.
                    </p>
                </div>

                {{-- SOAL 3: Tombol tambah hanya untuk admin dan petugas --}}
                @can('kelola-buku')
                    <a href="{{ route('buku.create') }}"
                       class="inline-flex items-center justify-center rounded-xl px-5 py-3 font-semibold text-white shadow-md transition hover:opacity-90"
                       style="background-color: #d96b91;">
                        + Tambah Buku
                    </a>
                @endcan
            </div>
        </div>

        <!-- Tabel Buku -->
        <div class="overflow-hidden rounded-3xl bg-white shadow-xl">

            <div class="border-b px-6 py-5"
                 style="border-color: #f3d5df;">

                <h2 class="text-xl font-bold"
                    style="color: #741d3c;">
                    Daftar Buku
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Menampilkan koleksi buku yang tersedia.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">

                    <thead style="background-color: #fff0f4; color: #741d3c;">
                        <tr>
                            <th class="px-4 py-4 font-bold">No</th>
                            <th class="px-4 py-4 font-bold">Judul</th>
                            <th class="px-4 py-4 font-bold">Kategori</th>
                            <th class="px-4 py-4 font-bold">Penulis</th>
                            <th class="px-4 py-4 font-bold">Tahun Terbit</th>
                            <th class="px-4 py-4 text-center font-bold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-pink-100">

                        @forelse ($buku as $item)
                            <tr class="transition hover:bg-pink-50">

                                <td class="px-4 py-4">
                                    {{ $buku->firstItem() + $loop->index }}
                                </td>

                                <td class="px-4 py-4 font-semibold"
                                    style="color: #741d3c;">

                                    <!-- {{-- SOAL 1 - A1: KODE SEBELUM PERBAIKAN (RENTAN XSS) --}}
                                    {!! $item->judul !!} -->

                                    {{-- SOAL 1 - A1: KODE SESUDAH PERBAIKAN --}}
                                    {{ $item->judul }} 
                                </td>

                                <td class="px-4 py-4">
                                    {{ $item->kategori->nama_kategori ?? '-' }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $item->penulis }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $item->tahun_terbit }}
                                </td>

                                <td class="px-4 py-4">
                                    <div class="flex flex-wrap items-center justify-center gap-2">

                                        <!-- Tombol Detail -->
                                        <a href="{{ route('buku.show', $item->id) }}"
                                           class="rounded-lg px-3 py-2 text-xs font-semibold text-white"
                                           style="background-color: #a8325a;">
                                            Detail
                                        </a>

                                        {{-- SOAL 3: Tombol edit dan hapus hanya untuk admin dan petugas --}}
                                        @can('kelola-buku')

                                            <a href="{{ route('buku.edit', $item->id) }}"
                                               class="rounded-lg px-3 py-2 text-xs font-semibold text-white"
                                               style="background-color: #d99a42;">
                                                Edit
                                            </a>
<!-- 
                                            {{-- SOAL 1 - A3: KODE SEBELUM PERBAIKAN (RENTAN CSRF) --}}
                                            {{-- <a href="{{ route('buku.hapus.get', $item->id) }}"
                                                 class="rounded-lg px-3 py-2 text-xs font-semibold text-white"
                                                 style="background-color: #dc3545;">
                                                Hapus
                                            </a> --}} -->

                                            {{-- SOAL 1 - A3: KODE SESUDAH PERBAIKAN --}}
                                            <form action="{{ route('buku.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus buku ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="rounded-lg px-3 py-2 text-xs font-semibold text-white"
                                                        style="background-color: #dc3545;">
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
                                    class="px-4 py-10 text-center text-gray-500">
                                    Belum ada data buku.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex flex-col items-center justify-between gap-3 border-t px-6 py-5 sm:flex-row"
                 style="border-color: #f3d5df;">

                <p class="text-sm text-gray-500">
                    Menampilkan
                    {{ $buku->firstItem() ?? 0 }}
                    sampai
                    {{ $buku->lastItem() ?? 0 }}
                    dari
                    {{ $buku->total() }}
                    buku
                </p>

                <div>
                    {{ $buku->links() }}
                </div>

            </div>

        </div>

        <!-- Footer -->
        <div class="mt-6 text-center text-sm"
             style="color: #a8325a;">
            Bookavy Library
        </div>

    </div>
</div>
@endsection