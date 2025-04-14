<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('admin.carousels.index', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $carousel = new Carousel();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('carousels', $imageName, 'public');
            $carousel->image = $imageName;
        }

        $carousel->save();

        return redirect()->route('admin.carousel.index');
    }

    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);
        $request->validate([
            'image' => 'required|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($carousel->image) {
                Storage::delete('public/carousels/' . $carousel->image); // Delete the old image
            }
            $image = $request->file('image');
            $imageName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('/carousels', $imageName, 'public');
            $carousel->image = $imageName;
        }
        $carousel->save();

        return redirect()->route('admin.carousel.index');
    }
}
