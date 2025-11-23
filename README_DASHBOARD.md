# 🚀 Dashboard Sidewalk.Go - Coffee Management System

![Dashboard Preview](https://img.shields.io/badge/Laravel-11-red?style=for-the-badge&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.0-blue?style=for-the-badge&logo=tailwindcss)
![Chart.js](https://img.shields.io/badge/Chart.js-Latest-orange?style=for-the-badge&logo=chartdotjs)

## 📋 Deskripsi

Dashboard frontend modern untuk sistem pencatatan keuangan dan stok produk pada perusahaan kopi keliling **Sidewalk.Go**. Dibangun dengan Laravel + Blade, Tailwind CSS, dan Chart.js untuk memberikan pengalaman user yang optimal.

## ✨ Fitur Utama

### 🎯 Dashboard Overview
- **Real-time Statistics**: Total penjualan, stok tersedia, transaksi harian
- **Grafik Penjualan**: Visualisasi data penjualan mingguan dengan bar chart interaktif
- **Responsive Cards**: Kartu statistik dengan animasi hover yang menarik
- **Auto-refresh**: Data diperbarui secara otomatis

### 💰 Transaksi
- **Daftar Transaksi**: Tabel lengkap dengan pagination
- **Filter & Search**: Cari berdasarkan tanggal, metode pembayaran, cabang
- **Tambah Transaksi**: Form modal untuk input transaksi baru (Raider & Admin)
- **Detail View**: Lihat detail lengkap setiap transaksi

### 📦 Stok Produk
- **Monitoring Real-time**: Pantau stok di semua cabang
- **Status Badge**: Visual indicator (Tersedia/Menipis/Habis)
- **Summary Cards**: Total produk, stok tersedia, menipis, habis
- **Update Stok**: Form untuk update jumlah stok (Kepala Gudang)

### 📊 Laporan Keuangan
- **Laporan Periodik**: Buat dan kelola laporan keuangan
- **Filter Periode**: Range date picker untuk filter data
- **Summary Cards**: Total pendapatan, rata-rata harian
- **Export**: Download laporan ke PDF/Excel (coming soon)

## 👥 Role-Based Access Control

| Role | Dashboard | Transaksi | Stok | Laporan |
|------|-----------|-----------|------|---------|
| **Owner** | ✅ | ✅ | ✅ | ✅ |
| **Admin (Finance)** | ✅ | ✅ | ❌ | ✅ |
| **Kepala Gudang** | ✅ | ✅ | ✅ | ❌ |
| **Raider (Kasir)** | ✅ | ✅ | ❌ | ❌ |

## 🎨 Design System

### Color Palette
```css
--primary-orange: #FF6B35
--secondary-orange: #FF8C42
--dark-orange: #D84315
--light-orange: #FFE5D9
--cream: #FFF8F0
--dark-red: #8B0000
```

### Typography
- **Font**: Inter, Instrument Sans
- **Headings**: Bold, 2xl-4xl
- **Body**: Regular, sm-base

### Components
- Modern gradient buttons
- Smooth hover animations
- Custom scrollbar
- Loading spinners
- Toast notifications

## 🛠️ Tech Stack

### Frontend
- **Framework**: Laravel 11 + Blade
- **CSS**: Tailwind CSS v4
- **JavaScript**: Vanilla JS + Alpine.js
- **Charts**: Chart.js
- **Icons**: Heroicons (SVG)
- **Build Tool**: Vite

### Backend Integration
- **API**: RESTful API dengan JWT Authentication
- **Database**: PostgreSQL
- **Auth**: JWT Token via Cookie

## 📁 Struktur Folder

```
BE-API-SW/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   └── partials/
│   │   │       ├── sidebar.blade.php
│   │   │       └── navbar.blade.php
│   │   ├── auth/
│   │   │   └── login.blade.php
│   │   ├── dashboard/
│   │   │   └── index.blade.php
│   │   ├── transaksi/
│   │   │   └── index.blade.php
│   │   ├── stok/
│   │   │   └── index.blade.php
│   │   └── laporan/
│   │       └── index.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── routes/
│   ├── web.php
│   └── api.php
└── app/
    └── Http/
        └── Middleware/
            ├── WebAuthMiddleware.php
            └── RoleMiddleware.php
```

## 🚀 Instalasi & Setup

### 1. Clone Repository
```bash
cd BE-API-SW
```

### 2. Install Dependencies
```bash
# PHP Dependencies
composer install

# Node Dependencies
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=SistemDatabaseSidewalkgo
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Build Assets
```bash
# Development (with hot reload)
npm run dev

# Production
npm run build
```

### 7. Start Server
```bash
php artisan serve
```

### 8. Akses Dashboard
```
http://localhost:8000/dashboard
```

## 🔐 Authentication

### Login
- **URL**: `/login`
- **Method**: POST
- **Endpoint**: `/api/login`
- **Body**:
```json
{
  "username": "your_username",
  "password": "your_password"
}
```

### Logout
- **URL**: `/logout`
- **Method**: POST
- **Endpoint**: `/api/logout`

## 📡 API Endpoints

### Dashboard
```javascript
GET /api/penjualan          // Get all sales
GET /api/stok               // Get all stock
GET /api/laporan-keuangan   // Get financial reports
```

### Transaksi
```javascript
GET    /api/penjualan       // List transactions
POST   /api/penjualan       // Create transaction
PUT    /api/penjualan/{id}  // Update transaction
DELETE /api/penjualan/{id}  // Delete transaction
```

### Stok
```javascript
GET    /api/stok            // List stock
POST   /api/stok            // Add stock
PUT    /api/stok/{id}       // Update stock
DELETE /api/stok/{id}       // Delete stock
```

### Laporan
```javascript
GET    /api/laporan-keuangan       // List reports
POST   /api/laporan-keuangan       // Create report
GET    /api/laporan-keuangan/{id}  // Get report detail
PUT    /api/laporan-keuangan/{id}  // Update report
DELETE /api/laporan-keuangan/{id}  // Delete report
```

## 📱 Responsive Design

- **Mobile**: < 768px
- **Tablet**: 768px - 1024px  
- **Desktop**: > 1024px

Semua halaman fully responsive dengan breakpoints Tailwind CSS.

## 🎯 Best Practices

### Security
- ✅ CSRF Protection
- ✅ JWT Authentication
- ✅ XSS Prevention
- ✅ Input Validation
- ✅ Role-based Access Control

### Performance
- ✅ Lazy Loading
- ✅ Asset Optimization
- ✅ Caching Strategy
- ✅ Minified CSS/JS

### Code Quality
- ✅ Clean Code
- ✅ Reusable Components
- ✅ Proper Documentation
- ✅ Error Handling

## 🐛 Troubleshooting

### Assets tidak muncul
```bash
npm run build
php artisan view:clear
php artisan cache:clear
```

### Tailwind classes tidak work
```bash
npm run dev
# Pastikan Vite server running
```

### API CORS Error
Check `config/cors.php` dan pastikan domain sudah ditambahkan

### JWT Token Error
```bash
php artisan jwt:secret
php artisan config:clear
```

## 📝 Development Tips

1. **Hot Reload**: Gunakan `npm run dev` untuk development
2. **Clear Cache**: Jalankan `php artisan view:clear` setelah update blade
3. **Build Production**: Gunakan `npm run build` sebelum deploy
4. **Test Responsive**: Test di berbagai device sizes

## 🔄 Update & Maintenance

```bash
# Update dependencies
composer update
npm update

# Clear all cache
php artisan optimize:clear

# Rebuild assets
npm run build
```

## 📞 Support

Untuk pertanyaan atau issue, silakan hubungi tim development.

---

**Developed with ❤️ by Senior Frontend Developer**  
**Version**: 1.0.0  
**Last Updated**: November 2025

