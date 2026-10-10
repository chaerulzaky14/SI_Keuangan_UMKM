# SI Keuangan UMKM

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)
![PHP](https://img.shields.io/badge/PHP-8.1%2B-purple.svg)
![Status](https://img.shields.io/badge/status-Active-brightgreen.svg)

Sistem Informasi Keuangan untuk UMKM berbasis web yang membantu pemilik usaha mencatat transaksi, memantau arus kas, dan melihat laporan keuangan secara lebih terstruktur dan mudah dipahami.

## Daftar Isi

- [Deskripsi Project](#deskripsi-project)
- [Masalah yang Diselesaikan](#masalah-yang-disesaikan)
- [Fitur Utama](#fitur-utama)
- [Tech Stack](#tech-stack)
- [Prasyarat](#prasyarat)
- [Instalasi](#instalasi)
- [Konfigurasi Environment](#konfigurasi-environment)
- [Struktur Folder](#struktur-folder)
- [Cara Penggunaan](#cara-penggunaan)
- [Roadmap](#roadmap)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)
- [Checklist Persiapan Repo](#checklist-persiapan-repo)

---

## Deskripsi Project

`SI Keuangan UMKM` adalah aplikasi web berbasis PHP yang dirancang untuk membantu pelaku UMKM dalam mengelola keuangan usaha secara lebih tertib. Sistem ini dapat digunakan untuk mencatat pendapatan, pengeluaran, memantau saldo, serta menghasilkan laporan keuangan yang berguna untuk pengambilan keputusan bisnis.

Project ini cocok digunakan oleh pelaku usaha mikro, kecil, dan menengah yang membutuhkan solusi sederhana namun tetap efektif untuk pengelolaan keuangan bisnis.

## Masalah yang Diselesaikan

Banyak UMKM masih mencatat keuangan secara manual menggunakan buku, spreadsheet, atau catatan tidak terstruktur. Hal ini sering menyebabkan:

- data transaksi tidak rapi dan sulit dilacak,
- laporan keuangan terlambat dibuat,
- pengambilan keputusan bisnis menjadi kurang akurat,
- kesulitan memantau arus kas harian atau bulanan.

Dengan aplikasi ini, proses pencatatan dan pelaporan keuangan dapat dilakukan lebih cepat, konsisten, dan terorganisir.

## Fitur Utama

- Manajemen transaksi pendapatan dan pengeluaran
- Dashboard ringkasan keuangan
- Pencatatan kategori transaksi
- Laporan keuangan sederhana (laba rugi, saldo, arus kas)
- Riwayat transaksi yang dapat dilihat berdasarkan periode
- Pengelolaan data usaha dan pengguna
- Antarmuka berbasis web yang mudah digunakan
- Sistem keamanan dasar untuk akses aplikasi

## Tech Stack

| Komponen | Teknologi |
|---|---|
| Bahasa Pemrograman | PHP |
| Framework Backend | CodeIgniter 4 |
| Frontend | HTML, CSS, JavaScript |
| Database | MySQL |
| Server | Apache / Nginx |
| Manajemen Dependensi | Composer |
| Version Control | Git / GitHub |

## Prasyarat

Pastikan perangkat Anda telah memenuhi syarat berikut:

- PHP 8.1 atau versi lebih baru
- Composer
- MySQL 8.0 atau MariaDB 10.3+
- Web server (Apache/Nginx)
- Git
- Browser modern (Chrome, Firefox, Edge, Safari)

## Instalasi

### 1. Clone repository

```bash
git clone https://github.com/chaerulzaky14/SI_Keuangan_UMKM.git
cd SI_Keuangan_UMKM
```

### 2. Install dependency

```bash
composer install
```

### 3. Siapkan environment

Salin file `env` menjadi `.env`:

```bash
cp env .env
```

### 4. Konfigurasi database

Edit file `.env` sesuai konfigurasi database lokal Anda:

```env
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = si_keuangan_umkm
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

### 5. Buat database

```sql
CREATE DATABASE si_keuangan_umkm;
```

### 6. Jalankan migrasi database

```bash
php spark migrate
```

### 7. Jalankan aplikasi

```bash
php spark serve
```

Akses aplikasi pada URL berikut:

```text
http://localhost:8080
```

## Konfigurasi Environment

Contoh konfigurasi `.env` yang umum digunakan:

```env
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
app.name = 'SI Keuangan UMKM'

database.default.hostname = localhost
database.default.database = si_keuangan_umkm
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix = 
```

## Struktur Folder

```text
SI_Keuangan_UMKM/
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Database/
│   ├── Models/
│   ├── Views/
│   └── Filters/
├── public/
│   ├── css/
│   ├── js/
│   └── index.php
├── writable/
│   ├── cache/
│   ├── logs/
│   └── uploads/
├── vendor/
├── .env
├── .env.example
├── .gitignore
├── composer.json
├── spark
├── README.md
├── LICENSE
└── phpunit.xml.dist
```

## Cara Penggunaan

### Login

1. Buka halaman aplikasi di browser.
2. Masukkan username dan password yang valid.
3. Akses dashboard utama.

### Mencatat transaksi

1. Buka menu transaksi.
2. Pilih tipe transaksi: pendapatan atau pengeluaran.
3. Masukkan tanggal, kategori, jumlah, dan keterangan.
4. Simpan data transaksi.

### Melihat laporan

1. Masuk ke menu laporan.
2. Pilih periode yang ingin ditampilkan.
3. Lihat ringkasan keuangan dan aktivitas transaksi.

## Roadmap

- [x] Sistem autentikasi dasar
- [x] Manajemen transaksi pendapatan dan pengeluaran
- [x] Dashboard keuangan
- [x] Laporan keuangan dasar
- [ ] Fitur budgeting dan forecasting
- [ ] Integrasi role pengguna lanjutan
- [ ] Export laporan ke PDF/Excel
- [ ] Notifikasi otomatis
- [ ] Integrasi payment gateway

## Kontribusi

Kontribusi sangat terbuka untuk pengembangan project ini. Jika Anda ingin berkontribusi, silakan ikuti langkah berikut:

1. Fork repository ini.
2. Buat branch baru:

```bash
git checkout -b feature/nama-fitur
```

3. Lakukan perubahan dan commit:

```bash
git commit -m "Menambahkan fitur X"
```

4. Push ke branch Anda:

```bash
git push origin feature/nama-fitur
```

5. Buat pull request ke branch utama.

Pastikan kode yang Anda kirim sudah diuji dan dokumentasi diperbarui sesuai perubahan yang dilakukan.

## Lisensi

Project ini dilisensikan di bawah lisensi MIT.

```text
MIT License

Copyright (c) 2025 chaerulzaky14

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## Checklist Persiapan Repo

- [x] Nama project sudah ditentukan
- [x] Deskripsi project sudah dibuat
- [x] Masalah yang diselesaikan sudah dijelaskan
- [x] Fitur utama sudah ditulis
- [x] Teknologi stack sudah ditentukan
- [x] Prasyarat instalasi sudah ditulis
- [x] Instalasi dan cara menjalankan sudah dijelaskan
- [x] Konfigurasi environment sudah ditambahkan
- [x] Struktur folder sudah dibuat
- [x] Cara penggunaan sudah dijelaskan
- [x] Roadmap sudah ada
- [x] Kontribusi sudah ditulis
- [x] Lisensi MIT sudah ditambahkan

---

Project ini dibuat untuk mendukung pengelolaan keuangan UMKM secara lebih praktis, transparan, dan terukur.
