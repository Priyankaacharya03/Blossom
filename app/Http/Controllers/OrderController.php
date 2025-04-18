<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $orders = Order::with('user:id,name')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function getOrderItems($id)
    {
        $order = Order::with(['orderItems.product', 'shippingAddress'])->findOrFail($id);

        $orderItems = $order->orderItems;
        $shippingInfo = $order->shippingAddress;


        return view('admin.orders.order_items', compact('order', 'orderItems', 'shippingInfo'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processed,shipped,delivered,cancelled',
        ]);

        $order = Order::find($id);
        $order->order_status = $request->status;
        $order->save();

        toastr()->success("Order Status updated to {$order->order_status}");
        return redirect()->back();
    }
}
