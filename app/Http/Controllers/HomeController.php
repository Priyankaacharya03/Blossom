<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $featured_products = Product::orderByDesc('is_feature')->limit(4)->get();
        $products = Product::latest()->limit(15)->get();
        $cart = Cart::all();

        $wishlists = Wishlist::all();

        // Check if user is logged in
        $wishlistCount = Auth::check() ? Wishlist::where('user_id', auth()->id())->count() : 0;

        return view('site.pages.home', compact('products', 'cart', 'featured_products', 'categories', 'wishlistCount', 'wishlists'));
    }


    public function shop(Request $request)
    {
        // return $request->all();
        // Get all categories with product count
        $categories = Category::withCount('product')->get();
        // dd($categories);

        // dd($categories);
        // Initialize query builder
        $productsQuery = Product::query();

        // dd($productsQuery);

        // Initialize variables
        $selectedCategory = null;
        $selectedSubcategory = null;
        $subcategories = collect();
        // dd($subcategories);

        // Search filter
        if ($request->has('search') && $request->search) {
            $productsQuery->where('product_name', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->has('category_id') && $request->category_id) {
            $productsQuery->where('category_id', $request->category_id);

            // Get selected category for display
            $selectedCategory = Category::find($request->category_id);

            // dd($selectedCategory);

            // Get subcategories for the selected category with product count
            if ($selectedCategory) {
                $subcategories = Subcategory::where('category_id', $request->category_id)
                    ->withCount('product')

                    ->get();

                // dd($subcategories);
            }
        }

        // Subcategory filter
        if ($request->has('subcategory_id') && $request->subcategory_id) {
            $productsQuery->where('subcategory_id', $request->subcategory_id);

            // Get selected subcategory for display
            $selectedSubcategory = Subcategory::find($request->subcategory_id);
        }

        // Price range filter
        if ($request->has('min_price') && $request->min_price) {
            $productsQuery->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $productsQuery->where('price', '<=', $request->max_price);
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $productsQuery->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $productsQuery->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $productsQuery->orderBy('created_at', 'desc');
                    break;
                case 'name_asc':
                    $productsQuery->orderBy('product_name', 'asc');
                    break;
                case 'name_desc':
                    $productsQuery->orderBy('product_name', 'desc');
                    break;
                default:
                    $productsQuery->orderBy('id', 'desc');
            }
        } else {
            // Default sorting
            $productsQuery->orderBy('id', 'desc');
        }

        // Eager load relationships
        $productsQuery->with(['category', 'subcategory']);

        // Paginate results
        $products = $productsQuery->paginate(12);

        // Pass data to view
        return view('site.pages.shop', compact(
            'products',
            'categories',
            'subcategories',
            'selectedCategory',
            'selectedSubcategory'
        ));
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

    public function toggle($product_id)
    {
        $user = auth()->user();
        $exists = Wishlist::where('user_id', $user->id)->where('product_id', $product_id)->first();

        if ($exists) {
            $exists->delete();
            toastr()->success('Removed from wishlist.');
            return back();
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product_id
            ]);


            toastr()->success('Added to wishlist.');
            return back();
        }
    }
}
