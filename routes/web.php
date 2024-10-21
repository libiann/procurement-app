<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/suppliers', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('suppliers');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('suppliers', SupplierController::class);
    Route::resource('items', ItemController::class);
    Route::get('purchase-orders', [PurchaseOrderController::class, 'index'])->name('orders.index');
    Route::get('purchase-orders/add', [PurchaseOrderController::class, 'add'])->name('orders.create');
    Route::get('/get-item-details/{id}', [PurchaseOrderController::class, 'getItemDetails']);
    Route::post('purchase-orders/create', [PurchaseOrderController::class, 'store'])->name('orders.store');
    Route::get('order-export/{id}', [PurchaseOrderController::class, 'export'])->name('orders.export');
    Route::get('order-print/{id}', [PurchaseOrderController::class, 'print'])->name('orders.print');
});

require __DIR__ . '/auth.php';
