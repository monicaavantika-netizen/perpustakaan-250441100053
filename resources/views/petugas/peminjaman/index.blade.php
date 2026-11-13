 @extends('layouts.bookavy')

@section('title', 'Bookavy - Data Peminjaman')

@section('content')
<div class="min-h-screen px-4 py-8 sm:px-8"
     style="background: linear-gradient(135deg, #fff8ef, #fce8ee);">

    <div class="mx-auto max-w-7xl">

        <!-- Banner -->
        <div class="mb-8 rounded-3xl p-8 text-white shadow-xl"
             style="background: linear-gradient(120deg, #4b1029, #8e294d, #c45b7c);">

            <p class="mb-2 text-sm font-semibold uppercase tracking-widest"
               style="color:#f8cbd8;">
                BOOKAVY PETUGAS PANEL
            </p>

            <h1 class="mb-3 text-3xl font-extrabold">
                Data Peminjaman
            </h1>

            <p class="text-sm text-pink-100">
                Kelola pengajuan peminjaman dan pengembalian buku dengan mudah.
            </p>
        </div>

        <!-- Pesan Berhasil -->
        @if(session('success'))
            <div class="mb-5 rounded-xl border border-green-200 bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Pesan Error -->
        @if(session('error'))
            <div class="mb-5 rounded-xl border border-red-200 bg-red-100 p-4 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 rounded-xl border border-red-200 bg-red-100 p-4 text-red-700">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Tabel Peminjaman -->
        <div class="overflow-hidden rounded-3xl border border-pink-100 bg-white shadow-lg">

            <div class="border-b border-pink-100 p-6">
                <p class="text-xs font-bold uppercase tracking-widest"
                   style="color:#a83c60;">
                    MANAJEMEN PERPUSTAKAAN
                </p>

                <h2 class="mt-2 text-2xl font-extrabold"
                    style="color:#4b1029;">
                    Daftar Pengajuan Peminjaman
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Periksa pengajuan dan perbarui status peminjaman buku.
                </p>
            </div>

            <div class="overflow-x-auto p-6">
                <table class="w-full min-w-[900px] border-collapse text-left">

                    <thead style="background:#741d3c; color:white;">
                        <tr>
                            <th class="rounded-l-xl px-5 py-4 text-sm">No.</th>
                            <th class="px-5 py-4 text-sm">Nama Anggota</th>
                            <th class="px-5 py-4 text-sm">Judul Buku</th>
                            <th class="px-5 py-4 text-sm">Tanggal Pinjam</th>
                            <th class="px-5 py-4 text-sm">Status</th>
                            <th class="rounded-r-xl px-5 py-4 text-center text-sm">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($peminjamans as $peminjaman)
                            <tr class="border-b border-pink-100 transition hover:bg-pink-50">

                                <td class="px-5 py-5 text-sm text-gray-600">
                                    {{ $peminjamans->firstItem() + $loop->index }}
                                </td>

                                <td class="px-5 py-5 text-sm font-semibold"
                                    style="color:#741d3c;">
                                    {{ $peminjaman->anggota->nama ?? '-' }}
                                </td>

                                <td class="px-5 py-5 text-sm text-gray-700">
                                    {{ $peminjaman->buku->judul ?? '-' }}
                                </td>

                                <td class="px-5 py-5 text-sm text-gray-600">
                                    {{ $peminjaman->tanggal_pinjam }}
                                </td>

                                <td class="px-5 py-5">
                                    <span class="inline-block rounded-full px-3 py-2 text-xs font-bold"
                                          style="background:#fce8ee; color:#741d3c;">
                                        {{ ucfirst($peminjaman->status) }}
                                    </span>
                                </td>

                                <td class="px-5 py-5">
                                    <div class="flex items-center justify-center gap-2">

                                        @if($peminjaman->status === 'menunggu')

                                            <form action="{{ route('petugas.peminjaman.updateStatus', $peminjaman->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="disetujui">

                                                <button type="submit"
                                                        class="rounded-lg px-3 py-2 text-xs font-bold text-white transition hover:opacity-80"
                                                        style="background:#741d3c;">
                                                    Setujui
                                                </button>
                                            </form>

                                            <form action="{{ route('petugas.peminjaman.updateStatus', $peminjaman->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="ditolak">

                                                <button type="submit"
                                                        class="rounded-lg px-3 py-2 text-xs font-bold text-white transition hover:opacity-80"
                                                        style="background:#a83c60;">
                                                    Tolak
                                                </button>
                                            </form>

                                        @elseif($peminjaman->status === 'disetujui')

                                            <form action="{{ route('petugas.peminjaman.kembalikan', $peminjaman->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                        class="rounded-lg px-3 py-2 text-xs font-bold text-white transition hover:opacity-80"
                                                        style="background:#741d3c;">
                                                    Konfirmasi Kembali
                                                </button>
                                            </form>

                                        @else

                                            <span class="text-xs font-medium text-gray-400">
                                                Selesai diproses
                                            </span>

                                        @endif

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-sm text-gray-500">
                                    Belum ada data peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <div class="border-t border-pink-100 p-6">
                {{ $peminjamans->links() }}
            </div>

        </div>

        <!-- Tombol Kembali -->
        <a href="{{ route('petugas.dashboard') }}"
           class="mt-6 inline-block rounded-xl px-5 py-3 text-sm font-bold text-white transition hover:opacity-80"
           style="background:#4b1029;">
            Kembali ke Dashboard
        </a>

        <p class="mt-8 text-center text-sm" style="color:#8e294d;">
            Bookavy - Sistem Informasi Perpustakaan
        </p>

    </div>
</div>
@endsection