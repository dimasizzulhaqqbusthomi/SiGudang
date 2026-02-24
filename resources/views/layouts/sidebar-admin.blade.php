<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0 shadow-sm">
    
    <div class="flex flex-col h-full">
        <div class="flex items-center h-20 border-b border-gray-100 px-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-pink-500 rounded-lg flex items-center justify-center shadow-md">
                    <span class="text-white font-bold">SG</span>
                </div>
                <div class="">
                    <span class="text-xl font-bold text-gray-800 tracking-tight">SiGudang</span>
                    <span class="text-sm text-gray-500 block -mt-1">{{ auth()->user()->role }}</span>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->is('admin*') ? 'text-indigo-600 bg-indigo-50' : 'hover:bg-gray-100' }} rounded-xl font-semibold group transition-all">
                <i class="fas fa-home w-6 transition-transform group-hover:scale-110"></i>
                <span class="ml-3">Dashboard</span>
            </a>

            <div class="text-xs font-bold text-gray-400 uppercase px-4 pt-6 pb-2 tracking-widest">Kelola</div>
            
            <a href="{{ route('products.index') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->is('products*') ? 'text-indigo-600 bg-indigo-50' : 'hover:bg-gray-50' }} rounded-xl transition-all group">
                <i class="fas fa-box w-6 group-hover:rotate-12"></i>
                <span class="ml-3">Data Barang</span>
            </a>

            <a href="{{ route('suppliers.index') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->is('suppliers*') ? 'text-indigo-600 bg-indigo-50' : 'hover:bg-gray-50' }} rounded-xl transition-all group">
                <i class="fas fa-truck w-6"></i>
                <span class="ml-3">Data Supplier</span>
            </a>

            <a href="{{ route('incoming-products.index') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->is('incoming-products*') ? 'text-indigo-600 bg-indigo-50' : 'hover:bg-gray-50' }} rounded-xl transition-all group">
                <i class="fas fa-arrow-down w-6 text-green-500"></i>
                <span class="ml-3">Barang Masuk</span>
            </a>

            <a href="{{ route('sales.index') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->is('sales*') ? 'text-indigo-600 bg-indigo-50' : 'hover:bg-gray-50' }} rounded-xl transition-all group">
                <i class="fas fa-shopping-cart w-6 text-blue-500"></i>
                <span class="ml-3">Penjualan</span>
            </a>

            <a href="{{ route('prints.index') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->is('prints*') ? 'text-indigo-600 bg-indigo-50' : 'hover:bg-gray-50' }} rounded-xl transition-all group">
                <i class="fas fa-file-alt w-6"></i>
                <span class="ml-3">Cetak Laporan</span>
            </a>

            <a href="{{ route('manage-cashiers.index') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->is('manage-cashiers*') ? 'text-indigo-600 bg-indigo-50' : 'hover:bg-gray-50' }} rounded-xl transition-all group">
                <i class="fas fa-user w-6"></i>
                <span class="ml-3">Kelola Kasir</span>
            </a>

            <a href="{{ route('profile.edit-admin') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->is('profile-admin*') ? 'text-indigo-600 bg-indigo-50' : 'hover:bg-gray-50' }} rounded-xl transition-all group">
                <i class="fas fa-key w-6"></i>
                <span class="ml-3">Ganti Password</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-3 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all font-bold">
                    <i class="fas fa-sign-out-alt w-6"></i>
                    <span class="ml-3 uppercase tracking-widest">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>