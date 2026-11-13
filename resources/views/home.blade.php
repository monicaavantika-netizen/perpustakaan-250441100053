@extends('layouts.app')

@section('title', 'Bookavy - Beranda')

@section('content')

<section class="hero">

    <div class="container">

        <div class="hero-content">

            <div class="hero-text">

                <div class="hero-label">
                    WELCOME TO BOOKAVY
                </div>

                <h1>
                    Temukan Buku Favoritmu
                </h1>

                <p>
                    Jelajahi berbagai koleksi buku yang tersedia
                    di perpustakaan Bookavy.
                </p>

                <a
                    href="{{ route('buku.index') }}"
                    class="btn-primary"
                >
                    Lihat Daftar Buku
                </a>

            </div>
<div class="hero-book">
    <div class="home-book-cover">
        <div class="home-cover-content">

            <span>BOOKAVY</span>

            <h2>The Little Prince</h2>

            <div class="home-cover-line"></div>

            <p>Antoine de Saint-Exupéry</p>

            <small>1943</small>

        </div>
    </div>
</div>
        </div>

    </div>

</section>

@endsection