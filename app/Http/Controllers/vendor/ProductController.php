<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::with('category')->get();
        // $categories = Category::all();
        $products = Product::with(['category', 'vendor'])->get();
        return view('vendor.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('vendor.products.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'discount_amount' => 'nullable|numeric|min:0|lt:price',
            'image' => 'required|image|max:4096',
            'is_feature' => 'sometimes | boolean',
            'description' => 'nullable|string',
            'vendor_name' => 'nullable| string',
        ]);

        //This ensures no duplicate slugs in the products table
        $slug = Str::slug($request->name);
        while (Product::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->name) . '-' . rand(1, 100);
        }

        // dd($request->all());
        $product = new Product();
        $product->product_name = $request->name;
        $product->slug = $slug;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $discount_amount = $request->discount_amount ?? 0;
        $product->discount_amount = $discount_amount;
        $product->primary_image =  $request->file('image')->store('products', 'public');
        $product->is_feature = $request->is_feature;
        $product->description = $request->description;
        $product->actual_amount = ($request->price - $request->discount_amount);
        // $product->vendor_id = Auth::id();
        // $product->vendor_id = "";
        $product->save();

        toastr()->success('Product added successfully');
        return redirect()->route('vendor.product.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('vendor.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'discount_amount' => 'nullable|numeric|min:0|lt:price',
            'image' => 'image|max:4096',
            'description' => 'nullable|string',
            'vendor_name' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);

        $slug = Str::slug($request->name);
        while (Product::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->name) . '-' . rand(1, 100);
        }

        // Initialize $imagePath in case no image is uploaded
        $imagePath = $product->primary_image;

        if ($request->hasFile('image')) { // Check if image is uploaded /  image xa ki nai check gareko

            if ($product->primary_image) { // Check if an image already exists in the database
                Storage::delete($product->primary_image); // Delete the old image
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->product_name = $request->name;
        $product->slug = $slug;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $discount_amount = $request->discount_amount ?? 0;
        $product->discount_amount = $discount_amount;
        $product->primary_image =  $imagePath;
        $product->description = $request->description;
        $product->actual_amount = ($request->price - $request->discount_amount);
        $product->vendor_id = Auth::id();
        $product->save();

        toastr()->success('Product updated successfully');
        return redirect()->route('vendor.product.index');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        toastr()->success('Product deleted successfully');

        return back();
    }
}
