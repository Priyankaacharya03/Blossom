<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\AuthCheckMiddleware;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;


//pages

Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('/shop', [HomeController::class, 'shop'])->name('shop');

Route::get('/product-details/{id}', [ProductController::class, 'productDetails'])->name('product.details');


Route::get('/blog', function () {
    return view('site.pages.blog');
})->name('blog');





Route::middleware([AuthCheckMiddleware::class])->group(function () {

    Route::prefix('cart')->as('cart.')->group(function () {
        Route::get('/', [CartController::class, 'getCarts'])->name('getCarts');
        Route::post('/store/{pid}/{quantity?}', [CartController::class, 'addToCart'])->name('addToCart');
        Route::put('/cart/update/{id}', [CartController::class, 'updateCart'])->name('update');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::post('/checkout/store', [CartController::class, 'storeCheckout'])->name('store.checkout');
        Route::delete('/delete/{id}', [CartController::class, 'delete'])->name('delete');
        Route::get('/confirm-page', [CartController::class, 'confirmPage'])->name('confirmpage');
        Route::get('/confirm', [CartController::class, 'confirm'])->name('confirm');
    });

    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::get('/profile-edit', [UserController::class, 'edit'])->name('profile.edit');
        Route::put('/profile-update', [UserController::class, 'update'])->name('profile.update');

        Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('password.change');
        Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.update');

        Route::get('/order', [UserController::class, 'orders'])->name('order');
        Route::get('/order-details/{order_id}', [UserController::class, 'orderDetails'])->name('order.details');
    });
    Route::get('/order-confirm', [OrderController::class, 'orderConfirm'])->name('orde.confirmr');

    Route::get('/search', [HomeController::class, 'search'])->name('search');


    Route::get('/khati/return', [PaymentController::class, 'return']);
});




require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/vendor.php';
