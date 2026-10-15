<?php
// Migration ini membuat tabel "admins" untuk menyimpan data akun admin
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // up() dijalankan saat migration di-run (php artisan migrate)
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();                          // kolom id, primary key, auto increment
            $table->string('username')->unique();  // username admin, harus unik
            $table->string('password');            // password (akan di-hash)
            $table->string('nama');                // nama lengkap admin
            $table->timestamps();                  // kolom created_at & updated_at otomatis
        });
    }

    // down() dijalankan saat migration di-rollback (php artisan migrate:rollback)
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
