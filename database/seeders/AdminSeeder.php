<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    // Membuat atau memperbarui 1 akun admin default untuk login
    public function run(): void
    {
        Admin::updateOrCreate(
            ['username' => 'Admin'],
            [
                'password' => Hash::make('admin#123'), // password default, WAJIB diganti setelah login pertama
                'nama'     => 'Administrator SPMB',
            ]
        );
    }
}
