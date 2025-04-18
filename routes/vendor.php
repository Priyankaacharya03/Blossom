<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Vendor\HomeController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\CategoryController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCheckMiddleware;


// Route::prefix('vendor')->as('vendor.')->middleware('auth')->group(function () {

//     Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
// });




Route::middleware([AuthCheckMiddleware::class])->group(function () {

    Route::get('/become-a-seller', [VendorController::class, 'vendorRegister'])->name('become.a.seller');

    Route::prefix('vendor')->as('vendor.')->group(function () {

        Route::post('/store', [VendorController::class, 'store'])->name('store');

        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::prefix('product')->as('product.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
        });


        Route::prefix('order')->as('order.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
          
        });

        Route::get('/details/{id}', [VendorController::class, 'getVendorDetails'])->name('details');
    });
});
