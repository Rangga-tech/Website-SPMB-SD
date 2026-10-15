@extends('layouts.app')
@section('title', 'Profil Sekolah')

@section('content')
<div class="container py-5">
    <h2 class="mb-4" style="color: var(--primary);">Profil Sekolah</h2>
    <div class="card card-spmb">
        <div class="card-body">
            <p><strong>Nama Sekolah</strong> : Nama Sekolah</p>
            <p><strong>Alamat</strong> : Alamat Sekolah</p>
            <p><strong>Akreditasi</strong> : A</p>
            <p class="mb-0">
                Paragraf tambahan tentang profil sekolah dapat ditambahkan di sini. Misalnya, sejarah sekolah, visi dan misi, prestasi, dan informasi lainnya yang relevan.
            </p>
        </div>
    </div>
</div>
@endsection
