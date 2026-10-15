<?php
// Tabel "pendaftars" -> tabel utama, menyimpan data calon murid yang mendaftar
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran')->unique(); // nomor unik hasil generate sistem, contoh SPMB-2026-0001
            $table->string('nik', 16)->unique();         // NIK anak, 16 digit, unik
            $table->string('nisn', 10)->nullable();      // NISN, boleh kosong saat daftar SD
            $table->string('nama');                      // nama lengkap calon murid
            $table->enum('jk', ['L', 'P']);              // jenis kelamin: L (Laki-laki) / P (Perempuan)
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->text('alamat');
            $table->string('asal_sekolah')->nullable();  // asal TK, boleh kosong
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('no_hp');
            $table->string('email')->nullable();

            // kolom-kolom ini menyimpan NAMA FILE hasil upload (bukan isi filenya)
            $table->string('foto')->nullable();
            $table->string('kk')->nullable();      // scan Kartu Keluarga
            $table->string('akta')->nullable();    // scan Akta Kelahiran
            $table->string('ijazah')->nullable();  // scan Ijazah TK (opsional)

            // status verifikasi berkas oleh admin
            $table->boolean('terverifikasi')->default(false);

            // status kelulusan: menunggu / diterima / ditolak
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftars');
    }
};
