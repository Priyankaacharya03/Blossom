@extends('admin.layouts.main')

@section('title', 'Order-index')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Order /</span> Index
    </h4>
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <h5 class="card-header">Orders</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Total Items</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name ?? 'Guest' }}</td>
                                    <td>Rs. {{ number_format($order->total_amount, 2) }}</td>
                                    @php
                                    $statusColor = match($order->order_status) {
                                    'pending' => 'warning',
                                    'confirmed' => 'primary',
                                    'processed' => 'info',
                                    'shipped' => 'secondary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'dark',
                                    };
                                    @endphp

                                    <td>
                                        <span class="badge bg-{{ $statusColor }}">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </td>

                                    <td>{{ ucfirst($order->payment_method) }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $order->orderItems->count() }}</td>
                                    <td>
                                        <a href="{{ route('admin.order.items', $order->id) }}" class="btn btn-primary btn-sm" style="width: 85px;">
                                            View Items
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection