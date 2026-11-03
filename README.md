# Portal O2SN - Sistem Informasi Pendataan Perlombaan Sekolah

Sistem Informasi Manajemen dan Pendataan Peserta, Sekolah, dan Cabang Perlombaan O2SN (Olimpiade Olahraga Siswa Nasional) berbasis PHP Native dan MySQL dengan Antarmuka Responsif, Modern, dan Terpadu.

## Requirement

Pastikan sudah terinstall:

* Git
* Web Server (Apache / XAMPP)
* PHP (v7.4 atau v8.x)
* MySQL / MariaDB
* Web Browser modern (Google Chrome, Microsoft Edge, Mozilla Firefox)

Cek Git:

```bash
git --version
```

Cek PHP:

```bash
php -v
```

## Instalasi

Clone repository:

```bash
git clone https://github.com/rusiadristi/website_sekolah.git
cd website_sekolah
```

Pindahkan atau tempatkan folder project ke dalam direktori web server (`htdocs`):

```bash
# Contoh direktori pada XAMPP Windows:
C:\xampp\htdocs\website_sekolah
```

## Konfigurasi Database

1. Buka XAMPP Control Panel dan aktifkan modul **Apache** dan **MySQL**.
2. Akses phpMyAdmin melalui browser:

```text
http://localhost/phpmyadmin
```

3. Buat database baru dengan nama:

```text
crud
```

4. Import file database `db/crud.sql` yang tersedia di dalam repository ini ke dalam database `crud`.
5. Pastikan konfigurasi koneksi pada file `koneksi.php` sudah sesuai:

```php
$host = "localhost";
$user = "root";
$password = "";
$db = "crud";

$kon = mysqli_connect($host, $user, $password, $db);
```

## Menjalankan Aplikasi

Pastikan service Apache dan MySQL pada XAMPP sudah berjalan, kemudian buka URL berikut di browser:

```text
http://localhost/website_sekolah/
```

## Akun Pengujian (Default)

Untuk keperluan pengujian sistem dan login (tabel `users`):

* **Administrator:**
  * Username: `admin`
  * Email: `admin@email.com`
  * Password: `admin`

## Fitur Utama Sistem

* **Dashboard Statistik Real-Time:** Menampilkan metrik total peserta terdaftar, sekolah yang berpartisipasi, dan kategori cabang lomba secara langsung dari database, disertai tanggal kalender Indonesia serta pratinjau data terbaru.
* **Manajemen Data Peserta (CRUD):** Pendataan lengkap data siswa peserta (nama lengkap, jenis kelamin, asal sekolah, jurusan/kelas, cabang lomba, nomor WhatsApp, dan alamat domisili) dengan auto-suggest sekolah & lomba.
* **Manajemen Data Sekolah (CRUD):** Pencatatan identitas sekolah peserta, kontak/telepon resmi, alamat lengkap, dan penghitungan otomatis jumlah siswa yang berpartisipasi dari sekolah tersebut.
* **Manajemen Cabang Lomba (CRUD):** Pengelolaan data cabang perlombaan O2SN, tingkatan jenjang (SD, SMP, SMA), tanggal pelaksanaan lomba, dan rekapitulasi peserta aktif.
* **Pencarian Data Instan (Live Table Search):** Fitur filter tabel interaktif pada setiap halaman data tanpa memerlukan reload halaman.
* **Desain Antarmuka Full-Width & Responsif:** Tata letak modern berstandar Bootstrap 5.3, icon vector Font Awesome 6, typography Google Fonts Plus Jakarta Sans, dan layout *fluid* penuh ke sisi kanan dan kiri layar.
* **Dialog Konfirmasi SweetAlert2:** Dialog konfirmasi elegan sebelum melakukan aksi hapus data untuk meminimalisir kesalahan pengguna.
* **Integrasi WhatsApp:** Nomor handphone peserta dapat diklik langsung untuk membuka obrolan WhatsApp tanpa perlu menyimpan kontak terlebih dahulu.
* **Keamanan & Validasi Input:** Sanitasi input menggunakan `mysqli_real_escape_string`, `htmlspecialchars`, serta validasi `intval` untuk mencegah SQL Injection.

> Pastikan database `db/crud.sql` telah di-import ke phpMyAdmin sebelum mengakses aplikasi.
