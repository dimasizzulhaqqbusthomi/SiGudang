<?php

use App\Http\Controllers\Admin\CashierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PrintController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Cashier\PrintCashierController;
use App\Http\Controllers\Cashier\SaleCashierController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('/admin', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');

    Route::get('admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('suppliers', SupplierController::class);

    Route::resource('products', ProductController::class);

    // Route::get('incoming-products', [ProductController::class, 'indexIncoming'])->name('incoming-products.index');

    // Route::get('incoming-products/create', [ProductController::class, 'createIncoming'])->name('incoming-products.create');

    // Route::post('incoming-products', [ProductController::class, 'storeIncoming'])->name('incoming-products.store');

    Route::get('incoming-products', [ProductController::class, 'indexIncoming'])->name('incoming-products.index');

    Route::post('/incoming-products/{id}/restock', [ProductController::class, 'restock'])->name('products.restock');

    Route::resource('manage-cashiers', CashierController::class);

    Route::patch('cashiers/{id}/update-role', [CashierController::class, 'updateRole'])->name('cashiers.update-role');

    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');

    Route::post('/sales/store', [SaleController::class, 'store'])->name('sales.store');
    
    // Route::get('/sales/history', [SaleController::class, 'history'])->name('sales.history');

    Route::get('/prints' , function () {
        return view('admin.prints.manage-prints');
    })->name('prints.index');

    Route::get('/print-products', [PrintController::class, 'printProducts'])->name('print.products');
    Route::get('/print-incoming', [PrintController::class, 'printIncoming'])->name('print.incoming');
    Route::get('/print-sales', [PrintController::class, 'printSales'])->name('print.sales');
});

Route::middleware(['auth', 'role:cashier'])->group(function () {
    Route::get('/cashier', function () {
        return view('cashier.dashboard');
    })->name('cashier.dashboard');

    Route::get('/salescashier', [SaleCashierController::class, 'index'])->name('salesCashier.index');

    Route::post('/salescashier/store', [SaleCashierController::class, 'store'])->name('salesCashier.store');

    Route::get('/printscashier' , function () {
        return view('cashier.prints.manage-prints');
    })->name('printsCashier.index');

    Route::get('/print-products-cashier', [PrintCashierController::class, 'printProducts'])->name('printCashier.products');
    Route::get('/print-incoming-cashier', [PrintCashierController::class, 'printIncoming'])->name('printCashier.incoming');
    Route::get('/print-sales-cashier', [PrintCashierController::class, 'printSales'])->name('printCashier.sales');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile-admin', [ProfileController::class, 'editAdmin'])->name('profile.edit-admin');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
