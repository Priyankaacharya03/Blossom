<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetails($id)
    {
        // Fetch product from database
        $product = Product::with('vendor:id,vendor_name')->findOrFail($id);
        // Get related products (products from the same category)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();


        return view('site.pages.product_details', compact('product', 'relatedProducts'));
    }
}
