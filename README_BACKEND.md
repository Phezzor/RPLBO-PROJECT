# 🔌 Backend API - Sidewalk.Go

## 📋 Overview

Ini adalah **Backend API** untuk sistem manajemen keuangan dan stok produk Sidewalk.Go. Backend ini menyediakan RESTful API yang dikonsumsi oleh Frontend Dashboard.

---

## 🏗️ Arsitektur

```
┌─────────────────────┐         HTTP/HTTPS          ┌─────────────────────┐
│                     │    ◄──────────────────►     │                     │
│  FE-DASHBOARD-SW    │                              │    BE-API-SW        │
│  (Frontend)         │    API Calls (JWT Auth)     │  (Backend API)      │
│                     │                              │                     │
└─────────────────────┘                              └─────────────────────┘
                                                              │
                                                              │
                                                              ▼
                                                        PostgreSQL DB
                                                   (SistemDatabaseSidewalkgo)
```

---

## 🚀 Quick Start

### 1. Install Dependencies
```bash
cd BE-API-SW
composer install
```

### 2. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
```

### 3. Configure Database
Edit `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=SistemDatabaseSidewalkgo
DB_USERNAME=postgres
DB_PASSWORD=270700
```

### 4. Run Migrations
```bash
php artisan migrate
```

### 5. Seed Database (Optional)
```bash
php artisan db:seed
```

### 6. Run API Server
```bash
php artisan serve --port=8000
```

### 7. Test API
```
GET http://localhost:8000/api/produk
POST http://localhost:8000/api/login
```

---

## 📁 Struktur Folder

```
BE-API-SW/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php              # Authentication
│   │   │   ├── PenggunaController.php          # User management
│   │   │   ├── CabangController.php            # Branch management
│   │   │   ├── ProdukController.php            # Product management
│   │   │   ├── StokController.php              # Stock management
│   │   │   ├── PenjualanController.php         # Sales management
│   │   │   ├── DetailPenjualanController.php   # Sales details
│   │   │   ├── ClosingHarianController.php     # Daily closing
│   │   │   ├── LaporanKeuanganController.php   # Financial reports
│   │   │   └── ProfileController.php           # User profile
│   │   └── Middleware/
│   │       ├── JwtMiddleware.php               # JWT authentication
│   │       ├── RoleMiddleware.php              # Role-based access
│   │       └── JWTFromCookie.php               # JWT from cookie
│   └── Models/
│       ├── Pengguna.php                        # User model
│       ├── Cabang.php                          # Branch model
│       ├── Produk.php                          # Product model
│       ├── Stok.php                            # Stock model
│       ├── Penjualan.php                       # Sales model
│       ├── DetailPenjualan.php                 # Sales detail model
│       ├── ClosingHarian.php                   # Daily closing model
│       └── LaporanKeuangan.php                 # Financial report model
├── database/
│   ├── migrations/                             # Database migrations
│   └── seeders/                                # Database seeders
├── routes/
│   └── api.php                                 # API routes
├── config/
│   ├── database.php                            # Database config
│   ├── jwt.php                                 # JWT config
│   └── cors.php                                # CORS config
└── .env                                        # Environment variables
```

---

## 🔌 API Endpoints

### Authentication
```
POST   /api/login                    # Login
POST   /api/logout                   # Logout (requires auth)
GET    /api/profile                  # Get user profile (requires auth)
PUT    /api/profile                  # Update profile (requires auth)
```

### Pengguna (User Management)
```
GET    /api/role                     # Get all users (requires auth)
POST   /api/role                     # Create user (owner, admin only)
PUT    /api/role/{id}                # Update user (owner, admin only)
DELETE /api/role/{id}                # Delete user (owner, admin only)
```

### Produk (Products)
```
GET    /api/produk                   # Get all products (public)
GET    /api/produk/{id}              # Get product detail (requires auth)
POST   /api/produk                   # Create product (kepala_gudang only)
PUT    /api/produk/{id}              # Update product (kepala_gudang only)
DELETE /api/produk/{id}              # Delete product (kepala_gudang only)
```

### Cabang (Branches)
```
GET    /api/cabang                   # Get all branches (public)
GET    /api/cabang/{id}              # Get branch detail (requires auth)
POST   /api/cabang                   # Create branch (admin only)
PUT    /api/cabang/{id}              # Update branch (admin only)
DELETE /api/cabang/{id}              # Delete branch (admin only)
```

### Stok (Stock)
```
GET    /api/stok                     # Get all stock (public)
POST   /api/stok                     # Create stock (kepala_gudang only)
PUT    /api/stok/{id}                # Update stock (kepala_gudang only)
```

### Penjualan (Sales)
```
GET    /api/penjualan                # Get all sales (requires auth)
POST   /api/penjualan                # Create sale (raider, admin only)
GET    /api/penjualan/{id}           # Get sale detail (requires auth)
```

### Laporan Keuangan (Financial Reports)
```
GET    /api/laporan-keuangan         # Get all reports (admin, owner only)
POST   /api/laporan-keuangan         # Create report (admin, owner only)
GET    /api/laporan-keuangan/{id}    # Get report detail (admin, owner only)
```

---

## 🔐 Authentication

### JWT Token
Backend menggunakan JWT (JSON Web Token) untuk authentication.

### Login Flow
1. POST `/api/login` dengan username & password
2. Backend validate credentials
3. Backend generate JWT token
4. Backend return token di response body dan set di cookie
5. Frontend simpan token
6. Setiap request include token di header atau cookie

### Request Header
```
Authorization: Bearer {token}
```

### Cookie
```
jwt_token={token}
```

---

## 👥 User Roles

| Role | Description |
|------|-------------|
| **owner** | Full access ke semua fitur |
| **admin** | Manage transaksi & laporan keuangan |
| **kepala_gudang** | Manage stok & produk |
| **raider** | Input transaksi penjualan |

---

## 🗄️ Database

### Database Name
```
SistemDatabaseSidewalkgo
```

### Tables
- `pengguna` - Users
- `cabang` - Branches
- `produk` - Products
- `stok` - Stock
- `penjualan` - Sales
- `detail_penjualan` - Sales details
- `closing_harian` - Daily closing
- `laporan_keuangan` - Financial reports

---

## 🔧 Development

### Run Development Server
```bash
php artisan serve --port=8000
```

### Run Migrations
```bash
php artisan migrate
```

### Rollback Migrations
```bash
php artisan migrate:rollback
```

### Seed Database
```bash
php artisan db:seed
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

---

## 🚀 Deployment

### 1. Optimize Laravel
```bash
php artisan config:cache
php artisan route:cache
composer install --optimize-autoloader --no-dev
```

### 2. Set Environment
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=pgsql
DB_HOST=your-db-host
DB_DATABASE=SistemDatabaseSidewalkgo
```

### 3. Run Migrations
```bash
php artisan migrate --force
```

---

## 📝 Catatan Penting

### ⚠️ Backend Hanya API
Backend ini **HANYA** menyediakan API. Tidak ada UI/views.

### ⚠️ CORS Configuration
Pastikan CORS sudah dikonfigurasi untuk allow frontend domain.

### ⚠️ Database Required
Backend **HARUS** terhubung ke PostgreSQL database.

---

**Version**: 1.0.0  
**Type**: Backend API  
**Framework**: Laravel 11  
**Database**: PostgreSQL  
**Last Updated**: November 23, 2025

