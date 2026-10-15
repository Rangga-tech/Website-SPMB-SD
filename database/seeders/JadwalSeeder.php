<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        Jadwal::updateOrCreate(
            ['judul' => 'Pendaftaran Gelombang 1'],
            [
                'tanggal_mulai'   => '2026-11-02',
                'tanggal_selesai' => '2026-11-30',
                'keterangan'      => 'Pendaftaran online dibuka 24 jam melalui website ini.',
            ]
        );

        Jadwal::updateOrCreate(
            ['judul' => 'Verifikasi Berkas'],
            [
                'tanggal_mulai'   => '2026-12-01',
                'tanggal_selesai' => '2026-12-10',
                'keterangan'      => 'Panitia melakukan verifikasi kelengkapan berkas pendaftar.',
            ]
        );

        Jadwal::updateOrCreate(
            ['judul' => 'Pengumuman Hasil Seleksi'],
            [
                'tanggal_mulai'   => '2026-12-15',
                'tanggal_selesai' => '2026-12-15',
                'keterangan'      => 'Hasil dapat dilihat pada menu Pengumuman atau Cek Status.',
            ]
        );
    }
}
