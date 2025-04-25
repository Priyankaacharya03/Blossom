<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetails($id)
    {
        // Fetch product from database with vendor information
        $product = Product::with('vendor:id,vendor_name')->findOrFail($id);

        // Get related products (products from the same category)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        // Fetch gallery images for the product
        $productImages = ProductImage::where('product_id', $id)->get();

        // Return the product details view with product, related products, and images
        return view('site.pages.product_details', compact('product', 'relatedProducts', 'productImages'));
    }
}
