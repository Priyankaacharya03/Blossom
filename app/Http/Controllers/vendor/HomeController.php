<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dash()
    {
        return view('vendor.dashboard');
    }

    public function index()
    {
        $vendor = auth()->user();
        $vendor_id = $vendor->vendor->id;
        // Get vendor statistics
        $totalProducts = Product::where('vendor_id', $vendor_id)->count();
        $outOfStockProducts = Product::where('vendor_id', $vendor_id)->where('stock', 0)->count();

        $orderItems = OrderItem::whereHas('order', function ($query) {
            $query->where('order_status', 'confirmed');
        })
            ->where('vendor_id', 1)
            ->get();

        $totalOrders = OrderItem::where('vendor_id', $vendor_id)->count();
        $pendingOrders = OrderItem::where('vendor_id', $vendor_id)
            ->whereHas('order', function ($query) {
                $query->whereIn('order_status', ['pending', 'processed']);
            })->count();
        $completedOrders = OrderItem::where('vendor_id', $vendor_id)
            ->whereHas('order', function ($query) {
                $query->where('order_status', 'confirmed');
            })->count();

        $totalRevenue = OrderItem::where('vendor_id', $vendor_id)
            ->whereHas('order', function ($query) {
                $query->where('order_status', 'confirmed');
            })
            ->sum('price');

        $currentMonthRevenue = OrderItem::where('vendor_id', $vendor_id)
            ->whereHas('order', function ($query) {
                $query->where('order_status', 'confirmed');
            })
            ->whereMonth('created_at', now()->month)
            ->sum('price');


        // Get recent orders
        $recentOrders = OrderItem::with(['product', 'order.user'])
            ->where('vendor_id', $vendor_id)
            ->latest()
            ->take(5)
            ->get();


        // Get low stock products
        $lowStockProducts = Product::with('category')
            ->where('vendor_id', $vendor_id)
            ->where('stock', '<=', 5)
            ->where('stock', '>', 0)
            ->get();

        // Chart data
        $salesChartLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $salesChartOrders = [15, 20, 25, 30, 25, 35, 40];
        $salesChartRevenue = [150, 200, 250, 300, 250, 350, 400];



        return view('vendor.dashboard', compact(
            'vendor',
            'totalProducts',
            'outOfStockProducts',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalRevenue',
            'currentMonthRevenue',
            'recentOrders',
            'lowStockProducts',
            'salesChartLabels',
            'salesChartOrders',
            'salesChartRevenue',
        ));
    }
}
