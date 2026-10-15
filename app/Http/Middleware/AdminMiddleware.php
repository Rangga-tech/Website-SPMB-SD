<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

// Middleware ini bertugas menjaga agar hanya admin yang sudah login
// yang bisa mengakses halaman-halaman /admin/*
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login sebagai admin, tendang ke halaman login
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        // Jika sudah login, lanjutkan request ke controller tujuan
        return $next($request);
    }
}
