@extends('layouts.master-admin')

@section('content')
{{-- Inisialisasi Alpine.js dengan penambahan state untuk Detail Modal --}}
<div class="max-w-7xl mx-auto" x-data="{ 
    openDeleteModal: false, 
    openDetailModal: false,
    itemName: '', 
    deleteUrl: '',
    selectedProduct: {
        name: '',
        id: '',
        desc: '',
        stock: 0,
        price: '',
        supplier: ''
    }
}">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
        <div class="shrink-0">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Manajemen Barang</h1>
            <p class="text-sm text-gray-500 font-light">Kelola stok dan inventaris barang di SiGudang.</p>
        </div>

        <div class="w-full md:w-auto flex items-center gap-4">
            <form action="{{ route('products.index') }}" method="GET" class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari kode, nama, atau supplier..." 
                    class="block w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 transition-all text-sm">
            </form>

            @if(request('search'))
                <a href="{{ route('products.index') }}" class="text-sm text-gray-400 hover:text-red-600 font-semibold transition-colors whitespace-nowrap">
                    Reset
                </a>
            @endif

            <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-all text-sm font-bold shadow-sm">
                <i class="fas fa-plus"></i>
                Tambah Barang
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 px-6 py-4 bg-green-50 border border-green-100 rounded-2xl flex items-center gap-3">
            <i class="fas fa-check-circle text-green-500"></i>
            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 pagination-sm">
            {{ $products->appends(['search' => request('search')])->links() }}
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400 text-center">No</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400">Info Barang</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400">Supplier</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400 text-center">Stok</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400">Harga</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $index => $product)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">
                            {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            {{-- Button Nama Produk untuk Detail Modal --}}
                            <button @click="
                                selectedProduct = {
                                    name: '{{ $product->name_product }}',
                                    id: '{{ $product->id_product }}',
                                    desc: '{{ addslashes($product->description) }}',
                                    stock: '{{ $product->stock }}',
                                    price: '{{ number_format($product->price, 0, ',', '.') }}',
                                    supplier: '{{ $product->supplier->nama_supplier ?? 'N/A' }}'
                                };
                                openDetailModal = true;
                            " class="text-left group outline-none focus:outline-none">
                                <p class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                    {{ $product->name_product }}
                                </p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-tighter group-hover:text-indigo-400">
                                    ID: PRO-{{ $product->id_product }}
                                </p>
                            </button>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-truck text-xs text-gray-300"></i>
                                <span class="font-medium">{{ $product->supplier->nama_supplier ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $product->stock <= 5 ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600' }}">
                                {{ $product->stock }} Unit
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 font-semibold">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('products.edit', $product->id_product) }}" class="p-2 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-900 hover:text-white transition-all">
                                    <i class="fas fa-edit w-4 h-4"></i>
                                </a>
                                <button @click="
                                    openDeleteModal = true; 
                                    itemName = '{{ $product->name_product }}'; 
                                    deleteUrl = '{{ route('products.destroy', $product->id_product) }}'
                                " class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition-all">
                                    <i class="fas fa-trash w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400 italic text-sm">
                            <i class="fas fa-box-open text-4xl mb-4 opacity-20"></i>
                            <p>Belum ada data barang terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="openDetailModal" 
        class="fixed inset-0 z-[100] overflow-y-auto" 
        x-cloak
        style="display: none;"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div @click.away="openDetailModal = false"
                class="relative transform overflow-hidden rounded-[2.5rem] bg-white shadow-2xl transition-all sm:w-full sm:max-w-lg border border-gray-100">
                
                <div class="bg-gray-50/50 px-8 py-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900">Detail Inventaris</h3>
                    <button @click="openDetailModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="p-8 space-y-6">
                    <div class="flex items-center gap-4 p-5 bg-indigo-50 rounded-3xl border border-indigo-100">
                        <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg shadow-indigo-200">
                            <i class="fas fa-box"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-widest">Nama Produk</p>
                            <p class="text-xl font-black text-gray-900" x-text="selectedProduct.name"></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-5 border border-gray-100 rounded-3xl bg-gray-50/30">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Stok Gudang</p>
                            <p class="text-lg font-bold text-gray-900"><span x-text="selectedProduct.stock"></span> <span class="text-sm font-normal text-gray-500">Unit</span></p>
                        </div>
                        <div class="p-5 border border-gray-100 rounded-3xl bg-gray-50/30">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Harga Jual</p>
                            <p class="text-lg font-bold text-indigo-600">Rp <span x-text="selectedProduct.price"></span></p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2">Pemasok Resmi</p>
                            <div class="flex items-center gap-3 px-4 py-3 bg-white border border-gray-100 rounded-2xl shadow-sm">
                                <i class="fas fa-truck text-indigo-500"></i>
                                <span class="font-bold text-gray-700" x-text="selectedProduct.supplier"></span>
                            </div>
                        </div>

                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2">Deskripsi Lengkap</p>
                            <div class="text-sm text-gray-600 leading-relaxed bg-gray-50/80 p-5 rounded-3xl border border-gray-100" 
                                x-text="selectedProduct.desc || 'Deskripsi tidak tersedia untuk produk ini.'"></div>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100 text-right">
                    <button @click="openDetailModal = false" 
                            class="px-8 py-3.5 bg-gray-900 text-white rounded-2xl font-bold hover:bg-gray-800 transition-all text-sm shadow-xl shadow-gray-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="openDeleteModal" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;" x-cloak>
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"></div>
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div @click.away="openDeleteModal = false" class="relative bg-white p-8 rounded-[2.5rem] shadow-2xl sm:max-w-md w-full">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-red-50 mb-6 text-red-500 text-3xl">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Barang?</h3>
                <p class="text-sm text-gray-500 px-4">Hapus <span class="font-bold text-red-600" x-text="itemName"></span>? Tindakan ini akan menghapus data inventaris secara permanen.</p>
                <div class="mt-8 flex gap-3">
                    <button @click="openDeleteModal = false" class="flex-1 px-6 py-3.5 bg-gray-100 text-gray-600 rounded-2xl font-bold">Batal</button>
                    <form :action="deleteUrl" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full px-6 py-3.5 bg-red-600 text-white rounded-2xl font-bold shadow-lg shadow-red-200">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection