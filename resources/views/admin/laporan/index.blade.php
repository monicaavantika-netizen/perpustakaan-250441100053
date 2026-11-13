<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold" style="color:#741d3c;">
            Laporan Perpustakaan
        </h2>
    </x-slot>

    <div class="min-h-screen px-4 py-8 sm:px-8"
         style="background:linear-gradient(135deg,#fff8ef,#fce8ee);">

        <div class="mx-auto max-w-7xl">

            <!-- Ringkasan Laporan -->
            <div class="mb-6 rounded-3xl bg-white p-6 shadow-lg">

                <h3 class="mb-5 text-xl font-bold" style="color:#741d3c;">
                    Ringkasan Aktivitas Perpustakaan
                </h3>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

                    <div class="rounded-2xl p-5" style="background:#fff0f4;">
                        <p class="text-sm text-gray-600">Total Peminjaman</p>
                        <h3 class="mt-2 text-3xl font-extrabold" style="color:#741d3c;">
                            {{ $totalPeminjaman }}
                        </h3>
                    </div>

                    <div class="rounded-2xl p-5" style="background:#eaf7ed;">
                        <p class="text-sm text-gray-600">Total Pengembalian</p>
                        <h3 class="mt-2 text-3xl font-extrabold text-green-700">
                            {{ $totalPengembalian }}
                        </h3>
                    </div>

                    <div class="rounded-2xl p-5" style="background:#fff5e9;">
                        <p class="text-sm text-gray-600">Menunggu Persetujuan</p>
                        <h3 class="mt-2 text-3xl font-extrabold text-orange-600">
                            {{ $totalMenunggu }}
                        </h3>
                    </div>

                    <div class="rounded-2xl p-5" style="background:#eaf5ff;">
                        <p class="text-sm text-gray-600">Disetujui</p>
                        <h3 class="mt-2 text-3xl font-extrabold text-blue-700">
                            {{ $totalDisetujui }}
                        </h3>
                    </div>

                    <div class="rounded-2xl p-5" style="background:#fce8ee;">
                        <p class="text-sm text-gray-600">Ditolak</p>
                        <h3 class="mt-2 text-3xl font-extrabold text-red-700">
                            {{ $totalDitolak }}
                        </h3>
                    </div>

                </div>
            </div>

            <!-- Riwayat Peminjaman -->
            <div class="rounded-3xl bg-white p-6 shadow-lg">

                <h3 class="mb-5 text-xl font-bold" style="color:#741d3c;">
                    Riwayat Peminjaman
                </h3>

                <div class="overflow-x-auto rounded-xl border border-gray-200">
                    <table class="w-full border-collapse text-left text-sm">

                        <thead style="background:#741d3c;color:white;">
                            <tr>
                                <th class="w-16 px-5 py-4 text-center">No</th>
                                <th class="px-5 py-4">Anggota</th>
                                <th class="px-5 py-4">Buku</th>
                                <th class="px-5 py-4 text-center">Status</th>
                                <th class="px-5 py-4 text-center">Tanggal Kembali</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($peminjamans as $item)
                                <tr class="border-b border-gray-200 transition hover:bg-pink-50">

                                    <td class="px-5 py-4 text-center text-gray-600">
                                        {{ $peminjamans->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-5 py-4 font-medium text-gray-700">
                                        {{ $item->anggota->nama ?? '-' }}
                                    </td>

                                    <td class="px-5 py-4 font-medium text-gray-700">
                                        {{ $item->buku->judul ?? '-' }}
                                    </td>

                                    <td class="px-5 py-4 text-center">
                                        <span class="inline-block rounded-lg px-3 py-1 text-xs font-bold"
                                              style="background:#fce8ee;color:#741d3c;">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4 text-center text-gray-600">
                                        {{ $item->tanggal_kembali ?? '-' }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-5 py-8 text-center text-gray-500">
                                        Belum ada riwayat peminjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-5">
                    {{ $peminjamans->links() }}
                </div>

                <!-- Tombol Kembali Sesuai Role -->
                <a href="{{ auth()->user()->hasRole('petugas') ? route('petugas.dashboard') : route('admin.dashboard') }}"
                   class="mt-6 inline-block rounded-xl px-5 py-2 text-white"
                   style="background:#741d3c;">
                    Kembali ke Dashboard
                </a>

            </div>
        </div>
    </div>
</x-app-layout>