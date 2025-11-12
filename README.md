<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

Projek ini merupakan hasil dari Ujikom pembuatan Sistem Perpustakaan.

## 🚀 Instalasi dan Prasyarat

Repo ini memerlukan beberapa resource berikut ini untuk menjalankan proyek ini secara lokal.

- PHP (versi 8.4 atau lebih baru)

- Composer

- Node.js & NPM

- Server Database MySQL

### Langkah-Langkah Instalasi

1).  Clone proyek ke repo 

```bash
  git clone https://github.com/UlhaqDaffa/Sistem-Perpustakaan-Ujikom.git
```

2). Pergi ke direktori proyek

```bash
  cd sistem-perpustakaan-ujikom
```

3). Install dependensi PHP (Composer)

```bash
  composer install
```

4). Install dependensi JavaScript (NPM)

```bash
  npm install
```

5). Buat file `.env` dari contoh

```bash
  cp .env.example .env
```

6). Generate kunci aplikasi Laravel

```bash
  php artisan key:generate
```

7). Konfigurasi koneksi database di dalam file `.env`

```javascript
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=sistem_perpustakaan
  DB_USERNAME=root
  DB_PASSWORD=
```

8). Buat database pada mysql

```bash
  CREATE DATABASE sistem_perpustakaan;

```

8). Jalankan migrasi database untuk membuat tabel-tabel yang diperlukan

```bash
  php artisan migrate
```

8). Jalankan migrasi database seeder untuk mengisi database

```bash
  php artisan db:seed
```

9). Jalankan server development

```bash
  composer run dev
```

### Konfigurasi Laravel Herd (opsional)

Pembuat menggunakan laravel herd site generator untuk development aplikasi, berikut cara konfigurasinya:

1). Install Laravel Herd jika belum
2). Klik Sites pada menu sidebar
3). Klik tombol add pada pojok kanan
4). Pilih link existing project lalu next
5). Pilih folder project yang sudah di clone
6). Atur project name dan klik https kemudian next


