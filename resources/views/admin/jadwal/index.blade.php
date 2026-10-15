@extends('layouts.admin')
@section('title', 'Kelola Jadwal')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 style="color: var(--primary);">Kelola Jadwal</h3>
    <button class="btn btn-spmb" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-lg" aria-hidden="true"></i>Tambah Jadwal</button>
</div>

<div class="card card-spmb">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead class="table-light">
                <tr><th>Judul</th><th>Mulai</th><th>Selesai</th><th>Keterangan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($jadwals as $j)
                <tr>
                    <td>{{ $j->judul }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->tanggal_mulai)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->tanggal_selesai)->format('d-m-Y') }}</td>
                    <td>{{ $j->keterangan }}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-spmb" data-bs-toggle="modal" data-bs-target="#edit{{ $j->id }}"><i class="bi bi-pencil-fill" aria-hidden="true"></i>Edit</button>
                        <form action="{{ route('admin.jadwal.destroy', $j) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3-fill" aria-hidden="true"></i>Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- MODAL EDIT -->
                <div class="modal fade" id="edit{{ $j->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.jadwal.update', $j) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-header"><h5 class="modal-title">Edit Jadwal</h5></div>
                                <div class="modal-body">
                                    <div class="mb-2"><label class="form-label">Judul</label><input type="text" name="judul" class="form-control" value="{{ $j->judul }}" required></div>
                                    <div class="mb-2"><label class="form-label">Tanggal Mulai</label><input type="date" name="tanggal_mulai" class="form-control" value="{{ $j->tanggal_mulai }}" required></div>
                                    <div class="mb-2"><label class="form-label">Tanggal Selesai</label><input type="date" name="tanggal_selesai" class="form-control" value="{{ $j->tanggal_selesai }}" required></div>
                                    <div class="mb-2"><label class="form-label">Keterangan</label><textarea name="keterangan" class="form-control">{{ $j->keterangan }}</textarea></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-spmb"><i class="bi bi-check-lg" aria-hidden="true"></i>Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-3">Belum ada jadwal.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.jadwal.store') }}" method="POST">
                @csrf
                <div class="modal-header"><h5 class="modal-title">Tambah Jadwal</h5></div>
                <div class="modal-body">
                    <div class="mb-2"><label class="form-label">Judul</label><input type="text" name="judul" class="form-control" required></div>
                    <div class="mb-2"><label class="form-label">Tanggal Mulai</label><input type="date" name="tanggal_mulai" class="form-control" required></div>
                    <div class="mb-2"><label class="form-label">Tanggal Selesai</label><input type="date" name="tanggal_selesai" class="form-control" required></div>
                    <div class="mb-2"><label class="form-label">Keterangan</label><textarea name="keterangan" class="form-control"></textarea></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-spmb"><i class="bi bi-check-lg" aria-hidden="true"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
