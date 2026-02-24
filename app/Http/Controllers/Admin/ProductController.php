<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockLog;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $products = Product::with('supplier')
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    // Mencari berdasarkan kolom di tabel products
                    $q->where('name_product', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    
                    // Mencari berdasarkan kolom nama_supplier di tabel suppliers
                    ->orWhereHas('supplier', function ($subQuery) use ($search) {
                        $subQuery->where('nama_supplier', 'like', "%{$search}%");
                    });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.products.manage-product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::orderBy('nama_supplier', 'asc')->get();
        return view('admin.products.create-product', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'description'  => 'nullable|string|max:1000',
            'stock'        => 'required|integer|min:0',
            'price'        => 'required|numeric|min:0',
            'id_supplier'  => 'required|exists:suppliers,id_supplier',
        ], [
            'id_supplier.exists' => 'Supplier yang dipilih tidak valid.'
        ]);

        // Menggunakan mass assignment untuk menyimpan data
        Product::create([
            'name_product' => $request->name_product,
            'description'  => $request->description,
            'stock'        => $request->stock,
            'price'        => $request->price,
            'id_supplier'  => $request->id_supplier,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Barang baru berhasil ditambahkan ke inventaris SiGudang!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::orderBy('nama_supplier', 'asc')->get();
        return view('admin.products.edit-product', compact('product', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'description'  => 'nullable|string|max:1000',
            'stock'        => 'required|integer|min:0',
            'price'        => 'required|numeric|min:0',
            'id_supplier'  => 'required|exists:suppliers,id_supplier',
        ], [
            'id_supplier.exists' => 'Supplier yang dipilih tidak valid.'
        ]);

        // Menggunakan mass assignment untuk memperbarui data
        $product->update([
            'name_product' => $request->name_product,
            'description'  => $request->description,
            'stock'        => $request->stock,
            'price'        => $request->price,
            'id_supplier'  => $request->id_supplier,
        ]);

        return redirect()->route('products.index')->with('success', 'Informasi barang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    // public function indexincoming(Request $request)
    // {
    //     $search = $request->query('search');

    //     $products = Product::with('supplier')
    //         ->when($search, function ($query, $search) {
    //             return $query->where(function($q) use ($search) {
    //                 // Mencari berdasarkan kolom di tabel products
    //                 $q->where('name_product', 'like', "%{$search}%")
    //                 ->orWhere('description', 'like', "%{$search}%")
                    
    //                 // Mencari berdasarkan kolom nama_supplier di tabel suppliers
    //                 ->orWhereHas('supplier', function ($subQuery) use ($search) {
    //                     $subQuery->where('nama_supplier', 'like', "%{$search}%");
    //                 });
    //             });
    //         })
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(10);

    //     return view('admin.incoming.incoming-products', compact('products'));
    // }

    // public function createIncoming()
    // {
    //     $suppliers = Supplier::orderBy('nama_supplier', 'asc')->get();
    //     return view('admin.incoming.create-incoming', compact('suppliers'));
    // }

    // public function storeIncoming(Request $request)
    // {
    //     $request->validate([
    //         'name_product' => 'required|string|max:255',
    //         'description'  => 'nullable|string|max:1000',
    //         'stock'        => 'required|integer|min:0',
    //         'price'        => 'required|numeric|min:0',
    //         'id_supplier'  => 'required|exists:suppliers,id_supplier',
    //     ], [
    //         'id_supplier.exists' => 'Supplier yang dipilih tidak valid.'
    //     ]);

    //     // Menggunakan mass assignment untuk menyimpan data
    //     Product::create([
    //         'name_product' => $request->name_product,
    //         'description'  => $request->description,
    //         'stock'        => $request->stock,
    //         'price'        => $request->price,
    //         'id_supplier'  => $request->id_supplier,
    //     ]);

    //     return redirect()->route('incoming-products.index')
    //         ->with('success', 'Barang baru berhasil ditambahkan ke inventaris SiGudang!');
    // }

    public function indexIncoming(Request $request)
    {
        $search = $request->query('search');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $products = Product::with('supplier')
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name_product', 'like', "%{$search}%")
                    ->orWhereHas('supplier', function ($subQuery) use ($search) {
                        $subQuery->where('nama_supplier', 'like', "%{$search}%");
                    });
                });
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.incoming.incoming-productsx', compact('products'));
    }

    public function restock(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($id);
        $oldStock = $product->stock;
        $added = $request->amount;
        $newStock = $oldStock + $added;

        $product->update(['stock' => $newStock]);

        StockLog::create([
            'id_product' => $id,
            'stock_before' => $oldStock,
            'amount_added' => $added,
            'stock_after' => $newStock
        ]);

        return response()->json([
            'status' => 'success',
            'message' => "{$product->name_product} berhasil restok {$added} unit.",
            'new_stock' => $newStock
        ]);
    }
}
