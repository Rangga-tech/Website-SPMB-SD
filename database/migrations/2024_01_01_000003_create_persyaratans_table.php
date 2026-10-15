<?php
// Tabel "persyaratans" -> menyimpan daftar syarat pendaftaran
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persyaratans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');            // contoh: "Fotokopi Kartu Keluarga"
            $table->text('keterangan')->nullable();
            $table->integer('urutan')->default(0); // untuk mengurutkan tampilan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persyaratans');
    }
};
