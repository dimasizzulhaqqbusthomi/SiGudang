@extends('layouts.master-cashier')

@section('content')
<div class="max-w-7xl mx-auto" x-data="posSystem()">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2">
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Penjualan Baru</h1>
                    <p class="text-sm text-gray-500 font-light">Pilih produk untuk dimasukkan ke keranjang belanja.</p>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block mb-1">Kasir Aktif</span>
                    <span class="text-sm font-bold text-indigo-600">{{ Auth::user()->name }}</span>
                </div>
            </div>

            <div class="relative mb-8">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" x-model="search" placeholder="Cari nama produk atau ID..." 
                    class="w-full pl-11 pr-6 py-4 bg-white border border-gray-100 rounded-[1.5rem] shadow-sm focus:ring-4 focus:ring-indigo-50 focus:border-indigo-600 transition-all outline-none">
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                <template x-for="product in filteredProducts" :key="product.id_product">
                    <div class="bg-white p-5 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute top-4 right-4 z-10">
                            <span class="px-2 py-1 rounded-lg text-[10px] font-bold uppercase"
                                :class="product.stock > 10 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600'">
                                Stok: <span x-text="product.stock"></span>
                            </span>
                        </div>

                        <div class="w-full h-32 bg-gray-50 rounded-[2rem] mb-4 flex items-center justify-center text-gray-200 group-hover:bg-indigo-50 group-hover:text-indigo-200 transition-colors">
                            <i class="fas fa-box text-4xl"></i>
                        </div>
                        
                        <h3 class="font-bold text-gray-900 text-sm mb-1 truncate" x-text="product.name_product"></h3>
                        <p class="text-[10px] text-gray-400 uppercase mb-3">ID: PRO-<span x-text="product.id_product"></span></p>
                        
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-xs font-black text-indigo-600" x-text="formatCurrency(product.price)"></span>
                            <button @click="addToCart(product)" 
                                :disabled="product.stock <= 0"
                                class="p-2.5 rounded-xl transition-all shadow-sm"
                                :class="product.stock > 0 ? 'bg-indigo-600 text-white hover:bg-indigo-700 hover:shadow-indigo-200' : 'bg-gray-100 text-gray-400 cursor-not-allowed'">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-2xl p-8 sticky top-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-lg font-bold text-gray-900">Detail Pembelian</h2>
                    <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full text-[10px] font-black" x-text="cart.length + ' Item'"></span>
                </div>

                <div class="space-y-4 mb-8 max-h-[450px] overflow-y-auto pr-2 custom-scrollbar">
                    <template x-for="(item, index) in cart" :key="index">
                        <div class="p-4 bg-gray-50 rounded-[1.5rem] border border-gray-100 group transition-all">
                            <div class="flex justify-between items-start mb-3">
                                <div class="w-2/3">
                                    <p class="text-xs font-bold text-gray-800 leading-tight" x-text="item.name_product"></p>
                                    <p class="text-[10px] text-gray-400 mt-1" x-text="formatCurrency(item.price)"></p>
                                </div>
                                <button @click="removeFromCart(index)" class="text-gray-300 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center bg-white border border-gray-200 rounded-xl p-1 shadow-sm">
                                    <button @click="decreaseQty(index)" class="w-7 h-7 flex items-center justify-center text-gray-400 hover:text-indigo-600">-</button>
                                    <input type="number" 
                                        x-model.number="item.qty" 
                                        @blur="validateQty(index)"
                                        class="w-10 text-center border-none focus:ring-0 text-[11px] font-bold text-gray-900 bg-transparent [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <button @click="increaseQty(index)" class="w-7 h-7 flex items-center justify-center text-indigo-600">+</button>
                                </div>
                                <span class="text-xs font-black text-gray-900" x-text="formatCurrency(item.price * item.qty)"></span>
                            </div>
                        </div>
                    </template>

                    <template x-if="cart.length === 0">
                        <div class="py-20 text-center">
                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-200">
                                <i class="fas fa-shopping-basket text-3xl"></i>
                            </div>
                            <p class="text-xs text-gray-400 font-medium tracking-wide">Keranjang masih kosong</p>
                        </div>
                    </template>
                </div>

                <div class="border-t border-dashed border-gray-200 pt-6">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-gray-400 text-xs font-bold uppercase tracking-widest">Total Bayar</span>
                        <span class="text-2xl font-black text-indigo-600" x-text="formatCurrency(calculateTotal())"></span>
                    </div>

                    <button @click="checkout()" :disabled="cart.length === 0"
                        class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-3">
                        <span>Selesaikan Penjualan</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function posSystem() {
    return {
        products: @json($products), 
        search: '',
        cart: [],
        
        get filteredProducts() {
            return this.products.filter(p => 
                p.name_product.toLowerCase().includes(this.search.toLowerCase()) ||
                p.id_product.toString().includes(this.search)
            );
        },

        addToCart(product) {
            let found = this.cart.find(item => item.id_product === product.id_product);
            if (found) {
                if (found.qty < product.stock) {
                    found.qty++;
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Stok Terbatas',
                        text: 'Jumlah melebihi stok yang tersedia!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            } else {
                this.cart.push({
                    id_product: product.id_product,
                    name_product: product.name_product,
                    price: product.price,
                    qty: 1,
                    maxStock: product.stock
                });
            }
        },

        removeFromCart(index) {
            this.cart.splice(index, 1);
        },

        increaseQty(index) {
            if (this.cart[index].qty < this.cart[index].maxStock) {
                this.cart[index].qty++;
            }
        },

        decreaseQty(index) {
            if (this.cart[index].qty > 1) {
                this.cart[index].qty--;
            }
        },

        validateQty(index) {
            let item = this.cart[index];
            
            // Jika input kosong atau bukan angka saat kehilangan fokus, kembalikan ke 1
            if (item.qty === '' || item.qty === null || isNaN(item.qty) || item.qty < 1) {
                item.qty = 1;
            }

            // Tetap batasi agar tidak melebihi stok yang ada
            if (item.qty > item.maxStock) {
                item.qty = item.maxStock;
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Terbatas',
                    text: `Maksimal pembelian adalah ${item.maxStock} unit`,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        },

        calculateTotal() {
            return this.cart.reduce((total, item) => total + (item.price * item.qty), 0);
        },

        formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount);
        },

        async checkout() {
            const result = await Swal.fire({
                title: 'Konfirmasi Pembayaran',
                html: `Total yang harus dibayar: <br><b class="text-2xl text-indigo-600">${this.formatCurrency(this.calculateTotal())}</b>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Proses Bayar',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#4f46e5',
                customClass: {
                    popup: 'rounded-[2rem]',
                    confirmButton: 'rounded-xl px-6 py-3',
                    cancelButton: 'rounded-xl px-6 py-3'
                }
            });

            if (result.isConfirmed) {
                try {
                    const response = await fetch("{{ route('salesCashier.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            cart: this.cart,
                            total_price: this.calculateTotal()
                        })
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonColor: '#4f46e5',
                        }).then(() => {
                            window.location.reload(); 
                        });
                    } else {
                        throw new Error(data.message);
                    }
                } catch (error) {
                    Swal.fire('Gagal!', error.message || 'Terjadi kesalahan sistem', 'error');
                }
            }
        }
    }
}
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
</style>
@endsection