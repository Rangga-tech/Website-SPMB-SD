@extends('layouts.app')
@section('title', 'Daftar Akun')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-spmb">
                <div class="card-body p-4">
                    <h4 class="mb-4 text-center" style="color: var(--primary);">Daftar Akun</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="password-toggle-group">
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                                <button type="button" class="btn-password-toggle" title="Lihat password" aria-label="Lihat password" tabindex="-1">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <div class="password-toggle-group">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password" required>
                                <button type="button" class="btn-password-toggle" title="Lihat password" aria-label="Lihat password" tabindex="-1">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-spmb w-100">Daftar</button>
                    </form>

                    <p class="text-center mt-3 mb-0 small">
                        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.btn-password-toggle').forEach(function(button) {
        button.addEventListener('click', function() {
            const input = this.closest('.password-toggle-group').querySelector('input');
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
                this.setAttribute('title', 'Sembunyikan password');
                this.setAttribute('aria-label', 'Sembunyikan password');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
                this.setAttribute('title', 'Lihat password');
                this.setAttribute('aria-label', 'Lihat password');
            }
            input.focus();
        });
    });
</script>
@endpush