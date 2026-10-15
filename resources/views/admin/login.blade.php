<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SPMB SD</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ARTI_DAN_MAKNA_LAMBANG_LOGO_SEKOLAH_DASAR_SD_NEGERI-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body style="background-color:#f6f5f1;">
<div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card card-spmb shadow-sm" style="width: 380px;">
        <div class="card-body p-4">
            <h4 class="text-center mb-4" style="color: var(--primary);">Login Admin SPMB SD</h4>

            @if ($errors->any())
                <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('admin.login.proses') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="password-toggle-group">
                        <input type="password" name="password" id="admin_password" class="form-control" placeholder="Masukkan password" required>
                        <button type="button" class="btn-password-toggle" title="Lihat password" aria-label="Lihat password" tabindex="-1">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
                <button type="submit" class="btn btn-spmb w-100"><i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i>Masuk</button>
            </form>
        </div>
    </div>
</div>

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
</body>
</html>
