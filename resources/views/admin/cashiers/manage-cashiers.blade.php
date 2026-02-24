@extends('layouts.master-admin')

@section('content')
<div class="max-w-7xl mx-auto" x-data="{ 
    openDeleteModal: false, 
    openRoleModal: false, 
    itemName: '', 
    deleteUrl: '',
    selectedUser: { id: '', name: '', role: '' }
}">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
        <div class="shrink-0">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight text-indigo-900">Manajemen Kasir</h1>
            <p class="text-sm text-gray-500 font-light">Kelola akun staf kasir yang bertugas di SiGudang.</p>
        </div>

        <a href="{{ route('manage-cashiers.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-all text-sm font-bold shadow-sm group">
            <i class="fas fa-user-plus transition-transform group-hover:scale-110"></i>
            Tambah Kasir
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 px-6 py-4 bg-green-50 border border-green-100 rounded-2xl flex items-center gap-3 animate-pulse">
            <i class="fas fa-check-circle text-green-500 text-lg"></i>
            <p class="text-sm text-green-700 font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-md border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400 text-center">No</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400">Informasi Kasir</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400">Username/Email</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400 text-center">Akses Role</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($cashiers as $index => $cashier)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4 text-sm text-gray-600 text-center font-medium">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $cashier->name }}</p>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-tighter font-semibold">ID: STF-{{ $cashier->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                            {{ $cashier->email }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button @click="
                                selectedUser = {
                                    id: '{{ $cashier->id }}',
                                    name: '{{ $cashier->name }}',
                                    role: '{{ $cashier->role }}'
                                };
                                openRoleModal = true;
                            " class="px-4 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-600 border border-blue-100 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 transition-all duration-300 shadow-sm cursor-pointer">
                                {{ $cashier->role ?? 'Cashier' }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex gap-2">
                                <button @click="
                                    openDeleteModal = true; 
                                    itemName = '{{ $cashier->name }}'; 
                                    deleteUrl = '{{ route('manage-cashiers.destroy', $cashier->id) }}'
                                " class="p-2.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition-all hover:shadow-lg hover:shadow-red-100">
                                    <i class="fas fa-trash w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center opacity-20">
                                <i class="fas fa-users-slash text-6xl mb-4"></i>
                                <p class="text-lg font-bold">Belum ada akun kasir terdaftar.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="openDeleteModal" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;" x-cloak>
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="openDeleteModal = false"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white p-8 rounded-[2.5rem] shadow-2xl sm:max-w-md w-full border border-gray-100">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-red-50 mb-6 text-red-500 text-3xl shadow-inner">
                    <i class="fas fa-user-times"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Akun Kasir?</h3>
                <p class="text-sm text-gray-500 px-4">Akses kasir <span class="font-bold text-red-600" x-text="itemName"></span> akan dicabut secara permanen.</p>
                <div class="mt-8 flex gap-3">
                    <button @click="openDeleteModal = false" class="flex-1 px-6 py-3.5 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition-all text-sm">Batal</button>
                    <form :action="deleteUrl" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full px-6 py-3.5 bg-red-600 text-white rounded-2xl font-bold shadow-lg shadow-red-200 hover:bg-red-700 transition-all text-sm">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div x-show="openRoleModal" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;" x-cloak>
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="openRoleModal = false"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white p-8 rounded-3xl shadow-2xl sm:max-w-md w-full border border-gray-100">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-indigo-50 mb-6 text-indigo-600 text-3xl shadow-inner border border-indigo-100">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Promosikan Jadi Admin?</h3>
                <p class="text-sm text-gray-500 mb-8 px-2">
                    Jadikan <span class="font-bold text-gray-900" x-text="selectedUser.name"></span> sebagai Administrator? Mereka akan mendapatkan kendali penuh atas SiGudang.
                </p>

                <div class="flex flex-col gap-3">
                    <form :action="`/cashiers/${selectedUser.id}/update-role`" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="role" value="admin">
                        <button type="submit" class="w-full px-6 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">
                            Konfirmasi Jadi Admin
                        </button>
                    </form>
                    <button @click="openRoleModal = false" class="w-full px-6 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition-all text-sm">
                        Batalkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection