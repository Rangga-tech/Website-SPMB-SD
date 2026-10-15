@extends('layouts.app')
@section('title', 'Bukti Pendaftaran')

@section('content')
<div class="container py-5">

    @if(session('sukses'))
        <div class="alert alert-success no-print">{{ session('sukses') }}</div>
    @endif

    <div class="card card-spmb">
        <div class="card-body">
            <div class="text-center mb-4">
                <h4 style="color: var(--primary);">BUKTI PENDAFTARAN</h4>
                <p class="text-muted mb-0">SPMB SD Harapan Tahun Ajaran 2026/2027</p>
            </div>

            <table class="table table-borderless">
                <tr><td width="220"><strong>No. Pendaftaran</strong></td><td>: {{ $pendaftar->no_pendaftaran }}</td></tr>
                <tr><td><strong>Nama Lengkap</strong></td><td>: {{ $pendaftar->nama }}</td></tr>
                <tr><td><strong>NIK</strong></td><td>: {{ $pendaftar->nik }}</td></tr>
                <tr><td><strong>Tempat, Tanggal Lahir</strong></td><td>: {{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->translatedFormat('d M Y') }}</td></tr>
                <tr><td><strong>Jenis Kelamin</strong></td><td>: {{ $pendaftar->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                <tr><td><strong>Nama Ayah / Ibu</strong></td><td>: {{ $pendaftar->nama_ayah }} / {{ $pendaftar->nama_ibu }}</td></tr>
                <tr><td><strong>No. HP</strong></td><td>: {{ $pendaftar->no_hp }}</td></tr>
                <tr><td><strong>Status Berkas</strong></td><td>: {{ $pendaftar->terverifikasi ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}</td></tr>
                <tr><td><strong>Status Diterima</strong></td><td>: {{ ucfirst($pendaftar->status) }}</td></tr>
            </table>

            <p class="text-muted small">
                Simpan nomor pendaftaran ini untuk mengecek status pendaftaran Anda melalui menu "Cek Status".
            </p>

            <div class="no-print mt-3 d-flex flex-wrap gap-2">
                <div class="btn-group">
                    <button type="button" class="btn btn-spmb dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-download" aria-hidden="true"></i> Simpan / Cetak
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('bukti.pdf', $pendaftar->no_pendaftaran) }}"><i class="bi bi-file-earmark-pdf-fill text-danger" aria-hidden="true"></i> Download PDF</a></li>
                        <li><a class="dropdown-item" href="#" onclick="window.print(); return false;"><i class="bi bi-printer-fill" aria-hidden="true"></i> Cetak Berkas</a></li>
                    </ul>
                </div>
                <a href="{{ route('home') }}" class="btn btn-outline-spmb"><i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>
@endsection
