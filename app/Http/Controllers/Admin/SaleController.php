<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SaleController extends Controller
{   

    /**
     * Menampilkan halaman Penjualan (POS)
     */
    public function index()
    {
        $products = Product::with('supplier')->get();

        return view('admin.sales.sale', compact('products'));
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction(); // Mengamankan transaksi database

            $sale = Sale::create([
                'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
                'total_price' => $request->total_price,
                'user_id' => auth()->id(),
            ]);

            foreach ($request->cart as $item) {
                // 1. Simpan detail
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'id_product' => $item['id_product'],
                    'qty' => $item['qty'],
                    'price_at_sale' => $item['price'],
                ]);

                // 2. Potong stok produk
                $product = Product::findOrFail($item['id_product']);
                $product->decrement('stock', $item['qty']);
            }

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Transaksi berhasil!']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
