@extends('layouts.app')

@section('title', 'Stok Produk')
@section('page-title', 'Stok Produk')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Manajemen Stok Produk</h3>
            <p class="text-gray-600 mt-1">Kelola stok produk di semua cabang</p>
        </div>
        
        @if(auth()->user()->role === 'kepala_gudang')
        <button onclick="openAddStokModal()" class="px-6 py-3 bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Stok
        </button>
        @endif
    </div>
    
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Total Produk</p>
                    <h3 class="text-3xl font-bold mt-2">24</h3>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Stok Tersedia</p>
                    <h3 class="text-3xl font-bold mt-2">1,245</h3>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Stok Menipis</p>
                    <h3 class="text-3xl font-bold mt-2">5</h3>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Stok Habis</p>
                    <h3 class="text-3xl font-bold mt-2">2</h3>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Filter -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Produk</label>
                <input type="text" id="searchProduct" placeholder="Nama produk..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cabang</label>
                <select id="filterCabang" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent">
                    <option value="">Semua Cabang</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Stok</label>
                <select id="filterStatus" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="available">Tersedia</option>
                    <option value="low">Menipis</option>
                    <option value="empty">Habis</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- Stock Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold">ID Produk</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Nama Produk</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Cabang</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Jumlah Stok</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody id="stokTableBody" class="divide-y divide-gray-200">
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <p class="text-lg font-medium">Memuat data stok...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Stok Modal -->
<div id="stokModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4">
        <div class="bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] px-6 py-4 rounded-t-2xl">
            <h3 class="text-xl font-bold text-white">Update Stok Produk</h3>
        </div>
        <form id="stokForm" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Produk</label>
                <select name="produk_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]">
                    <option value="">Pilih Produk</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cabang</label>
                <select name="cabang_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]">
                    <option value="">Pilih Cabang</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Stok</label>
                <input type="number" name="jumlah" required min="0" placeholder="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]">
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeStokModal()" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] text-white rounded-lg font-medium hover:shadow-lg transition-all">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Modal Functions
    function openAddStokModal() {
        document.getElementById('stokModal').classList.remove('hidden');
        document.getElementById('stokModal').classList.add('flex');
    }

    function closeStokModal() {
        document.getElementById('stokModal').classList.add('hidden');
        document.getElementById('stokModal').classList.remove('flex');
    }

    // Load Stock Data
    async function loadStok() {
        try {
            const response = await fetch('/api/stok', {
                headers: {
                    'Accept': 'application/json',
                }
            });

            const result = await response.json();
            const tbody = document.getElementById('stokTableBody');

            if (result.data && result.data.length > 0) {
                tbody.innerHTML = result.data.map(item => {
                    const jumlah = parseInt(item.jumlah);
                    let statusBadge = '';
                    let statusClass = '';

                    if (jumlah === 0) {
                        statusBadge = 'Habis';
                        statusClass = 'bg-red-100 text-red-800';
                    } else if (jumlah < 50) {
                        statusBadge = 'Menipis';
                        statusClass = 'bg-yellow-100 text-yellow-800';
                    } else {
                        statusBadge = 'Tersedia';
                        statusClass = 'bg-green-100 text-green-800';
                    }

                    return `
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">#${item.produk_id}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">${item.produk?.nama_produk || '-'}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">${item.produk?.kategori || '-'}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">${item.cabang?.nama_cabang || '-'}</td>
                            <td class="px-6 py-4 text-sm font-bold ${jumlah < 50 ? 'text-red-600' : 'text-green-600'}">${jumlah}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full ${statusClass}">
                                    ${statusBadge}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="editStok(${item.id})" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    `;
                }).join('');
            } else {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <p>Tidak ada data stok</p>
                        </td>
                    </tr>
                `;
            }
        } catch (error) {
            console.error('Error loading stock:', error);
        }
    }

    // Load on page ready
    document.addEventListener('DOMContentLoaded', loadStok);
</script>
@endpush

