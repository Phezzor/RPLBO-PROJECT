<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\StokWebController;
use App\Http\Controllers\LaporanWebController;

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Authentication Routes (jika belum ada)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', function () {
    // Logout logic
    return redirect()->route('login');
})->name('logout');

// Dashboard Routes (Protected)
Route::middleware(['auth'])->group(function () {

    // Dashboard Overview
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // Transaksi Routes
    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', function () {
            return view('transaksi.index');
        })->name('index');
    });

    // Stok Produk Routes (Admin Gudang & Owner)
    Route::prefix('stok')->name('stok.')->middleware('role:kepala_gudang,owner')->group(function () {
        Route::get('/', function () {
            return view('stok.index');
        })->name('index');
    });

    // Laporan Keuangan Routes (Admin & Owner)
    Route::prefix('laporan')->name('laporan.')->middleware('role:admin,owner')->group(function () {
        Route::get('/', function () {
            return view('laporan.index');
        })->name('index');
    });
});
