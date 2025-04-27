<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        // $subcategories = Subcategory::with(['category'])->get();

        $subcategories = Subcategory::all();
        $categories = Category::all(); // fetch all categories

        return view('admin.products.product_subcategory', compact('subcategories', 'categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory = new Subcategory();
        $subcategory->subcategory_name = $request->name;
        $subcategory->category_id = $request->category_id;

        $subcategory->save();

        toastr()->success('Subcategory added successfully!');

        return redirect()->route('admin.product-subcategory.index');
    }

    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.product_subcategory', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',

        ]);
        $subcategory = Subcategory::findOrFail($id);

        $subcategory->subcategory_name = $request->name;

        $subcategory->save();
        toastr()->success('Subcategory updated successfully');
        return redirect()->route('admin.product-subcategory.index');
    }
    public function delete($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        toastr()->success('Subcategory deleted successfully');
        return redirect()->route('admin.product-subcategory.index');
    }


    public function getSubcategories($category_id)
    {
        $subcategories = Subcategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }
}
