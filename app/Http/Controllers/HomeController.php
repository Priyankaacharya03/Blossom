<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
}
