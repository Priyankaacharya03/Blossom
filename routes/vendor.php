<?php

use App\Http\Controllers\vendor\HomeController;
use Illuminate\Support\Facades\Route;

// Route::prefix('vendor')->as('vendor.')->middleware('auth')->group(function () {

//     Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
// });

Route::prefix('vendor')->as('vendor.')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

