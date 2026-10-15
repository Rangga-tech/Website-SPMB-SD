<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendaftar SPMB</title>
    <style>
        @page {
            margin: 18mm 15mm 22mm 15mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            font-size: 10px;
            color: #1a1a2e;
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        /* ==============================
           KOP SURAT
        ============================== */
        .kop-wrapper {
            width: 100%;
            border-bottom: 3px solid #000000;
            padding-bottom: 10px;
            margin-bottom: 16px;
        }

        .kop-table {
            width: 100%;
            display: table;
        }

        .kop-logo-cell {
            display: table-cell;
            width: 75px;
            vertical-align: middle;
            text-align: center;
        }

        .kop-logo-img {
            width: 65px;
            height: 65px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .kop-text-cell {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            padding: 0 10px;
        }

        .kop-dinas {
            font-size: 9.5px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 1px;
        }

        .kop-sekolah {
            font-size: 20px;
            font-weight: bold;
            color: #000000;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 2px 0;
        }

        .kop-alamat {
            font-size: 8.5px;
            color: #888;
        }

        .kop-akreditasi-cell {
            display: table-cell;
            width: 70px;
            vertical-align: middle;
            text-align: center;
        }

        .akreditasi-box {
            border: 2px solid #000000;
            border-radius: 6px;
            padding: 4px 8px;
            color: #000000;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .akreditasi-grade {
            font-size: 20px;
            font-weight: bold;
            display: block;
            margin: 1px 0;
        }

        /* ==============================
           JUDUL LAPORAN
        ============================== */
        .judul-wrapper {
            text-align: center;
            margin: 12px 0 10px 0;
        }

        .judul-wrapper h2 {
            font-size: 13px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0 0 2px 0;
        }

        .judul-garis {
            height: 2px;
            background: #000;
            width: 60%;
            margin: 4px auto;
        }

        .judul-sub {
            font-size: 9.5px;
            color: #555;
            margin: 4px 0 0 0;
        }

        /* ==============================
           INFO FILTER & CETAK
        ============================== */
        .info-bar {
            display: table;
            width: 100%;
            background: #fdf2f2;
            border: 1px solid #e8c4c4;
            border-radius: 4px;
            padding: 6px 10px;
            margin-bottom: 14px;
        }

        .info-bar-left {
            display: table-cell;
            width: 50%;
            vertical-align: middle;
        }

        .info-bar-right {
            display: table-cell;
            width: 50%;
            vertical-align: middle;
            text-align: right;
        }

        .info-bar .label {
            font-weight: bold;
            color: #000000;
        }

        /* ==============================
           STATISTIK
        ============================== */
        .statistik-wrapper {
            display: table;
            width: 100%;
            margin-bottom: 16px;
        }

        .stat-box {
            display: table-cell;
            text-align: center;
            padding: 8px 4px;
            border: 1px solid #e0e0e0;
        }

        .stat-box:first-child {
            border-left: 3px solid #000000;
            border-radius: 4px 0 0 4px;
            background: #fdf2f2;
        }

        .stat-box:nth-child(2) {
            background: #f8f8f8;
        }

        .stat-box:nth-child(3) {
            background: #f0fdf4;
        }

        .stat-box:last-child {
            background: #fff5f5;
            border-radius: 0 4px 4px 0;
        }

        .stat-number {
            font-size: 22px;
            font-weight: bold;
            display: block;
        }

        .stat-number-total   { color: #000000; }
        .stat-number-menunggu { color: #6c757d; }
        .stat-number-diterima { color: #28a745; }
        .stat-number-ditolak  { color: #dc3545; }

        .stat-label {
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #888;
        }

        /* ==============================
           TABEL DATA
        ============================== */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        table.data-table thead tr {
            background: #f0f0f0;
        }

        table.data-table thead th {
            color: #000;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 9px 7px;
            text-align: left;
            border: 1px solid #000;
        }

        table.data-table thead th.text-center {
            text-align: center;
        }

        table.data-table tbody td {
            padding: 7px 7px;
            border: 1px solid #000;
            font-size: 9.5px;
            vertical-align: middle;
        }

        table.data-table tbody tr:nth-child(even) {
            background: #ffffff;
        }

        table.data-table tbody tr:nth-child(odd) {
            background: #ffffff;
        }

        .text-center { text-align: center; }

        /* No pendaftaran style */
        .no-pendaftaran {
            font-size: 9px;
            color: #000;
        }

        /* NIK style */
        .nik-text {
            font-family: 'DejaVu Sans Mono', monospace;
            font-size: 9px;
            letter-spacing: 0.5px;
            color: #444;
        }

        /* Status badges */
        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 8.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-menunggu {
            background: #e9ecef;
            color: #495057;
            border: 1px solid #ced4da;
        }

        .badge-diterima {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .badge-ditolak {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Nomor baris */
        .no-baris {
            text-align: center;
            color: #888;
            font-size: 9px;
        }

        /* ==============================
           FOOTER
        ============================== */
        .footer-divider {
            border: none;
            border-top: 1px solid #ccc;
            margin: 16px 0 12px 0;
        }

        .footer-wrapper {
            display: table;
            width: 100%;
        }

        .footer-left {
            display: table-cell;
            width: 55%;
            vertical-align: top;
        }

        .footer-right {
            display: table-cell;
            width: 45%;
            vertical-align: top;
            text-align: center;
        }

        .footer-info {
            font-size: 8px;
            color: #999;
            line-height: 1.8;
        }

        .footer-info strong {
            color: #666;
        }

        .ttd-kota-tgl {
            font-size: 9.5px;
            color: #333;
            margin-bottom: 55px;
        }

        .ttd-nama {
            font-size: 10px;
            font-weight: bold;
            color: #1a1a2e;
            border-top: 1.5px solid #333;
            padding-top: 3px;
            display: inline-block;
            min-width: 140px;
        }

        .ttd-jabatan {
            font-size: 8.5px;
            color: #666;
            margin-top: 2px;
        }

        .ttd-nip {
            font-size: 8px;
            color: #888;
        }

        /* Tidak ada data */
        .no-data-row td {
            text-align: center;
            padding: 20px !important;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>

    <!-- ===== KOP SURAT ===== -->
    <div class="kop-wrapper">
        <div class="kop-table">
            <div class="kop-logo-cell">
                <img src="{{ public_path('images/ARTI_DAN_MAKNA_LAMBANG_LOGO_SEKOLAH_DASAR_SD_NEGERI-removebg-preview.png') }}"
                     alt="Logo SD" class="kop-logo-img">
            </div>
            <div class="kop-text-cell">
                <div class="kop-dinas">Dinas Pendidikan Kabupaten / Kota</div>
                <div class="kop-sekolah">SD</div>
                <div class="kop-alamat">
                    Jl. Pendidikan No. 1, Indonesia &nbsp;&bull;&nbsp; Telp: (021) 0000-0000 &nbsp;&bull;&nbsp; Email: info@spmb-sd.sch.id
                </div>
            </div>
            <div class="kop-logo-cell" style="text-align: center;">
                <img src="{{ public_path('images/logo-tut-wuri-handayani.png') }}"
                     alt="Logo Tut Wuri Handayani" class="kop-logo-img">
            </div>
        </div>
    </div>

    <!-- ===== JUDUL LAPORAN ===== -->
    <div class="judul-wrapper">
        <h2>Laporan Data Pendaftar SPMB</h2>
        <div class="judul-garis"></div>
        <div class="judul-sub">Seleksi Penerimaan Murid Baru &nbsp;&mdash;&nbsp; Tahun Pelajaran {{ date('Y') }}/{{ date('Y') + 1 }}</div>
    </div>



    <!-- ===== TABEL DATA PENDAFTAR ===== -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 28px;" class="text-center">No</th>
                <th style="width: 145px;">No. Pendaftaran</th>
                <th>Nama Siswa / Siswi</th>
                <th style="width: 145px;">NIK</th>
                <th style="width: 90px;" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftars as $i => $p)
            <tr>
                <td class="no-baris">{{ $i + 1 }}</td>
                <td>
                    <span class="no-pendaftaran">{{ $p->no_pendaftaran }}</span>
                </td>
                <td>{{ $p->nama }}</td>
                <td>
                    <span class="nik-text">{{ $p->nik }}</span>
                </td>
                <td class="text-center">
                    <span class="status-badge badge-{{ $p->status }}">
                        @if($p->status === 'diterima')
                            &#10003; Diterima
                        @elseif($p->status === 'ditolak')
                            &#10007; Ditolak
                        @else
                            Menunggu
                        @endif
                    </span>
                </td>
            </tr>
            @empty
            <tr class="no-data-row">
                <td colspan="5">Tidak ada data pendaftar yang sesuai dengan filter.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- ===== FOOTER ===== -->
    <hr class="footer-divider">
    <div class="footer-wrapper">
        <div class="footer-left">
            <div class="footer-info">
                <strong>Keterangan Status:</strong><br>
                &bull; <strong>Diterima</strong> &mdash; Peserta dinyatakan lulus seleksi<br>
                &bull; <strong>Ditolak</strong> &mdash; Peserta tidak memenuhi syarat<br>
                &bull; <strong>Menunggu</strong> &mdash; Proses seleksi masih berlangsung<br>
                <br>
                Dokumen ini diterbitkan secara resmi oleh sistem SPMB SD.<br>
                Dokumen ini sah tanpa tanda tangan apabila dicetak dari sistem.
            </div>
        </div>
        <div class="footer-right">
            <div class="ttd-kota-tgl">
                Indonesia, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </div>
            <div class="ttd-nama">Kepala Sekolah</div>
            <div class="ttd-jabatan">SD</div>
            <div class="ttd-nip">NIP. ____________________</div>
        </div>
    </div>

</body>
</html>
