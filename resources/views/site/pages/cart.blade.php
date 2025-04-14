<!-- site/pages/cart.blade.php -->
@extends('site.layouts.main')

@section('title', 'Cart')

@section('main-section')

<style>
    /* Simplified Custom CSS */
    .cart-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .cart-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .cart-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #555;
    }

    .cart-table td {
        vertical-align: middle;
        padding: 15px;
    }


    .cart-table td a {
        text-decoration: none;
    }

    .cart-table td a span {
        color: white;
        background-color: var(--rose-gold);
        color: white;
        border: none;
        border-radius: 4px;
        padding: 0.2rem;
        font-size: 0.9rem;
        cursor: pointer;
    }


    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .quantity-btn {
        width: 30px;
        height: 30px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f8f9fa;
        color: #333;
    }

    .quantity-btn:hover {
        background-color: #e9ecef;
    }

    .quantity-input {
        width: 50px;
        height: 30px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .summary-card {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .summary-title {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .checkout-btn {
        background-color: #bd8c7d;
        border: none;
        padding: 10px;
        border-radius: 5px;
        font-weight: 500;
        color: white;
    }

    .checkout-btn:hover {
        background-color: #a67c6e;
        color: white;
    }

    .price-text {
        font-weight: 500;
        color: #333;
    }

    .discount-text {
        color: #dc3545;
    }

    .quantity-text {
        color: #28a745;
    }

    @media (max-width: 767px) {
        .quantity-control {
            flex-direction: column;
            gap: 5px;
        }
    }
</style>

<div class="container mt-4">
    <div class="row">
        <!-- Cart Items Section -->
        <div class="col-lg-8">
            <div class="cart-container">
                <h4 class="cart-title">Shopping Cart</h4>
                <div class="table-responsive">
                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($carts->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">
                                    No items in your shopping cart.
                                    <a href="{{ route('index') }}" style="font-size: 13px; color: blue;">
                                        <span> Start Shopping....</span>
                                    </a>
                                    <br>
                                    <span style="text-align: center;">
                                        <img style="height: 10rem;" src="{{ asset('assets/images/empty_cart.png') }}" alt="Empty Cart">
                                    </span>
                                </td>
                            </tr>
                            @else
                            @foreach ($carts as $cart)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $cart->product->primary_image) }}"
                                        class="product-image"
                                        alt="{{ $cart->product->product_name }}">
                                </td>
                                <td>
                                    {{ $cart->product->product_name }}
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-end">
                                            <span class="badge bg-danger text-white rounded-pill" style="font-size: 0.7rem;">
                                                {{ $cart->product->discount_percent }}% OFF
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                        <div class="quantity-control">
                                            <button type="button" class="quantity-btn decrease-btn" data-id="{{ $cart->id }}">-</button>
                                            @csrf
                                            @method('PUT')
                                            <input type="text"
                                                class="quantity-input"
                                                value="{{ $cart->quantity }}"
                                                name="quantity"
                                                data-id="{{ $cart->id }}"
                                                data-price="{{ $cart->product->price }}"
                                                data-discount="{{ $cart->product->discount_percent }}"
                                                readonly>
                                            <button type="button" class="quantity-btn increase-btn" data-id="{{ $cart->id }}">+</button>
                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-primary">
                                                Update
                                            </button>
                                        </div>

                                    </form>
                                </td>
                                <td class="price-text">Rs.{{ number_format($cart->product->price, 2) }}</td>
                                <td class="price-text item-total">Rs.{{ number_format($cart->quantity * $cart->product->price, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.delete', $cart->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger border-0 bg-transparent">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Summary Section -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="summary-card">
                <h5 class="summary-title">Order Summary</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-end price-text" id="subtotal">Rs {{ number_format($subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td class="text-end quantity-text" id="quantity">{{ $quantity }}</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td class="text-end discount-text" id="discount">-Rs {{ number_format($discount_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td class="text-end price-text" id="total">Rs {{ number_format($total, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('cart.checkout') }}" class="btn checkout-btn w-100">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>

<!-- Include Font Awesome for Trash Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- JavaScript for Quantity Buttons -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const increaseButtons = document.querySelectorAll(".increase-btn")
        const decreaseButtons = document.querySelectorAll(".decrease-btn")

        // Increase
        increaseButtons.forEach((button) => {
            button.addEventListener("click", function() {
                const cartId = this.getAttribute("data-id")
                const input = this.parentElement.querySelector(".quantity-input")
                let quantity = Number.parseInt(input.value)
                quantity += 1
                input.value = quantity
                updateTotal(cartId, quantity)
            })
        })

        // Decrease
        decreaseButtons.forEach((button) => {
            button.addEventListener("click", function() {
                const cartId = this.getAttribute("data-id")
                const input = this.parentElement.querySelector(".quantity-input")
                let quantity = Number.parseInt(input.value)
                if (quantity > 1) {
                    quantity -= 1
                    input.value = quantity
                    updateTotal(cartId, quantity)
                }
            })
        })

        // Update Total for Each Item
        function updateTotal(cartId, quantity) {
            const row = document.querySelector(`input[data-id="${cartId}"]`).closest("tr")
            const input = document.querySelector(`input[data-id="${cartId}"]`)
            const price = Number.parseFloat(input.getAttribute("data-price"))

            // Update the item subtotal (using original price)
            const itemSubtotal = price * quantity
            row.querySelector(".item-total").textContent = `Rs.${itemSubtotal.toFixed(2)}`

            updateSummary()

            // Update the server with the new quantity
            // updateCartQuantity(cartId, quantity)
        }

        // Update Order Summary (Subtotal, Quantity, Total)
        function updateSummary() {
            let subtotal = 0
            let totalQuantity = 0
            let totalDiscount = 0

            document.querySelectorAll(".quantity-input").forEach((input) => {
                const quantity = Number.parseInt(input.value)
                const price = Number.parseFloat(input.getAttribute("data-price"))
                const discountPercent = Number.parseFloat(input.getAttribute("data-discount"))

                // Calculate values exactly as in the controller
                const itemSubtotal = price * quantity
                const itemDiscountAmount = ((price * discountPercent) / 100) * quantity

                subtotal += itemSubtotal
                totalDiscount += itemDiscountAmount
                totalQuantity += quantity
            })

            const total = subtotal - totalDiscount

            document.getElementById("subtotal").textContent = `Rs ${subtotal.toFixed(2)}`
            document.getElementById("quantity").textContent = totalQuantity
            document.getElementById("discount").textContent = `-Rs ${totalDiscount.toFixed(2)}`
            document.getElementById("total").textContent = `Rs ${total.toFixed(2)}`
        }



        // Initialize summary on page load
        updateSummary()
    })
</script>

@endsection