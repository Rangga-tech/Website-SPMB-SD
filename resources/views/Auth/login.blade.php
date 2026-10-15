@extends('layouts.app')
@section('title', 'Login Akun')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-spmb">
                <div class="card-body p-4">
                    <h4 class="mb-4 text-center" style="color: var(--primary);">Login Akun</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
                    @endif

                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="password-toggle-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                                <button type="button" class="btn-password-toggle" title="Lihat password" aria-label="Lihat password" tabindex="-1">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        <button type="submit" class="btn btn-spmb w-100">Masuk</button>
                    </form>

                    <p class="text-center mt-3 mb-0 small">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
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