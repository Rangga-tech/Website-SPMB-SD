@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<h3 class="admin-page-header">Dashboard</h3>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-spmb stat-card text-center p-3">
            <div class="text-muted small">Total Pendaftar</div>
            <div class="fs-3 fw-bold">{{ $totalPendaftar }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-spmb stat-card text-center p-3">
            <div class="text-muted small">Sudah Diverifikasi</div>
            <div class="fs-3 fw-bold text-success">{{ $sudahVerifikasi }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-spmb stat-card text-center p-3">
            <div class="text-muted small">Belum Diverifikasi</div>
            <div class="fs-3 fw-bold text-danger">{{ $belumVerifikasi }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-spmb stat-card text-center p-3">
            <div class="text-muted small">Menunggu</div>
            <div class="fs-4 fw-bold">{{ $menunggu }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-spmb stat-card text-center p-3">
            <div class="text-muted small">Diterima</div>
            <div class="fs-4 fw-bold text-success">{{ $diterima }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-spmb stat-card text-center p-3">
            <div class="text-muted small">Ditolak</div>
            <div class="fs-4 fw-bold text-danger">{{ $ditolak }}</div>
        </div>
    </div>
</div>

<div class="card card-spmb">
    <div class="card-header">Pendaftar Terbaru</div>
    <div class="card-body p-0">
        <table class="table admin-table mb-0">
            <thead>
                <tr><th>No. Pendaftaran</th><th>Nama</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($pendaftarTerbaru as $p)
                <tr>
                    <td>{{ $p->no_pendaftaran }}</td>
                    <td>{{ $p->nama }}</td>
                    <td><span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                    <td><a href="{{ route('admin.pendaftar.show', $p) }}" class="btn btn-sm btn-outline-spmb"><i class="bi bi-eye-fill" aria-hidden="true"></i>Detail</a></td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-3">Belum ada pendaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
