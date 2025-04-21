<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user',
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'password' => 'required | confirmed | min:8 | max :30',

        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->hasFile('profile_img')) {
            if ($user->profile_img) {
                Storage::delete('public/users/' . $user->profile_img); // Delete the old image
            }
            $image = $request->file('profile_img');
            $imageName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('/users', $imageName, 'public');
            $user->profile_img = $imageName;
        }

        // $user->profile_img = $request->image;
        $user->password = Hash::make($request->password);
        $user->save();

        toastr()->success('User added sucessfully');
        return redirect()->back();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user',));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],  // Correct way to ignore current user's email
            'role' => 'required|in:admin,user',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'password' => 'nullable|confirmed|min:8|max:30',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // If a new profile image is uploaded, handle the update
        if ($request->hasFile('profile_img')) {
            // If the user already has a profile image, delete it from storage
            if ($user->profile_img) {
                Storage::delete('public/users/' . $user->profile_img);
            }

            // Store the new profile image
            $image = $request->file('profile_img');
            $imageName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('/users', $imageName, 'public');
            $user->profile_img = $imageName;  // Save the new image name in the database
        }

        // If a password is provided, update it
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        toastr()->success('User updated successfully');
        return redirect()->back();
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        toastr()->success('User deleted successfully');

        return back();
    }
}
