# POS Kasir Digital

Aplikasi POS Kasir Digital berbasis web modern yang dibangun dengan teknologi modern.

## Alur Sistem
* Customer datang memilih nomor pesanan (Jika Dine In)
* Kasir mencatat pesanan
* Customer memilih layanan (Dine In atau Take Away) dan metode bayar (Transfer atau Tunai)
* Kasir memasukkan data customer dan memproses pembayaran
* Kasir memasukkan nominal uang dan kembalian dari pesannan customer
* Setelahnya kasir mencetak resi dan menyelesaikan proses pemesanan
* Data pesanan customer tadi masuk ke database
* Admin kemudian mengelola data pesanan tadi di halaman admin tersendiri

## Fitur Utama
* **Autentikasi Pegawai:** Login dan manajemen sesi yang aman
* **Halaman Manajemen Menu:** Menampilkan UI menu makanan dan minuman
* **Pencatatan Pesanan Realtime:** Menampilkan sidebar untuk mencatat pesanan pelanggan
*  **Halaman Dashboard Admin:** Halaman untuk pencatatan laporan pemasukan, jumlah pelanggan, laporan harian

## Tech Stack & Prasyarat

Sebelum menjalankan proyek ini, pastikan di device anda sudah ada beberapa komponen berikut:

### Tools
* **PHP:** `>= 8.3`
* **Composer**
* **Node.js & NPM**
* **HTML**
* **TailwindCSS**
* **Alpine JS**
* **Laravel:**
* **Pdo_Oci & oci_8** (Opsional)


### Database
* **Oracle Database:** `26ai / 19c`
* **Oracle Instant Client**
* **Laragon / Xampp**

Jika belum ada kunjungi situs resmi dari tiap komponen yang belum ada dibawah ini:
* [Oracle Database](https://www.oracle.com/database/free/get-started/)
* [SQL Developer for Oracle](https://www.oracle.com/database/sqldeveloper/technologies/download/)
* [Node.js](https://nodejs.org/en/download)
* [Composer](https://getcomposer.org/download/)
* [PDO_OCI 1.2.0](https://pecl.php.net/package/PDO_OCI/1.2.0/windows)
* [OCI_8 3.4.1](https://pecl-php-net.translate.goog/package/oci8/3.4.1/windows?_x_tr_sl=en&_x_tr_tl=id&_x_tr_hl=id&_x_tr_pto=tc)
* [Laragon](https://laragon.org/docs/install)
* [Xampp](https://www.apachefriends.org/download.html)
* [Oracle Instant Client](https://www.oracle.com/database/technologies/instant-client/downloads.html)
* [PHP](https://www.php.net/downloads.php)


#### Langkah-langkah instalasi

* Jalankan Perintah Ini Di Terminal

```bash

# Clone Repository Ini
git clone https://github/JohannesMRS/Sistem-Pemesanan-Makanan.git

# Pindah ke Folder Repository
cd Sistem-Pemesanan-Makanan

# Install Package PHP Untuk Laravel
composer Install

#Install Node.js
npm install

# Install Package Yajra untuk Support Oracle Database
composer require yajra/laravel-oci8:^13

```
* Modifikasi Database Di File .env
```bash

DB_CONNECTION = oracle
DB_HOST = localhost
DB_PORT = 1521
DB_DATABASE = xe / free / freepdb1
DB_USERNAME = username_database_oracle_anda
DB_PASSOWRD = passowrd_database_oracle_anda





