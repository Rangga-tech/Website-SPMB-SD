# SPMB SDN Harapan

Panduan menjalankan website Sistem Penerimaan Murid Baru (SPMB) berbasis Laravel.

## 1. Isi Fitur

Website ini memiliki dua bagian utama:

- **Halaman publik**: beranda, profil sekolah, informasi jadwal dan persyaratan, pengumuman, formulir pendaftaran, bukti pendaftaran, serta cek status.
- **Halaman admin**: dashboard, pengelolaan pendaftar, jadwal, pengumuman, dan persyaratan.
- **Halaman publik**: beranda, profil sekolah, informasi jadwal dan persyaratan, pengumuman, formulir pendaftaran, bukti pendaftaran (cetak & unduh PDF), serta cek status pendaftaran.
- **Halaman admin**: dashboard, pengelolaan pendaftar, jadwal, pengumuman, persyaratan, serta rekap/laporan pendaftar (ekspor PDF).

## 2. Persyaratan Sistem

Pastikan aplikasi berikut sudah terpasang:

- PHP 8.3 atau lebih baru (pastikan ekstensi **GD** aktif untuk fitur cetak PDF)
- Composer
- Node.js dan npm
- MySQL/MariaDB melalui Laragon atau XAMPP
- VS Code (opsional)

Periksa instalasi melalui terminal:

```bash
php -v
composer -V
node -v
npm -v
```

## 3. Buka Folder Proyek

Buka terminal dan masuk ke folder proyek:

```bash
cd C:\laragon\www\Spmb-Sd1
```

Semua perintah pada panduan ini dijalankan dari folder tersebut.

## 4. Pasang Dependency

Dependency PHP dan JavaScript diperlukan agar aplikasi dapat berjalan:

```bash
composer install
npm install
```

Jika folder `vendor` dan `node_modules` sudah ada, perintah tetap aman dijalankan untuk memastikan dependency sesuai konfigurasi proyek.

## 5. Siapkan File Environment

Buat file `.env` dari `.env.example`.

Pada Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Lalu buat application key:

```bash
php artisan key:generate
```

Jangan membagikan file `.env` karena dapat berisi password database dan konfigurasi rahasia.

## 6. Buat Database

1. Jalankan MySQL dari Laragon atau XAMPP.
2. Buka HeidiSQL, phpMyAdmin, atau database manager lain.
3. Buat database baru dengan nama `spmb_sd`.

Edit `.env` dan sesuaikan bagian database. Contoh konfigurasi MySQL lokal:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spmb_sd
DB_USERNAME=root
DB_PASSWORD=
```

Jika MySQL menggunakan password, isi nilai `DB_PASSWORD` sesuai password komputer tersebut.

## 7. Buat Tabel dan Data Awal

Jalankan migration dan seeder:

```bash
php artisan migrate
php artisan db:seed
```

Perintah tersebut membuat tabel aplikasi dan data awal berupa akun admin, jadwal, serta persyaratan.

Jika ingin menghapus seluruh data lalu membuatnya kembali dari awal, gunakan perintah berikut **hanya pada database pengembangan**:

```bash
php artisan migrate:fresh --seed
```

## 8. Siapkan Penyimpanan File Upload

Buat symbolic link agar foto dan dokumen pendaftar dapat diakses aplikasi:

```bash
php artisan storage:link
```

Pastikan folder `storage` dapat ditulis oleh web server jika aplikasi dijalankan melalui Laragon atau XAMPP.

## 9. Jalankan Website

Untuk development, jalankan Vite dan server Laravel pada dua terminal terpisah.

Terminal pertama:

```bash
npm run dev
```

Terminal kedua:

```bash
php artisan serve
```

Buka alamat berikut di browser:

- Website publik: <http://127.0.0.1:8000>
- Login admin: <http://127.0.0.1:8000/admin/login>

Untuk membuat asset production, jalankan:

```bash
npm run build
```

## 10. Login Admin

Akun admin yang dibuat oleh `AdminSeeder`:

```text
Username: Admin
Password: admin#123
```

Segera ganti password default sebelum website dipakai di lingkungan nyata. Jangan memakai akun default pada server publik.

## 11. Alur Penggunaan Website

### Dari sisi calon murid

1. Buka halaman **Informasi** untuk membaca jadwal dan persyaratan.
2. Buka menu **Daftar** dan isi data calon murid.
3. Unggah dokumen yang diminta pada formulir.
4. Simpan nomor pendaftaran dan buka bukti pendaftaran.
5. Gunakan menu **Cek Status** untuk melihat perkembangan pendaftaran.
4. Simpan nomor pendaftaran dan buka bukti pendaftaran (bisa dicetak langsung atau diunduh format PDF).
5. Gunakan menu **Cek Status** untuk melihat perkembangan pendaftaran, membuka rincian berkas, dan mengunduh ulang bukti pendaftaran.

### Dari sisi admin

1. Login melalui `/admin/login`.
2. Periksa data pada **Pendaftar**.
3. Buka detail pendaftar dan lakukan verifikasi dokumen.
4. Ubah status menjadi `menunggu`, `diterima`, atau `ditolak`.
5. Kelola jadwal dan persyaratan pada menu masing-masing.
6. Tulis atau perbarui pengumuman untuk ditampilkan kepada calon murid.
7. Buka menu **Laporan Pendaftar** untuk mencetak rekapitulasi data pendaftar dalam format PDF.

## 12. Struktur Folder Penting

```text
app/Http/Controllers/    Controller halaman publik dan admin
app/Http/Middleware/     Middleware pembatas akses admin
app/Models/              Model database
database/migrations/     Struktur tabel
database/seeders/        Data awal aplikasi
public/css/              CSS halaman
public/storage/          Link menuju file storage
resources/views/         Template Blade
routes/web.php           Daftar route website
storage/app/public/      File upload publik
```

## 13. Route Utama

### Publik

| URL | Kegunaan |
|---|---|
| `/` | Beranda |
| `/profil` | Profil sekolah |
| `/informasi` | Jadwal dan persyaratan |
| `/pengumuman` | Pengumuman |
| `/daftar` | Formulir pendaftaran |
| `/bukti/{no_pendaftaran}` | Bukti pendaftaran |
| `/bukti/{no_pendaftaran}/pdf` | Cetak PDF Bukti Pendaftaran |
| `/cek-status` | Cek status pendaftaran |

### Admin

| URL | Kegunaan |
|---|---|
| `/admin/login` | Login admin |
| `/admin/dashboard` | Ringkasan data |
| `/admin/pendaftar` | Verifikasi dan status pendaftar |
| `/admin/jadwal` | Kelola jadwal |
| `/admin/pengumuman` | Kelola pengumuman |
| `/admin/persyaratan` | Kelola persyaratan |
| `/admin/laporan` | Cetak Laporan Pendaftar PDF |

Semua route admin selain login memerlukan autentikasi admin.

## 14. Perintah Pemeliharaan

Membersihkan cache konfigurasi dan route:

```bash
php artisan optimize:clear
```

Melihat daftar route:

```bash
php artisan route:list
```

Menjalankan test:

```bash
php artisan test
```

## 15. Troubleshooting

- **Database connection refused**: pastikan MySQL aktif, nama database benar, dan nilai `DB_*` di `.env` sesuai.
- **No application encryption key**: jalankan `php artisan key:generate`.
- **File upload tidak tampil**: jalankan `php artisan storage:link` dan periksa folder `storage/app/public`.
- **Perubahan `.env` tidak terbaca**: jalankan `php artisan optimize:clear`, lalu restart server.
- **Asset CSS/JavaScript tidak diperbarui**: pastikan `npm run dev` sedang berjalan, atau jalankan `npm run build`.
- **Login admin gagal**: jalankan `php artisan db:seed --class=AdminSeeder` untuk membuat atau memperbarui akun default.
- **Error saat Download PDF (The PHP GD extension is required)**: Aktifkan `extension=gd` pada file `php.ini`, lalu restart web server (Apache/Nginx/Laragon).

## 16. Catatan Keamanan

- Jangan mengunggah `.env`, password, atau data pendaftar ke repositori publik.
- Ganti akun admin default.
- Gunakan `APP_ENV=production` dan `APP_DEBUG=false` saat deployment.
- Lakukan backup database dan file upload secara berkala.
