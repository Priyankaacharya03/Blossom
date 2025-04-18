<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'role' => 'required|in:admin,user',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'password' => 'required | confirmed | min:8 | max :30',

        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->profile_img = $request->image;
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
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'password' => 'required | confirmed | min:8 | max :30',

        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->profile_img = $request->image;
        $user->password = Hash::make($request->password);
        $user->save();

        toastr()->success('User added sucessfully');
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
