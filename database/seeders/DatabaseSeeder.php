<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Ini adalah "pintu masuk" seeder utama.
    // Jalankan dengan: php artisan db:seed
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            JadwalSeeder::class,
            PersyaratanSeeder::class,
        ]);
    }
}
