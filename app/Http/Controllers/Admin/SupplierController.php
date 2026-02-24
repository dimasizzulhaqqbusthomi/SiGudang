<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $suppliers = Supplier::when($search, function ($query, $search) {
            return $query->where('nama_supplier', 'like', "%{$search}%")
                        ->orWhere('alamat_supplier', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('admin.suppliers.manage-supplier', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.suppliers.create-supplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat_supplier' => 'required|string|max:500',
            'no_telp_supplier' => 'required|string|max:20',
        ], 
        [
            'nama_supplier.required' => 'Nama supplier wajib diisi.',
            'alamat_supplier.required' => 'Alamat supplier wajib diisi.',
            'no_telp_supplier.required' => 'Nomor telepon supplier wajib diisi.',
        ]);

        Supplier::create($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {   
        return view('admin.suppliers.edit-supplier', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat_supplier' => 'required|string|max:500',
            'no_telp_supplier' => 'required|string|max:20',
        ], 
        [
            'nama_supplier.required' => 'Nama supplier wajib diisi.',
            'alamat_supplier.required' => 'Alamat supplier wajib diisi.',
            'no_telp_supplier.required' => 'Nomor telepon supplier wajib diisi.',
        ]);

        $supplier->update($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
