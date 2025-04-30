<?php

namespace App\Http\Controllers;

use App\Mail\OrderConformationMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpseclib3\File\ASN1\Maps\Validity;

class CartController extends Controller
{
    // Private method to calculate cart totals
    private function calculateCartTotals($carts)
    {
        $subtotal = $quantity = $discount_amount = $total = 0;

        foreach ($carts as $cart) {
            $subtotal += $cart->product->price * $cart->quantity;
            $quantity += $cart->quantity;
            $discount_amount += $cart->product->discount_amount * $cart->quantity;
            $total += $cart->product->actual_amount * $cart->quantity;
        }

        return compact('subtotal', 'quantity', 'discount_amount', 'total');
    }


    public function getCarts()
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        $totals = $this->calculateCartTotals($carts);


        return view('site.pages.cart', array_merge(compact('carts'), $totals));
    }

    public function addToCart($pid, $quantity = 1)
    {
        $user_id = Auth::id();
        $product = Product::findOrFail($pid);

        // Ensure quantity is positive and reasonable
        if ($quantity < 1 || $quantity > $product->stock) {
            toastr()->error('Invalid quantity');
            return redirect()->route('index');
        }

        $cart = Cart::where('user_id', $user_id)->where('product_id', $pid)->first();

        $wishlist = Wishlist::where('user_id', $user_id)->where('product_id', $pid)->first();

        if ($wishlist) {
            $wishlist->delete();
        }

        if ($cart) {
            if (($cart->quantity + $quantity) > $product->stock) {
                toastr()->error('Not enough stock available');
                return redirect()->back();
            }
            $cart->quantity += $quantity;
        } else {
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->product_id = $pid;
            $cart->quantity = $quantity;
        }
        $cart->save();

        toastr()->success('Successfully added to cart');
        return redirect()->back();
    }

    // public function updateCart(Request $request, $id)
    // {
    //     $cart = Cart::findOrFail($id);
    //     $request->validate([
    //         'quantity' => 'required|numeric|min:1',
    //     ]);
    //     $product = Product::where('product_id', $id)->first();
    //     if ($product->stock > $request->quantity) {
    //         toastr()->error('Only ' .  $product->stock  . ' items are available in stock.');
    //         return redirect()->back();
    //     }

    //     $cart->quantity = $request->quantity;
    //     $cart->save();
    //     return redirect()->route('cart.getCarts');
    // }

    // public function updateCart(Request $request, $id)
    // {
    //     // Find the cart item
    //     $cart = Cart::findOrFail($id);

    //     // Validate the quantity input
    //     $request->validate([
    //         'quantity' => 'required|numeric|min:1',
    //     ]);

    //     // Find the product related to the cart item
    //     $product = Product::where('id', $cart->product_id)->first(); // Assuming you use `product_id` to reference the product

    //     // Check if requested quantity is more than the available stock
    //     if ($request->quantity > $product->stock) {
    //         // Display an error if the requested quantity exceeds stock
    //         toastr()->error('Only ' . $product->stock . ' items are available in stock.');
    //         return redirect()->back(); // Redirect back with error message
    //     }

    //     // Update the cart with the new quantity
    //     $cart->quantity = $request->quantity;
    //     $cart->save();

    //     // Optionally, you can show a success message when the cart is updated
    //     toastr()->success('Cart updated successfully!');
    //     return redirect()->back();
    // }

    public function update(Request $request, $cartId)
    {
        // Validate incoming data
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the cart item
        $cart = Cart::find($cartId);
        if (!$cart) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        // Update the quantity
        $cart->quantity = $request->quantity;
        $cart->save();

        // Recalculate the subtotal, total, and discount values for the updated cart
        $product = $cart->product;
        $subtotal = $cart->quantity * $product->price;
        $discountAmount = ($product->price * $product->discount_percent / 100) * $cart->quantity;
        $total = $subtotal - $discountAmount;

        // Recalculate the order summary (subtotal, quantity, discount, total)
        $orderSummary = [
            'subtotal' => $subtotal,
            'quantity' => $cart->quantity,
            'discount' => $discountAmount,
            'total' => $total,
        ];

        // Return updated data as JSON
        return response()->json([
            'success' => true,
            'subtotal' => $orderSummary['subtotal'],
            'quantity' => $orderSummary['quantity'],
            'discount' => $orderSummary['discount'],
            'total' => $orderSummary['total'],
        ]);
    }



    public function updateQuantity($id, $quantity)
    {
        $cart = Cart::findOrFail($id);
        $product = $cart->product; // Get associated product

        if ($quantity < 1 || $quantity > $product->stock) {
            return response()->json(['success' => false, 'message' => 'Invalid quantity'], 400);
        }

        $cart->quantity = $quantity;
        $cart->save();

        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        $totals = $this->calculateCartTotals($carts);

        return response()->json([
            'success' => true,
            'totals' => $totals
        ]);
    }

    public function delete($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $cart->delete();

        toastr()->success('Successfully removed from cart');
        return redirect()->route('cart.getCarts');
    }


    public function checkout()
    {
        $user_id = auth()->id();
        $user = Auth::user();
        $carts = Cart::where('user_id', $user_id)->with('product')->get();

        // Redirect if the cart is empty
        if ($carts->isEmpty()) {
            toastr()->error('Your cart is empty. Please add items before checking out.');
            return redirect()->route('cart.getCarts');
        }

        // Get the user's shipping address
        $shippingInfo = ShippingAddress::where('user_id', $user_id)->where('is_permanent', true)->first();

        $totals = $this->calculateCartTotals($carts);
        $shipping_cost = 100;
        $final_total = $totals['total'] + $shipping_cost;

        return view('site.pages.checkout', array_merge(compact('shippingInfo', 'carts', 'shipping_cost', 'final_total', 'user'), $totals));
    }

    public function storeCheckout(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:15',
            'landmark' => 'nullable|max:255',
            'postal_code' => 'required|max:10',
            'street_no' => 'nullable|max:50',
            'state' => 'required|max:100',
            'is_permanent' => 'required|boolean',
            'payment_method' => 'required',
        ]);

        $user_id = Auth::user()->id;
        $user = Auth::user();

        //Get users cart items
        $carts = Cart::where('user_id', $user_id)->get();

        $totalAmount = $carts->sum(function ($cart) {
            return $cart->product->actual_amount * $cart->quantity;
        });

        // Add shipping cost (default 100)
        $shipping_cost = 100;
        $totalAmount += $shipping_cost;  // Add shipping cost to the total amount


        //create new order instance
        $order = new Order();
        $order->user_id = $user_id;
        $order->order_status = 'pending';
        $order->total_amount = $totalAmount;
        $order->payment_method = $request->payment_method;
        $order->save();

        $shippingInfo = null;


        // Check if user wants to save this as permanent address
        if ($request->is_permanent) {
            $shippingInfo = ShippingAddress::where('user_id', $user_id)->where('is_permanent', true)->first();
        }

        //update existing shipping info if it exists
        if ($shippingInfo) {
            $shippingInfo->name = $request->name;
            $shippingInfo->email = $request->email;
            $shippingInfo->address = $request->address;
            $shippingInfo->phone_number = $request->phone_number;
            $shippingInfo->landmark = $request->landmark;
            $shippingInfo->postal_code = $request->postal_code;
            $shippingInfo->street_no = $request->street_no;
            $shippingInfo->state = $request->state;
            $shippingInfo->is_permanent = $request->is_permanent;
            $shippingInfo->order_id = $order->id;
            $shippingInfo->save();
        } else {
            // dd($request->all());
            // Create new shipping info if none exists
            $shippingInfo = new ShippingAddress();
            $shippingInfo->name = $request->name;
            $shippingInfo->email = $request->email;
            $shippingInfo->address = $request->address;
            $shippingInfo->phone_number = $request->phone_number;
            $shippingInfo->landmark = $request->landmark;
            $shippingInfo->postal_code = $request->postal_code;
            $shippingInfo->street_no = $request->street_no;
            $shippingInfo->state = $request->state;
            $shippingInfo->is_permanent = $request->is_permanent;
            $shippingInfo->user_id = $user_id;
            $shippingInfo->order_id = $order->id;
            $shippingInfo->save();
        }

        // dd($order);
        $orderItems = [];

        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            $orderItem = new OrderItem();
            $orderItem->quantity = $cart->quantity;
            $orderItem->price = $product->price;
            $orderItem->product_id = $cart->product_id;
            $orderItem->order_id = $order->id;
            $orderItem->vendor_id = $product->vendor_id;
            $orderItem->save();

            $orderItem->product_name = $product->product_name;
            $orderItems[] = $orderItem; // Push the item to the array
        }


        foreach ($carts as $cart) {
            $cart->delete();
        }
        if ($request->payment_method === 'khalti') {
            return PaymentController::khaltiPay($totalAmount, $order);
        }

        $order->order_status = 'confirmed';
        $order->save();

        Mail::to($user->email)->send(new OrderConformationMail($user->name, $order, $orderItems));

        $paymentMethod = 'COD';

        $transaction_id =  null;


        toastr()->success('Order successfully');
        return view('site.pages.order_confirm', compact('order', 'paymentMethod', 'orderItems', 'transaction_id'));

        // return redirect()->route('cart.confirmpage');
    }

    public function confirmPage()
    {
        $user_id = Auth::user()->id;

        $carts = Cart::where('user_id', $user_id)->with('product')->get();


        // Get the user's shipping address
        $shippingInfo = ShippingAddress::where('user_id', $user_id)->where('is_permanent', true)->first();

        $totals = $this->calculateCartTotals($carts);
        $shipping_cost = 100;
        $final_total = $totals['total'] + $shipping_cost;

        return view('site.pages.checkout', array_merge(compact('shippingInfo', 'carts', 'shipping_cost', 'final_total'), $totals));
    }
}
