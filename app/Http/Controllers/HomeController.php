<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return view('site.pages.home', compact('products', 'cart', 'featured_products', 'categories'));
    }

    public function shop()
    {
        $products = Product::all();
        return view('site.pages.shop', compact('products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::where('product_name', 'LIKE', "%$keyword%")->get();

        $categories = Category::where('category_name', 'LIKE', "%$keyword%")->get();

        // $data = [
        //     'products' =>  Product::where('product_name', 'LIKE', "%$keyword%")->get(),
        //     'categories' => Category::where('category_name', 'LIKE', "%$keyword%")->get()
        // ];

        return view('site.pages.search', compact('products', 'categories'));
    }


    public function getWishlist()
    {
        if (!Auth::check()) {
            return redirect()->route('userHome')->with('error', 'You need to login to view your wishlist.');
        }

        $wishlists = Wishlist::with('product')
            ->where('user_id', auth()->id())
            ->paginate(12);

        return view('site.pages.wishlist', compact('wishlists'));
    }


    public function getAddOnWhishlist($id)
    {
        if (Auth::check()) {
            $check = Wishlist::where('product_id', $id)
                ->where('user_id', Auth()->user()->id)
                ->count();

            if ($check === 0) {
                $wishlist = new Wishlist;
                $wishlist->product_id = $id;
                $wishlist->user_id = Auth()->user()->id;
                $wishlist->save();

                // return response()->json(['status' => 'added']);
                toastr()->success('wishlist added successfully');
                return redirect()->route('index');
            } else {
                Wishlist::where('product_id', $id)
                    ->where('user_id', Auth()->user()->id)
                    ->delete();

                // return response()->json(['status' => 'removed']);
                toastr()->success('Wishlist removed successfully');
                return redirect()->route('index');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to login to add to wishlist.');
        }
    }
}
