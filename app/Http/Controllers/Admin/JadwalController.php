<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // Tampilkan semua jadwal
    public function index()
    {
        $jadwals = Jadwal::orderBy('tanggal_mulai')->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    // Simpan jadwal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:255',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan'       => 'nullable|string',
        ]);

        Jadwal::create($validated);

        return back()->with('sukses', 'Jadwal berhasil ditambahkan.');
    }

    // Update jadwal
    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:255',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan'       => 'nullable|string',
        ]);

        $jadwal->update($validated);

        return back()->with('sukses', 'Jadwal berhasil diperbarui.');
    }

    // Hapus jadwal
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return back()->with('sukses', 'Jadwal berhasil dihapus.');
    }
}
