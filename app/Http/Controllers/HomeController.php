<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Persyaratan;
use App\Models\Pengumuman;

class HomeController extends Controller
{
    // Menampilkan halaman Beranda
    public function index()
    {
        // Mengambil jadwal yang masih berjalan/terbaru untuk ditampilkan di beranda
        $jadwal = Jadwal::orderBy('tanggal_mulai', 'desc')->first();

        // view() akan mencari file di resources/views/home.blade.php
        // compact('jadwal') mengirim variabel $jadwal ke dalam file blade tersebut
        return view('home', compact('jadwal'));
    }

    // Menampilkan halaman Profil Sekolah
    public function profil()
    {
        return view('profil');
    }

    // Menampilkan halaman Informasi SPMB (jadwal + persyaratan)
    public function informasi()
    {
        $jadwals = Jadwal::orderBy('tanggal_mulai')->get();
        $persyaratans = Persyaratan::orderBy('urutan')->get();

        return view('informasi', compact('jadwals', 'persyaratans'));
    }

    // Menampilkan halaman Pengumuman untuk publik
    public function pengumuman()
    {
        $pengumumans = Pengumuman::orderBy('tanggal', 'desc')->paginate(5);

        return view('pengumuman', compact('pengumumans'));
    }
}
