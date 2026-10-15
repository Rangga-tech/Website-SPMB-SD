@extends('layouts.app')
@section('title', 'Pengumuman')

@section('content')
<div class="container py-5">
    <h2 class="mb-4" style="color: var(--primary);">Pengumuman</h2>

    @forelse($pengumumans as $p)
    <div class="card card-spmb mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $p->judul }}</h5>
            <p class="text-muted small mb-2">{{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d M Y') }}</p>
            <p class="mb-0">{{ $p->isi }}</p>
        </div>
    </div>
    @empty
    <p class="text-muted">Belum ada pengumuman.</p>
    @endforelse

    {{ $pengumumans->links() }}
</div>
@endsection
