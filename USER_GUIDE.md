# 📖 User Guide - Dashboard Sidewalk.Go

## 🎯 Panduan Penggunaan Dashboard

### 🔐 Login

1. Buka browser dan akses: `http://localhost:8000/login`
2. Masukkan **Username** dan **Password**
3. Klik tombol **"Masuk"**
4. Jika berhasil, Anda akan diarahkan ke Dashboard

**Tips:**
- Pastikan username dan password benar
- Jika lupa password, hubungi administrator
- Gunakan browser modern (Chrome, Firefox, Edge)

---

## 🏠 Dashboard Overview

### Halaman Utama
Setelah login, Anda akan melihat:

#### 1. **Kartu Statistik** (3 kartu di bagian atas)
- **💰 Total Penjualan**: Menampilkan total penjualan dan persentase perubahan
- **📦 Stok Tersedia**: Menampilkan persentase stok yang tersedia
- **📝 Transaksi Harian**: Menampilkan jumlah transaksi hari ini

#### 2. **Grafik Penjualan**
- Grafik batang menampilkan penjualan mingguan
- **Biru**: Target penjualan
- **Orange**: Penjualan aktual
- Hover pada batang untuk melihat detail angka

#### 3. **Sidebar Menu**
- **Dashboard**: Halaman utama
- **Transaksi**: Kelola transaksi penjualan
- **Stok Produk**: Monitor dan kelola stok
- **Laporan Keuangan**: Buat dan lihat laporan

---

## 💰 Transaksi

### Melihat Daftar Transaksi

1. Klik menu **"Transaksi"** di sidebar
2. Anda akan melihat tabel dengan kolom:
   - ID Transaksi
   - Tanggal
   - Cabang
   - Kasir
   - Total
   - Metode Pembayaran

### Filter Transaksi

**Filter berdasarkan Tanggal:**
1. Pilih **Tanggal Mulai** dan **Tanggal Akhir**
2. Klik tombol **"Filter"**

**Filter berdasarkan Metode Pembayaran:**
1. Pilih metode: Cash, QRIS, atau Transfer
2. Data akan otomatis terfilter

**Search:**
1. Ketik kata kunci di kolom pencarian
2. Tekan Enter atau klik ikon search

### Tambah Transaksi Baru (Raider & Admin)

1. Klik tombol **"+ Tambah Transaksi"**
2. Isi form:
   - **Tanggal**: Pilih tanggal transaksi
   - **Cabang**: Pilih cabang
   - **Metode Pembayaran**: Cash/QRIS/Transfer
   - **Produk**: Pilih produk dan jumlah
3. Klik **"Simpan"**

**Tips:**
- Pastikan semua field terisi
- Cek kembali jumlah sebelum simpan
- Transaksi tidak bisa diedit setelah disimpan

---

## 📦 Stok Produk

### Melihat Stok

1. Klik menu **"Stok Produk"** di sidebar
2. Anda akan melihat:
   - **Summary Cards**: Total produk, stok tersedia, menipis, habis
   - **Tabel Stok**: Daftar semua produk dengan status

### Status Stok

- **✅ Tersedia** (Hijau): Stok > 50
- **⚠️ Menipis** (Kuning): Stok 1-50
- **❌ Habis** (Merah): Stok = 0

### Filter Stok

**Filter berdasarkan Cabang:**
1. Pilih cabang dari dropdown
2. Data akan otomatis terfilter

**Filter berdasarkan Status:**
1. Pilih status: Tersedia/Menipis/Habis
2. Data akan otomatis terfilter

**Search Produk:**
1. Ketik nama produk di kolom pencarian
2. Tekan Enter

### Update Stok (Kepala Gudang)

1. Klik tombol **"Edit"** pada produk yang ingin diupdate
2. Masukkan **Jumlah Stok** baru
3. Klik **"Update Stok"**

**Tips:**
- Update stok secara berkala
- Perhatikan produk dengan status "Menipis"
- Koordinasi dengan supplier untuk restock

---

## 📊 Laporan Keuangan

### Melihat Laporan

1. Klik menu **"Laporan Keuangan"** di sidebar
2. Anda akan melihat:
   - **Summary Cards**: Total pendapatan, rata-rata harian
   - **Tabel Laporan**: Daftar semua laporan

### Filter Laporan

**Filter berdasarkan Periode:**
1. Pilih **Periode Awal** dan **Periode Akhir**
2. Klik tombol **"Filter"**

**Filter berdasarkan Cabang:**
1. Pilih cabang dari dropdown
2. Data akan otomatis terfilter

### Buat Laporan Baru (Admin)

1. Klik tombol **"+ Buat Laporan"**
2. Isi form:
   - **Periode Awal**: Tanggal mulai periode
   - **Periode Akhir**: Tanggal akhir periode
   - **Cabang**: Pilih cabang
3. Klik **"Buat Laporan"**

**Tips:**
- Buat laporan setiap akhir bulan
- Simpan laporan untuk arsip
- Review laporan sebelum submit

### Download Laporan (Coming Soon)

1. Klik tombol **"Download"** pada laporan
2. Pilih format: PDF atau Excel
3. File akan otomatis terdownload

---

## 👤 Profil & Pengaturan

### Lihat Profil

1. Klik **nama user** di pojok kanan atas
2. Pilih **"Profil"**
3. Anda akan melihat informasi user

### Logout

1. Klik **nama user** di pojok kanan atas
2. Pilih **"Logout"**
3. Anda akan diarahkan ke halaman login

---

## 🎨 Tips & Tricks

### Keyboard Shortcuts
- `Esc` - Tutup modal
- `Ctrl + F` - Search di halaman
- `F5` - Refresh halaman

### Best Practices
- ✅ Logout setelah selesai menggunakan
- ✅ Jangan share username/password
- ✅ Update data secara berkala
- ✅ Backup data penting
- ✅ Gunakan browser terbaru

### Responsive Design
Dashboard dapat diakses dari:
- 💻 **Desktop**: Full features
- 📱 **Tablet**: Optimized layout
- 📱 **Mobile**: Touch-friendly

---

## 🚨 Troubleshooting

### Tidak Bisa Login
- Cek username dan password
- Pastikan koneksi internet stabil
- Clear browser cache
- Hubungi administrator

### Data Tidak Muncul
- Refresh halaman (F5)
- Cek filter yang aktif
- Cek koneksi internet
- Logout dan login kembali

### Grafik Tidak Muncul
- Refresh halaman
- Clear browser cache
- Gunakan browser lain
- Hubungi IT support

### Error Saat Submit Form
- Cek semua field sudah terisi
- Cek format data (tanggal, angka)
- Cek koneksi internet
- Coba lagi beberapa saat

---

## 📞 Bantuan & Support

### Hubungi Kami
- **Email**: support@sidewalk.go
- **Phone**: +62 xxx xxxx xxxx
- **WhatsApp**: +62 xxx xxxx xxxx

### Jam Operasional
- Senin - Jumat: 08:00 - 17:00 WIB
- Sabtu: 08:00 - 12:00 WIB
- Minggu & Libur: Tutup

---

## 📝 FAQ

**Q: Bagaimana cara mengubah password?**  
A: Hubungi administrator untuk reset password.

**Q: Apakah bisa akses dari HP?**  
A: Ya, dashboard fully responsive dan bisa diakses dari HP.

**Q: Berapa lama data tersimpan?**  
A: Data tersimpan permanen di database.

**Q: Bisa export data ke Excel?**  
A: Fitur export sedang dalam pengembangan (coming soon).

**Q: Bagaimana cara menambah user baru?**  
A: Hubungi administrator untuk menambah user baru.

---

**Selamat menggunakan Dashboard Sidewalk.Go! ☕**

**Version**: 1.0.0  
**Last Updated**: November 2025

