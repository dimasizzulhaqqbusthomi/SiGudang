@extends('layouts.master-admin')

@section('content')
<div class="max-w-7xl mx-auto" x-data="{ openDetailModal: false, selectedProduct: {} }">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Barang Masuk</h1>
            <p class="text-sm text-gray-500 font-light">Daftar barang yang baru masuk ke database SiGudang.</p>
        </div>

        {{-- Tombol Tambah Barang Baru
        <a href="{{ route('incoming-products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-all text-sm font-bold shadow-sm group">
            <i class="fas fa-plus transition-transform group-hover:rotate-90"></i>
            Tambah Barang Masuk
        </a> --}}
    </div>

    <div class="bg-white p-6 rounded-md border border-gray-100 shadow-sm mb-8">
        <form action="{{ route('incoming-products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div class="md:col-span-1">
                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 ml-1">Cari Nama/Supplier</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." 
                    class="block w-full px-4 py-2.5 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-100 transition-all text-sm">
            </div>

            <div class="md:col-span-1">
                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 ml-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" 
                    class="block w-full px-4 py-2.5 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-100 transition-all text-sm text-gray-600">
            </div>

            <div class="md:col-span-1">
                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 ml-1">Sampai</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" 
                    class="block w-full px-4 py-2.5 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-100 transition-all text-sm text-gray-600">
            </div>

            <div class="md:col-span-1 flex gap-2">
                <button type="submit" class="flex-1 h-[42px] bg-gray-900 text-white rounded-xl hover:bg-indigo-600 transition-all shadow-sm flex items-center justify-center">
                    <i class="fas fa-search"></i>
                </button>

                @if (request('search') || request('start_date') || request('end_date'))
                    <a href="{{ route('incoming-products.index') }}" 
                    class="flex-1 h-[42px] bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all flex items-center justify-center border border-red-100"
                    title="Reset Filter">
                        <i class="fas fa-undo"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    @if (session('success'))
        <div class="mb-6 px-4 py-3 rounded-xl bg-green-50 border border-green-100 text-green-600 text-sm font-medium">
            {{ session('success') }}
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
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400 text-center">Tanggal Masuk</th>
                        <th class="px-6 py-4 text-[11px] uppercase tracking-widest font-bold text-gray-400 text-center">Stok</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $index => $product)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">
                            {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            <button @click="selectedProduct = { ... }; openDetailModal = true;" class="text-left group outline-none">
                                <p class="text-sm font-bold text-gray-900 group-hover:text-indigo-600">{{ $product->name_product }}</p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-tighter">ID: PRO-{{ $product->id_product }}</p>
                            </button>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <span class="font-medium">{{ $product->supplier->nama_supplier ?? 'N/A' }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-xs font-bold text-gray-400">
                                {{ $product->created_at->format('d M Y') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="openRestockModal('{{ $product->id_product }}', '{{ $product->name_product }}', {{ $product->stock }})" 
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-xs font-bold bg-green-50 text-green-600 hover:bg-green-600 hover:text-white hover:shadow-lg hover:shadow-green-100 transition-all duration-300 border border-green-100 group">
                                <i class="fas fa-plus-circle opacity-50 group-hover:opacity-100"></i>
                                {{-- ID ini krusial untuk pembaruan real-time via JS --}}
                                <span id="stock-display-{{ $product->id_product }}">{{ $product->stock }}</span> Unit
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 pagination-sm">
            {{ $products->appends(['search' => request('search')])->links() }}
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function openRestockModal(id, name, currentStock) {
    Swal.fire({
        title: 'Input Stok Masuk',
        html: `Menambah persediaan untuk <b class="text-indigo-600">${name}</b>`,
        input: 'number',
        inputAttributes: {
            min: 1,
            step: 1,
            class: 'rounded-2xl border-gray-100 bg-gray-50 text-center font-bold'
        },
        showCancelButton: true,
        confirmButtonText: 'Konfirmasi Stok',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#4f46e5', // Indigo-600
        cancelButtonColor: '#f3f4f6', // Gray-100
        customClass: {
            popup: 'rounded-3xl p-8 border-none shadow-2xl',
            title: 'text-2xl font-bold text-gray-900 tracking-tight',
            confirmButton: 'rounded-2xl px-6 py-3 font-bold text-sm',
            cancelButton: 'rounded-2xl px-6 py-3 font-bold text-sm text-gray-500'
        },
        showLoaderOnConfirm: true,
        preConfirm: (amount) => {
            if (!amount || amount <= 0) {
                Swal.showValidationMessage('Jumlah stok harus lebih dari 0');
                return false;
            }
            
            return fetch(`/incoming-products/${id}/restock`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ amount: parseInt(amount) })
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal menghubungi server SiGudang.');
                return response.json();
            })
            .catch(error => {
                Swal.showValidationMessage(`Terjadi Kesalahan: ${error}`);
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            // Update angka di tabel secara real-time
            const stockElement = document.getElementById(`stock-display-${id}`);
            if (stockElement) {
                stockElement.innerText = result.value.new_stock;
                
                // Animasi sederhana untuk memberi petunjuk visual angka berubah
                stockElement.classList.add('scale-125', 'text-indigo-600');
                setTimeout(() => stockElement.classList.remove('scale-125', 'text-indigo-600'), 1000);
            }
            
            // Pesan sukses selaras design
            Swal.fire({
                icon: 'success',
                title: 'Stok Terupdate',
                text: result.value.message,
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-3xl p-8 shadow-2xl border-none',
                    title: 'text-xl font-bold text-green-600'
                }
            });
        }
    });
}
</script>