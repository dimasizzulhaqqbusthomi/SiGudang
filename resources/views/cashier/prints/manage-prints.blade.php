@extends('layouts.master-cashier')

@section('content')
<div class="max-w-7xl mx-auto" x-data="{ 
    openModal: false, 
    printTitle: '', 
    printUrl: '',
    startDate: '{{ date('Y-m-01') }}',
    endDate: '{{ date('Y-m-d') }}'
}">
    <div class="mb-12">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Pusat Cetak Laporan</h1>
        <p class="text-sm text-gray-500 font-light">Tentukan rentang tanggal untuk mencetak laporan kustom Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300">
            <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors shadow-inner">
                <i class="fas fa-boxes text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Stok Barang</h3>
            <p class="text-xs text-gray-500 mb-8 leading-relaxed">Daftar produk yang didaftarkan ke sistem pada periode tertentu.</p>
            
            <button @click="openModal = true; printTitle = 'Daftar Produk Baru'; printUrl = '{{ route('printCashier.products') }}'" 
                class="flex items-center justify-between w-full px-6 py-4 bg-gray-50 text-gray-700 rounded-2xl font-bold text-sm hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                Cetak Produk <i class="fas fa-print opacity-50"></i>
            </button>
        </div>

        <div class="group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300">
            <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mb-6 group-hover:bg-green-600 group-hover:text-white transition-colors shadow-inner">
                <i class="fas fa-file-import text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Stok Masuk</h3>
            <p class="text-xs text-gray-500 mb-8 leading-relaxed">Laporan histori penambahan barang dari supplier berdasarkan periode tertentu.</p>
            <button @click="openModal = true; printTitle = 'Laporan Stok Masuk'; printUrl = '{{ route('printCashier.incoming') }}'" 
                class="flex items-center justify-between w-full px-6 py-4 bg-gray-50 text-gray-700 rounded-2xl font-bold text-sm hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                Atur Tanggal <i class="fas fa-calendar-alt opacity-50"></i>
            </button>
        </div>

        <div class="group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300">
            <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors shadow-inner">
                <i class="fas fa-shopping-bag text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Penjualan</h3>
            <p class="text-xs text-gray-500 mb-8 leading-relaxed">Rekapitulasi transaksi penjualan dan total pendapatan toko SiGudang.</p>
            <button @click="openModal = true; printTitle = 'Laporan Penjualan'; printUrl = '{{ route('printCashier.sales') }}'" 
                class="flex items-center justify-between w-full px-6 py-4 bg-gray-50 text-gray-700 rounded-2xl font-bold text-sm hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                Atur Tanggal <i class="fas fa-calendar-alt opacity-50"></i>
            </button>
        </div>
    </div>

    <div x-show="openModal" 
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 overflow-y-auto" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        x-cloak>
        
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="openModal = false"></div>
        
        <div class="relative bg-white p-8 rounded-[2.5rem] shadow-2xl max-w-md w-full border border-gray-100 ring-1 ring-black/5">
            <h3 class="text-xl font-bold text-gray-900 mb-2" x-text="printTitle"></h3>
            <p class="text-xs text-gray-500 mb-8 leading-relaxed">Sistem akan menyaring data berdasarkan rentang tanggal yang dipilih.</p>
            
            <form :action="printUrl" method="GET" target="_blank" @submit="openModal = false">
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 ml-1">Dari Tanggal</label>
                        <input type="date" name="start_date" x-model="startDate" 
                            class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-100 font-bold text-gray-700 text-sm outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 ml-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" x-model="endDate" :min="startDate" 
                            class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-100 font-bold text-gray-700 text-sm outline-none">
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" @click="openModal = false" 
                        class="flex-1 px-6 py-4 bg-gray-100 text-gray-500 rounded-2xl font-bold text-sm hover:bg-gray-200 transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                        class="flex-1 px-6 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">
                        Cetak PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection