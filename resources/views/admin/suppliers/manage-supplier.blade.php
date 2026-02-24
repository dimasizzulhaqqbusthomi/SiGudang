@extends('layouts.master-admin')

@section('content')
<div class="max-w-7xl mx-auto" x-data="{ 
    openDeleteModal: false, 
    supplierName: '', 
    deleteUrl: '' 
}">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
        <div class="shrink-0">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Manajemen Supplier</h1>
            <p class="text-sm text-gray-500 font-light">Kelola daftar mitra penyedia barang inventaris Anda.</p>
        </div>

        <div class="w-full md:w-auto flex items-center gap-4">
            <form action="{{ route('suppliers.index') }}" method="GET" class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari nama atau alamat..." 
                    class="block w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-red-100 focus:border-red-500 transition-all text-sm">
            </form>

            @if(request('search'))
                <a href="{{ route('suppliers.index') }}" class="text-sm text-gray-400 hover:text-red-600 font-semibold transition-colors whitespace-nowrap">
                    Reset
                </a>
            @endif

            <a href="{{ route('suppliers.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-all text-sm font-bold shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah
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
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 pagination-sm">
            {{ $suppliers->appends(['search' => request('search')])->links() }}
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400">No</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400">Perusahaan</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400">Alamat</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400 text-center">Kontak</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($suppliers as $index => $supplier)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ ($suppliers->currentPage() - 1) * $suppliers->perPage() + $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-gray-900">{{ $supplier->nama_supplier }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-tighter">ID: {{ $supplier->id_supplier }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600 truncate max-w-xs">{{ $supplier->alamat_supplier }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg text-xs font-semibold">
                                <i class="fas fa-phone-alt text-indigo-500"></i>
                                {{ $supplier->no_telp_supplier }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('suppliers.edit', $supplier->id_supplier) }}" class="p-2 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-900 hover:text-white transition-all">
                                    <i class="fas fa-edit w-4 h-4"></i>
                                </a>
                                
                                <button @click="
                                    openDeleteModal = true; 
                                    supplierName = '{{ $supplier->nama_supplier }}'; 
                                    deleteUrl = '{{ route('suppliers.destroy', $supplier->id_supplier) }}'
                                " class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition-all">
                                    <i class="fas fa-trash w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic text-sm">Belum ada data supplier terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination yang rapi --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 pagination-sm">
            {{ $suppliers->appends(['search' => request('search')])->links() }}
        </div>
    </div>

    <div x-show="openDeleteModal" 
        class="fixed inset-0 z-[100] overflow-y-auto" 
        style="display: none;"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div @click.away="openDeleteModal = false"
                class="relative transform overflow-hidden rounded-[2.5rem] bg-white p-8 text-center shadow-2xl transition-all sm:w-full sm:max-w-md border border-gray-100">
                
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-red-50 mb-6">
                    <i class="fas fa-exclamation-triangle text-3xl text-red-500"></i>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Supplier?</h3>
                <p class="text-sm text-gray-500 leading-relaxed px-4">
                    Anda akan menghapus <span class="font-bold text-red-600" x-text="supplierName"></span>. Data yang dihapus tidak dapat dipulihkan kembali.
                </p>

                <div class="mt-8 flex gap-3">
                    <button @click="openDeleteModal = false" 
                            class="flex-1 px-6 py-3.5 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition-all">
                        Batal
                    </button>
                    <form :action="deleteUrl" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full px-6 py-3.5 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 shadow-lg shadow-red-200 transition-all">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection