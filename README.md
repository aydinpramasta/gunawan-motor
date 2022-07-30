<h1>Gunawan Motor Administration App</h1>

Gunawan Motor Administration App adalah aplikasi berbasis Web untuk membantu memantau (tracking) pemasukan, pengeluaran, dan stok barang.

## Prerequisites

- PHP versi ^8.0.2
- Composer
- MySQL

## Installation Guide

- Clone repository ini
```bash
git clone git@github.com:aydinpramasta/gunawan-motor.git
```
- Copy file .env.example ke .env
```bash
cp .env.example .env
```
- Sesuaikan kredensial database dengan konfigurasi komputer anda
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gunawan_motor
DB_USERNAME=root
DB_PASSWORD=
```
- Download dependency-dependency yang dibutuhkan
```bash
composer install
```
- Generate key untuk aplikasi
```bash
php artisan key:generate
```
- Migrasi pembuatan tabel ke database
```bash
# tanpa user dummy
php artisan migrate

# dengan user dummy
# username: admin
# password: admin
php artisan migrate --seed
```
- Jalankan Local Development Server
```bash
php artisan serve
```
- Akses aplikasi di http://localhost:8000