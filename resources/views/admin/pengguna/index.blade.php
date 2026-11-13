@extends('layouts.bookavy')

@section('title', 'Bookavy - Data Pengguna')

@section('content')
<div class="min-h-screen px-4 py-8 sm:px-8"
     style="background: linear-gradient(135deg, #fff8ef, #fce8ee);">

    <div class="mx-auto max-w-7xl">

        <!-- Banner -->
        <div class="relative mb-8 overflow-hidden rounded-3xl p-8 text-white shadow-xl"
             style="background: linear-gradient(120deg, #4b1029, #8e294d, #c45b7c);">

            <div class="relative z-10">
                <p class="mb-2 text-sm font-semibold uppercase tracking-widest"
                   style="color: #f8cbd8;">
                    BOOKAVY ADMIN PANEL
                </p>

                <h1 class="mb-3 text-3xl font-extrabold sm:text-4xl">
                    Data Pengguna
                </h1>

                <p class="max-w-xl text-sm leading-relaxed text-pink-100 sm:text-base">
                    Kelola akun pengguna dan atur hak akses
                    sesuai peran masing-masing di perpustakaan Bookavy.
                </p>
            </div>

            <div class="pointer-events-none absolute -right-8 -top-16 h-64 w-64 rounded-full border-[30px] border-white opacity-10"></div>
            <div class="pointer-events-none absolute -bottom-24 right-40 h-52 w-52 rounded-full bg-pink-300 opacity-10"></div>

            <div class="absolute bottom-5 right-8 hidden text-7xl font-black text-white opacity-10 sm:block">
                B
            </div>
        </div>

        <!-- Informasi -->
        <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2">

            <div class="rounded-2xl border border-pink-100 bg-white p-6 shadow-lg">
                <p class="text-sm font-semibold text-gray-500">
                    Jumlah Pengguna
                </p>

                <h2 class="mt-2 text-3xl font-extrabold"
                    style="color: #741d3c;">
                    {{ $users->total() }}
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Total akun yang terdaftar.
                </p>
            </div>

            <div class="rounded-2xl border border-pink-100 p-6 shadow-lg"
                 style="background: #fce8ee;">
                <p class="text-sm font-semibold text-gray-500">
                    Pengaturan Akun
                </p>

                <h2 class="mt-2 text-2xl font-extrabold"
                    style="color: #a83c60;">
                    Hak Akses Pengguna
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Atur peran admin, petugas, dan siswa.
                </p>
            </div>

        </div>

        <!-- Tabel Pengguna -->
        <div class="overflow-hidden rounded-3xl border border-pink-100 bg-white shadow-lg">

            <div class="border-b border-pink-100 p-6">
                <p class="text-xs font-bold uppercase tracking-widest"
                   style="color: #a83c60;">
                    MANAJEMEN AKUN
                </p>

                <h2 class="mt-2 text-2xl font-extrabold"
                    style="color: #4b1029;">
                    Daftar Pengguna
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Berikut daftar akun yang terdaftar pada Bookavy.
                </p>
            </div>

            @if(session('success'))
                <div class="mx-6 mt-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mx-6 mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto p-6">
                <table class="w-full min-w-[700px] border-collapse text-left">

                    <thead>
                        <tr style="background: #741d3c; color: white;">
                            <th class="rounded-l-xl px-5 py-4 text-sm font-semibold">
                                No.
                            </th>
                            <th class="px-5 py-4 text-sm font-semibold">
                                Nama Pengguna
                            </th>
                            <th class="px-5 py-4 text-sm font-semibold">
                                Email
                            </th>
                            <th class="px-5 py-4 text-sm font-semibold">
                                Role Saat Ini
                            </th>
                            <th class="rounded-r-xl px-5 py-4 text-sm font-semibold">
                                Ubah Role
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-b border-pink-100 transition hover:bg-pink-50">

                                <td class="px-5 py-5 text-sm text-gray-600">
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                <td class="px-5 py-5">
                                    <p class="font-bold" style="color: #741d3c;">
                                        {{ $user->name }}
                                    </p>
                                </td>

                                <td class="px-5 py-5 text-sm text-gray-600">
                                    {{ $user->email }}
                                </td>

                                <td class="px-5 py-5">
                                    @php
                                        $role = $user->roles->first()?->name ?? 'Belum memiliki role';
                                    @endphp

                                    <span class="inline-block rounded-full px-4 py-2 text-xs font-bold"
                                          style="background: #fce8ee; color: #741d3c;">
                                        {{ ucfirst($role) }}
                                    </span>
                                </td>

                                <td class="px-5 py-5">
                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('admin.pengguna.updateRole', $user->id) }}"
                                              method="POST"
                                              class="flex items-center gap-2">

                                            @csrf
                                            @method('PATCH')

                                            <select name="role"
                                                    class="rounded-lg border border-pink-200 px-3 py-2 text-sm focus:border-pink-500 focus:ring-pink-300">
                                                @foreach($roles as $item)
                                                    <option value="{{ $item }}"
                                                        {{ $role === $item ? 'selected' : '' }}>
                                                        {{ ucfirst($item) }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <button type="submit"
                                                    class="rounded-lg px-4 py-2 text-sm font-semibold text-white transition hover:opacity-90"
                                                    style="background: #741d3c;">
                                                Simpan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-sm font-semibold text-gray-400">
                                            Akun Anda
                                        </span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-5 py-10 text-center text-sm text-gray-500">
                                    Belum ada pengguna terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="border-t border-pink-100 px-6 py-5">
                {{ $users->links() }}
            </div>

        </div>

        <!-- Kembali -->
        <div class="mt-6">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-block rounded-xl px-5 py-3 text-sm font-bold transition hover:opacity-90"
               style="background: #4b1029; color: white;">
                Kembali ke Dashboard
            </a>
        </div>

        <p class="mt-8 text-center text-sm" style="color: #8e294d;">
            Bookavy - Sistem Informasi Perpustakaan
        </p>

    </div>
</div>
@endsection
