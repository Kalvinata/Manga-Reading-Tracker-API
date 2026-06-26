📚 MRTA (Manga Reading Tracker API)

RESTful API untuk mengelola daftar bacaan manga menggunakan framework Laravel. API ini mendukung autentikasi JWT, manajemen data Genre, Manga, Reading List, serta Activity Log untuk mencatat seluruh aktivitas request API.

📖 Deskripsi Singkat

MRTA (Manga Reading Tracker API) merupakan REST API yang dikembangkan menggunakan Laravel 12 sebagai backend service. Sistem ini memungkinkan pengguna melakukan autentikasi menggunakan JWT Token kemudian mengelola data Genre, Manga, serta Reading List secara aman melalui endpoint REST API.

Fitur yang tersedia

- 🔐 Authentication menggunakan JWT
- 📚 Manajemen Genre Manga
- 📖 Manajemen Data Manga
- 📑 Manajemen Reading List
- 📝 Activity Log otomatis setiap request API
- 🛡 Middleware Authentication
- 📄 Dokumentasi API menggunakan Postman

 ⚙ Cara Menjalankan Project

Persyaratan

- PHP >= 8.2
- Composer
- MySQL
- Laravel Herd / XAMPP
- Git

## 1. Clone Repository

```bash
git clone [https://github.com/Kalvinata/Manga-Reading-Tracker-API.git](https://github.com/Kalvinata/Manga-Reading-Tracker-API.git)

cd Manga-Reading-Tracker-API

---

## 2. Install Dependency

```bash
composer install
```

---

## 3. Copy File Environment

```bash
cp .env.example .env
```

---

## 4. Generate Application Key

```bash
php artisan key:generate
```

---

## 5. Konfigurasi Database

Sesuaikan file **.env**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mrta
DB_USERNAME=root
DB_PASSWORD=
```

## 6. Generate JWT Secret

```bash
php artisan jwt:secret
```

7. Jalankan Migration

```bash
php artisan migrate --seed
```

---

## 8. Jalankan Project

```bash
php artisan serve
```

Server berjalan pada

```
http://127.0.0.1:8000
```

atau

```
http://mrta.test
```

(apabila menggunakan Laravel Herd)

---

 👤 Akun Login

Gunakan akun berikut untuk melakukan login.

| Email | Password |
|--------|----------|
| kalvin@gmail.com | 12345678 |

---

# 📌 Daftar Endpoint

## 🔐 Authentication

| Method | Endpoint | Keterangan |
|---------|----------|------------|
| POST | /api/login | Login dan mendapatkan JWT Token |
| GET | /api/me | Mendapatkan data user login |
| GET | /api/refresh | Refresh JWT Token |
| POST | /api/logout | Logout dan invalidate token |

---

📚 Genre

| Method | Endpoint | Keterangan |
|---------|----------|------------|
| GET | /api/genre | Menampilkan seluruh genre |
| POST | /api/genre | Menambahkan genre |
| GET | /api/genre/{id} | Detail genre |
| PUT | /api/genre/{id} | Update seluruh data genre |
| PATCH | /api/genre/{id} | Update sebagian data genre |
| DELETE | /api/genre/{id} | Menghapus genre |

---

## 📖 Manga

| Method | Endpoint | Keterangan |
|---------|----------|------------|
| GET | /api/manga | Menampilkan seluruh manga |
| POST | /api/manga | Menambahkan manga |
| GET | /api/manga/{id} | Detail manga |
| PUT | /api/manga/{id} | Update manga |
| DELETE | /api/manga/{id} | Menghapus manga |
| GET | /api/manga/genre/{genre_id} | Menampilkan manga berdasarkan genre |


 📑 Reading List

| Method | Endpoint | Keterangan |
|---------|----------|------------|
| GET | /api/reading-list | Menampilkan seluruh reading list |
| POST | /api/reading-list | Menambahkan reading list |
| GET | /api/reading-list/{id} | Detail reading list |
| PUT | /api/reading-list/{id} | Update reading list |
| DELETE | /api/reading-list/{id} | Menghapus reading list |
| GET | /api/reading-list/manga/{manga_id} | Menampilkan reading list berdasarkan manga |

---

## 📝 Activity Log

| Method | Endpoint | Keterangan |
|---------|----------|------------|
| GET | /api/activity-log | Menampilkan seluruh aktivitas API |

---

# 📄 Dokumentasi API

Dokumentasi lengkap seluruh endpoint tersedia melalui Postman.

👉 **Link Dokumentasi Postman**

```
https://documenter.getpostman.com/view/43068824/2sBXwyFS8j#a2213f22-d481-42e2-8eb3-7bdaae99199b
```

*(Ganti dengan link Postman milikmu.)*


# 🛠 Teknologi yang Digunakan

| Teknologi | Keterangan |
|------------|------------|
| Laravel 12 | Framework PHP |
| PHP 8.2 | Bahasa Pemrograman |
| MySQL | Database |
| JWT Auth | Authentication |
| Laravel Herd | Local Development |
| Postman | API Testing & Documentation |
| GitHub | Version Control |


👨‍💻 Tim Pengembang

| Nama | NIM | Tugas |
|------|------|------|
| Kalif Fauzan Firdaus | 2301040033 | Backend Development, Authentication JWT, Endpoint Genre, Manga, Reading List, API Documentation |
| Gifari Alrofif | 2301040007 | Database Design, Activity Log, API Testing, Documentation
---

📚 Mata Kuliah

Pemrograman Web Service

Semester Genap 2025/2026

Universitas Bumigora

© 2026 MRTA (Manga Reading Tracker API)
