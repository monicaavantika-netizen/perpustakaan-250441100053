<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl" style="color: #741d3c;">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="min-h-screen px-4 py-8 sm:px-8"
         style="background: linear-gradient(135deg, #fff8ef, #fce8ee);">

        <div class="mx-auto max-w-7xl">

            <!-- Banner Selamat Datang -->
            <div class="relative mb-8 overflow-hidden rounded-3xl p-8 text-white shadow-xl"
                 style="background: linear-gradient(120deg, #4b1029, #8e294d, #c45b7c);">

                <div class="relative z-10">
                    <p class="mb-2 text-sm font-semibold uppercase tracking-widest"
                       style="color: #f8cbd8;">
                        BOOKAVY ADMIN PANEL
                    </p>

                    <h1 class="mb-3 text-3xl font-extrabold sm:text-4xl">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h1>

                    <p class="max-w-xl text-sm leading-relaxed text-pink-100 sm:text-base">
                        Kelola perpustakaan Bookavy dengan mudah.
                        Pantau buku, pengguna, dan aktivitas peminjaman
                        melalui halaman dashboard ini.
                    </p>
                </div>

                <div class="pointer-events-none absolute -right-8 -top-16 h-64 w-64 rounded-full border-[30px] border-white opacity-10"></div>
                <div class="pointer-events-none absolute -bottom-24 right-40 h-52 w-52 rounded-full bg-pink-300 opacity-10"></div>

                <div class="absolute bottom-5 right-8 hidden text-7xl font-black text-white opacity-10 sm:block">
                    B
                </div>
            </div>

            <!-- Kartu Informasi -->
            <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                <!-- Pengelolaan Buku -->
                <a href="{{ route('buku.index') }}"
                   class="block rounded-2xl border border-pink-100 bg-white p-6 shadow-lg transition hover:-translate-y-1 hover:shadow-xl">

                    <p class="text-sm font-semibold text-gray-500">
                        Pengelolaan Buku
                    </p>

                    <h3 class="mt-2 text-2xl font-extrabold" style="color:#741d3c;">
                        Daftar Buku
                    </h3>

                    <p class="mt-3 text-sm text-gray-500">
                        Lihat dan kelola koleksi buku perpustakaan.
                    </p>

                    <p class="mt-5 inline-block rounded-xl px-5 py-2.5 text-sm font-bold text-white"
                       style="background:#741d3c;">
                        Buka Daftar Buku
                    </p>
                </a>

                <!-- Pengelolaan Pengguna -->
                <div class="rounded-2xl border border-pink-100 p-6 shadow-lg"
                     style="background:#fce8ee;">

                    <p class="text-sm font-semibold text-gray-500">
                        Pengelolaan Akun
                    </p>

                    <h3 class="mt-2 text-2xl font-extrabold" style="color:#a83c60;">
                        Pengguna
                    </h3>

                    <p class="mt-3 text-sm text-gray-500">
                        Kelola akun dan hak akses pengguna.
                    </p>

                    <a href="{{ route('admin.pengguna.index') }}"
                       class="mt-5 inline-block rounded-xl px-5 py-2.5 text-sm font-bold text-white"
                       style="background:#a83c60;">
                        Kelola Pengguna
                    </a>
                </div>

                <!-- Informasi Akun -->
                <div class="rounded-2xl border border-pink-100 bg-white p-6 shadow-lg">

                    <p class="text-sm font-semibold text-gray-500">
                        Informasi Akun
                    </p>

                    <h3 class="mt-2 text-2xl font-extrabold" style="color:#8e294d;">
                        Administrator
                    </h3>

                    <p class="mt-3 text-sm text-gray-500">
                        Anda masuk sebagai administrator Bookavy.
                    </p>

                    <a href="{{ route('profile.edit') }}"
                       class="mt-5 inline-block rounded-xl px-5 py-2.5 text-sm font-bold text-white"
                       style="background:#8e294d;">
                        Lihat Profil
                    </a>
                </div>

            </div>

            <!-- Menu Utama -->
            <div class="mb-8 rounded-3xl border border-pink-100 bg-white p-6 shadow-lg sm:p-8">

                <div class="mb-6">
                    <p class="text-xs font-bold uppercase tracking-widest"
                       style="color:#a83c60;">
                        MENU ADMIN
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold"
                        style="color:#4b1029;">
                        Kelola Perpustakaan
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Pilih menu untuk mengelola sistem Bookavy.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <!-- Data Buku -->
                    <a href="{{ route('buku.index') }}"
                       class="block rounded-2xl p-5 transition hover:-translate-y-1 hover:shadow-md"
                       style="background:#fff0f4; border:1px solid #f2c5d2;">

                        <h3 class="font-bold" style="color:#741d3c;">
                            Data Buku
                        </h3>

                        <p class="mt-2 text-sm text-gray-600">
                            Melihat dan mengelola koleksi buku perpustakaan.
                        </p>
                    </a>

                    <!-- Data Pengguna -->
                    <a href="{{ route('admin.pengguna.index') }}"
                       class="block rounded-2xl p-5 transition hover:-translate-y-1 hover:shadow-md"
                       style="background:#fff5e9; border:1px solid #f3dfc6;">

                        <h3 class="font-bold" style="color:#741d3c;">
                            Data Pengguna
                        </h3>

                        <p class="mt-2 text-sm text-gray-600">
                            Mengatur akun dan peran pengguna.
                        </p>
                    </a>

                    <!-- Data Peminjaman -->
                    <a href="{{ route('admin.peminjaman.index') }}"
                       class="block rounded-2xl p-5 transition hover:-translate-y-1 hover:shadow-md"
                       style="background:#f0eaff; border:1px solid #d8c9f5;">

                        <h3 class="font-bold" style="color:#741d3c;">
                            Data Peminjaman
                        </h3>

                        <p class="mt-2 text-sm text-gray-600">
                            Melihat daftar peminjaman buku.
                        </p>
                    </a>

                    <!-- Data Pengembalian -->
                    <a href="{{ route('admin.pengembalian.index') }}"
                       class="block rounded-2xl p-5 transition hover:-translate-y-1 hover:shadow-md"
                       style="background:#eaf5ff; border:1px solid #c8e2f5;">

                        <h3 class="font-bold" style="color:#741d3c;">
                            Data Pengembalian
                        </h3>

                        <p class="mt-2 text-sm text-gray-600">
                            Melihat data pengembalian buku.
                        </p>
                    </a>

                    <!-- Laporan Perpustakaan -->
                    <a href="{{ route('admin.laporan.index') }}"
                       class="block rounded-2xl p-5 transition hover:-translate-y-1 hover:shadow-md"
                       style="background:#eaf7ed; border:1px solid #c9e8d0;">

                        <h3 class="font-bold" style="color:#741d3c;">
                            Laporan Perpustakaan
                        </h3>

                        <p class="mt-2 text-sm text-gray-600">
                            Melihat rekap aktivitas perpustakaan.
                        </p>
                    </a>

                </div>
            </div>

            <!-- Footer -->
            <div class="rounded-2xl p-5 text-center text-sm text-white"
                 style="background:#4b1029;">

                <p class="font-semibold">
                    BOOKAVY LIBRARY
                </p>

                <p class="mt-1 text-pink-200">
                    Sistem Informasi Perpustakaan Digital
                </p>
            </div>

        </div>
    </div>
</x-app-layout>