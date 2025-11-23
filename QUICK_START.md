# ⚡ Quick Start Guide - Sidewalk.Go Dashboard

## 🎯 Langkah Cepat untuk Memulai

### 1️⃣ Install Dependencies (5 menit)
```bash
cd BE-API-SW

# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 2️⃣ Setup Environment (2 menit)
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Generate JWT secret
php artisan jwt:secret
```

### 3️⃣ Konfigurasi Database (3 menit)
Edit file `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=SistemDatabaseSidewalkgo
DB_USERNAME=postgres
DB_PASSWORD=270700
```

### 4️⃣ Run Migrations (2 menit)
```bash
php artisan migrate
```

### 5️⃣ Build Frontend Assets (3 menit)
```bash
# Development mode (dengan hot reload)
npm run dev

# ATAU Production mode
npm run build
```

### 6️⃣ Start Server (1 menit)
```bash
# Terminal 1: Laravel Server
php artisan serve

# Terminal 2 (jika dev mode): Vite Dev Server
npm run dev
```

### 7️⃣ Akses Dashboard
Buka browser dan akses:
```
http://localhost:8000/login
```

## 🔑 Default Login Credentials

Gunakan credentials yang sudah ada di database:

```
Username: [sesuai data di database]
Password: [sesuai data di database]
```

## 📋 Checklist Setup

- [ ] Composer dependencies installed
- [ ] NPM dependencies installed
- [ ] .env file configured
- [ ] Database connected
- [ ] Migrations run successfully
- [ ] Assets built (npm run build)
- [ ] Server running (php artisan serve)
- [ ] Can access login page
- [ ] Can login successfully
- [ ] Dashboard loads correctly

## 🎨 Fitur yang Bisa Langsung Dicoba

### 1. Dashboard Overview
- Lihat statistik real-time
- Grafik penjualan mingguan
- Cards dengan animasi hover

### 2. Transaksi
- Lihat daftar transaksi
- Filter berdasarkan tanggal
- Tambah transaksi baru (jika role Raider/Admin)

### 3. Stok Produk
- Monitor stok real-time
- Lihat status stok (Tersedia/Menipis/Habis)
- Update stok (jika role Kepala Gudang)

### 4. Laporan Keuangan
- Lihat laporan keuangan
- Filter berdasarkan periode
- Buat laporan baru (jika role Admin)

## 🚨 Troubleshooting Cepat

### Problem: Assets tidak muncul
```bash
npm run build
php artisan view:clear
```

### Problem: Error 500
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Problem: JWT Token Error
```bash
php artisan jwt:secret
php artisan config:clear
```

### Problem: Database Connection Error
- Cek PostgreSQL sudah running
- Cek credentials di .env
- Cek database sudah dibuat

### Problem: Tailwind classes tidak work
```bash
# Pastikan Vite running
npm run dev

# Atau rebuild
npm run build
```

## 📱 Test Responsive

Setelah dashboard berjalan, test di berbagai ukuran layar:

1. **Desktop**: > 1024px - Full layout dengan sidebar
2. **Tablet**: 768px - 1024px - Adjusted layout
3. **Mobile**: < 768px - Mobile-optimized

## 🎯 Next Steps

Setelah setup berhasil:

1. ✅ Explore semua fitur dashboard
2. ✅ Test role-based access control
3. ✅ Coba tambah data transaksi
4. ✅ Update stok produk
5. ✅ Buat laporan keuangan
6. ✅ Test responsive di mobile

## 📚 Dokumentasi Lengkap

Untuk dokumentasi lengkap, lihat:
- `README_DASHBOARD.md` - Dokumentasi lengkap
- `FRONTEND_STRUCTURE.md` - Struktur folder detail

## 💡 Tips Development

### Hot Reload Development
```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

Setiap perubahan di CSS/JS akan auto-reload!

### Production Build
```bash
npm run build
```

Untuk deployment production, selalu build assets terlebih dahulu.

### Clear Cache Saat Development
```bash
# Clear semua cache
php artisan optimize:clear

# Atau satu per satu
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## 🎨 Customization

### Ubah Warna
Edit `resources/views/layouts/app.blade.php`:
```css
:root {
    --primary-orange: #FF6B35;
    --secondary-orange: #FF8C42;
    --dark-orange: #D84315;
}
```

### Tambah Custom CSS
Edit `resources/css/app.css`

### Tambah Custom JavaScript
Edit `resources/js/app.js`

## 🚀 Ready to Go!

Dashboard Sidewalk.Go siap digunakan! 🎉

Selamat menggunakan dan semoga membantu mengelola bisnis kopi keliling Anda!

---

**Need Help?** Hubungi tim development untuk support.

