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

            <div class="text-xs font-bold text-gray-400 uppercase px-4 pb-2 tracking-widest">Dashboard</div>

            <a href="{{ route('salesCashier.index') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->is('sales*') ? 'text-indigo-600 bg-indigo-50' : 'hover:bg-gray-50' }} rounded-xl transition-all group">
                <i class="fas fa-shopping-cart w-6 text-blue-500"></i>
                <span class="ml-3">Penjualan</span>
            </a>

            <a href="{{ route('printsCashier.index') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->is('prints*') ? 'text-indigo-600 bg-indigo-50' : 'hover:bg-gray-50' }} rounded-xl transition-all group">
                <i class="fas fa-file-alt w-6"></i>
                <span class="ml-3">Cetak Laporan</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->is('profile') ? 'text-indigo-600 bg-indigo-50' : 'hover:bg-gray-50' }} rounded-xl transition-all group">
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