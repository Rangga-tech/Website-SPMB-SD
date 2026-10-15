@extends('layouts.app')
@section('title', 'Informasi SPMB')

@section('content')
<div class="container py-5">
    <h2 class="mb-4" style="color: var(--primary);">Jadwal Pendaftaran</h2>
    <div class="table-responsive mb-5">
        <table class="table table-bordered bg-white">
            <thead class="table-light">
                <tr>
                    <th>Kegiatan</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $j)
                <tr>
                    <td>{{ $j->judul }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->tanggal_mulai)->translatedFormat('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->tanggal_selesai)->translatedFormat('d M Y') }}</td>
                    <td>{{ $j->keterangan }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada jadwal.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 class="mb-4" style="color: var(--primary);">Persyaratan Pendaftaran</h2>
    <ul class="list-group">
        @forelse($persyaratans as $p)
        <li class="list-group-item">
            <strong>{{ $p->judul }}</strong>
            @if($p->keterangan)<br><small class="text-muted">{{ $p->keterangan }}</small>@endif
        </li>
        @empty
        <li class="list-group-item text-muted">Belum ada persyaratan ditambahkan.</li>
        @endforelse
    </ul>

    <a href="{{ route('daftar') }}" class="btn btn-spmb mt-4"><i class="bi bi-pencil-square" aria-hidden="true"></i>Daftar Sekarang</a>
</div>
@endsection
