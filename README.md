# Laravel API

Tugas study grup Chevalier Lab yang mengimplementasikan REST API sederhana menggunakan Laravel dengan fitur JWT Authentication, CRUD Product, dan Relational Model.

## Tech Stack

- Laravel
- MySQL
- JWT Auth (`tymon/jwt-auth`)
- Postman

---

# Cara Menjalankan Project

## 1. Clone Repository

```bash
git clone <link repo>
cd laravel-studygroup-api
```

---

## 2. Install Dependency

```bash
composer install
```

---

## 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
```

Jika terjadi error terkait file `Controller.php`, pastikan struktur folder controller berada pada:

```text
app/Http/Controllers/
```

---

## 4. Konfigurasi Database

Buat database:

```sql
CREATE DATABASE laravel_studygroup_api;
```

Edit `.env`:

```env
DB_DATABASE=laravel_studygroup_api
DB_USERNAME=root
DB_PASSWORD=
```

---

## 5. Jalankan Migration

```bash
php artisan migrate
```

---

## 6. Jalankan Server

```bash
php artisan serve
```

Server berjalan pada:

```text
http://127.0.0.1:8000
```

---

# Authentication JWT

## Register

```http
POST /api/auth/register
```

Body:

```json
{
  "name": "Abc",
  "email": "abcde@email.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

---

## Login

```http
POST /api/auth/login
```

Body:

```json
{
  "email": "abcde@email.com",
  "password": "password123"
}
```

---

# Product Endpoint

| Method | Endpoint |
|---|---|
| GET | /api/products |
| POST | /api/products |
| GET | /api/products/{id} |
| PUT | /api/products/{id} |
| DELETE | /api/products/{id} |

Endpoint product menggunakan JWT Bearer Token.

---

# Category Endpoint

| Method | Endpoint | Deskripsi |
|---|---|---|
| GET | /api/categories | Ambil semua kategori |
| POST | /api/categories | Tambah kategori baru |
| DELETE | /api/categories/{id} | Hapus kategori |

---

# Relational Model

- Category hasMany Product
- Product belongsTo Category

Menggunakan eager loading:

```php
Product::with('category')
```

---

# Fitur

- JWT Authentication
- CRUD Product
- Validation Request
- Protected Route
- Relational Model
- Eager Loading
- Pagination & Search
- JSON Response API
