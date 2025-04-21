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


        // $vendor = Vendor::where('user_id', $user->id)->first();



        //  dd($user);

        if ($user->role == 'vendor') {

            $orderIds = OrderItem::where('vendor_id', Auth::user()->id)
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
                $orderDetails = OrderItem::where('vendor_id', Auth::user()->id)
                    ->where('order_id', $order->id)->get();

                //dd($orderDetails);
                $order_cost = 0;
                foreach ($orderDetails as $orderDetail) {


                    $order_cost += $orderDetail['price'] * $orderDetail['quantity'];

                    //dd($order_cost);
                }


                $totalItem = OrderItem::where('vendor_id', Auth::user()->id)
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

            $vendorProducts = Product::where('vendor_id', Auth::user()->id)->pluck('id');

            // $orders = $orders->whereHas('orderItems', function ($query) use ($vendorProducts) {
            //     $query->whereIn('product_id', $vendorProducts);
            // })->with('orderItems.product')->latest()->get();




            return view('vendor.orders.index', compact('orders'));
        }

        return redirect()->route('home')->with('error', 'Unauthorized access');
    }


    public function getOrderItems($id)
    {
        // dd($id);

        $user = Auth::user();
        //$customer_id = $id;
        // dd($user->id);

        $orderId = $id;


        // dd($user)
        // dd($user->id);
        $orderItems = OrderItem::with('product')->where('vendor_id', Auth::user()->id)
            ->where('order_id', $orderId)->get();


        // dd($orderItems);
        // dd($orderItems);



        // $vendor = Vendor::where('user_id', Auth::user()->id)->first();

        // $orderIds = Order::where('user_id', $id)->pluck('id')->toArray();

        // // $vendorOrderId = OrderItem::whereIn('order_id', $orderIds)

        // $orderItems = OrderItem::with('product')->whereIn('order_id', $orderIds)
        //     ->where('vendor_id', $vendor->id)->get();

        // dd($orderItems);

        // $productIds = Product::where('vendor_id', $vendor->id)->pluck('id')->toArray();

        // $orderIds = OrderItem::whereIn('product_id', $productIds)
        //     ->pluck('id')->toArray();

        // $orderIds = Order::whereIn('id', $orderIds)->where('user_id', $customer_id)->pluck('id')->toArray();

        // $uproductIds = OrderItem::wherein('order_id', $orderIds)->pluck('product_id')->toArray();
        // // $orderItems = 
        // // dd($uproductIds);
        // $productDetails = Product::whereIn('id', $uproductIds)->get();


        // $orderDetails = [
        //     ''
        // ]

        //dd($productDetails);    


        // $order = Order::with(['shippingAddress'])->whereIn('id', $productIds)->get();

        //        dd($order);
        // $orderItems = $orderItems;
        // $shippingInfo = $order->shippingAddress;

        if ($user->role === "admin") {
            return view('admin.orders.order_items', compact('order', 'orderItems', 'shippingInfo'));
        } elseif ($user->role === "vendor") {

            // $vendorProducts = Product::where('vendor_id', $vendor->id)->pluck('id');
            // $orderItems = $orderItems->filter(function ($item) use ($vendorProducts) {
            //     return $vendorProducts->contains($item->product_id);
            // });
            // if ($orderItems->isEmpty()) {
            //     return redirect()->back()->with('error', 'No items found for your vendor products.');
            // }

            return view('vendor.orders.order_items', compact('orderItems'));
        }

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
