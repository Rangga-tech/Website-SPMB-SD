<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // Menampilkan halaman laporan dengan filter (GET /admin/laporan)
    public function index(Request $request)
    {
        $query = Pendaftar::query();

        // Filter berdasarkan status kelulusan
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan verifikasi berkas
        if ($request->filled('verifikasi')) {
            $query->where('terverifikasi', $request->verifikasi);
        }

        // Filter berdasarkan tanggal pendaftaran
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('created_at', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('created_at', '<=', $request->sampai_tanggal);
        }

        $pendaftars = $query->orderBy('no_pendaftaran', 'asc')->get();

        // Statistik ringkasan
        $statistik = [
            'total'     => $pendaftars->count(),
            'menunggu'  => $pendaftars->where('status', 'menunggu')->count(),
            'diterima'  => $pendaftars->where('status', 'diterima')->count(),
            'ditolak'   => $pendaftars->where('status', 'ditolak')->count(),
        ];

        return view('admin.laporan.index', compact('pendaftars', 'statistik'));
    }

    // Generate dan download laporan PDF (GET /admin/laporan/pdf)
    public function downloadPdf(Request $request)
    {
        $query = Pendaftar::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('verifikasi')) {
            $query->where('terverifikasi', $request->verifikasi);
        }

        if ($request->filled('dari_tanggal')) {
            $query->whereDate('created_at', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('created_at', '<=', $request->sampai_tanggal);
        }

        $pendaftars = $query->orderBy('no_pendaftaran', 'asc')->get();

        // Statistik ringkasan
        $statistik = [
            'total'     => $pendaftars->count(),
            'menunggu'  => $pendaftars->where('status', 'menunggu')->count(),
            'diterima'  => $pendaftars->where('status', 'diterima')->count(),
            'ditolak'   => $pendaftars->where('status', 'ditolak')->count(),
        ];

        // Label filter yang aktif
        $filterLabel = $this->buildFilterLabel($request);

        $pdf = Pdf::loadView('pdf.laporan-pendaftar', compact('pendaftars', 'statistik', 'filterLabel'));
        $pdf->setPaper('A4', 'landscape');

        $namaFile = 'Laporan-SPMB-' . date('Y-m-d_His') . '.pdf';

        return $pdf->download($namaFile);
    }

    // Membuat label filter untuk ditampilkan di PDF
    private function buildFilterLabel(Request $request): string
    {
        $labels = [];

        if ($request->filled('status')) {
            $labels[] = 'Status: ' . ucfirst($request->status);
        }
        if ($request->filled('verifikasi')) {
            $labels[] = 'Verifikasi: ' . ($request->verifikasi ? 'Sudah' : 'Belum');
        }
        if ($request->filled('dari_tanggal')) {
            $labels[] = 'Dari: ' . $request->dari_tanggal;
        }
        if ($request->filled('sampai_tanggal')) {
            $labels[] = 'Sampai: ' . $request->sampai_tanggal;
        }

        return count($labels) ? implode(' | ', $labels) : 'Semua Data';
    }
}

