@extends('site.layouts.main')

@section('title', 'Order Confirmation')

@section('main-section')

<style>
    :root {
        --rose-gold: #bd8c7d;
        --rose-gold-light: #d4b2a7;
        --rose-gold-dark: #a67c6e;
        --grey: #808080;
        --grey-dark: #4a4a4a;
    }

    .order-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .order-header {
        text-align: center;
        margin-bottom: 2rem;
        color: var(--rose-gold-dark);
        border-bottom: 2px solid var(--rose-gold-light);
        padding-bottom: 1rem;
    }

    .order-info {
        padding: 1rem;
        border-radius: 5px;
        margin-bottom: 1.5rem;
    }

    .order-info h4 {
        color: var(--grey-dark);
        margin: 0.5rem 0;
    }

    .order-info span {
        color: var(--rose-gold-dark);
        font-weight: bold;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1.5rem;
    }

    .product-table p {
        margin: 0;
        padding: 1rem;
    }

    .product-row {
        border-bottom: 1px solid var(--rose-gold-light);
    }

    .total-section {
        text-align: right;
        padding: 1rem 0;
    }

    .btn-primary {
        background: var(--rose-gold);
        border: none;
        padding: 0.75rem 1.5rem;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        margin: 0 0.5rem;
        transition: background 0.3s ease;
    }

    .btn-primary:hover {
        background: var(--rose-gold-dark);
        color: white;
    }

    .button-group {
        text-align: center;
        margin-top: 2rem;
    }
</style>

<div class="order-container">
    <div class="order-header">
        <h1>Order Confirmed</h1>
        <p>Thank you for your purchase, Ramu!</p>
    </div>

    <div class="order-info">
        <h4>Order ID: <span>{{ $order->id }}</span></h4>
        <h4>Payment Method: <span>{{ $paymentMethod }}</span></h4>
        @if ($transaction_id)
        <h4>Transaction ID: <span>{{ $transaction_id }}</span></h4>
        @endif
    </div>

    <h4>Product Details</h4>
    <div class="product-table">
        @foreach ($orderItems as $orderItem)
        <div class="product-row d-flex justify-content-between">
            <p>{{ $orderItem->product_name }}</p>
            <p>Qty: {{ $orderItem->quantity }}</p>
            <p>Rs. {{ $orderItem->price }}</p>
            <p>Rs. {{ $orderItem->price * $orderItem->quantity }}</p>
        </div>
        @endforeach
    </div>

    <div class="total-section">
        <h4>Total Products: <span>{{ count($orderItems) }}</span></h4>
        <h4>Total Price: Rs. <span>{{ $order->total_amount }}</span></h4>
    </div>

    <p class="text-center">Your order will be delivered within 2-3 working days.</p>

    <div class="button-group">
        <a class="btn btn-primary" href="{{ route('index') }}" role="button">Home</a>
        <a class="btn btn-primary" href="{{ route('user.order') }}" role="button">View Orders</a>
    </div>
</div>

@endsection