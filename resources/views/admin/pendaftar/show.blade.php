@extends('layouts.admin')
@section('title', 'Detail Pendaftar')

@section('content')
<a href="{{ route('admin.pendaftar.index') }}" class="btn btn-sm btn-outline-spmb mb-3"><i class="bi bi-arrow-left" aria-hidden="true"></i>Kembali</a>

<div class="card card-spmb mb-3">
    <div class="card-header">Data Diri</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-borderless mb-0">
                    <tr><td width="220"><strong>No. Pendaftaran</strong></td><td>: {{ $pendaftar->no_pendaftaran }}</td></tr>
                    <tr><td><strong>Nama</strong></td><td>: {{ $pendaftar->nama }}</td></tr>
                    <tr><td><strong>NIK</strong></td><td>: {{ $pendaftar->nik }}</td></tr>
                    <tr><td><strong>NISN</strong></td><td>: {{ $pendaftar->nisn ?? '-' }}</td></tr>
                    <tr><td><strong>Tempat, Tgl Lahir</strong></td><td>: {{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->translatedFormat('d M Y') }}</td></tr>
                    <tr><td><strong>Jenis Kelamin</strong></td><td>: {{ $pendaftar->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                    <tr><td><strong>Agama</strong></td><td>: {{ $pendaftar->agama }}</td></tr>
                    <tr><td><strong>Alamat</strong></td><td>: {{ $pendaftar->alamat }}</td></tr>
                    <tr><td><strong>Asal Sekolah</strong></td><td>: {{ $pendaftar->asal_sekolah ?? '-' }}</td></tr>
                    <tr><td><strong>Nama Ayah / Ibu</strong></td><td>: {{ $pendaftar->nama_ayah }} / {{ $pendaftar->nama_ibu }}</td></tr>
                    <tr><td><strong>No. HP</strong></td><td>: {{ $pendaftar->no_hp }}</td></tr>
                    <tr><td><strong>Email</strong></td><td>: {{ $pendaftar->email ?? '-' }}</td></tr>
                </table>
            </div>
            <div class="col-md-4 text-center">
                @if($pendaftar->foto)
                    <img src="{{ asset('storage/foto/'.$pendaftar->foto) }}" class="img-fluid rounded border" style="max-height:220px;">
                @else
                    <div class="text-muted">Tidak ada foto</div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card card-spmb mb-3">
    <div class="card-header">Berkas Upload</div>
    <div class="card-body">
        <ul class="mb-0">
            <li>Kartu Keluarga:
                @if($pendaftar->kk) <a href="{{ asset('storage/kk/'.$pendaftar->kk) }}" target="_blank">Lihat File</a> @else <span class="text-muted">Tidak ada</span> @endif
            </li>
            <li>Akta Kelahiran:
                @if($pendaftar->akta) <a href="{{ asset('storage/akta/'.$pendaftar->akta) }}" target="_blank">Lihat File</a> @else <span class="text-muted">Tidak ada</span> @endif
            </li>
            <li>Ijazah/Ket. Lulus TK:
                @if($pendaftar->ijazah) <a href="{{ asset('storage/ijazah/'.$pendaftar->ijazah) }}" target="_blank">Lihat File</a> @else <span class="text-muted">Tidak ada</span> @endif
            </li>
        </ul>

        @if(!$pendaftar->terverifikasi)
        <form action="{{ route('admin.pendaftar.verifikasi', $pendaftar) }}" method="POST" class="mt-3">
            @csrf
            <button class="btn btn-spmb btn-sm"><i class="bi bi-shield-check" aria-hidden="true"></i>Verifikasi Berkas</button>
        </form>
        @else
        <span class="badge bg-success mt-3 d-inline-block">Berkas sudah diverifikasi</span>
        @endif
    </div>
</div>

<div class="card card-spmb">
    <div class="card-header">Ubah Status Kelulusan</div>
    <div class="card-body">
        <form action="{{ route('admin.pendaftar.status', $pendaftar) }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="menunggu" {{ $pendaftar->status=='menunggu'?'selected':'' }}>Menunggu</option>
                    <option value="diterima" {{ $pendaftar->status=='diterima'?'selected':'' }}>Diterima</option>
                    <option value="ditolak" {{ $pendaftar->status=='ditolak'?'selected':'' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-outline-spmb w-100"><i class="bi bi-check-lg" aria-hidden="true"></i>Simpan Status</button>
            </div>
        </form>
    </div>
</div>
@endsection
