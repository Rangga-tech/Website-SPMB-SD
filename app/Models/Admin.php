<?php

namespace App\Models;

// Authenticatable adalah class bawaan Laravel supaya model ini bisa dipakai untuk login
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // Memberitahu Laravel bahwa model Admin menggunakan tabel "admins"
    protected $table = 'admins';

    // Kolom yang boleh diisi lewat mass-assignment (Admin::create([...]))
    protected $fillable = [
        'username',
        'password',
        'nama',
    ];

    // Kolom yang disembunyikan saat model diubah ke array/JSON
    protected $hidden = [
        'password',
    ];

    // Casting otomatis: password akan di-hash otomatis saat disimpan
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
