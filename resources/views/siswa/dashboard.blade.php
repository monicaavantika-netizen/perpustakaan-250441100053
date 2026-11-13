
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl" style="color: #702936;">
            Dashboard Siswa Bookavy
        </h2>
    </x-slot>

    <style>
        .student-dashboard {
            min-height: 90vh;
            padding: 35px 22px 55px;
            background:
                radial-gradient(circle at 5% 10%, #f7cbd2 0, transparent 25%),
                radial-gradient(circle at 95% 80%, #f3c2cb 0, transparent 25%),
                linear-gradient(135deg, #fff8f4, #fce8eb 55%, #f9dce2);
        }

        .student-container {
            max-width: 1200px;
            margin: auto;
        }

        /* Banner utama */
        .student-banner {
            position: relative;
            overflow: hidden;
            padding: 48px 45px;
            border-radius: 24px;
            color: white;
            background: linear-gradient(115deg, #57182d, #842b46 55%, #c65d78);
            box-shadow: 0 12px 30px rgba(91, 24, 45, .2);
        }

        .student-banner::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            right: 100px;
            top: -180px;
            background: rgba(255,255,255,.09);
        }

        .student-banner::after {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            border-radius: 50%;
            right: -60px;
            bottom: -150px;
            background: rgba(255,210,220,.2);
        }

        .banner-content {
            position: relative;
            z-index: 1;
            max-width: 650px;
        }

        .banner-label {
            display: inline-block;
            padding: 7px 14px;
            margin-bottom: 17px;
            border: 1px solid rgba(255,255,255,.4);
            border-radius: 30px;
            background: rgba(255,255,255,.13);
            font-size: 11px;
            letter-spacing: 2px;
        }

        .student-banner h1 {
            color: white;
            font-size: 34px;
            line-height: 1.3;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .student-banner p {
            color: #ffe7eb;
            font-size: 15px;
            line-height: 1.8;
        }

        .banner-decoration {
            position: absolute;
            right: 55px;
            bottom: -8px;
            font-size: 115px;
            color: rgba(255,255,255,.15);
            font-family: Georgia, serif;
            font-weight: bold;
        }

        /* Kartu informasi */
        .student-welcome {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin: 25px 0 35px;
        }

        .welcome-card {
            padding: 22px;
            border-radius: 17px;
            background: linear-gradient(135deg, #fffdfb, #fcebed);
            border: 1px solid #f3d4da;
            box-shadow: 0 7px 20px rgba(112,37,54,.07);
            transition: .25s;
        }

        .welcome-card:hover {
            transform: translateY(-5px);
        }

        .welcome-card:nth-child(2) {
            background: linear-gradient(135deg, #f8dce2, #fff0ed);
        }

        .welcome-card:nth-child(3) {
            background: linear-gradient(135deg, #792b43, #a74761);
            color: white;
        }

        .welcome-card small {
            display: block;
            font-size: 12px;
            margin-bottom: 10px;
            opacity: .75;
        }

        .welcome-card h3 {
            font-size: 19px;
            font-weight: 800;
        }

        /* Judul bagian */
        .section-heading {
            margin-bottom: 20px;
        }

        .section-heading h2 {
            color: #702536;
            font-size: 23px;
            font-weight: 800;
        }

        .section-heading p {
            color: #95616d;
            font-size: 13px;
            margin-top: 5px;
        }

        /* Menu siswa */
        .student-menu {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .menu-card {
            position: relative;
            overflow: hidden;
            min-height: 245px;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 9px 24px rgba(112,37,54,.1);
            transition: transform .25s, box-shadow .25s;
        }

        .menu-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 28px rgba(112,37,54,.16);
        }

        .menu-card.books {
            background: linear-gradient(135deg, #fff, #f5cbd5);
            border: 1px solid #edc0cb;
            color: #702536;
        }

        .menu-card.loans {
            color: white;
            background: linear-gradient(130deg, #74243d, #b94d6b, #d77c91);
        }

        .menu-number {
            display: inline-block;
            padding: 7px 13px;
            margin-bottom: 18px;
            border-radius: 20px;
            background: rgba(173,65,94,.12);
            color: #8d304c;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .loans .menu-number {
            color: white;
            background: rgba(255,255,255,.17);
        }

        .menu-card h3 {
            font-size: 23px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .menu-card p {
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 22px;
            max-width: 390px;
            opacity: .85;
        }

        .menu-button {
            position: relative;
            z-index: 2;
            display: inline-block;
            padding: 11px 20px;
            border-radius: 9px;
            background: linear-gradient(100deg, #79283f, #a9405d);
            color: white;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s;
        }

        .menu-button:hover {
            background: #54182c;
            transform: translateY(-2px);
        }

        .loans .menu-button {
            color: #76283f;
            background: #fff1f0;
        }

        .loans .menu-button:hover {
            background: white;
        }

        .menu-decoration {
            position: absolute;
            right: 20px;
            bottom: -35px;
            font-family: Georgia, serif;
            font-size: 145px;
            font-weight: bold;
            opacity: .09;
            pointer-events: none;
        }

        /* Informasi bawah */
        .student-footer {
            margin-top: 30px;
            padding: 27px;
            border-radius: 17px;
            text-align: center;
            color: #702536;
            background: linear-gradient(100deg, #f6d6dd, #fff0eb, #f8dce2);
            border: 1px solid #edc5ce;
            box-shadow: 0 7px 20px rgba(112,37,54,.06);
        }

        .student-footer strong {
            font-size: 17px;
        }

        .student-footer p {
            margin-top: 6px;
            font-size: 12px;
            color: #96616d;
        }

        @media(max-width: 700px) {
            .student-welcome,
            .student-menu {
                grid-template-columns: 1fr;
            }

            .student-banner {
                padding: 32px 25px;
            }

            .student-banner h1 {
                font-size: 26px;
            }

            .banner-decoration {
                right: 15px;
                font-size: 75px;
            }

            .menu-card {
                padding: 24px;
            }
        }
    </style>

    <div class="student-dashboard">
        <div class="student-container">

            <!-- Banner Selamat Datang -->
            <div class="student-banner">
                <div class="banner-content">

                    <span class="banner-label">
                        BOOKAVY DIGITAL LIBRARY
                    </span>

                    <h1>
                        Selamat Datang,<br>
                        {{ Auth::user()->name }}!
                    </h1>

                    <p>
                        Temukan buku favoritmu, perluas pengetahuan,
                        dan nikmati pengalaman membaca bersama Bookavy.
                    </p>

                </div>

                <div class="banner-decoration">B</div>
            </div>

            <!-- Informasi Siswa -->
            <div class="student-welcome">

                <div class="welcome-card">
                    <small>AKUN PENGGUNA</small>
                    <h3>{{ Auth::user()->name }}</h3>
                </div>

                <div class="welcome-card">
                    <small>STATUS AKUN</small>
                    <h3>Anggota Perpustakaan</h3>
                </div>

                <div class="welcome-card">
                    <small>LAYANAN BOOKAVY</small>
                    <h3>Baca dan Pinjam Buku</h3>
                </div>

            </div>

            <!-- Menu Utama -->
            <div class="section-heading">
                <h2>Jelajahi Bookavy</h2>
                <p>Pilih layanan yang ingin kamu gunakan.</p>
            </div>

            <div class="student-menu">

                <!-- Menu Daftar Buku -->
                <div class="menu-card books">

                    <span class="menu-number">
                        01 / KOLEKSI
                    </span>

                    <h3>Daftar Buku</h3>

                    <p>
                        Temukan berbagai koleksi buku menarik.
                        Lihat judul, kategori, penulis, dan tahun terbit.
                    </p>

                    <a href="{{ route('buku.index') }}" class="menu-button">
                        Jelajahi Buku
                    </a>

                    <div class="menu-decoration">B</div>
                </div>

                <!-- Menu Peminjaman -->
                <div class="menu-card loans">

                    <span class="menu-number">
                        02 / LAYANAN
                    </span>

                    <h3>Peminjaman Buku</h3>

                    <p>
                        Ajukan peminjaman buku dan pantau status
                        pengajuan serta riwayat peminjamanmu.
                    </p>

                    <a href="{{ route('siswa.peminjaman.index') }}"
                       class="menu-button">
                        Buka Peminjaman
                    </a>

                    <div class="menu-decoration">P</div>
                </div>

            </div>

            <!-- Footer -->
            <div class="student-footer">
                <strong>BOOKAVY — Perpustakaan Digital</strong>

                <p>
                    Membaca hari ini, menambah wawasan untuk masa depan.
                </p>
            </div>

        </div>
    </div>

</x-app-layout>
