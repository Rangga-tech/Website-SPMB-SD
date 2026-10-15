<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    // Menampilkan semua data pendaftar (dengan fitur pencarian & filter status)
    public function index(Request $request)
    {
        $query = Pendaftar::query();

        // Fitur pencarian berdasarkan nama atau no_pendaftaran atau NIK
        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                  ->orWhere('no_pendaftaran', 'like', "%{$cari}%")
                  ->orWhere('nik', 'like', "%{$cari}%");
            });
        }

        // Fitur filter berdasarkan status kelulusan
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pendaftars = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pendaftar.index', compact('pendaftars'));
    }

    // Menampilkan detail 1 pendaftar (untuk verifikasi berkas & ubah status)
    public function show(Pendaftar $pendaftar)
    {
        // Laravel otomatis mencari data Pendaftar berdasarkan {pendaftar} di URL
        // teknik ini disebut Route Model Binding
        return view('admin.pendaftar.show', compact('pendaftar'));
    }

    // Verifikasi berkas pendaftar
    public function verifikasi(Pendaftar $pendaftar)
    {
        $pendaftar->update(['terverifikasi' => true]);

        return back()->with('sukses', 'Berkas pendaftar berhasil diverifikasi.');
    }

    // Mengubah status kelulusan (diterima/ditolak/menunggu)
    public function ubahStatus(Request $request, Pendaftar $pendaftar)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
        ]);

        $pendaftar->update(['status' => $request->status]);

        return back()->with('sukses', 'Status pendaftar berhasil diperbarui.');
    }

    // Menghapus data pendaftar
    public function destroy(Pendaftar $pendaftar)
    {
        $pendaftar->delete();

        return redirect()->route('admin.pendaftar.index')->with('sukses', 'Data pendaftar berhasil dihapus.');
    }
}
