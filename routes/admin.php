<?php

use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\CateoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

// Route::get('/admin-dashboard', function () {
//     return view('admin.dashboard');
// });

Route::prefix('admin')->as('admin.')->middleware(['admin'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::prefix('product')->as('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('delete');


        Route::get('/images/{pid}', [ProductImageController::class, 'index'])->name('images.index');
        Route::post('/images/store/{pid}', [ProductImageController::class, 'store'])->name('images.store');
        Route::delete('/images/delete/{id}', [ProductImageController::class, 'delete'])->name('images.delete');
    });


    Route::prefix('product-category')->as('product-category.')->group(function () {
        Route::get('/', [CateoryController::class, 'index'])->name('index');
        Route::post('/store', [CateoryController::class, 'store'])->name('store');
        Route::put('/edit/{id}', [CateoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CateoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
    });

    Route::prefix('vendor')->as('vendor.')->group(function () {
        Route::get('/request', [VendorController::class, 'vendorRequest'])->name('request');
        Route::get('/request-details/{id}', [VendorController::class, 'vendorRequestDetails'])->name('request.details');
        Route::post('/request-handle/{id}', [VendorController::class, 'handleRequest'])->name('request.handle');
    });

    Route::prefix('carousel')->as('carousel.')->group(function () {
        Route::get('/', [CarouselController::class, 'index'])->name('index');
        Route::post('/store', [CarouselController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CarouselController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CarouselController::class, 'delete'])->name('delete');
    });
});
