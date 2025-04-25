<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {

        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        return view('admin.profile', compact('user'));
    }


    public function setting()
    {
        return view('admin.setting');
    }
}
