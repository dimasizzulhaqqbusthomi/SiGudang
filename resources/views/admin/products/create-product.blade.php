@extends('layouts.master-admin')

@section('content')
<div class="mx-auto">
    <div class="mb-10">
        <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-gray-400 mb-3">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="{{ route('products.index') }}" class="hover:text-indigo-600 transition-colors">Data Barang</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-indigo-600">Tambah Baru</span>
        </nav>

        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Tambah Barang</h1>
                <p class="text-sm text-gray-500 font-light">Input inventaris barang baru ke SiGudang.</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-md border border-gray-100 shadow-sm overflow-hidden">
        <form action="{{ route('products.store') }}" method="POST" class="sm:p-10 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block font-semibold text-sm text-gray-700 mb-2">Nama Barang</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fas fa-box"></i>
                        </span>
                        <input type="text" name="name_product" value="{{ old('name_product') }}"
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm @error('name_product') border-red-500 @enderror"
                            placeholder="Contoh: Beras Pandan Wangi" required autofocus>
                    </div>
                    @error('name_product') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block font-semibold text-sm text-gray-700 mb-2">Stok Awal</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fas fa-archive"></i>
                        </span>
                        <input type="number" name="stock" value="{{ old('stock') }}"
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm @error('stock') border-red-500 @enderror"
                            placeholder="0">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-sm text-gray-700 mb-2">Harga Satuan (Rp)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 font-bold text-xs">
                            Rp
                        </span>
                        <input type="number" name="price" value="{{ old('price') }}"
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm @error('price') border-red-500 @enderror"
                            placeholder="0">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block font-semibold text-sm text-gray-700 mb-2">Pemasok / Supplier</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fas fa-truck"></i>
                        </span>
                        <select name="id_supplier" 
                            class="block w-full pl-11 pr-10 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm appearance-none @error('id_supplier') border-red-500 @enderror">
                            <option value="">Pilih Supplier...</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id_supplier }}" {{ old('id_supplier') == $supplier->id_supplier ? 'selected' : '' }}>
                                    {{ $supplier->nama_supplier }}
                                </option>
                            @endforeach
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                    @error('id_supplier') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block font-semibold text-sm text-gray-700 mb-2">Deskripsi Barang (Opsional)</label>
                    <textarea name="description" rows="3"
                        class="block w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm"
                        placeholder="Tambahkan catatan detail barang...">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="pt-6 flex flex-col sm:flex-row gap-3">
                <button type="reset" class="flex-1 px-6 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition-all order-2 sm:order-1">
                    Reset
                </button>
                <button type="submit" class="flex-[2] px-6 py-4 bg-gradient-to-r from-indigo-600 to-pink-500 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:opacity-90 active:scale-[0.98] transition-all order-1 sm:order-2">
                    Simpan ke Gudang <i class="fas fa-save ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection