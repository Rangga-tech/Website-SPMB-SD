<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - SPMB SD Harapan')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ARTI_DAN_MAKNA_LAMBANG_LOGO_SEKOLAH_DASAR_SD_NEGERI-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 sidebar-admin p-0">
            <div class="p-3 border-bottom border-secondary">
                <div class="admin-brand">
                    <img src="{{ asset('images/logo-tut-wuri-handayani.png') }}" alt="Logo Tut Wuri Handayani" class="admin-brand-logo">
                    <strong class="text-white">SPMB SD Admin</strong>
                </div>
                <br>
                <small>{{ auth('admin')->user()->nama }}</small>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2" aria-hidden="true"></i>Dashboard</a>
            <a href="{{ route('admin.pendaftar.index') }}" class="{{ request()->routeIs('admin.pendaftar.*') ? 'active' : '' }}"><i class="bi bi-people-fill" aria-hidden="true"></i>Data Pendaftar</a>
            <a href="{{ route('admin.jadwal.index') }}" class="{{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}"><i class="bi bi-calendar3" aria-hidden="true"></i>Kelola Jadwal</a>
            <a href="{{ route('admin.pengumuman.index') }}" class="{{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}"><i class="bi bi-megaphone-fill" aria-hidden="true"></i>Kelola Pengumuman</a>
            <a href="{{ route('admin.persyaratan.index') }}" class="{{ request()->routeIs('admin.persyaratan.*') ? 'active' : '' }}"><i class="bi bi-file-earmark-check-fill" aria-hidden="true"></i>Kelola Persyaratan</a>
            <a href="{{ route('admin.laporan.index') }}" class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}"><i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i>Laporan Pendaftar</a>
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-3 px-3">
                @csrf
                <button class="btn btn-sm btn-outline-light w-100" type="submit"><i class="bi bi-box-arrow-right" aria-hidden="true"></i>Logout</button>
            </form>
        </div>

        <!-- KONTEN -->
        <div class="col-md-10 p-4 admin-content">
            @if(session('sukses'))
                <div class="alert alert-success">{{ session('sukses') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
