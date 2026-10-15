@extends('layouts.app')
@section('title', 'Form Pendaftaran')

@section('content')
<div class="container py-5">
    <h2 class="mb-4" style="color: var(--primary);">Form Pendaftaran Murid Baru</h2>

    <div class="card card-spmb">
        <div class="card-body">
            {{-- enctype WAJIB ada karena form ini mengunggah file --}}
            <form action="{{ route('daftar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf {{-- token keamanan wajib ada di setiap form POST Laravel --}}

                <h5 class="text-muted mb-3">Data Calon Murid</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" maxlength="16" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}">
                        @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NISN (jika ada)</label>
                        <input type="text" name="nisn" maxlength="10" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}">
                        @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jk" class="form-select @error('jk') is-invalid @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jk')=='L'?'selected':'' }}>Laki-laki</option>
                            <option value="P" {{ old('jk')=='P'?'selected':'' }}>Perempuan</option>
                        </select>
                        @error('jk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Agama</label>
                        <input type="text" name="agama" class="form-control @error('agama') is-invalid @enderror" value="{{ old('agama') }}">
                        @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Asal Sekolah/TK (opsional)</label>
                        <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" rows="2" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <h5 class="text-muted mt-4 mb-3">Data Orang Tua & Kontak</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" value="{{ old('nama_ayah') }}">
                        @error('nama_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu') }}">
                        @error('nama_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. HP / WhatsApp</label>
                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}">
                        @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email (opsional)</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                </div>

                <h5 class="text-muted mt-4 mb-3">Upload Berkas</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Pas Foto (jpg/png, maks 2MB)</label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kartu Keluarga (jpg/png/pdf, maks 2MB)</label>
                        <input type="file" name="kk" class="form-control @error('kk') is-invalid @enderror">
                        @error('kk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Akta Kelahiran (jpg/png/pdf, maks 2MB)</label>
                        <input type="file" name="akta" class="form-control @error('akta') is-invalid @enderror">
                        @error('akta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ijazah/Ket. Lulus TK (opsional)</label>
                        <input type="file" name="ijazah" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-spmb mt-4"><i class="bi bi-send-fill" aria-hidden="true"></i>Kirim Pendaftaran</button>
            </form>
        </div>
    </div>
</div>
@endsection
