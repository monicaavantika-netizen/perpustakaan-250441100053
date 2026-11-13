@extends('layouts.bookavy')

@section('title', 'Bookavy - Detail Buku')

@section('content')

<style>
    .detail-section {
        min-height: 80vh;
        padding: 45px 0 65px;
    }

    .detail-container {
        width: 90%;
        max-width: 1000px;
        margin: auto;
    }

    .detail-card {
        display: grid;
        grid-template-columns: 1fr 1.3fr;
        gap: 35px;
        padding: 30px;
        border: 1px solid currentColor;
        border-radius: 15px;
    }

    .detail-cover {
        min-height: 380px;
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff8f2;
        background: linear-gradient(145deg, #702536, #a8475d, #d98b9c);
        border-radius: 12px;
    }

    .detail-cover-content h2 {
        margin: 25px 0;
        font-size: 25px;
    }

    .detail-cover-line {
        width: 65px;
        height: 2px;
        margin: 20px auto;
        background: #f8d9d5;
    }

    .detail-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .detail-info h1 {
        margin: 15px 0 25px;
        font-size: 30px;
    }

    .detail-data {
        margin-bottom: 25px;
        line-height: 2;
    }

    .detail-btn {
        display: inline-block;
        width: fit-content;
        padding: 11px 18px;
        border-radius: 7px;
        color: white;
        background: linear-gradient(100deg, #772635, #b44f68);
        text-decoration: none;
    }

    .detail-btn:hover {
        opacity: .85;
    }

    .not-found {
        padding: 40px;
        text-align: center;
        border: 1px solid currentColor;
        border-radius: 12px;
    }

    @media(max-width: 700px) {
        .detail-card {
            grid-template-columns: 1fr;
        }

        .detail-info h1 {
            font-size: 24px;
        }
    }
</style>

<section class="detail-section">
    <div class="detail-container">

        @if($buku)

            <div class="detail-card">

                <div class="detail-cover">
                    <div class="detail-cover-content">
                        <span>BOOKAVY</span>

                        <h2>{{ $buku->judul }}</h2>

                        <div class="detail-cover-line"></div>

                        <p>{{ $buku->penulis }}</p>
                        <small>{{ $buku->tahun_terbit }}</small>
                    </div>
                </div>

                <div class="detail-info">

                    <div class="hero-label">DETAIL BUKU</div>

                    <h1>{{ $buku->judul }}</h1>

                    <div class="detail-data">
                        <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>
                        <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
                    </div>

                    <a href="{{ route('buku.index') }}" class="detail-btn">
                        Kembali ke Daftar Buku
                    </a>

                </div>
            </div>

        @else

            <div class="not-found">
                <h1>Buku Tidak Ditemukan</h1>
                <p>Data buku yang kamu cari tidak tersedia.</p>

                <a href="{{ route('buku.index') }}" class="detail-btn">
                    Kembali ke Daftar Buku
                </a>
            </div>

        @endif

    </div>
</section>

@endsection
