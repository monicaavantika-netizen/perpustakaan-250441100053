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

    .form-group input {
        width: 100%;
        padding: 13px 15px;
        border: 1px solid #edcbd7;
        border-radius: 12px;
        outline: none;
        color: #4b1029;
        background: #fffafd;
        transition: 0.2s;
    }

    .form-group input:focus {
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

    .btn-save:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .form-message {
        display: none;
        padding: 14px 16px;
        margin-bottom: 20px;
        border-radius: 12px;
        font-size: 14px;
    }

    .form-message.success {
        display: block;
        color: #166534;
        background: #dcfce7;
    }

    .form-message.error {
        display: block;
        color: #991b1b;
        background: #fee2e2;
    }

    .edit-footer {
        margin-top: 28px;
        text-align: center;
        color: #8e294d;
        font-size: 13px;
    }

    @media (max-width: 600px) {
        .edit-banner {
            padding: 25px;
        }

        .edit-banner h1 {
            font-size: 25px;
        }

        .edit-card {
            padding: 22px;
        }
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

        <!-- Pesan -->
        <div id="pesan" class="form-message"></div>

        <!-- Form -->
        <div class="edit-card">

            <h2>Informasi Buku</h2>
            <p class="edit-subtitle">
                Silakan periksa dan ubah informasi buku di bawah ini.
            </p>

            <form id="formBuku">

                <div class="form-group">
                    <label for="kategori_id">ID Kategori</label>
                    <input type="number" id="kategori_id"
                           placeholder="Masukkan ID kategori" required>
                </div>

                <div class="form-group">
                    <label for="judul">Judul Buku</label>
                    <input type="text" id="judul"
                           placeholder="Masukkan judul buku" required>
                </div>

                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="text" id="penulis"
                           placeholder="Masukkan nama penulis" required>
                </div>

                <div class="form-group">
                    <label for="tahun_terbit">Tahun Terbit</label>
                    <input type="number" id="tahun_terbit"
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

<script>
    // Mengambil ID buku dari URL
    const idBuku = window.location.pathname
        .split('/')
        .filter(Boolean)
        .slice(-2, -1)[0];

    const apiUrl = '/api/buku/' + encodeURIComponent(idBuku);

    const form = document.getElementById('formBuku');
    const pesan = document.getElementById('pesan');

    function tampilkanPesan(teks, jenis) {
        pesan.textContent = teks;
        pesan.className = 'form-message ' + jenis;
    }

    // Mengambil data buku berdasarkan ID
    async function ambilBuku() {
        try {
            const response = await fetch(apiUrl, {
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json'
                }
            });

            const text = await response.text();
            let hasil;
            try {
                hasil = JSON.parse(text);
            } catch {
                throw new Error('Server membalas HTML saat ambil data (Status ' + response.status + ').');
            }

            if (!response.ok) {
                throw new Error(hasil.message || 'Buku tidak ditemukan.');
            }

            const buku = hasil.data || hasil;

            document.getElementById('kategori_id').value = buku.kategori_id;
            document.getElementById('judul').value = buku.judul_buku ?? buku.judul ?? '';
            document.getElementById('penulis').value = buku.penulis;
            document.getElementById('tahun_terbit').value = buku.tahun_terbit;

        } catch (error) {
            tampilkanPesan(error.message, 'error');
            form.querySelector('button[type="submit"]').disabled = true;
        }
    }

    // Memperbarui data buku
    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        const dataBuku = {
            kategori_id: document.getElementById('kategori_id').value,
            judul: document.getElementById('judul').value,
            penulis: document.getElementById('penulis').value,
            tahun_terbit: document.getElementById('tahun_terbit').value
        };

        const tombol = form.querySelector('button[type="submit"]');
        tombol.disabled = true;
        tombol.textContent = 'Menyimpan...';

        try {
            const response = await fetch(apiUrl, {
                method: 'PUT',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(dataBuku)
            });

            const text = await response.text();
            let hasil;
            try {
                hasil = JSON.parse(text);
            } catch {
                throw new Error('Server membalas HTML saat simpan (Status ' + response.status + '). Cek routes/api.php atau Logs Vercel.');
            }

            if (!response.ok) {
                const error = hasil.errors
                    ? Object.values(hasil.errors).flat().join(' ')
                    : hasil.message || 'Gagal memperbarui buku.';

                throw new Error(error);
            }

            tampilkanPesan('Buku berhasil diperbarui.', 'success');

            setTimeout(() => {
                window.location.href = "{{ route('buku.index') }}";
            }, 1000);

        } catch (error) {
            tampilkanPesan(error.message, 'error');
            tombol.disabled = false;
            tombol.textContent = 'Simpan Perubahan';
        }
    });

    ambilBuku();
</script>

@endsection