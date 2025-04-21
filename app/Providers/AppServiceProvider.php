<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer('*', function (View $view) {
            $carts = Auth::check() ? Cart::where('user_id', Auth::id())->get() : null;
            $wishlistCount = Auth::check() ? Wishlist::where('user_id', Auth::id())->count() : 0;

            // Pass both carts and wishlistCount to all views
            $view->with([
                'carts' => $carts,
                'wishlistCount' => $wishlistCount
            ]);
        });
    }
}
