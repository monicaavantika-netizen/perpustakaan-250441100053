<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold" style="color:#741d3c;">
            Dashboard Petugas
        </h2>
    </x-slot>

    <div class="min-h-screen px-4 py-8 sm:px-8"
         style="background:linear-gradient(135deg,#fff8ef,#fce8ee);">

        <div class="mx-auto max-w-7xl">

            <!-- Selamat Datang -->
            <div class="mb-6 rounded-3xl bg-white p-8 shadow-lg">
                <p class="text-xs font-bold uppercase tracking-widest"
                   style="color:#a83c60;">
                    BOOKAVY PETUGAS PANEL
                </p>

                <h3 class="mt-3 text-2xl font-bold" style="color:#741d3c;">
                    Selamat Datang, Petugas!
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    Kelola operasional perpustakaan melalui menu yang tersedia.
                    Kamu dapat mengelola buku, memproses peminjaman dan pengembalian,
                    serta melihat laporan perpustakaan.
                </p>
            </div>

            <!-- Menu Petugas -->
            <div class="rounded-3xl bg-white p-6 shadow-lg">

                <h3 class="mb-5 text-xl font-bold" style="color:#741d3c;">
                    Menu Pengelolaan Perpustakaan
                </h3>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                    <!-- Data Buku -->
                    <a href="{{ route('buku.index') }}"
                       class="rounded-2xl p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                       style="background:#fff0f4;">
                        <h4 class="text-lg font-bold" style="color:#741d3c;">
                            Data Buku
                        </h4>
                        <p class="mt-2 text-sm text-gray-600">
                            Melihat, menambah, mengubah, dan menghapus data buku.
                        </p>
                    </a>

                    <!-- Peminjaman -->
                    <a href="{{ route('petugas.peminjaman.index') }}"
                       class="rounded-2xl p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                       style="background:#fff5e9;">
                        <h4 class="text-lg font-bold" style="color:#741d3c;">
                            Data Peminjaman
                        </h4>
                        <p class="mt-2 text-sm text-gray-600">
                            Melihat pengajuan serta memproses persetujuan peminjaman.
                        </p>
                    </a>

                    <!-- Pengembalian -->
                    <a href="{{ route('petugas.peminjaman.index') }}"
                       class="rounded-2xl p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                       style="background:#eaf7ed;">
                        <h4 class="text-lg font-bold" style="color:#741d3c;">
                            Data Pengembalian
                        </h4>
                        <p class="mt-2 text-sm text-gray-600">
                            Memproses pengembalian buku dari anggota.
                        </p>
                    </a>

                    <!-- Laporan -->
                    <a href="{{ route('petugas.laporan.index') }}"
                       class="rounded-2xl p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                       style="background:#eaf5ff;">
                        <h4 class="text-lg font-bold" style="color:#741d3c;">
                            Laporan Perpustakaan
                        </h4>
                        <p class="mt-2 text-sm text-gray-600">
                            Melihat ringkasan peminjaman dan pengembalian buku.
                        </p>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>