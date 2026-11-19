<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold" style="color:#741d3c;">
            Data Pengembalian
        </h2>
    </x-slot>

    <div class="min-h-screen px-4 py-8 sm:px-8"
         style="background:linear-gradient(135deg,#fff8ef,#fce8ee);">

        <div class="mx-auto max-w-7xl rounded-3xl bg-white p-6 shadow-lg">

            <div class="mb-6">
                <p class="text-xs font-bold uppercase tracking-widest"
                   style="color:#a83c60;">
                    BOOKAVY ADMIN PANEL
                </p>

                <h3 class="mt-2 text-xl font-bold" style="color:#741d3c;">
                    Daftar Pengembalian Buku
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    Konfirmasi pengembalian buku yang sedang dipinjam dan pantau riwayat pengembalian.
                </p>
            </div>

            <!-- Pesan Berhasil -->
            @if(session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-100 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Pesan Error -->
            @if(session('error'))
                <div class="mb-5 rounded-xl border border-red-200 bg-red-100 p-4 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="w-full border-collapse text-left text-sm">
                    <thead style="background:#741d3c;color:white;">
                        <tr>
                            <th class="w-16 px-5 py-4 text-center">No</th>
                            <th class="px-5 py-4">Anggota</th>
                            <th class="px-5 py-4">Buku</th>
                            <th class="px-5 py-4 text-center">Tanggal Kembali</th>
                            <th class="px-5 py-4 text-center">Status</th>
                            <th class="px-5 py-4 text-center">Aksi</th>
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

                                <td class="px-5 py-4 text-center text-gray-600">
                                    {{ $item->tanggal_kembali ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-center">
                                    @if($item->status === 'dikembalikan')
                                        <span class="inline-block rounded-lg px-3 py-1 text-xs font-bold"
                                              style="background:#dcfce7;color:#166534;">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @else
                                        <span class="inline-block rounded-lg px-3 py-1 text-xs font-bold"
                                              style="background:#fce8ee;color:#741d3c;">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 text-center">
                                    @if($item->status === 'disetujui')
                                        <form action="{{ route('petugas.peminjaman.kembalikan', $item->id) }}"
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
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-5 py-8 text-center text-gray-500">
                                    Belum ada data pengembalian buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $peminjamans->links() }}
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="mt-6 inline-block rounded-xl px-5 py-2.5 text-sm font-bold text-white"
               style="background:#741d3c;">
                Kembali ke Dashboard
            </a>

        </div>
    </div>
</x-app-layout>