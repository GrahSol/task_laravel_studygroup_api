# Laravel Study Group API

REST API sederhana menggunakan Laravel dengan fitur JWT Authentication, CRUD Product, dan Relational Model.

## Tech Stack

- Laravel
- MySQL
- JWT Auth (`tymon/jwt-auth`)
- Postman

---

# Cara Menjalankan Project

## 1. Clone Repository

```bash
git clone <LINK_REPOSITORY>
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

Server:

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
  "name": "Anugrah",
  "email": "anugrah@gmail.com",
  "password": "abcde123"
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
  "email": "anugrah@gmail.com",
  "password": "abcde123"
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

Protected menggunakan JWT Bearer Token.

---

# Relational Model

- Category hasMany Product
- Product belongsTo Category

Menggunakan eager loading:

```php
Product::with('category')
```

---

