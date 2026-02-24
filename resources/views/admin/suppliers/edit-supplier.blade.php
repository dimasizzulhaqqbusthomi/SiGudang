@extends('layouts.master-admin')

@section('content')
<div class="mx-auto max-w-7xl">
    <div class="mb-10">
        {{-- Breadcrumbs disesuaikan untuk Edit --}}
        <nav class="flex items-center gap-2 mb-3 text-xs font-semibold tracking-widest text-gray-400 uppercase">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="{{ route('suppliers.index') }}" class="hover:text-indigo-600 transition-colors">Data Supplier</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-indigo-600">Edit Supplier</span>
        </nav>

        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Edit Supplier</h1>
                <p class="text-sm font-light text-gray-500">
                    Memperbarui data: <span class="font-bold text-indigo-600">{{ $supplier->nama_supplier }}</span>
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-md border border-gray-100 shadow-sm overflow-hidden">
        {{-- Form Action menggunakan route update dengan Method PUT --}}
        <form action="{{ route('suppliers.update', $supplier->id_supplier) }}" method="POST" class="space-y-6 sm:p-10">
            @csrf
            @method('PUT')

            {{-- Nama Supplier --}}
            <div>
                <label for="nama_supplier" class="block mb-2 text-sm font-semibold text-gray-700">Nama Perusahaan/Supplier</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i class="fas fa-building"></i>
                    </span>
                    <input type="text" name="nama_supplier" id="nama_supplier" 
                        value="{{ old('nama_supplier', $supplier->nama_supplier) }}"
                        class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm @error('nama_supplier') border-red-500 @enderror"
                        placeholder="Contoh: PT. Maju Bersama">
                </div>
                @error('nama_supplier')
                    <p class="mt-2 text-xs text-red-500 italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nomor Telepon --}}
            <div>
                <label for="no_telp_supplier" class="block mb-2 text-sm font-semibold text-gray-700">Nomor Telepon</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i class="fas fa-phone-alt"></i>
                    </span>
                    <input type="text" name="no_telp_supplier" id="no_telp_supplier" 
                        value="{{ old('no_telp_supplier', $supplier->no_telp_supplier) }}"
                        class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm @error('no_telp_supplier') border-red-500 @enderror"
                        placeholder="Contoh: 08123456789">
                </div>
                @error('no_telp_supplier')
                    <p class="mt-2 text-xs text-red-500 italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label for="alamat_supplier" class="block mb-2 text-sm font-semibold text-gray-700">Alamat Lengkap</label>
                <div class="relative">
                    <span class="absolute top-4 left-4 text-gray-400">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <textarea name="alamat_supplier" id="alamat_supplier" rows="4"
                        class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all text-sm @error('alamat_supplier') border-red-500 @enderror"
                        placeholder="Masukkan alamat lengkap kantor atau gudang supplier">{{ old('alamat_supplier', $supplier->alamat_supplier) }}</textarea>
                </div>
                @error('alamat_supplier')
                    <p class="mt-2 text-xs text-red-500 italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-3 pt-4 sm:flex-row">
                {{-- Tombol Batal --}}
                <a href="{{ route('suppliers.index') }}" class="flex-1 px-6 py-4 font-bold text-center text-gray-600 transition-all bg-gray-100 rounded-2xl hover:bg-gray-200 order-2 sm:order-1">
                    Batal
                </a>
                {{-- Tombol Update --}}
                <button type="submit" class="flex-[2] px-6 py-4 bg-gradient-to-r from-indigo-600 to-pink-500 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:opacity-90 active:scale-[0.98] transition-all order-1 sm:order-2">
                    Update Perubahan <i class="fas fa-save ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection