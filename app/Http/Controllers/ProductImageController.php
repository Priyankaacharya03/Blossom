<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function index($pid)
    {
        $product = Product::findOrFail($pid); // product ko kei details fetch garna use gareko
        $productImages = ProductImage::where('product_id', $pid)->get(); // Fetch gallery images for that product

        return view('admin.products.product_images', compact('productImages', 'product'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:3000',
        ]);

        // dd($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('productImages', 'public');

                // Save each image to the database
                $productImage = new ProductImage();
                $productImage->product_id = $request->product_id; // Ensure product_id is stored
                $productImage->product_image = $imagePath;
                $productImage->save();
            }
        }

        return redirect()->route('admin.product.images.index', ['pid' => $request->product_id])
            ->with('success', 'Product gallery images added successfully!');
    }

    public function delete($id)
    {
        $gallery = ProductImage::findOrFail($id); // Find image by ID

        // Delete the image from storage
        if ($gallery->images) {
            Storage::disk('public')->delete($gallery->images);
        }

        $gallery->delete(); // Remove from database

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
