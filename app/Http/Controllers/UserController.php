<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function profile()
    {

        $user = Auth::user();
        $shippingInfo = ShippingAddress::all();
        return view('user.profile', compact('user', 'shippingInfo'));
    }
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit_profile', compact('user'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = Auth::user();

        $user->name = $request->name;

        if ($request->hasFile('profile_img')) {
            if ($user->profile_img) {
                Storage::delete('public/users/' . $user->profile_img); // Delete the old image
            }
            $image = $request->file('profile_img');
            $imageName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('/users', $imageName, 'public');
            $user->profile_img = $imageName;
        }

        $user->save();

        // Redirect back with a success message
        toastr()->success('Profile updated successfully.');
        return redirect()->back();
    }

    //change password
    public function showChangePasswordForm()
    {
        $user = Auth::user();
        return view('user.change_password', compact('user'));
    }

    // Handle the change password request
    public function changePassword(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the current password matches the one in the database
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            // If the current password does not match, return with an error

            toastr()->error('Current password is incorrect.');
            return redirect()->back();
        }

        // Update the user's password in the database
        $user = Auth::user();
        $user->password = Hash::make($request->new_password); // Hash the new password
        $user->save();

        // Redirect back with a success message
        toastr()->success('Password updated successfully!');
        return redirect()->back(); // Redirect to the profile or dashboard page
    }



    //orders

    public function orders(Request $request)
    {
        $user_id = Auth::id();
        $filter = $request->query('filter');

        // Start the query builder
        $ordersQuery = Order::where('user_id', $user_id) // Filter by user_id
            ->with(['orderItems.product'])
            ->withCount('orderItems')
            ->latest();

        // If a filter is provided, add the 'order_status' condition
        if ($filter) {
            $ordersQuery->where('order_status', $filter);
        }

        $orders = $ordersQuery->get();

        return view('site.pages.order', compact('orders'));
    }


    public function orderDetails($order_id)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('id', $order_id)->first();
        return view('site.pages.order_details', compact('order'));
    }
}
