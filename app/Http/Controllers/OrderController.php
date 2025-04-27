<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $vendor = Vendor::where('user_id', $user->id)->first();

        //  dd($user);

        if ($user->role == 'vendor') {

            $orderIds = OrderItem::where('vendor_id', $vendor->id)
                ->pluck('order_id')
                ->unique()
                ->values()
                ->toArray();

            //dd($totalAmount);

            // dd($orderIds);

            $orders = Order::whereIn('id', $orderIds)->get();

            //dd($orders);

            foreach ($orders as $order) {

                //dd($order);
                $orderDetails = OrderItem::where('vendor_id', $vendor->id)
                    ->where('order_id', $order->id)->get();

                //dd($orderDetails);
                $order_cost = 0;
                foreach ($orderDetails as $orderDetail) {


                    $order_cost += $orderDetail['price'] * $orderDetail['quantity'];

                    //dd($order_cost);
                }

                $totalItem = OrderItem::where('vendor_id', $vendor->id)
                    ->where('order_id', $order->id)->count();

                //dd($order->id);

                $order->totalAmount = $order_cost;
                $order->totalItem = $totalItem;

                //dd($order);
            }
        } else if ($user->role == 'admin') {
            $orders = Order::query();
        }

        // $orders = Order::all();

        //dd($orders);

        if ($user->role === "admin") {

            $orders = $orders->with('orderItems.product')->latest()->get();

            //dd($orders);
            return view('admin.orders.index', compact('orders'));
        } elseif ($user->role === "vendor") {

            $vendorProducts = Product::where('vendor_id', $vendor->id)->pluck('id');

            // $orders = $orders->whereHas('orderItems', function ($query) use ($vendorProducts) {
            //     $query->whereIn('product_id', $vendorProducts);
            // })->with('orderItems.product')->latest()->get();

            return view('vendor.orders.index', compact('orders'));
        }

        return redirect()->route('home')->with('error', 'Unauthorized access');
    }


    public function getOrderItems($id)
    {
        $user = Auth::user();
        $orderId = $id;

        // Start the query to fetch the order items based on the order_id
        $orderItemsQuery = OrderItem::with('product')->where('order_id', $orderId);

        // If the user is a vendor, filter by the vendor_id
        if ($user->role === "vendor") {
            $vendor = Vendor::where('user_id', $user->id)->first();
            $orderItemsQuery->where('vendor_id', $vendor->id);
        }

        // Execute the query to get the order items
        $orderItems = $orderItemsQuery->get();

        // Return the appropriate view based on user role
        if ($user->role === "admin") {
            return view('admin.orders.order_items', compact('orderItems'));
        } elseif ($user->role === "vendor") {
            return view('vendor.orders.order_items', compact('orderItems'));
        }

        // Unauthorized access for other roles
        return redirect()->back()->with('error', 'Unauthorized access.');
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
