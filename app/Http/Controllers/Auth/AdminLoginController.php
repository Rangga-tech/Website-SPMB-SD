<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // Menampilkan halaman form login admin (GET /admin/login)
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Memproses login (POST /admin/login)
    public function login(Request $request)
    {
        // Validasi input tidak boleh kosong
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Auth::guard('admin')->attempt() akan:
        // 1. Mencari admin dengan username tsb
        // 2. Mencocokkan password (yang di-hash) dengan input
        // Jika cocok, admin otomatis login (session dibuat)
        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); // mencegah session fixation attack
            return redirect()->intended(route('admin.dashboard'));
        }

        // Jika gagal, kembali ke form login dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Proses logout (POST /admin/logout)
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();       // menghapus session login admin
        $request->session()->invalidate();    // menghapus semua data session
        $request->session()->regenerateToken(); // membuat token CSRF baru

        return redirect()->route('admin.login');
    }
}
