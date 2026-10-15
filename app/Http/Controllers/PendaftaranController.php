<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class PendaftaranController extends Controller
{
    // Menampilkan form pendaftaran (GET /daftar)
    public function create()
    {
        return view('daftar');
    }

    // Memproses form pendaftaran yang dikirim (POST /daftar)
    public function store(Request $request)
    {
        // 1. VALIDASI: memastikan data yang dikirim user sudah benar
        //    Jika ada yang tidak valid, Laravel otomatis redirect kembali
        //    dengan pesan error, dan input lama tetap tersimpan (old input).
        $validated = $request->validate([
            'nik'           => 'required|digits:16|unique:pendaftars,nik',
            'nisn'          => 'nullable|digits:10',
            'nama'          => 'required|string|max:255',
            'jk'            => 'required|in:L,P',
            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama'         => 'required|string|max:100',
            'alamat'        => 'required|string',
            'asal_sekolah'  => 'nullable|string|max:255',
            'nama_ayah'     => 'required|string|max:255',
            'nama_ibu'      => 'required|string|max:255',
            'no_hp'         => 'required|string|max:20',
            'email'         => 'nullable|email|max:255',

            // File wajib: format gambar/pdf, maksimal 2MB (2048 KB)
            'foto'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kk'            => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'akta'          => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'ijazah'        => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // 2. GENERATE NOMOR PENDAFTARAN otomatis, contoh: SPMB-2026-0001
        $tahun = date('Y');
        $urutan = Pendaftar::whereYear('created_at', $tahun)->count() + 1;
        $validated['no_pendaftaran'] = 'SPMB-' . $tahun . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

        // 3. UPLOAD FILE
        //    Setiap file disimpan ke storage/app/public/... dan
        //    nama file uniknya disimpan ke database.
        foreach (['foto', 'kk', 'akta', 'ijazah'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $namaFile = Str::slug($validated['nama']) . '-' . $field . '-' . time() . '.' . $file->getClientOriginalExtension();
                // disk 'public' -> file akan tersimpan di storage/app/public/{field}/
                $file->storeAs($field, $namaFile, 'public');
                $validated[$field] = $namaFile;
            }
        }

        // 4. SIMPAN KE DATABASE
        $pendaftar = Pendaftar::create($validated);

        // 5. REDIRECT ke halaman bukti pendaftaran, membawa no_pendaftaran
        return redirect()
            ->route('bukti', $pendaftar->no_pendaftaran)
            ->with('sukses', 'Pendaftaran berhasil! Silakan simpan/cetak bukti pendaftaran Anda.');
    }

    // Menampilkan bukti pendaftaran (GET /bukti/{no_pendaftaran})
    public function bukti($no_pendaftaran)
    {
        // firstOrFail() -> otomatis menampilkan halaman 404 jika data tidak ditemukan
        $pendaftar = Pendaftar::where('no_pendaftaran', $no_pendaftaran)->firstOrFail();

        return view('bukti', compact('pendaftar'));
    }

    // Menampilkan form cek status (GET /cek-status)
    public function cekStatusForm()
    {
        return view('cek-status');
    }

    // Memproses pencarian status pendaftaran (POST /cek-status)
    public function cekStatus(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required',
            'nik'            => 'required',
        ]);

        $pendaftar = Pendaftar::where('no_pendaftaran', $request->no_pendaftaran)
            ->where('nik', $request->nik)
            ->first();

        if (!$pendaftar) {
            return back()->with('gagal', 'Data tidak ditemukan. Periksa kembali No. Pendaftaran dan NIK Anda.');
        }

        return view('cek-status', compact('pendaftar'));
    }

    // Download bukti pendaftaran dalam format PDF (GET /bukti/{no_pendaftaran}/pdf)
    public function downloadPdf($no_pendaftaran)
    {
        $pendaftar = Pendaftar::where('no_pendaftaran', $no_pendaftaran)->firstOrFail();

        $pdf = Pdf::loadView('pdf.bukti-pendaftaran', compact('pendaftar'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Bukti-Pendaftaran-' . $pendaftar->no_pendaftaran . '.pdf');
    }
}
