# RedPlay – Website Informasi Film

## Deskripsi
RedPlay adalah website informasi film yang menyediakan data lengkap seperti judul, sinopsis, rating, genre, dan tahun rilis. Website ini dirancang untuk membantu pengguna menemukan film yang ingin ditonton dengan cepat melalui fitur pencarian dan kategori.

## Tujuan Project
- Mempermudah pengguna dalam mencari informasi film  
- Menyediakan platform eksplorasi film yang sederhana  
- Mengembangkan kemampuan Software Development  
- Menerapkan konsep frontend dan backend dalam satu project  

## Fitur Utama
- Pencarian film berdasarkan judul  
- Filter film berdasarkan genre  
- Informasi rating film  
- Halaman detail film (sinopsis, tahun rilis, genre)  
- Tampilan responsive untuk berbagai perangkat  

## Teknologi yang Digunakan
- Frontend: HTML, CSS, JavaScript, Bootstrap  
- Backend: PHP (CodeIgniter / Laravel)  
- Database: MySQL / MariaDB  
- Tools: Composer / NPM  

## Instalasi dan Menjalankan Project

### 1. Clone Repository
```bash
git clone https://github.com/username/redplay.git
cd redplay
```

### 2. Install Dependencies
Jika menggunakan PHP:
```bash
composer install
```

Jika menggunakan Node.js:
```bash
npm install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
```

Edit file `.env`:
```
DB_HOST=localhost
DB_NAME=redplay
DB_USER=root
DB_PASS=
BASE_URL=http://localhost:8080
```

### 4. Setup Database
- Buat database baru di MySQL  
- Import file:
```
database.sql
```

### 5. Jalankan Server

PHP:
```bash
php spark serve
```
atau
```bash
php artisan serve
```

Node.js:
```bash
npm run dev
```

### 6. Akses Aplikasi
Buka di browser:
```
http://localhost:8080
```

## Cara Penggunaan
1. Buka halaman utama  
2. Gunakan fitur pencarian untuk mencari film  
3. Gunakan filter genre untuk mempersempit hasil  
4. Klik film untuk melihat detail lengkap  

## Struktur Folder
```
redplay/
│── app/
│── public/
│── resources/
│── routes/
│── database/
│── .env
│── composer.json / package.json
```

## Pengembangan Selanjutnya
- Sistem login dan register  
- Fitur favorit / wishlist  
- Review dan komentar pengguna  
- Integrasi API film (TMDB / IMDb)  
- Dashboard admin (CRUD film)  

## Kontribusi
Kontribusi terbuka. Silakan fork repository dan buat pull request.

