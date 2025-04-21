<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public static function khaltiPay($totalAmount, $order)
    {
        $user = Auth::user();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'key live_secret_key_68791341fdd94846a146f0457ff7b455',
        ])
            ->post('https://dev.khalti.com/api/v2/epayment/initiate/', [
                "return_url" => "http://127.0.0.1:8000/khati/return",
                "website_url" => "http://127.0.0.1:8000/",
                "amount" => $totalAmount * 100,
                "purchase_order_id" => $order->id,
                "purchase_order_name" => "product",
                "customer_info" => [
                    "name" => $user->name,
                    "email" => $user->email,
                ],
            ]);

        // Log or debug the response
        if ($response->ok()) {
            $body = json_decode($response->body());

            return redirect()->to($body->payment_url);
        } else {
            toastr()->error('Khalti Server Error');
            return redirect()->route('index');
            // dd($response->body());
        }
    }

    public function return(Request $request)
    {
        if ($request->status === 'Completed') {
            $payment = new Payment();
            $payment->amount = $request->total_amount;
            $payment->transaction_id = $request->transaction_id;
            $payment->payment_status = $request->status;
            $payment->payload = json_encode($request->all());
            $payment->order_id = $request->purchase_order_id;
            $payment->save();

            $order = Order::find($request->purchase_order_id);
            $order->order_status = 'confirmed';
            $order->save();

            $paymentMethod = 'khalti';

            $transaction_id = $request->transaction_id;

            $order = Order::find($request->purchase_order_id);
            $orderItems = OrderItem::where('order_id', $request->purchase_order_id)->get();

            foreach ($orderItems as $orderItem) {
                $product = Product::find($orderItem->product_id);
                $orderItem->product_name = $product->product_name;
            }

            toastr()->success('Order successfully');
            return view('site.pages.order_confirm', compact('order', 'paymentMethod', 'orderItems', 'transaction_id'));
        } else {
            toastr()->error('Payment Canceled');
            return redirect()->route('index');
        }
    }
}
