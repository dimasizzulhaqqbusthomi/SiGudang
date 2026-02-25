<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $totalSales = Sale::sum('total_price'); // Nominal uang
        
        // Menghitung berapa kali transaksi terjadi
        $totalTransactions = Sale::count(); 

        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalSuppliers', 
            'totalSales',
            'totalTransactions'
        ));
    }
}