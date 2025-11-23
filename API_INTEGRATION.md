# 🔌 API Integration Guide - Sidewalk.Go Dashboard

## 📡 Base URL

```
Development: http://localhost:8000/api
Production: https://yourdomain.com/api
```

## 🔐 Authentication

Dashboard menggunakan JWT (JSON Web Token) authentication yang disimpan di HTTP-only cookie.

### Login Flow

```javascript
// 1. User submit login form
const response = await fetch('/api/login', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    body: JSON.stringify({
        username: 'your_username',
        password: 'your_password'
    })
});

// 2. Server response dengan JWT token
{
    "success": true,
    "message": "Login berhasil",
    "data": {
        "user": {
            "id": 1,
            "username": "admin",
            "nama": "Admin User",
            "role": "admin",
            "email": "admin@sidewalk.go"
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGc..."
    }
}

// 3. Token disimpan di cookie (automatic)
// Cookie name: jwt_token
// HttpOnly: true
// Secure: true (production)
// SameSite: Lax
```

### Authenticated Requests

Semua request ke API akan otomatis menyertakan JWT token dari cookie:

```javascript
// Helper function di app.js
async function apiCall(endpoint, options = {}) {
    const defaultOptions = {
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        credentials: 'include' // Include cookies
    };

    const response = await fetch(`/api${endpoint}`, {
        ...defaultOptions,
        ...options,
        headers: {
            ...defaultOptions.headers,
            ...options.headers
        }
    });

    return await response.json();
}

// Usage
const data = await apiCall('/penjualan');
```

## 📊 API Endpoints

### 1. Authentication

#### Login
```http
POST /api/login
Content-Type: application/json

{
    "username": "admin",
    "password": "password123"
}

Response 200:
{
    "success": true,
    "message": "Login berhasil",
    "data": {
        "user": {...},
        "token": "..."
    }
}

Response 401:
{
    "success": false,
    "message": "Username atau password salah"
}
```

#### Logout
```http
POST /api/logout
Authorization: Bearer {token}

Response 200:
{
    "success": true,
    "message": "Logout berhasil"
}
```

#### Get Current User
```http
GET /api/user
Authorization: Bearer {token}

Response 200:
{
    "success": true,
    "data": {
        "id": 1,
        "username": "admin",
        "nama": "Admin User",
        "role": "admin",
        "email": "admin@sidewalk.go"
    }
}
```

### 2. Dashboard

#### Get Dashboard Stats
```http
GET /api/dashboard/stats
Authorization: Bearer {token}

Response 200:
{
    "success": true,
    "data": {
        "total_penjualan": 579000000,
        "total_penjualan_formatted": "Rp 579.000.000",
        "persentase_penjualan": 12.5,
        "stok_tersedia": 89,
        "persentase_stok": -5.7,
        "transaksi_harian": 5000,
        "persentase_transaksi": 17.3
    }
}
```

#### Get Sales Chart Data
```http
GET /api/dashboard/sales-chart?period=weekly
Authorization: Bearer {token}

Response 200:
{
    "success": true,
    "data": {
        "labels": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
        "target": [400, 400, 400, 400, 400, 400, 400],
        "actual": [350, 420, 380, 450, 410, 390, 430]
    }
}
```

### 3. Transaksi (Penjualan)

#### Get All Transactions
```http
GET /api/penjualan?page=1&per_page=10&search=&tanggal_mulai=&tanggal_akhir=&metode_pembayaran=
Authorization: Bearer {token}

Response 200:
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "tanggal": "2025-09-05",
                "cabang": {
                    "id": 1,
                    "nama": "Pusat"
                },
                "kasir": {
                    "id": 1,
                    "nama": "Andi"
                },
                "total": 150000,
                "total_formatted": "Rp 150.000",
                "metode_pembayaran": "cash",
                "items": [...]
            }
        ],
        "total": 100,
        "per_page": 10,
        "last_page": 10
    }
}
```

#### Create Transaction
```http
POST /api/penjualan
Authorization: Bearer {token}
Content-Type: application/json

{
    "tanggal": "2025-09-05",
    "cabang_id": 1,
    "kasir_id": 1,
    "metode_pembayaran": "cash",
    "items": [
        {
            "produk_id": 1,
            "jumlah": 2,
            "harga": 25000
        }
    ]
}

Response 201:
{
    "success": true,
    "message": "Transaksi berhasil ditambahkan",
    "data": {...}
}
```

### 4. Stok Produk

#### Get All Stock
```http
GET /api/stok?search=&cabang_id=&status=
Authorization: Bearer {token}

Response 200:
{
    "success": true,
    "data": [
        {
            "id": 1,
            "produk": {
                "id": 1,
                "nama": "Espresso",
                "kategori": "Coffee"
            },
            "cabang": {
                "id": 1,
                "nama": "Pusat"
            },
            "jumlah": 150,
            "status": "tersedia",
            "updated_at": "2025-09-05T10:00:00Z"
        }
    ]
}
```

#### Update Stock
```http
PUT /api/stok/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
    "jumlah": 200
}

Response 200:
{
    "success": true,
    "message": "Stok berhasil diupdate",
    "data": {...}
}
```

### 5. Laporan Keuangan

#### Get All Reports
```http
GET /api/laporan-keuangan?periode_awal=2025-09-01&periode_akhir=2025-09-30&cabang_id=
Authorization: Bearer {token}

Response 200:
{
    "success": true,
    "data": [
        {
            "id": 1,
            "periode_awal": "2025-09-01",
            "periode_akhir": "2025-09-30",
            "cabang": {
                "id": 1,
                "nama": "Pusat"
            },
            "total_pendapatan": 45000000,
            "total_pendapatan_formatted": "Rp 45.000.000",
            "dibuat_oleh": {
                "id": 1,
                "nama": "Admin A"
            },
            "created_at": "2025-09-05T10:00:00Z"
        }
    ]
}
```

#### Create Report
```http
POST /api/laporan-keuangan
Authorization: Bearer {token}
Content-Type: application/json

{
    "periode_awal": "2025-09-01",
    "periode_akhir": "2025-09-30",
    "cabang_id": 1
}

Response 201:
{
    "success": true,
    "message": "Laporan berhasil dibuat",
    "data": {...}
}
```

## 🛠️ Helper Functions

### Currency Formatter
```javascript
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

// Usage
formatCurrency(150000); // "Rp 150.000"
```

### Date Formatter
```javascript
function formatDate(dateString) {
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}

// Usage
formatDate('2025-09-05'); // "5 September 2025"
```

### Toast Notification
```javascript
function showToast(message, type = 'success') {
    // Implementation in app.js
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => toast.remove(), 3000);
}

// Usage
showToast('Data berhasil disimpan', 'success');
showToast('Terjadi kesalahan', 'error');
```

## 🔒 Error Handling

### Standard Error Response
```json
{
    "success": false,
    "message": "Error message here",
    "errors": {
        "field_name": ["Validation error message"]
    }
}
```

### HTTP Status Codes
- `200` - Success
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

### Error Handling Example
```javascript
try {
    const response = await apiCall('/penjualan', {
        method: 'POST',
        body: JSON.stringify(data)
    });
    
    if (response.success) {
        showToast(response.message, 'success');
    } else {
        showToast(response.message, 'error');
    }
} catch (error) {
    console.error('API Error:', error);
    showToast('Terjadi kesalahan koneksi', 'error');
}
```

## 📝 Notes

- Semua request harus menyertakan CSRF token di header
- JWT token otomatis disertakan via cookie
- Response selalu dalam format JSON
- Tanggal menggunakan format ISO 8601 (YYYY-MM-DD)
- Currency dalam format Rupiah (IDR)

---

**Last Updated**: November 2025

