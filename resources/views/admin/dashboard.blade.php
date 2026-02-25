@extends('layouts.master-admin')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Header Dashboard --}}
    <div class="mb-10">
        <h1 class="text-2xl font-bold text-indigo-900 tracking-tight">Ringkasan Statistik</h1>
        <p class="text-sm text-gray-500 font-light">Pantau performa inventaris dan penjualan SiGudang hari ini.</p>
    </div>

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        
        {{-- Total Barang --}}
        <div class="group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-inner">
                    <i class="fas fa-boxes text-xl"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Inventaris</span>
            </div>
            <h3 class="text-3xl font-black text-gray-900 mb-1">{{ number_format($totalProducts) }}</h3>
            <p class="text-sm text-gray-500 font-medium">Total Barang Terdaftar</p>
        </div>

        {{-- Total Supplier --}}
        <div class="group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all shadow-inner">
                    <i class="fas fa-truck-loading text-xl"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Mitra</span>
            </div>
            <h3 class="text-3xl font-black text-gray-900 mb-1">{{ number_format($totalSuppliers) }}</h3>
            <p class="text-sm text-gray-500 font-medium">Pemasok Aktif</p>
        </div>

        {{-- Total Penjualan --}}
        <div class="group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-all shadow-inner">
                    <i class="fas fa-cash-register text-xl"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Keuangan</span>
            </div>
            <h3 class="text-3xl font-black text-gray-900 mb-1">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
            <p class="text-sm text-gray-500 font-medium">Total Pendapatan</p>
        </div>

        {{-- Total Transaksi (Baru) --}}
        <div class="group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-all shadow-inner">
                    <i class="fas fa-receipt text-xl"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Aktivitas</span>
            </div>
            <h3 class="text-3xl font-black text-gray-900 mb-1">{{ number_format($totalTransactions) }}</h3>
            <p class="text-sm text-gray-500 font-medium">Total Transaksi</p>
        </div>

    </div>

    {{-- Info Tambahan (Opsional) --}}
    <div class="bg-indigo-900 rounded-[3rem] p-10 text-white relative overflow-hidden shadow-xl shadow-indigo-100">
        <div class="relative z-10">
            <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}!</h2>
            <p class="text-indigo-200 text-sm max-w-md leading-relaxed">Kelola stok barang, pantau transaksi kasir, dan cetak laporan berkala melalui panel navigasi di sebelah kiri.</p>
        </div>
        <i class="fas fa-warehouse absolute -right-10 -bottom-10 text-[15rem] opacity-10"></i>
    </div>
</div>
@endsection