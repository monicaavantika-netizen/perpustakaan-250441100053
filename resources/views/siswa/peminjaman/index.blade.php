@extends('layouts.bookavy')

@section('title', 'Peminjaman Buku - Bookavy')

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    .loan-page {
        min-height: 100vh;
        padding: 40px 0 65px;
        background: linear-gradient(135deg, #fff7f5 0%, #fce9eb 45%, #f8dce2 100%);
        color: #702936;
    }

    .loan-container {
        width: 92%;
        max-width: 1200px;
        margin: auto;
    }

    /* HEADER */
    .loan-heading {
        position: relative;
        overflow: hidden;
        padding: 40px;
        margin-bottom: 28px;
        border-radius: 16px;
        background: linear-gradient(115deg, #772635 0%, #a63f55 50%, #dc899a 100%);
        box-shadow: 0 8px 20px rgba(105, 35, 48, .12);
    }

    .loan-heading h1 {
        margin: 0 0 10px;
        font-size: 32px;
        font-weight: 800;
        color: #fff;
        letter-spacing: -.5px;
    }

    .loan-heading p {
        margin: 0;
        font-size: 15px;
        color: #ffeaed;
    }

    /* NOTIFICATION */
    .loan-alert,
    .loan-error {
        padding: 16px 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        font-size: 14px;
    }

    .loan-alert {
        border: 1px solid #b8dcb8;
        background: #edf8ec;
        color: #286b35;
    }

    .loan-error {
        border: 1px solid #e9bdc0;
        background: #fff0f0;
        color: #a52e3a;
    }

    /* CARD */
    .loan-card {
        margin-bottom: 28px;
        overflow: hidden;
        border: 1px solid #f0dce0;
        border-radius: 14px;
        background: rgba(255, 255, 255, .95);
        box-shadow: 0 5px 18px rgba(105, 35, 48, .07);
    }

    .loan-card-title {
        display: block;
        padding: 17px 25px;
        background: linear-gradient(110deg, #772635, #a94258, #c86b7e);
        color: #fff;
        font-size: 18px;
        font-weight: 700;
    }

    .loan-card-body {
        padding: 28px;
    }

    /* FORM */
    .loan-form {
        display: flex;
        align-items: end;
        gap: 20px;
        flex-wrap: wrap;
    }

    .loan-form-group {
        flex: 1;
        min-width: 230px;
    }

    .loan-form label {
        display: block;
        margin-bottom: 10px;
        color: #702936;
        font-size: 14px;
        font-weight: 700;
    }

    .loan-form select {
        width: 100%;
        height: 48px;
        padding: 0 15px;
        border: 1px solid #d9aab4;
        border-radius: 8px;
        outline: none;
        background: #fffafa;
        color: #493536;
        font-size: 14px;
    }

    .loan-form select:focus {
        border-color: #96394e;
        box-shadow: 0 0 0 3px rgba(150, 57, 78, .1);
    }

    .loan-button {
        height: 48px;
        padding: 0 25px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(110deg, #772635, #b64e65);
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s;
    }

    .loan-button:hover {
        background: linear-gradient(110deg, #64202d, #96394e);
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(105, 35, 48, .15);
    }

    /* TABLE */
    .loan-table-wrapper {
        overflow-x: auto;
    }

    .loan-table {
        width: 100%;
        min-width: 680px;
        border-collapse: collapse;
    }

    .loan-table thead {
        background: linear-gradient(110deg, #f8e2e6, #fcecef);
    }

    .loan-table th {
        padding: 17px 18px;
        text-align: left;
        color: #702936;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .loan-table td {
        padding: 18px;
        border-bottom: 1px solid #f2e5e7;
        color: #514143;
        font-size: 13px;
    }

    .loan-table tbody tr {
        transition: .2s;
    }

    .loan-table tbody tr:hover {
        background: #fff8f8;
    }

    .loan-number {
        color: #a45d6b !important;
        font-weight: 700;
    }

    .loan-book-title {
        color: #702936 !important;
        font-weight: 700;
    }

    /* STATUS */
    .loan-status {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #fff0d4;
        color: #95600c;
    }

    .status-disetujui {
        background: #e3f4e5;
        color: #28743a;
    }

    .status-ditolak {
        background: #fde5e7;
        color: #a52e3a;
    }

    .status-dikembalikan {
        background: #e6edfa;
        color: #355a9b;
    }

    /* EMPTY */
    .loan-empty {
        padding: 45px 20px !important;
        text-align: center;
        color: #a17d82 !important;
    }

    /* PAGINATION */
    .loan-pagination {
        padding: 20px 25px;
        background: #fffdfd;
    }

    .loan-pagination nav {
        display: flex;
        justify-content: center;
    }

    /* RESPONSIVE */
    @media (max-width: 650px) {
        .loan-page {
            padding: 25px 0 40px;
        }

        .loan-container {
            width: 94%;
        }

        .loan-heading {
            padding: 28px 23px;
        }

        .loan-heading h1 {
            font-size: 25px;
        }

        .loan-card-body {
            padding: 20px;
        }

        .loan-form {
            align-items: stretch;
        }

        .loan-form-group {
            width: 100%;
        }

        .loan-button {
            width: 100%;
        }

        .loan-card-title {
            font-size: 16px;
        }
    }
</style>

<div class="loan-page">
    <div class="loan-container">

        {{-- HEADER --}}
        <div class="loan-heading">
            <h1>Peminjaman Buku</h1>
            <p>Ajukan peminjaman buku favoritmu di Bookavy.</p>
        </div>

        {{-- NOTIFIKASI --}}
        @if(session('success'))
            <div class="loan-alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="loan-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="loan-error">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- FORM PENGAJUAN --}}
        <div class="loan-card">
            <div class="loan-card-title">
                Ajukan Peminjaman
            </div>

            <div class="loan-card-body">
                <form
                    action="{{ route('siswa.peminjaman.store') }}"
                    method="POST"
                    class="loan-form"
                >
                    @csrf

                    <div class="loan-form-group">
                        <label for="buku_id">Pilih Buku</label>

                        <select name="buku_id" id="buku_id" required>
                            <option value="">-- Pilih Buku --</option>

                            @foreach($bukus as $buku)
                                <option
                                    value="{{ $buku->id }}"
                                    {{ old('buku_id') == $buku->id ? 'selected' : '' }}
                                >
                                    {{ $buku->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="loan-button">
                        Ajukan Peminjaman
                    </button>
                </form>
            </div>
        </div>

        {{-- RIWAYAT PEMINJAMAN --}}
        <div class="loan-card">
            <div class="loan-card-title">
                Riwayat Peminjaman Saya
            </div>

            <div class="loan-table-wrapper">
                <table class="loan-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($peminjamans as $index => $peminjaman)
                            <tr>
                                <td class="loan-number">
                                    {{ $peminjamans->firstItem() + $index }}
                                </td>

                                <td class="loan-book-title">
                                    {{ $peminjaman->buku->judul ?? '-' }}
                                </td>

                                <td>
                                    {{ $peminjaman->tanggal_pinjam
                                        ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td>
                                    {{ $peminjaman->tanggal_kembali
                                        ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td>
                                    <span class="loan-status status-{{ $peminjaman->status }}">
                                        {{ ucfirst($peminjaman->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="loan-empty">
                                    Belum ada riwayat peminjaman buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="loan-pagination">
                {{ $peminjamans->links() }}
            </div>
        </div>

    </div>
</div>

@endsection