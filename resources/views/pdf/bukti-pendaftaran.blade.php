<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - {{ $pendaftar->no_pendaftaran }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #2f2a2a;
            margin: 0;
            padding: 30px 40px;
        }

        .header {
            text-align: center;
            border-bottom: 3px double #9a2e2e;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header h2 {
            color: #9a2e2e;
            margin: 0 0 5px 0;
            font-size: 18px;
        }

        .header p {
            margin: 0;
            color: #666;
            font-size: 11px;
        }

        .section-title {
            background: #9a2e2e;
            color: #fff;
            padding: 6px 12px;
            font-weight: bold;
            font-size: 11px;
            margin: 20px 0 10px 0;
            border-radius: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 5px 8px;
            vertical-align: top;
        }

        table td:first-child {
            width: 180px;
            font-weight: bold;
            color: #555;
        }

        .foto-container {
            text-align: center;
            margin: 10px 0;
        }

        .foto-container img {
            max-height: 150px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .status-box {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 11px;
        }

        .status-verified { background: #d4edda; color: #155724; }
        .status-unverified { background: #e2e3e5; color: #383d41; }
        .status-menunggu { background: #e2e3e5; color: #383d41; }
        .status-diterima { background: #d4edda; color: #155724; }
        .status-ditolak { background: #f8d7da; color: #721c24; }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .no-pendaftaran {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #9a2e2e;
            margin: 10px 0 5px 0;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>BUKTI PENDAFTARAN MURID BARU</h2>
        <p>SPMB SD Harapan — Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}</p>
        <div class="no-pendaftaran">{{ $pendaftar->no_pendaftaran }}</div>
    </div>

    <div class="section-title">DATA CALON MURID</div>

    <table>
        <tr>
            <td>Nama Lengkap</td>
            <td>: {{ $pendaftar->nama }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $pendaftar->nik }}</td>
        </tr>
        <tr>
            <td>NISN</td>
            <td>: {{ $pendaftar->nisn ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $pendaftar->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td>Tempat, Tgl Lahir</td>
            <td>: {{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>: {{ $pendaftar->agama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $pendaftar->alamat }}</td>
        </tr>
        <tr>
            <td>Asal Sekolah/TK</td>
            <td>: {{ $pendaftar->asal_sekolah ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">DATA ORANG TUA & KONTAK</div>

    <table>
        <tr>
            <td>Nama Ayah</td>
            <td>: {{ $pendaftar->nama_ayah }}</td>
        </tr>
        <tr>
            <td>Nama Ibu</td>
            <td>: {{ $pendaftar->nama_ibu }}</td>
        </tr>
        <tr>
            <td>No. HP / WhatsApp</td>
            <td>: {{ $pendaftar->no_hp }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: {{ $pendaftar->email ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">STATUS PENDAFTARAN</div>

    <table>
        <tr>
            <td>Status Berkas</td>
            <td>:
                <span class="status-box {{ $pendaftar->terverifikasi ? 'status-verified' : 'status-unverified' }}">
                    {{ $pendaftar->terverifikasi ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}
                </span>
            </td>
        </tr>
        <tr>
            <td>Status Diterima</td>
            <td>:
                <span class="status-box status-{{ $pendaftar->status }}">
                    {{ ucfirst($pendaftar->status) }}
                </span>
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis oleh sistem SPMB SD pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB.</p>
        <p>Simpan nomor pendaftaran <strong>{{ $pendaftar->no_pendaftaran }}</strong> untuk mengecek status pendaftaran Anda.</p>
    </div>
</body>
</html>

