@extends('layouts.master-admin')

@section('content')
<div class="mx-auto">
    {{-- Header --}}
    <div class="mb-10 flex items-center gap-4">
        <a href="{{ route('manage-cashiers.index') }}" class="w-12 h-12 bg-white border border-gray-100 rounded-2xl flex items-center justify-center text-gray-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight text-indigo-900">Registrasi Kasir Baru</h1>
            <p class="text-sm text-gray-500 font-light">Daftarkan akun staf kasir baru untuk mengakses SiGudang.</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white p-10 rounded-2xl border border-gray-100 shadow-sm">
        <form action="{{ route('manage-cashiers.store') }}" method="POST">
            @csrf
            
            <div class="space-y-8">
                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase text-gray-400 mb-3 ml-1 tracking-widest">Nama Lengkap</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full pl-12 pr-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-100 font-medium text-gray-700 transition-all placeholder:text-gray-300"
                            placeholder="Contoh: Budi Santoso">
                    </div>
                    @error('name') <p class="mt-2 text-xs text-red-500 font-bold ml-1">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase text-gray-400 mb-3 ml-1 tracking-widest">Alamat Email / Username</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-12 pr-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-100 font-medium text-gray-700 transition-all placeholder:text-gray-300"
                            placeholder="budi@sigudang.com">
                    </div>
                    @error('email') <p class="mt-2 text-xs text-red-500 font-bold ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Password --}}
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-gray-400 mb-3 ml-1 tracking-widest">Password Default</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                <i class="fas fa-key"></i>
                            </span>
                            <input type="password" name="password" required
                                class="w-full pl-12 pr-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-100 font-medium text-gray-700 transition-all placeholder:text-gray-300"
                                placeholder="••••••••">
                        </div>
                        <p class="mt-2 text-[10px] text-gray-400 italic ml-1">*Berikan password ini kepada kasir terkait.</p>
                        @error('password') <p class="mt-2 text-xs text-red-500 font-bold ml-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-gray-400 mb-3 ml-1 tracking-widest">Ulangi Password</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password_confirmation" required
                                class="w-full pl-12 pr-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-100 font-medium text-gray-700 transition-all placeholder:text-gray-300"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="pt-6 flex flex-col md:flex-row gap-4">
                    <button type="submit" class="flex-1 px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-1 transition-all active:scale-95">
                        Daftarkan Akun Kasir
                    </button>
                    <a href="{{ route('manage-cashiers.index') }}" class="px-8 py-4 bg-gray-100 text-gray-500 rounded-2xl font-bold text-center hover:bg-gray-200 transition-all">
                        Batalkan
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection