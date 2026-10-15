<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPMB SD')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ARTI_DAN_MAKNA_LAMBANG_LOGO_SEKOLAH_DASAR_SD_NEGERI-removebg-preview.png') }}">

    <!-- Bootstrap 5 dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <!-- CSS custom kita sendiri -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-xl navbar-spmb">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
                <img src="{{ asset('images/ARTI_DAN_MAKNA_LAMBANG_LOGO_SEKOLAH_DASAR_SD_NEGERI-removebg-preview.png') }}" alt="Logo SD" class="brand-logo" width="150" height="150">
                <span class="brand-text">SPMB SD</span>
            </a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                <ul class="navbar-nav align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="bi bi-house-door-fill" aria-hidden="true"></i> Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('profil') }}"><i class="bi bi-building-fill" aria-hidden="true"></i> Profil Sekolah</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('informasi') }}"><i class="bi bi-info-circle-fill" aria-hidden="true"></i> Informasi SPMB</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pengumuman') }}"><i class="bi bi-megaphone-fill" aria-hidden="true"></i> Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cek-status') }}"><i class="bi bi-search" aria-hidden="true"></i> Cek Status</a></li>
                    @auth
                    <li class="nav-item">
                        <span class="nav-link nav-user"><i class="bi bi-person-circle" aria-hidden="true"></i> Halo, {{ auth()->user()->username }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link nav-logout"><i class="bi bi-box-arrow-right" aria-hidden="true"></i> Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right" aria-hidden="true"></i> Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus-fill" aria-hidden="true"></i> Register</a></li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link btn-spmb rounded-pill px-3 ms-lg-2 mt-2 mt-lg-0 d-inline-flex align-items-center justify-content-center text-center" href="{{ route('daftar') }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Daftar Sekarang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ALERT SUKSES/GAGAL GLOBAL -->
    <div class="container mt-3">
        @if(session('sukses'))
            <div class="alert alert-success">{{ session('sukses') }}</div>
        @endif
        @if(session('gagal'))
            <div class="alert alert-danger">{{ session('gagal') }}</div>
        @endif
    </div>

    <!-- KONTEN HALAMAN -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer-spmb mt-5">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo"><i class="bi bi-mortarboard-fill" aria-hidden="true"></i><strong>SPMB SD</strong></div>
                    <p>Sistem Penerimaan Murid Baru SD yang membantu keluarga menemukan informasi pendaftaran dengan mudah, jelas, dan terpercaya.</p>
                    <div class="footer-socials" aria-label="Media sosial sekolah">
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                        <a href="#" aria-label="YouTube"><i class="bi bi-youtube" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Layanan Utama</h3>
                    <a href="{{ route('daftar') }}"><i class="bi bi-chevron-right" aria-hidden="true"></i> Pendaftaran Murid Baru</a>
                    <a href="{{ route('informasi') }}"><i class="bi bi-chevron-right" aria-hidden="true"></i> Informasi SPMB</a>
                    <a href="{{ route('cek-status') }}"><i class="bi bi-chevron-right" aria-hidden="true"></i> Cek Status Pendaftaran</a>
                    <a href="{{ route('pengumuman') }}"><i class="bi bi-chevron-right" aria-hidden="true"></i> Pengumuman</a>
                    <a href="{{ route('profil') }}"><i class="bi bi-chevron-right" aria-hidden="true"></i> Profil Sekolah</a>
                </div>
                <div class="footer-column footer-contact">
                    <h3>Kontak &amp; Lokasi</h3>
                    <p><i class="bi bi-geo-alt-fill" aria-hidden="true"></i> Sekolah Dasar Negeri, Indonesia</p>
                    <p><i class="bi bi-envelope-fill" aria-hidden="true"></i> info@spmb-sd.sch.id</p>
                    <p><i class="bi bi-telephone-fill" aria-hidden="true"></i> (021) 0000 0000</p>
                </div>
            </div>
            <div class="footer-bottom">
                <span>&copy; {{ date('Y') }} SPMB SD</span>
                <span>Melangkah bersama menuju masa depan.</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
