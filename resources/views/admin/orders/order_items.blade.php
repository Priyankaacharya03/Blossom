@extends('admin.layouts.main')

@section('title', 'Order Items')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-secondary">← Back to Orders</a>

    </h4>

    <div class="card">
        <h5 class="card-header">Order Item Details</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Category</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $orderItem)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $orderItem->product->product_name ?? 'N/A' }}</td>
                        <td>
                            @if ($orderItem->product && $orderItem->product->primary_image)
                            <img src="{{ asset('storage/' . $orderItem->product->primary_image) }}" width="60" height="50" alt="Product Image">
                            @else
                            N/A
                            @endif
                        </td>
                        <td>{{ $orderItem->quantity }}</td>
                        <td>Rs. {{ number_format($orderItem->price, 2) }}</td>
                        <td>{{ $orderItem->product->category->category_name ?? 'N/A' }}</td>
                        <td>Rs. {{ number_format($orderItem->price * $orderItem->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection