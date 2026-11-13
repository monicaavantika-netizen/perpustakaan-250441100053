<div class="book-card">

    <div class="book-cover">
        <div class="cover-content">
            <span class="cover-brand">BOOKAVY</span>

            <h3>{{ $buku->judul }}</h3>

            <div class="cover-line"></div>

            <p>{{ $buku->penulis }}</p>

            <small>{{ $buku->tahun_terbit }}</small>
        </div>
    </div>

    <div class="book-info">

        <h3>{{ $buku->judul }}</h3>

        <p class="book-author">
            {{ $buku->penulis }}
        </p>

        <p class="book-year">
            Tahun Terbit: {{ $buku->tahun_terbit }}
        </p>

        {{ $slot }}

    </div>

</div>