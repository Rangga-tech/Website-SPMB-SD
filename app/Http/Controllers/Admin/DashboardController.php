<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;

class DashboardController extends Controller
{
    // Menampilkan halaman dashboard dengan ringkasan data (statistik)
    public function index()
    {
        $totalPendaftar   = Pendaftar::count();
        $sudahVerifikasi  = Pendaftar::where('terverifikasi', true)->count();
        $belumVerifikasi  = Pendaftar::where('terverifikasi', false)->count();
        $diterima         = Pendaftar::where('status', 'diterima')->count();
        $ditolak          = Pendaftar::where('status', 'ditolak')->count();
        $menunggu         = Pendaftar::where('status', 'menunggu')->count();

        // Data pendaftar terbaru (5 data terakhir) untuk ditampilkan di dashboard
        $pendaftarTerbaru = Pendaftar::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'sudahVerifikasi',
            'belumVerifikasi',
            'diterima',
            'ditolak',
            'menunggu',
            'pendaftarTerbaru'
        ));
    }
}
