# 🎬 RedPlay – Website Informasi Film

![RedPlay Banner](https://via.placeholder.com/1200x400?text=RedPlay+Movie+Website)

## 📌 Deskripsi
**RedPlay** adalah website informasi film yang menyediakan berbagai data lengkap seperti judul, sinopsis, rating, genre, dan tahun rilis. Platform ini dirancang untuk membantu pengguna menemukan film yang ingin ditonton dengan cepat dan mudah melalui fitur pencarian dan kategori.

---

## 🎯 Tujuan Project
- Mempermudah pengguna dalam mencari informasi film  
- Menyediakan platform eksplorasi film yang sederhana dan informatif  
- Mengembangkan kemampuan Software Development  
- Mengimplementasikan konsep Frontend & Backend dalam satu project  

---

## ✨ Fitur Utama
- 🔍 Pencarian Film – Cari film berdasarkan judul  
- 🎭 Kategori Genre – Filter film berdasarkan genre  
- ⭐ Rating Film – Menampilkan rating tiap film  
- 📄 Detail Film – Informasi lengkap (sinopsis, tahun, genre)  
- 📱 Responsive Design – Optimal di desktop & mobile  

---

## 🛠️ Teknologi yang Digunakan
- Frontend: HTML, CSS, JavaScript, Bootstrap  
- Backend: PHP (CodeIgniter / Laravel)  
- Database: MySQL / MariaDB  
- Tools: Composer / NPM  

---

## ⚙️ Cara Install & Menjalankan

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

Edit file .env:
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

### 6. Akses Website
Buka browser:
```
http://localhost:8080
```

---

## 📖 Cara Menggunakan
1. Buka halaman utama  
2. Gunakan fitur pencarian untuk mencari film  
3. Pilih genre untuk filter film  
4. Klik film untuk melihat detail lengkap  

---

## 📁 Struktur Folder
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

---

## 💡 Pengembangan Selanjutnya
- 🔐 Sistem login & register user  
- ❤️ Fitur favorit / wishlist  
- 📝 Review & komentar pengguna  
- 🎬 Integrasi API film (TMDB / IMDb)  
- 📊 Dashboard admin (CRUD film)  

---

## 🤝 Kontribusi
Kontribusi sangat terbuka!  
Silakan fork repository ini dan buat pull request.

---

## 📄 Lisensi
Project ini menggunakan lisensi MIT.
