<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persyaratan;

class PersyaratanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul' => 'Fotokopi Kartu Keluarga (KK)', 'urutan' => 1],
            ['judul' => 'Fotokopi Akta Kelahiran', 'urutan' => 2],
            ['judul' => 'Pas Foto berwarna 3x4 (terbaru)', 'urutan' => 3],
            ['judul' => 'Fotokopi Ijazah/Keterangan Lulus TK (jika ada)', 'urutan' => 4],
            ['judul' => 'Usia minimal 6 tahun pada tanggal 1 Juli tahun ajaran baru', 'urutan' => 5],
        ];

        foreach ($data as $item) {
            Persyaratan::create($item);
        }
    }
}
