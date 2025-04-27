<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalOrders = Order::where(function ($query) {
            $query->where('payment_method', 'cod')
                ->orWhere(function ($q) {
                    $q->where('payment_method', 'khalti')
                        ->whereHas('payment', function ($p) {
                            $p->where('payment_status', 'completed');
                        });
                });
        })
            ->count();
        $totalVendors = User::where('role', 'vendor')->count();
        $totalRevenue = 0;
        $recentOrders = Order::latest()->limit(10)->get();
        return view('admin.dashboard', compact('totalUsers', 'totalOrders', 'totalVendors', 'totalRevenue', 'recentOrders'));
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
