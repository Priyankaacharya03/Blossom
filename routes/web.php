<?php


use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


//pages

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', function () {
    return view('site.pages.shop');
})->name('shop');


Route::get('/blog', function () {
    return view('site.pages.blog');
})->name('blog');

// Route::get('/become-a-seller', function () {
//     return view('site.pages.become_a_seller');
// })->name('become.a.seller');







require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/vendor.php';
