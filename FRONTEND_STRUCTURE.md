# 📁 Struktur Folder Frontend Dashboard Sidewalk.Go

## 🎯 Overview
Dashboard frontend untuk sistem pencatatan keuangan dan stok produk Sidewalk.Go menggunakan Laravel + Blade dengan desain modern dan user-friendly.

## 📂 Struktur Folder

```
BE-API-SW/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php                 # Master layout utama
│   │   │   └── partials/
│   │   │       ├── sidebar.blade.php         # Sidebar navigation
│   │   │       └── navbar.blade.php          # Top navbar
│   │   │
│   │   ├── auth/
│   │   │   └── login.blade.php               # Halaman login
│   │   │
│   │   ├── dashboard/
│   │   │   └── index.blade.php               # Dashboard overview dengan grafik
│   │   │
│   │   ├── transaksi/
│   │   │   └── index.blade.php               # Halaman transaksi penjualan
│   │   │
│   │   ├── stok/
│   │   │   └── index.blade.php               # Halaman stok produk
│   │   │
│   │   └── laporan/
│   │       └── index.blade.php               # Halaman laporan keuangan
│   │
│   ├── css/
│   │   └── app.css                           # Custom CSS dengan Tailwind
│   │
│   └── js/
│       └── app.js                            # JavaScript utama
│
├── routes/
│   └── web.php                               # Web routes untuk dashboard
│
└── public/
    └── build/                                # Compiled assets (generated)
```

## 🎨 Desain & Warna

### Color Palette
- **Primary Orange**: `#FF6B35`
- **Secondary Orange**: `#FF8C42`
- **Dark Orange**: `#D84315`
- **Light Orange**: `#FFE5D9`
- **Cream Background**: `#FFF8F0`
- **Dark Red**: `#8B0000`

### Typography
- Font Family: Inter, Instrument Sans, system-ui
- Heading: Bold, 2xl-4xl
- Body: Regular, sm-base

## 🔐 Role-Based Access

### 1. Owner
- ✅ Dashboard Overview
- ✅ Transaksi
- ✅ Stok Produk
- ✅ Laporan Keuangan

### 2. Admin (Finance)
- ✅ Dashboard Overview
- ✅ Transaksi
- ✅ Laporan Keuangan

### 3. Kepala Gudang
- ✅ Dashboard Overview
- ✅ Transaksi
- ✅ Stok Produk

### 4. Raider (Kasir Lapangan)
- ✅ Dashboard Overview
- ✅ Transaksi

## 📊 Fitur Dashboard

### 1. Dashboard Overview (`/dashboard`)
- **Stats Cards**: Total Penjualan, Stok Tersedia, Transaksi Harian
- **Grafik Penjualan**: Bar chart mingguan dengan Chart.js
- **Real-time Data**: Update otomatis dari API

### 2. Transaksi (`/transaksi`)
- **Daftar Transaksi**: Tabel dengan pagination
- **Filter**: Tanggal, metode pembayaran, cabang
- **Tambah Transaksi**: Modal form (untuk raider & admin)
- **Detail Transaksi**: View detail per transaksi

### 3. Stok Produk (`/stok`)
- **Summary Cards**: Total produk, stok tersedia, menipis, habis
- **Tabel Stok**: Real-time stock monitoring
- **Update Stok**: Modal form (untuk kepala gudang)
- **Status Badge**: Visual indicator (tersedia/menipis/habis)

### 4. Laporan Keuangan (`/laporan`)
- **Summary Cards**: Total pendapatan, rata-rata harian
- **Filter Periode**: Range date picker
- **Buat Laporan**: Modal form (untuk admin)
- **Download**: Export laporan ke PDF/Excel

## 🛠️ Teknologi Stack

### Frontend
- **Framework**: Laravel Blade
- **CSS**: Tailwind CSS v4
- **JavaScript**: Vanilla JS + Alpine.js
- **Charts**: Chart.js
- **Icons**: Heroicons (SVG)

### Build Tools
- **Vite**: Modern build tool
- **PostCSS**: CSS processing

## 🚀 Cara Menggunakan

### 1. Install Dependencies
```bash
cd BE-API-SW
npm install
```

### 2. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 3. Akses Dashboard
```
http://localhost:8000/dashboard
```

## 📱 Responsive Design
- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

## 🔄 API Integration

### Endpoints yang Digunakan
```javascript
// Dashboard
GET /api/penjualan
GET /api/stok
GET /api/laporan-keuangan

// Transaksi
GET /api/penjualan
POST /api/penjualan
PUT /api/penjualan/{id}

// Stok
GET /api/stok
POST /api/stok
PUT /api/stok/{id}

// Laporan
GET /api/laporan-keuangan
POST /api/laporan-keuangan
GET /api/laporan-keuangan/{id}
```

## 🎯 Best Practices

### 1. Struktur Blade
- Gunakan `@extends` untuk inheritance
- Pisahkan components ke `partials/`
- Gunakan `@section` dan `@yield` untuk content

### 2. JavaScript
- Fetch API untuk AJAX calls
- Async/await untuk asynchronous operations
- Error handling yang proper

### 3. CSS
- Utility-first dengan Tailwind
- Custom classes untuk reusable components
- Responsive design dengan breakpoints

### 4. Security
- CSRF token di semua form
- Input validation
- XSS protection

## 📝 Maintenance Tips

1. **Update Dependencies**: Jalankan `npm update` secara berkala
2. **Clear Cache**: `php artisan view:clear` setelah update blade
3. **Rebuild Assets**: `npm run build` sebelum deploy
4. **Test Responsive**: Test di berbagai device sizes

## 🐛 Troubleshooting

### Assets tidak muncul
```bash
npm run build
php artisan view:clear
```

### Tailwind classes tidak work
```bash
npm run dev
# Pastikan Vite running
```

### API error
- Cek CORS settings
- Pastikan API endpoint benar
- Cek authentication token

## 👥 Kontributor
- Frontend Developer: Senior Professional (5 tahun pengalaman)
- Design: Modern, User-friendly, Professional

---

**Last Updated**: November 2025
**Version**: 1.0.0

