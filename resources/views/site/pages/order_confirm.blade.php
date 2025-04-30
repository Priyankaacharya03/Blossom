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
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
        background-color: #f9f9f9;
    }

    .order-detail {
        display: flex;
        justify-content: space-between;
        margin: 0.5rem 0;
        font-size: 1rem;
    }

    .detail-label {
        color: var(--grey-dark);
        font-weight: 500;
    }

    .detail-value {
        color: var(--rose-gold-dark);
        font-weight: bold;
    }

    .section-title {
        color: var(--rose-gold-dark);
        margin: 1.5rem 0 0.75rem 0;
        font-size: 1.2rem;
        font-weight: 600;
        border-left: 3px solid var(--rose-gold);
        padding-left: 0.75rem;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .product-table p {
        margin: 0;
        padding: 1rem;
    }

    .product-row {
        border-bottom: 1px solid var(--rose-gold-light);
    }

    .product-row:hover {
        background-color: #f9f7f6;
    }

    .total-section {
        text-align: right;
        padding: 1rem;
        background-color: #f9f9f9;
        border-radius: 5px;
    }

    .total-item {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin: 0.5rem 0;
    }

    .total-label {
        margin-right: 1rem;
        font-weight: 500;
    }

    .total-value {
        color: var(--rose-gold-dark);
        font-weight: bold;
    }

    .delivery-note {
        text-align: center;
        margin: 1.5rem 0;
        padding: 0.75rem;
        background-color: #f9f7f6;
        border-radius: 5px;
        font-style: italic;
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
        display: inline-block;
    }

    .btn-primary:hover {
        background: var(--rose-gold-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .button-group {
        text-align: center;
        margin-top: 2rem;
    }

    @media (max-width: 576px) {
        .order-container {
            padding: 1rem;
            margin: 1rem;
        }

        .button-group .btn-primary {
            display: block;
            margin: 0.5rem auto;
            width: 80%;
        }
    }
</style>

<div class="order-container">
    <div class="order-header">
        <h1>Order Confirmed</h1>
        <p>Thank you for your purchase, {{ Auth::user()->name }}!</p>
    </div>

    <div class="order-info">
        <div class="order-detail">
            <span class="detail-label">Order ID:</span>
            <span class="detail-value">{{ $order->id }}</span>
        </div>
        <div class="order-detail">
            <span class="detail-label">Payment Method:</span>
            <span class="detail-value">{{ $paymentMethod }}</span>
        </div>
        @if ($transaction_id)
        <div class="order-detail">
            <span class="detail-label">Transaction ID:</span>
            <span class="detail-value">{{ $transaction_id }}</span>
        </div>
        @endif
    </div>

    <div class="section-title">Product Details</div>
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
        <div class="total-item">
            <span class="total-label">Total Products:</span>
            <span class="total-value">{{ count($orderItems) }}</span>
        </div>
        <div class="total-item">
            <span class="total-label">Total Price:</span>
            <span class="total-value">Rs. {{ $order->total_amount }}</span>
        </div>
    </div>

    <div class="delivery-note">
        Your order will be delivered within 2-3 working days.
    </div>

    <div class="button-group">
        <a class="btn btn-primary" href="{{ route('index') }}" role="button">Home</a>
        <a class="btn btn-primary" href="{{ route('user.order') }}" role="button">View Orders</a>
    </div>
</div>

@endsection