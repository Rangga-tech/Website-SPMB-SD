@extends('layouts.admin')
@section('title', 'Kelola Pengumuman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 style="color: var(--primary);">Kelola Pengumuman</h3>
    <button class="btn btn-spmb" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-lg" aria-hidden="true"></i>Tambah Pengumuman</button>
</div>

<div class="card card-spmb">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead class="table-light">
                <tr><th>Judul</th><th>Tanggal</th><th>Isi</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($pengumumans as $p)
                <tr>
                    <td>{{ $p->judul }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ Str::limit($p->isi, 60) }}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-spmb" data-bs-toggle="modal" data-bs-target="#edit{{ $p->id }}"><i class="bi bi-pencil-fill" aria-hidden="true"></i>Edit</button>
                        <form action="{{ route('admin.pengumuman.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengumuman ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3-fill" aria-hidden="true"></i>Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="edit{{ $p->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.pengumuman.update', $p) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-header"><h5 class="modal-title">Edit Pengumuman</h5></div>
                                <div class="modal-body">
                                    <div class="mb-2"><label class="form-label">Judul</label><input type="text" name="judul" class="form-control" value="{{ $p->judul }}" required></div>
                                    <div class="mb-2"><label class="form-label">Tanggal</label><input type="date" name="tanggal" class="form-control" value="{{ $p->tanggal }}" required></div>
                                    <div class="mb-2"><label class="form-label">Isi</label><textarea name="isi" class="form-control" rows="4" required>{{ $p->isi }}</textarea></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-spmb"><i class="bi bi-check-lg" aria-hidden="true"></i>Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-3">Belum ada pengumuman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.pengumuman.store') }}" method="POST">
                @csrf
                <div class="modal-header"><h5 class="modal-title">Tambah Pengumuman</h5></div>
                <div class="modal-body">
                    <div class="mb-2"><label class="form-label">Judul</label><input type="text" name="judul" class="form-control" required></div>
                    <div class="mb-2"><label class="form-label">Tanggal</label><input type="date" name="tanggal" class="form-control" required></div>
                    <div class="mb-2"><label class="form-label">Isi</label><textarea name="isi" class="form-control" rows="4" required></textarea></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-spmb"><i class="bi bi-check-lg" aria-hidden="true"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
