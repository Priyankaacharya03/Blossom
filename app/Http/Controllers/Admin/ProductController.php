<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // public function index()
    // {
    //     // $products = Product::with('category')->get();
    //     // $categories = Category::all();
    //     $products = Product::with(['category', 'vendor'])->get();
    //     return view('admin.products.index', compact('products'));
    // }

    public function index(Request $request)
    {
        $search = $request->query('search');  // Get search query from request
        $filter = $request->query('filter');  // Get filter query from request

        // If there is a search query
        if ($search) {
            // Filter products by name
            $query = Product::where('product_name', 'like', '%' . $search . '%')->with(['category']);
        } elseif ($filter) {
            // If there is a category filter
            $query = Product::where('category_id', $filter)->with(['category']);
        } else {
            // If no search or filter, get all products
            $query = Product::with(['category']);
        }

        // Paginate the products
        $products = $query->paginate(10);

        // Get all categories to pass to the view
        $categories = Category::all();

        // Return the view with products and categories
        return view('admin.products.index', compact('products', 'categories'));
    }


    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.products.create', compact('categories', 'subcategories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'discount_percent' => 'nullable|numeric|min:0|lt:price',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_feature' => 'sometimes | boolean',
            'description' => 'nullable|string',
            'vendor_name' => 'nullable| string',
            'product_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
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
        $product->discount_percent = $request->discount_percent ?? 0;
        $product->primary_image =  $request->file('image')->store('products', 'public');
        $product->is_feature = $request->is_feature;
        $product->description = $request->description;
        $product->vendor_id = Auth::id();
        // $product->vendor_id = "";
        $product->save();

        if ($request->hasFile('product_image')) {
            foreach ($request->file('product_image') as $image) {
                $product_image = new ProductImage();
                $product_image->product_image = $image->store('productImages', 'public');
                $product_image->product_id = $product->id;
                $product_image->save();
            }
        }

        toastr()->success('Product added successfully');
        return redirect()->route('admin.product.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'discount_percent' => 'nullable|numeric|min:0|lt:price',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'product_images' => 'nullable|image',
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
        $discount_percent = $request->discount_percent ?? 0;
        $product->discount_percent = $discount_percent;
        $product->primary_image =  $imagePath;
        $product->description = $request->description;
        $product->vendor_id = Auth::id();
        $product->save();

        toastr()->success('Product updated successfully');
        return redirect()->route('admin.product.index');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        toastr()->success('Product deleted successfully');

        return back();
    }
}
