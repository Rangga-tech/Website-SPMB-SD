@extends('layouts.admin')
@section('title', 'Kelola Persyaratan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 style="color: var(--primary);">Kelola Persyaratan</h3>
    <button class="btn btn-spmb" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-lg" aria-hidden="true"></i>Tambah Persyaratan</button>
</div>

<div class="card card-spmb">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead class="table-light">
                <tr><th>Urutan</th><th>Judul</th><th>Keterangan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($persyaratans as $p)
                <tr>
                    <td>{{ $p->urutan }}</td>
                    <td>{{ $p->judul }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-spmb" data-bs-toggle="modal" data-bs-target="#edit{{ $p->id }}"><i class="bi bi-pencil-fill" aria-hidden="true"></i>Edit</button>
                        <form action="{{ route('admin.persyaratan.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus persyaratan ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3-fill" aria-hidden="true"></i>Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="edit{{ $p->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.persyaratan.update', $p) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-header"><h5 class="modal-title">Edit Persyaratan</h5></div>
                                <div class="modal-body">
                                    <div class="mb-2"><label class="form-label">Judul</label><input type="text" name="judul" class="form-control" value="{{ $p->judul }}" required></div>
                                    <div class="mb-2"><label class="form-label">Urutan</label><input type="number" name="urutan" class="form-control" value="{{ $p->urutan }}"></div>
                                    <div class="mb-2"><label class="form-label">Keterangan</label><textarea name="keterangan" class="form-control">{{ $p->keterangan }}</textarea></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-spmb"><i class="bi bi-check-lg" aria-hidden="true"></i>Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-3">Belum ada persyaratan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.persyaratan.store') }}" method="POST">
                @csrf
                <div class="modal-header"><h5 class="modal-title">Tambah Persyaratan</h5></div>
                <div class="modal-body">
                    <div class="mb-2"><label class="form-label">Judul</label><input type="text" name="judul" class="form-control" required></div>
                    <div class="mb-2"><label class="form-label">Urutan</label><input type="number" name="urutan" class="form-control" value="0"></div>
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
