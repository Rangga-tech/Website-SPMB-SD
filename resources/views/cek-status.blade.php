@extends('layouts.app')
@section('title', 'Cek Status Pendaftaran')

@section('content')
<div class="container py-5">
    <h2 class="mb-4" style="color: var(--primary);">Cek Status Pendaftaran</h2>

    <div class="card card-spmb mb-4">
        <div class="card-body">
            <form action="{{ route('cek-status.proses') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-5">
                    <label class="form-label">No. Pendaftaran</label>
                    <input type="text" name="no_pendaftaran" class="form-control" placeholder="Contoh: SPMB-2026-0001" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">NIK</label>
                    <input type="text" name="nik" class="form-control" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-spmb w-100"><i class="bi bi-search" aria-hidden="true"></i>Cek Status</button>
                </div>
            </form>
        </div>
    </div>

    @if(isset($pendaftar))
    <div class="card card-spmb">
        <div class="card-body">
            <h5>Hasil Pencarian</h5>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <p class="mb-1"><strong>No. Pendaftaran</strong>: {{ $pendaftar->no_pendaftaran }}</p>
                    <p class="mb-1"><strong>Status Berkas</strong>:
                        @if($pendaftar->terverifikasi)
                            <span class="badge bg-success">Sudah Diverifikasi</span>
                        @else
                            <span class="badge bg-secondary">Belum Diverifikasi</span>
                        @endif
                    </p>
                    <p class="mb-0"><strong>Status Diterima</strong>:
                        <span class="badge badge-{{ $pendaftar->status }}">{{ ucfirst($pendaftar->status) }}</span>
                    </p>
                </div>
            </div>

            {{-- Nama siswa yang bisa diklik untuk melihat detail --}}
            <div class="mt-3">
                <a href="#detailPendaftar" class="btn btn-spmb w-100 d-flex align-items-center justify-content-between"
                   data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="detailPendaftar">
                    <span><i class="bi bi-person-fill" aria-hidden="true"></i> {{ $pendaftar->nama }}</span>
                    <span class="small"><i class="bi bi-chevron-down" aria-hidden="true"></i> Lihat Detail Formulir</span>
                </a>
            </div>

            {{-- Detail formulir pendaftaran (collapse) --}}
            <div class="collapse mt-3" id="detailPendaftar">
                <div class="card card-spmb">
                    <div class="card-body">
                        {{-- Foto --}}
                        @if($pendaftar->foto)
                        <div class="text-center mb-3">
                            <img src="{{ asset('storage/foto/'.$pendaftar->foto) }}" alt="Foto {{ $pendaftar->nama }}" class="img-fluid rounded border" style="max-height: 180px;">
                        </div>
                        @endif

                        <h6 class="text-muted mb-2"><i class="bi bi-person-lines-fill" aria-hidden="true"></i> Data Calon Murid</h6>
                        <table class="table table-sm table-borderless mb-3">
                            <tr><td width="200"><strong>No. Pendaftaran</strong></td><td>: {{ $pendaftar->no_pendaftaran }}</td></tr>
                            <tr><td><strong>NIK</strong></td><td>: {{ $pendaftar->nik }}</td></tr>
                            <tr><td><strong>NISN</strong></td><td>: {{ $pendaftar->nisn ?? '-' }}</td></tr>
                            <tr><td><strong>Nama Lengkap</strong></td><td>: {{ $pendaftar->nama }}</td></tr>
                            <tr><td><strong>Jenis Kelamin</strong></td><td>: {{ $pendaftar->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                            <tr><td><strong>Tempat, Tgl Lahir</strong></td><td>: {{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->translatedFormat('d F Y') }}</td></tr>
                            <tr><td><strong>Agama</strong></td><td>: {{ $pendaftar->agama }}</td></tr>
                            <tr><td><strong>Alamat</strong></td><td>: {{ $pendaftar->alamat }}</td></tr>
                            <tr><td><strong>Asal Sekolah/TK</strong></td><td>: {{ $pendaftar->asal_sekolah ?? '-' }}</td></tr>
                        </table>

                        <h6 class="text-muted mb-2"><i class="bi bi-people-fill" aria-hidden="true"></i> Data Orang Tua & Kontak</h6>
                        <table class="table table-sm table-borderless mb-3">
                            <tr><td width="200"><strong>Nama Ayah</strong></td><td>: {{ $pendaftar->nama_ayah }}</td></tr>
                            <tr><td><strong>Nama Ibu</strong></td><td>: {{ $pendaftar->nama_ibu }}</td></tr>
                            <tr><td><strong>No. HP / WhatsApp</strong></td><td>: {{ $pendaftar->no_hp }}</td></tr>
                            <tr><td><strong>Email</strong></td><td>: {{ $pendaftar->email ?? '-' }}</td></tr>
                        </table>

                        <h6 class="text-muted mb-2"><i class="bi bi-folder-fill" aria-hidden="true"></i> Berkas yang Diupload</h6>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span><i class="bi bi-image" aria-hidden="true"></i> Pas Foto</span>
                                @if($pendaftar->foto)
                                    <a href="{{ asset('storage/foto/'.$pendaftar->foto) }}" target="_blank" class="badge bg-success">Lihat</a>
                                @else
                                    <span class="badge bg-secondary">Belum diupload</span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span><i class="bi bi-file-earmark" aria-hidden="true"></i> Kartu Keluarga</span>
                                @if($pendaftar->kk)
                                    <a href="{{ asset('storage/kk/'.$pendaftar->kk) }}" target="_blank" class="badge bg-success">Lihat</a>
                                @else
                                    <span class="badge bg-secondary">Belum diupload</span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span><i class="bi bi-file-earmark" aria-hidden="true"></i> Akta Kelahiran</span>
                                @if($pendaftar->akta)
                                    <a href="{{ asset('storage/akta/'.$pendaftar->akta) }}" target="_blank" class="badge bg-success">Lihat</a>
                                @else
                                    <span class="badge bg-secondary">Belum diupload</span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span><i class="bi bi-file-earmark" aria-hidden="true"></i> Ijazah/Ket. Lulus TK</span>
                                @if($pendaftar->ijazah)
                                    <a href="{{ asset('storage/ijazah/'.$pendaftar->ijazah) }}" target="_blank" class="badge bg-success">Lihat</a>
                                @else
                                    <span class="badge bg-secondary">Tidak ada</span>
                                @endif
                            </li>
                        </ul>

                        <h6 class="text-muted mb-2"><i class="bi bi-clipboard-check-fill" aria-hidden="true"></i> Status</h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td width="200"><strong>Status Berkas</strong></td>
                                <td>:
                                    @if($pendaftar->terverifikasi)
                                        <span class="badge bg-success">Sudah Diverifikasi</span>
                                    @else
                                        <span class="badge bg-secondary">Belum Diverifikasi</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status Diterima</strong></td>
                                <td>: <span class="badge badge-{{ $pendaftar->status }}">{{ ucfirst($pendaftar->status) }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Daftar</strong></td>
                                <td>: {{ $pendaftar->created_at->translatedFormat('d F Y, H:i') }} WIB</td>
                            </tr>
                        </table>

                        <div class="mt-3">
                            <a href="{{ route('bukti.pdf', $pendaftar->no_pendaftaran) }}" class="btn btn-spmb"><i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i> Download PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
