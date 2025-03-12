<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


//pages

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/shop', function () {
    return view('site.pages.shop');
})->name('shop');


Route::get('/blog', function () {
    return view('site.pages.blog');
})->name('blog');

// Route::get('/become-a-seller', function () {
//     return view('site.pages.become_a_seller');
// })->name('become.a.seller');



Route::prefix('cart')->as('cart.')->group(function () {
    Route::get('/', [CartController::class, 'getCarts'])->name('getCarts');
    Route::post('/store/{pid}/{quantity?}', [CartController::class, 'addToCart'])->name('addToCart');
});









require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/vendor.php';
