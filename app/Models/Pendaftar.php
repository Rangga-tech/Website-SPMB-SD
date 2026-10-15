<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    protected $table = 'pendaftars';

    // Semua kolom yang boleh diisi lewat form (mass-assignment)
    protected $fillable = [
        'no_pendaftaran',
        'nik',
        'nisn',
        'nama',
        'jk',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'asal_sekolah',
        'nama_ayah',
        'nama_ibu',
        'no_hp',
        'email',
        'foto',
        'kk',
        'akta',
        'ijazah',
        'terverifikasi',
        'status',
    ];

    // Casting kolom ke tipe data PHP yang sesuai
    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'terverifikasi' => 'boolean',
        ];
    }
}
