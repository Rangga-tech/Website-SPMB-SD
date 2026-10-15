@extends('layouts.admin')
@section('title', 'Data Pendaftar')

@section('content')
<h3 class="mb-4" style="color: var(--primary);">Data Pendaftar</h3>

<form method="GET" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari nama / no. pendaftaran / NIK">
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">-- Semua Status --</option>
            <option value="menunggu" {{ request('status')=='menunggu'?'selected':'' }}>Menunggu</option>
            <option value="diterima" {{ request('status')=='diterima'?'selected':'' }}>Diterima</option>
            <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-outline-spmb w-100"><i class="bi bi-funnel-fill" aria-hidden="true"></i>Filter</button>
    </div>
</form>

<div class="card card-spmb">
    <div class="card-body p-0">
        <table class="table mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>No. Pendaftaran</th><th>Nama</th><th>NIK</th>
                    <th>Verifikasi</th><th>Status</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftars as $p)
                <tr>
                    <td>{{ $p->no_pendaftaran }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->nik }}</td>
                    <td>
                        @if($p->terverifikasi)
                            <span class="badge bg-success">Terverifikasi</span>
                        @else
                            <span class="badge bg-secondary">Belum</span>
                        @endif
                    </td>
                    <td><span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                    <td>
                        <a href="{{ route('admin.pendaftar.show', $p) }}" class="btn btn-sm btn-outline-spmb"><i class="bi bi-eye-fill" aria-hidden="true"></i>Detail</a>
                        <form action="{{ route('admin.pendaftar.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3-fill" aria-hidden="true"></i>Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-3">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $pendaftars->links() }}</div>
@endsection
