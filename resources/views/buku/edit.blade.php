@extends('layouts.bookavy')

@section('title', 'Bookavy - Ubah Buku')

@section('content')

<style>
    .edit-page {
        min-height: 100vh;
        padding: 40px 20px 60px;
        background: linear-gradient(135deg, #fff8ef, #fce8ee);
    }

    .edit-container {
        max-width: 850px;
        margin: auto;
    }

    .edit-banner {
        padding: 35px;
        margin-bottom: 28px;
        border-radius: 25px;
        color: white;
        background: linear-gradient(120deg, #4b1029, #8e294d, #c45b7c);
        box-shadow: 0 10px 25px rgba(116, 29, 60, 0.15);
    }

    .edit-banner p {
        color: #f8cbd8;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 3px;
        margin-bottom: 10px;
    }

    .edit-banner h1 {
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .edit-banner .description {
        color: #ffe8ef;
        font-size: 14px;
    }

    .edit-card {
        padding: 30px;
        background: white;
        border: 1px solid #f5dce5;
        border-radius: 25px;
        box-shadow: 0 8px 25px rgba(116, 29, 60, 0.08);
    }

    .edit-card h2 {
        color: #4b1029;
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .edit-subtitle {
        color: #8e294d;
        font-size: 14px;
        margin-bottom: 28px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        color: #741d3c;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 13px 15px;
        border: 1px solid #edcbd7;
        border-radius: 12px;
        outline: none;
        color: #4b1029;
        background: #fffafd;
        transition: 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #a83c60;
        box-shadow: 0 0 0 3px rgba(168, 60, 96, 0.12);
    }

    .form-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 30px;
    }

    .btn-save,
    .btn-back {
        display: inline-block;
        padding: 12px 22px;
        border: none;
        border-radius: 11px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-save {
        color: white;
        background: #741d3c;
    }

    .btn-back {
        color: #741d3c;
        background: #fce8ee;
    }

    .btn-save:hover,
    .btn-back:hover {
        opacity: 0.85;
        transform: translateY(-2px);
    }

    .form-message {
        padding: 14px 16px;
        margin-bottom: 20px;
        border-radius: 12px;
        font-size: 14px;
    }

    .form-message.error {
        color: #991b1b;
        background: #fee2e2;
    }

    .edit-footer {
        margin-top: 28px;
        text-align: center;
        color: #8e294d;
        font-size: 13px;
    }
</style>

<section class="edit-page">
    <div class="edit-container">

        <!-- Banner -->
        <div class="edit-banner">
            <p>BOOKAVY COLLECTION</p>
            <h1>Ubah Informasi Buku</h1>
            <div class="description">
                Perbarui informasi koleksi buku perpustakaan dengan mudah.
            </div>
        </div>

        <!-- Pesan Validasi -->
        @if ($errors->any())
            <div class="form-message error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="edit-card">
            <h2>Informasi Buku</h2>
            <p class="edit-subtitle">
                Silakan periksa dan ubah informasi buku di bawah ini.
            </p>

            <form action="{{ route('buku.update', $buku->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kategori_id">ID Kategori</label>
                    <input type="number" name="kategori_id" id="kategori_id"
                           value="{{ old('kategori_id', $buku->kategori_id) }}"
                           placeholder="Masukkan ID kategori" required>
                </div>

                <div class="form-group">
                    <label for="judul">Judul Buku</label>
                    <input type="text" name="judul" id="judul"
                           value="{{ old('judul', $buku->judul_buku ?? $buku->judul) }}"
                           placeholder="Masukkan judul buku" required>
                </div>

                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="text" name="penulis" id="penulis"
                           value="{{ old('penulis', $buku->penulis) }}"
                           placeholder="Masukkan nama penulis" required>
                </div>

                <div class="form-group">
                    <label for="tahun_terbit">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" id="tahun_terbit"
                           value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                           placeholder="Masukkan tahun terbit" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('buku.index') }}" class="btn-back">
                        Kembali
                    </a>
                </div>
            </form>
        </div>

        <div class="edit-footer">
            Bookavy - Sistem Informasi Perpustakaan
        </div>

    </div>
</section>

@endsection