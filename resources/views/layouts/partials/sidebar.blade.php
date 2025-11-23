<!-- Sidebar -->
<aside class="w-64 bg-gradient-to-b from-[#FF6B35] to-[#D84315] text-white flex-shrink-0 shadow-2xl">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center justify-center h-20 bg-white/10 backdrop-blur-sm">
            <div class="flex items-center space-x-3">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-10 h-10 text-[#FF6B35]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M2 21h19v-3H2v3zM20 8H4V6h16v2zm0 4H4v-2h16v2zm-7 4h7v-2h-7v2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold">Sidewalk.Go</h1>
                    <p class="text-xs text-white/80">Coffee Dashboard</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white text-[#FF6B35] shadow-lg' : 'hover:bg-white/10' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>
            
            @if(in_array(auth()->user()->role ?? 'raider', ['owner', 'admin', 'raider', 'kepala_gudang']))
            <!-- Transaksi -->
            <a href="{{ route('transaksi.index') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('transaksi.*') ? 'bg-white text-[#FF6B35] shadow-lg' : 'hover:bg-white/10' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span class="font-medium">Transaksi</span>
            </a>
            @endif
            
            @if(in_array(auth()->user()->role ?? 'raider', ['owner', 'kepala_gudang']))
            <!-- Stok Produk -->
            <a href="{{ route('stok.index') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('stok.*') ? 'bg-white text-[#FF6B35] shadow-lg' : 'hover:bg-white/10' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <span class="font-medium">Stok Produk</span>
            </a>
            @endif
            
            @if(in_array(auth()->user()->role ?? 'raider', ['owner', 'admin']))
            <!-- Laporan Keuangan -->
            <a href="{{ route('laporan.index') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('laporan.*') ? 'bg-white text-[#FF6B35] shadow-lg' : 'hover:bg-white/10' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="font-medium">Laporan Keuangan</span>
            </a>
            @endif
        </nav>
        
        <!-- User Profile -->
        <div class="p-4 bg-white/10 backdrop-blur-sm">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#FF6B35]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold">{{ auth()->user()->nama ?? 'Admin' }}</p>
                    <p class="text-xs text-white/70 capitalize">{{ auth()->user()->role ?? 'Owner' }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>

