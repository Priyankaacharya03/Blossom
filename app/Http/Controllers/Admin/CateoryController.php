<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CateoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.products.product_category', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'status' => 'nullable|boolean', // Ensures status is either true (1) or false (0)
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',

        ]);

        $category = new Category();
        $category->category_name = $request->name;
        $category->status = $request->status ?? 1; // Default to active if not provided
        $category->image =  $request->file('image')->store('categories', 'public');
        $category->save();

        toastr()->success('Category added successfully!');

        return redirect()->route('admin.product-category.index');
    }


    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:1,0', // Assuming status can be 'active' or 'inactive'
            'image' => 'required|image|max:4096',

        ]);
        $category = Category::findOrFail($id);

        // Initialize $imagePath in case no image is uploaded
        $imagePath = $category->image;

        if ($request->hasFile('image')) { // Check if image is uploaded /  image xa ki nai check gareko

            if ($category->image) { // Check if an image already exists in the database
                Storage::delete($category->image); // Delete the old image
            }
            $imagePath = $request->file('image')->store('categories', 'public');
        }


        $category->category_name = $request->name;
        $category->status = $request->status;
        $category->image =   $imagePath;
        $category->save();
        toastr()->success('Category updated successfully');
        return redirect()->route('admin.product-category.index');
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        toastr()->success('Category deleted successfully');
        return redirect()->route('admin.product-category.index');
    }

    public function showCategory($id)
    {
        $category = Category::findOrFail($id);

        // Load products under this category (assuming relation exists)
        $products = Product::where('category_id', $id)->get();

        return view('site.pages.category_show', compact('category', 'products'));
    }
}
