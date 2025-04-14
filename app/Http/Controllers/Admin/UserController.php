<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
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
            'gender' => 'nullable|in:male,female,other',
            'role' => 'required|in:admin,user',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->role = $request->role;
        $user->profile_img = $request->image;
        $user->save();

        toastr()->success('User added sucessfully');
        return redirect()->back();
    }
}
