<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $featured_products = Product::orderByDesc('is_feature')->limit(3)->get();
        $products = Product::latest()->limit(15)->get();
        $cart = Cart::all();

        $wishlists = Wishlist::all();

        // Check if user is logged in
        $wishlistCount = Auth::check() ? Wishlist::where('user_id', auth()->id())->count() : 0;

        return view('site.pages.home', compact('products', 'cart', 'featured_products', 'categories', 'wishlistCount', 'wishlists'));
    }


    public function shop(Request $request)
    {
        $search = $request->query('search');
        $products = Product::all();
        if ($search) {
            // If search query exists, filter products by name
            $products = Product::where('product_name', 'like', '%' . $search . '%')
                ->with(['category'])
                ->get();
        } else {
            // If no search query, get all products
            $products = Product::with(['category'])->get();
        }
        return view('site.pages.shop', compact('products'));
    }


    // Display user's wishlist
    public function getWishlist()
    {
        if (!Auth::check()) {
            toastr()->error('You need to login to view your wishlist.');
            return redirect()->route('login');
        }

        $wishlists = Wishlist::with('product')
            ->where('user_id', auth()->id())->get();


        return view('site.pages.wishlist', compact('wishlists'));
    }

    public function toggle($tourId)
    {
        $user = auth()->user();
        $exists = Wishlist::where('user_id', $user->id)->where('product_id', $tourId)->first();

        if ($exists) {
            $exists->delete();
            toastr()->success('Removed from wishlist.');
            return back();
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $tourId
            ]);
            toastr()->success('Added to wishlist.');
            return back();
        }
    }
}
