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
                                        <div class="dropdown">
                                            <i class="bi bi-three-dots" data-bs-toggle="dropdown" role="button" style="cursor: pointer;" aria-expanded="false"></i>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item" href="{{ route('admin.order.items',$order->id) }}">View Items</a>

                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeStatus{{ $order->id }}">
                                                    Change Status
                                                </button>



                                            </div>
                                        </div>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="changeStatus{{ $order->id }}" tabindex="-1" aria-labelledby="changeStatus{{ $order->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.order.update.status', $order->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="changeOrderStatusLabel{{ $order->id }}">Update Order Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="status{{ $order->id }}" class="form-label">Status</label>
                                                            <select class="form-control" name="status" id="status{{ $order->id }}">
                                                                <option value="active" selected>Accept</option>
                                                                <option value="rejected">Reject</option>
                                                            </select>
                                                            @error('status')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Status</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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