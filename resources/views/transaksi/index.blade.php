@extends('layouts.app')

@section('title', 'Transaksi')
@section('page-title', 'Transaksi')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Transaksi</h3>
            <p class="text-gray-600 mt-1">Kelola semua transaksi penjualan</p>
        </div>
        
        @if(in_array(auth()->user()->role ?? 'raider', ['raider', 'admin']))
        <button onclick="openAddModal()" class="px-6 py-3 bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Transaksi
        </button>
        @endif
    </div>
    
    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Transaksi</label>
                <input type="text" id="searchInput" placeholder="Cari ID atau keterangan..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" id="startDate" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                <input type="date" id="endDate" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                <select id="paymentMethod" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent">
                    <option value="">Semua</option>
                    <option value="cash">Cash</option>
                    <option value="qris">QRIS</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- Transactions Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold">ID Transaksi</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Cabang</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Kasir</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Total</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Metode</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody id="transactionTableBody" class="divide-y divide-gray-200">
                    <!-- Data will be loaded via JavaScript -->
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-lg font-medium">Memuat data transaksi...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-200">
            <div class="text-sm text-gray-700">
                Menampilkan <span class="font-semibold">1</span> sampai <span class="font-semibold">10</span> dari <span class="font-semibold">100</span> transaksi
            </div>
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Previous
                </button>
                <button class="px-4 py-2 bg-[#FF6B35] text-white rounded-lg text-sm font-medium">1</button>
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Transaction Modal -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] px-6 py-4 rounded-t-2xl">
            <h3 class="text-xl font-bold text-white">Tambah Transaksi Baru</h3>
        </div>
        <form id="addTransactionForm" class="p-6 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cabang</label>
                    <select name="cabang_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]">
                        <option value="">Pilih Cabang</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Total</label>
                    <input type="number" name="total" required placeholder="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                    <select name="metode_pembayaran" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]">
                        <option value="">Pilih Metode</option>
                        <option value="cash">Cash</option>
                        <option value="qris">QRIS</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                <textarea name="keterangan" rows="3" placeholder="Keterangan transaksi (opsional)" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]"></textarea>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeAddModal()" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] text-white rounded-lg font-medium hover:shadow-lg transition-all">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Modal Functions
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.getElementById('addModal').classList.add('flex');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
        document.getElementById('addModal').classList.remove('flex');
    }

    // Load Transactions
    async function loadTransactions() {
        try {
            const response = await fetch('/api/penjualan', {
                headers: {
                    'Accept': 'application/json',
                }
            });

            const result = await response.json();
            const tbody = document.getElementById('transactionTableBody');

            if (result.data && result.data.length > 0) {
                tbody.innerHTML = result.data.map(item => `
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">#${item.id}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">${new Date(item.tanggal).toLocaleDateString('id-ID')}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">${item.cabang?.nama_cabang || '-'}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">${item.pengguna?.nama || '-'}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-[#FF6B35]">Rp ${parseInt(item.total).toLocaleString('id-ID')}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full ${
                                item.metode_pembayaran === 'cash' ? 'bg-green-100 text-green-800' :
                                item.metode_pembayaran === 'qris' ? 'bg-blue-100 text-blue-800' :
                                'bg-purple-100 text-purple-800'
                            }">
                                ${item.metode_pembayaran?.toUpperCase() || '-'}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="viewDetail(${item.id})" class="text-blue-600 hover:text-blue-800 mr-3">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                `).join('');
            } else {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <p>Tidak ada data transaksi</p>
                        </td>
                    </tr>
                `;
            }
        } catch (error) {
            console.error('Error loading transactions:', error);
        }
    }

    // Load on page ready
    document.addEventListener('DOMContentLoaded', loadTransactions);
</script>
@endpush

