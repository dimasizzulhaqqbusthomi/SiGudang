@extends('layouts.master-admin')

@section('content')
<div class="mx-auto max-w-7xl">
    <div class="mb-10">
        <nav class="flex items-center gap-2 mb-3 text-xs font-semibold tracking-widest text-gray-400 uppercase">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="{{ route('products.index') }}" class="hover:text-indigo-600 transition-colors">Data Barang</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-indigo-600">Edit Barang</span>
        </nav>

        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Edit Barang</h1>
                <p class="text-sm font-light text-gray-500">Memperbarui informasi inventaris: <span class="font-bold text-indigo-600">{{ $product->name_product }}</span></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
        <form action="{{ route('products.update', $product->id_product) }}" method="POST" class="space-y-6 sm:p-10">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Nama Barang</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fas fa-box"></i>
                        </span>
                        <input type="text" name="name_product" value="{{ old('name_product', $product->name_product) }}"
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm @error('name_product') border-red-500 @enderror"
                            placeholder="Contoh: Beras Pandan Wangi" required>
                    </div>
                    @error('name_product') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Stok Saat Ini</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fas fa-archive"></i>
                        </span>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm @error('stock') border-red-500 @enderror"
                            placeholder="0">
                    </div>
                    @error('stock') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Harga Satuan (Rp)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-xs font-bold text-gray-400">
                            Rp
                        </span>
                        <input type="number" name="price" value="{{ old('price', (int)$product->price) }}"
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm @error('price') border-red-500 @enderror"
                            placeholder="0">
                    </div>
                    @error('price') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Pemasok / Supplier</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fas fa-truck"></i>
                        </span>
                        <select name="id_supplier" 
                            class="block w-full pl-11 pr-10 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm appearance-none @error('id_supplier') border-red-500 @enderror">
                            <option value="">Pilih Supplier...</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id_supplier }}" {{ old('id_supplier', $product->id_supplier) == $supplier->id_supplier ? 'selected' : '' }}>
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
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Deskripsi Barang (Opsional)</label>
                    <textarea name="description" rows="3"
                        class="block w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm"
                        placeholder="Tambahkan catatan detail barang...">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <div class="flex flex-col gap-3 pt-6 sm:flex-row">
                <a href="{{ route('products.index') }}" class="flex-1 px-6 py-4 font-bold text-center text-gray-600 transition-all bg-gray-100 rounded-2xl hover:bg-gray-200 order-2 sm:order-1">
                    Batal
                </a>
                <button type="submit" class="flex-[2] px-6 py-4 bg-gradient-to-r from-indigo-600 to-pink-500 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:opacity-90 active:scale-[0.98] transition-all order-1 sm:order-2">
                    Update Perubahan <i class="fas fa-save ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection