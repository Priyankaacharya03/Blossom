@extends('site.layouts.main')

@section('title', 'Cart')

@section('main-section')


<style>
    :root {
        --rose-gold: #bd8c7d;
        --rose-gold-light: #d4b2a7;
        --rose-gold-dark: #a67c6e;
        --grey: #808080;
        --light-grey: #f0f0f0;
    }

    body {
        background-color: var(--light-grey);
        font-family: Arial, sans-serif;
    }

    .confirmation-container {
        max-width: 800px;
        margin: 50px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Table styling to match the theme */
    .table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        background-color: var(--rose-gold-light);
        color: #333;
        border-bottom: 2px solid var(--rose-gold);
    }

    .table tbody tr:hover {
        background-color: rgba(212, 178, 167, 0.1);
    }

    .table-responsive {
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .order-header {
        color: var(--rose-gold);
        border-bottom: 2px solid var(--rose-gold-light);
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    .order-details {
        margin-bottom: 30px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid var(--light-grey);
    }

    .payment-methods {
        margin: 20px 0;
    }

    .payment-option {
        padding: 15px;
        border: 1px solid var(--rose-gold-light);
        border-radius: 5px;
        margin-bottom: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .payment-option:hover {
        border-color: var(--rose-gold);
        background-color: var(--rose-gold-light);
    }

    .payment-option.active {
        border-color: var(--rose-gold);
        background-color: var(--rose-gold-light);
    }

    .btn-confirm {
        background-color: var(--rose-gold);
        border-color: var(--rose-gold);
        padding: 10px 30px;
        transition: all 0.3s ease;
    }

    .btn-confirm:hover {
        background-color: var(--rose-gold-dark);
        border-color: var(--rose-gold-dark);
    }
</style>
</head>

<body>
    <div class="confirmation-container">
        <h2 class="order-header">Order Confirmation</h2>

        <div class="order-items mb-4">
            <h4>Order Items</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Sn</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>(Discount)</th>
                            <th>Total</th>5432
                        </tr>
                    </thead>
                    @foreach ($carts as $cart)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cart->product->product_name }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rs. {{ $cart->product->price }}</td>
                            <td>Rs. {{ $cart->product->discount_amount * $cart->quantity}}</td>
                            <td>Rs. {{ $total }}</td>
                        </tr>

                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="order-details">
            <h4>Order Summary</h4>
            <div class="detail-item">
                <span>Order Number:</span>
                <span>#BLOSSOM{{ rand(1000, 9999) }}</span>
            </div>
            <div class="detail-item">
                <span>Items Total:</span>
                <span>Rs. 5,499.00</span>
            </div>
            <div class="detail-item">
                <span>Shipping:</span>
                <span>Rs. 150.00</span>
            </div>
            <div class="detail-item fw-bold">
                <span>Total Amount:</span>
                <span>Rs. 5,649.00</span>
            </div>
        </div>

        <div class="shipping-details">
            <h4>Shipping Address</h4>
            <p>John Doe<br>
                123 Blossom Street<br>
                Kathmandu, Nepal<br>
                Phone: +977-9876543210</p>
        </div>

        <div class="payment-methods">
            <h4>Select Payment Method</h4>
            <div class="payment-option" onclick="selectPayment(this, 'khalti')">
                <div class="d-flex align-items-center">
                    <i class="bi bi-wallet2 me-2"></i>
                    <span>Khalti Digital Wallet</span>
                </div>
            </div>
            <div class="payment-option" onclick="selectPayment(this, 'cod')">
                <div class="d-flex align-items-center">
                    <i class="bi bi-cash-stack me-2"></i>
                    <span>Cash on Delivery</span>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button class="btn btn-confirm text-white" onclick="confirmOrder()">Confirm Order</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectPayment(element, method) {
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('active');
            });
            element.classList.add('active');
            // You can store the selected payment method in a hidden input or variable here
        }

        function confirmOrder() {
            const selectedPayment = document.querySelector('.payment-option.active');
            if (!selectedPayment) {
                alert('Please select a payment method');
                return;
            }
            // Add your order confirmation logic here
            alert('Order confirmed successfully!');
            // Redirect to thank you page or process payment
        }
    </script>

    @endsection