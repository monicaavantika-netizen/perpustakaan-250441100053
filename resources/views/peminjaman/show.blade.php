<x-app-layout>
    <div class="min-h-screen bg-[#fff8f5] py-10 px-4">
        <div class="max-w-4xl mx-auto">

            <div class="mb-8">
                <a href="{{ url()->previous() }}"
                   class="text-sm text-[#8b3155] hover:text-[#5c1835]">
                    &larr; Kembali
                </a>

                <h1 class="text-3xl font-bold text-[#641d3b] mt-4">
                    Detail Peminjaman
                </h1>

                <p class="text-gray-500 mt-1">
                    Informasi lengkap data peminjaman buku.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-md overflow-hidden">

                <div class="bg-gradient-to-r from-[#641d3b] to-[#bd6689] p-6 text-white">
                    <h2 class="text-xl font-semibold">
                        Informasi Peminjaman
                    </h2>

                    <p class="text-sm text-pink-100 mt-1">
                        Nomor Peminjaman #{{ $peminjaman->id }}
                    </p>
                </div>

                <div class="p-6 space-y-5">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-sm text-gray-500 mb-1">Nama Anggota</p>
                            <p class="font-semibold text-gray-800">
                                {{ $peminjaman->anggota->nama ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-1">Email</p>
                            <p class="font-semibold text-gray-800">
                                {{ $peminjaman->anggota->email ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-1">Judul Buku</p>
                            <p class="font-semibold text-gray-800">
                                {{ $peminjaman->buku->judul ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-1">Penulis</p>
                            <p class="font-semibold text-gray-800">
                                {{ $peminjaman->buku->penulis ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-1">Tanggal Pinjam</p>
                            <p class="font-semibold text-gray-800">
                                {{ $peminjaman->tanggal_pinjam ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-1">Tanggal Kembali</p>
                            <p class="font-semibold text-gray-800">
                                {{ $peminjaman->tanggal_kembali ?? 'Belum dikembalikan' }}
                            </p>
                        </div>

                    </div>

                    <div class="border-t border-pink-100 pt-5">
                        <p class="text-sm text-gray-500 mb-2">
                            Status Peminjaman
                        </p>

                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-pink-100 text-pink-700">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </div>

                </div>
            </div>

            <div class="mt-6">
                <a href="{{ url()->previous() }}"
                   class="inline-block px-6 py-3 rounded-xl bg-gradient-to-r from-[#641d3b] to-[#bd6689] text-white font-semibold hover:opacity-90 transition">
                    Kembali
                </a>
            </div>

        </div>
    </div>
</x-app-layout>