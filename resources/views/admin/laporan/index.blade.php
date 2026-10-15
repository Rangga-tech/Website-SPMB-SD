@extends('layouts.admin')
@section('title', 'Laporan Pendaftar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="admin-page-header mb-0">
            <i class="bi bi-file-earmark-bar-graph-fill" aria-hidden="true"></i> Laporan Pendaftar
        </h3>
        <small class="text-muted">Cetak laporan data pendaftar SPMB dalam format PDF</small>
    </div>
    <a href="{{ route('admin.laporan.pdf', request()->query()) }}"
       class="btn btn-spmb btn-lg shadow-sm"
       target="_blank">
        <i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i>
        &nbsp;Download PDF
    </a>
</div>

{{-- FILTER --}}
<div class="card card-spmb mb-4">
    <div class="card-header"><i class="bi bi-funnel-fill" aria-hidden="true"></i> Filter Laporan</div>
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Status Kelulusan</label>
                <select name="status" class="form-select">
                    <option value="">-- Semua Status --</option>
                    <option value="menunggu" {{ request('status')=='menunggu'?'selected':'' }}>Menunggu</option>
                    <option value="diterima" {{ request('status')=='diterima'?'selected':'' }}>Diterima</option>
                    <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Verifikasi Berkas</label>
                <select name="verifikasi" class="form-select">
                    <option value="">-- Semua --</option>
                    <option value="1" {{ request('verifikasi')==='1'?'selected':'' }}>Sudah Diverifikasi</option>
                    <option value="0" {{ request('verifikasi')==='0'?'selected':'' }}>Belum Diverifikasi</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Dari Tanggal</label>
                <input type="date" name="dari_tanggal" class="form-control" value="{{ request('dari_tanggal') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Sampai Tanggal</label>
                <input type="date" name="sampai_tanggal" class="form-control" value="{{ request('sampai_tanggal') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-outline-spmb flex-fill">
                    <i class="bi bi-search" aria-hidden="true"></i> Terapkan
                </button>
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-lg" aria-hidden="true"></i>
                </a>
            </div>
        </form>
    </div>
</div>

{{-- STATISTIK RINGKASAN --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card card-spmb stat-card text-center p-3 h-100">
            <div class="text-muted small mb-1"><i class="bi bi-people-fill"></i> Total Data</div>
            <div class="fs-2 fw-bold">{{ $statistik['total'] }}</div>
            <div class="small text-muted">Pendaftar</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-spmb stat-card text-center p-3 h-100">
            <div class="text-muted small mb-1"><i class="bi bi-hourglass-split"></i> Menunggu</div>
            <div class="fs-2 fw-bold" style="color: #6c757d;">{{ $statistik['menunggu'] }}</div>
            <div class="small text-muted">Proses Seleksi</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-spmb stat-card text-center p-3 h-100">
            <div class="text-muted small mb-1"><i class="bi bi-check-circle-fill text-success"></i> Diterima</div>
            <div class="fs-2 fw-bold text-success">{{ $statistik['diterima'] }}</div>
            <div class="small text-muted">Lulus Seleksi</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-spmb stat-card text-center p-3 h-100">
            <div class="text-muted small mb-1"><i class="bi bi-x-circle-fill text-danger"></i> Ditolak</div>
            <div class="fs-2 fw-bold text-danger">{{ $statistik['ditolak'] }}</div>
            <div class="small text-muted">Tidak Lulus</div>
        </div>
    </div>
</div>

{{-- INFO DOWNLOAD --}}
<div class="alert alert-info d-flex align-items-center gap-2 mb-3" role="alert">
    <i class="bi bi-info-circle-fill fs-5" aria-hidden="true"></i>
    <div>
        Laporan PDF akan memuat kolom: <strong>No. Pendaftaran, Nama Siswa/Siswi, NIK,</strong> dan <strong>Status</strong> sesuai filter yang dipilih.
        Klik tombol <strong>Download PDF</strong> di pojok kanan atas untuk mengunduh.
    </div>
</div>

{{-- TABEL PREVIEW DATA --}}
<div class="card card-spmb">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>
            <i class="bi bi-table" aria-hidden="true"></i> Preview Data Laporan
            <span class="badge bg-secondary ms-2">{{ $statistik['total'] }} data</span>
        </span>
    </div>
    <div class="card-body p-0">
        <table class="table admin-table mb-0 align-middle">
            <thead>
                <tr>
                    <th width="50" class="text-center">No</th>
                    <th>No. Pendaftaran</th>
                    <th>Nama Siswa/Siswi</th>
                    <th>NIK</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftars as $i => $p)
                <tr>
                    <td class="text-center text-muted">{{ $i + 1 }}</td>
                    <td><code class="text-danger fw-bold">{{ $p->no_pendaftaran }}</code></td>
                    <td>{{ $p->nama }}</td>
                    <td><code>{{ $p->nik }}</code></td>
                    <td class="text-center">
                        @if($p->status === 'diterima')
                            <span class="badge bg-success"><i class="bi bi-check-lg"></i> Diterima</span>
                        @elseif($p->status === 'ditolak')
                            <span class="badge bg-danger"><i class="bi bi-x-lg"></i> Ditolak</span>
                        @else
                            <span class="badge bg-secondary"><i class="bi bi-hourglass-split"></i> Menunggu</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        Tidak ada data yang sesuai filter.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($statistik['total'] > 0)
    <div class="card-footer text-muted small">
        Menampilkan {{ $statistik['total'] }} data pendaftar
    </div>
    @endif
</div>
@endsection
