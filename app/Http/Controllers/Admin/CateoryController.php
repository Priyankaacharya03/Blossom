<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

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

        ]);

        $category = new Category();
        $category->category_name = $request->name;
        $category->status = $request->status ?? 1; // Default to active if not provided
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
        ]);

        $category->category_name = $request->name;
        $category->status = $request->status;
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
}
