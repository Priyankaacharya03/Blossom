@extends('site.layouts.main')

@section('title', 'My Orders')

@section('main-section')
<style>
    body {
        background-color: #f8f9fa;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .order-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .filter-section {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .order-header {
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-body {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .order-footer {
        padding: 15px 20px;
        background-color: #f9f9f9;
    }

    .btn-shop {
        width: 30px;
        height: 30px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: var(--rose-gold);
        border-color: var(--rose-gold);
        color: white;
        padding: 8px 16px;
        font-size: 14px;
        transition: background-color 0.3s ease, border-color 0.3s ease;
        text-decoration: none;
    }

    .btn-shop:hover {
        background-color: #d8a3a3;
        /* Slightly darker or any hover color */
        border-color: #d8a3a3;
    }


    .product-image {
        object-fit: cover;
        border: 1px solid #eee;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .store-icon {
        width: 30px;
        height: 30px;
        background-color: #5d3fd3;
        color: white;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .store-name {
        font-weight: 600;
        font-size: 18px;
        color: #333;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-processing {
        background-color: #d1ecf1;
        color: #0c5460;
    }

    .status-shipped {
        background-color: #d4edda;
        color: #155724;
    }

    .status-delivered {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-cancelled {
        background-color: #f8f9fa;
        color: #6c757d;
    }

    .product-title {
        font-size: 16px;
        font-weight: 500;
        color: #333;
        margin-bottom: 5px;
    }

    .product-price {
        font-weight: 600;
        font-size: 16px;
        color: #333;
    }

    .product-qty {
        color: #6c757d;
        font-size: 16px;
    }

    .select-container {
        position: relative;
        display: inline-block;
    }

    .select-container select {
        padding-right: 30px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .select-container::after {
        content: "\f107";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .no-orders-card {
        background: #fff;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        text-align: center;
        color: #333;
    }

    .no-orders-card i {
        font-size: 48px;
        color: #6c757d;
        margin-bottom: 15px;
    }

    .no-orders-card .btn {
        margin-top: 20px;
        font-weight: 500;
    }
</style>

<div class="container mt-4">
    @if($orders->isEmpty())
    <div class="no-orders-card">
        <i class="fas fa-box-open"></i>
        <h3 class="mt-3">No Orders Yet</h3>
        <p class="text-muted">Looks like you haven't placed any orders yet.</p>
        <a href="{{ route('index') }}" class="btn-shop ">
            <i class="fas fa-shopping-bag me-2 mt-0"></i>Start Shopping
        </a>


    </div>
    @else
    <div class="filter-section">
        <div class="row align-items-center">
            <div class="col-auto">
                <label for="orderFilter" class="form-label mb-0 fw-medium">Show:</label>
            </div>
            <div class="col-auto">
                <div class="select-container">
                    <form action="{{ route('user.order') }}" method="get">
                        <select class="form-select" name="filter" onchange="this.form.submit()" id="filter">
                            <option value="all" {{ request('status') == null ? 'selected' : '' }}>All Orders</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Processed</option>
                            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach($orders as $order)
    <div class="order-container order-item" data-status="{{ $order->status }}">
        <div class="order-header">
            <div class="d-flex align-items-center gap-2">

                <img src="{{ asset('storage/vendors/' . $order->orderItems->first()->vendor->vendor_profile_img) }}" class="vendor-avatar" style="width: 28px; border-radius: 50%;  border: 0.5px solid grey; ">

                <span class="store-name">{{ $order->orderItems->first()->vendor->vendor_name }}</span>

            </div>
            <div>
                <span class="status-badge status-{{ strtolower($order->order_status) }}">{{ $order->order_status }}</span>
            </div>
        </div>

        @foreach($order->orderItems as $item)
        <div class="order-body">
            <div class="row align-items-center">
                <div class="col-md-2 col-sm-3 mb-3 mb-sm-0">

                    <img src="{{ asset('storage/' . $item->product->primary_image) }}"
                        alt="{{ $item->product->product_name }}" class="primary-image" style="width:auto; height: 100px;">
                </div>
                <div class="col-md-7 col-sm-6">
                    <h3 class="product-title">{{ $item->product->product_name }}</h3>
                </div>
                <div class="col-md-2 col-sm-3 text-md-center">
                    <div class="product-price">Rs. {{ number_format($item->price, 2) }}</div>
                </div>
                <div class="col-md-1 col-sm-12 text-md-end text-sm-start mt-2 mt-md-0">
                    <div class="product-qty">Qty: {{ $item->quantity }}</div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="order-footer p-3 d-flex justify-content-between align-items-center">
            <div>
                <span class="text-muted">Order No.{{ $order->id }}</span>
                <span class="ms-3 text-muted">{{ $order->created_at->format('M d, Y') }}</span>
            </div>
            <div>
                @if($order->status == 'Delivered')
                <a href="" class="btn btn-sm btn-outline-success ms-2">Write Review</a>
                @endif

                @if(in_array($order->status, ['Pending', 'Processing']))
                <button class="btn btn-sm btn-outline-danger ms-2 cancel-order-btn"
                    data-order-id="{{ $order->id }}"
                    data-bs-toggle="modal"
                    data-bs-target="#cancelOrderModal">
                    Cancel Order
                </button>
                @endif
            </div>
        </div>
    </div>
    @endforeach

    @endif
</div>

{{-- Cancel Modal --}}
<div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="cancelOrderForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <p>Are you sure you want to cancel this order?</p>
                    <div class="mb-3">
                        <label for="cancelReason" class="form-label">Reason for cancellation</label>
                        <select class="form-select" id="cancelReason" name="cancel_reason" required>
                            <option value="">Select a reason</option>
                            <option value="Changed my mind">Changed my mind</option>
                            <option value="Found better price elsewhere">Found better price elsewhere</option>
                            <option value="Ordered by mistake">Ordered by mistake</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3" id="otherReasonContainer" style="display: none;">
                        <label for="otherReason" class="form-label">Please specify</label>
                        <textarea class="form-control" id="otherReason" name="other_reason" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Cancel Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('orderFilter').addEventListener('change', function() {
            const status = this.value;
            const baseUrl = '{{ route("user.order") }}';
            window.location.href = status === 'all' ? baseUrl : `${baseUrl}?status=${status}`;
        });

        document.querySelectorAll('.cancel-order-btn').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                document.getElementById('cancelOrderForm').action = `/orders/${orderId}/cancel`;
            });
        });

        const cancelReason = document.getElementById('cancelReason');
        const otherReasonContainer = document.getElementById('otherReasonContainer');
        cancelReason.addEventListener('change', function() {
            if (this.value === 'Other') {
                otherReasonContainer.style.display = 'block';
                document.getElementById('otherReason').setAttribute('required', 'required');
            } else {
                otherReasonContainer.style.display = 'none';
                document.getElementById('otherReason').removeAttribute('required');
            }
        });
    });
</script>
@endsection