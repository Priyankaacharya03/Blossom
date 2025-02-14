<?php

use App\Http\Controllers\Admin\CateoryController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/admin-dashboard', function () {
//     return view('admin.dashboard');
// });

Route::prefix('admin')->as('admin.')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');



    Route::prefix('product-category')->as('product-category.')->group(function () {
        Route::get('/', [CateoryController::class, 'index'])->name('index');
        Route::post('/store', [CateoryController::class, 'store'])->name('store');
        Route::put('/edit/{id}', [CateoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CateoryController::class, 'delete'])->name('delete');
    });
});
