@extends('layouts.app')

@section('title', 'Laporan Keuangan')
@section('page-title', 'Laporan Keuangan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Laporan Keuangan</h3>
            <p class="text-gray-600 mt-1">Kelola dan pantau laporan keuangan perusahaan</p>
        </div>
        
        @if(auth()->user()->role === 'admin')
        <button onclick="openAddLaporanModal()" class="px-6 py-3 bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Buat Laporan
        </button>
        @endif
    </div>
    
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Total Pendapatan</p>
                    <h3 class="text-2xl font-bold mt-2">Rp {{ number_format($totalPendapatan ?? 125000000, 0, ',', '.') }}</h3>
                    <p class="text-xs mt-2 opacity-80">Bulan ini</p>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
                </svg>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Rata-rata Harian</p>
                    <h3 class="text-2xl font-bold mt-2">Rp {{ number_format($rataHarian ?? 4500000, 0, ',', '.') }}</h3>
                    <p class="text-xs mt-2 opacity-80">Per hari</p>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Total Laporan</p>
                    <h3 class="text-2xl font-bold mt-2">{{ $totalLaporan ?? 12 }}</h3>
                    <p class="text-xs mt-2 opacity-80">Laporan dibuat</p>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Filter -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Periode Awal</label>
                <input type="date" id="periodeAwal" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Periode Akhir</label>
                <input type="date" id="periodeAkhir" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cabang</label>
                <select id="filterCabang" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent">
                    <option value="">Semua Cabang</option>
                </select>
            </div>
            <div class="flex items-end">
                <button onclick="filterLaporan()" class="w-full px-4 py-2 bg-[#FF6B35] text-white rounded-lg font-medium hover:bg-[#D84315] transition-colors">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
            </div>
        </div>
    </div>
    
    <!-- Reports Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold">ID Laporan</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Periode</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Cabang</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Total Pendapatan</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Dibuat Oleh</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal Dibuat</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody id="laporanTableBody" class="divide-y divide-gray-200">
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-lg font-medium">Memuat data laporan...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Laporan Modal -->
<div id="laporanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4">
        <div class="bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] px-6 py-4 rounded-t-2xl">
            <h3 class="text-xl font-bold text-white">Buat Laporan Keuangan</h3>
        </div>
        <form id="laporanForm" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cabang</label>
                <select name="cabang_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]">
                    <option value="">Pilih Cabang</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Periode Awal</label>
                    <input type="date" name="periode_awal" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Periode Akhir</label>
                    <input type="date" name="periode_akhir" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Total Pendapatan</label>
                <input type="number" name="total_pendapatan" required placeholder="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35]">
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeLaporanModal()" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] text-white rounded-lg font-medium hover:shadow-lg transition-all">
                    Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Modal Functions
    function openAddLaporanModal() {
        document.getElementById('laporanModal').classList.remove('hidden');
        document.getElementById('laporanModal').classList.add('flex');
    }

    function closeLaporanModal() {
        document.getElementById('laporanModal').classList.add('hidden');
        document.getElementById('laporanModal').classList.remove('flex');
    }

    // Load Reports
    async function loadLaporan() {
        try {
            const response = await fetch('/api/laporan-keuangan', {
                headers: {
                    'Accept': 'application/json',
                }
            });

            const result = await response.json();
            const tbody = document.getElementById('laporanTableBody');

            if (result.data && result.data.length > 0) {
                tbody.innerHTML = result.data.map(item => `
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">#${item.id}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            ${new Date(item.periode_awal).toLocaleDateString('id-ID')} -
                            ${new Date(item.periode_akhir).toLocaleDateString('id-ID')}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">${item.cabang?.nama_cabang || '-'}</td>
                        <td class="px-6 py-4 text-sm font-bold text-green-600">Rp ${parseInt(item.total_pendapatan).toLocaleString('id-ID')}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">${item.dibuat_oleh || '-'}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">${item.created_at ? new Date(item.created_at).toLocaleDateString('id-ID') : '-'}</td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="viewLaporan(${item.id})" class="text-blue-600 hover:text-blue-800 mr-2">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <button onclick="downloadLaporan(${item.id})" class="text-green-600 hover:text-green-800">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                `).join('');
            } else {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <p>Tidak ada data laporan</p>
                        </td>
                    </tr>
                `;
            }
        } catch (error) {
            console.error('Error loading reports:', error);
        }
    }

    // Load on page ready
    document.addEventListener('DOMContentLoaded', loadLaporan);
</script>
@endpush

