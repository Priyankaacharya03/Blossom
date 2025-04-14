@extends('site.layouts.main')

@section('title', $product->product_name)

@section('main-section')
<style>
    /* Color Variables */
    :root {
        --rose-gold: #bd8c7d;
        --rose-gold-light: #d4b2a7;
        --rose-gold-dark: #a67c6e;
        --grey: #808080;
        --grey-dark: #4a4a4a;
    }

    /* Product Images */
    .thumbnail-btn {
        border: 2px solid #e5e5e5;
        transition: all 0.3s ease;
    }

    .thumbnail-btn.active {
        border-color: var(--rose-gold);
    }

    .thumbnail-btn:hover:not(.active) {
        border-color: #ccc;
    }

    /* Related Products */
    .card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .card:hover .add-to-cart-overlay {
        transform: translateY(0);
    }

    .add-to-cart-overlay {
        transition: transform 0.3s ease;
    }

    .transition {
        transition: transform 0.5s ease;
    }

    .card:hover .transition {
        transform: scale(1.05);
    }

    /* Object fit utilities */
    .object-cover {
        object-fit: cover;
    }

    .object-contain {
        object-fit: contain;
    }

    /* Width utilities */
    .w-fit {
        width: fit-content;
    }

    /* For mobile view */
    @media (max-width: 767px) {
        .md-flex-row {
            flex-direction: row !important;
        }

        .md-flex-column {
            flex-direction: column !important;
        }

        .md-w-auto {
            width: auto !important;
        }

        .md-mb-0 {
            margin-bottom: 0 !important;
        }

        .md-object-cover {
            object-fit: cover !important;
        }
    }
</style>
<div class="container mx-auto px-4 py-8 max-w-7xl">
    <div class="row mb-5">
        <div class="col-lg-6 position-relative">
            <div class="d-flex flex-column-reverse md-flex-row gap-4">
                <!-- Main Image -->
                <div class="flex-grow position-relative rounded-lg overflow-hidden bg-light">
                    <img src="{{ asset('storage/' . $product->primary_image) }}"
                        alt="{{ $product->product_name }}"
                        id="main-product-image"
                        class="w-100 h-100 object-contain md-object-cover"
                        style="aspect-ratio: 1/1;">
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6 d-flex flex-column">
            <div class="mb-4 d-flex align-items-center gap-2">
                @if($product->stock > 0 && $product->stock <= 5)
                    <span class="badge text-bg-danger">Limited Stock</span>
                    @endif
                    @if($product->discount_percent >= 20)
                    <span class="badge text-bg-primary"
                        style="background-color: #bd8c7d !important;">Sale</span>
                    @endif
            </div>

            <h1 class="fs-3 fw-semibold text-dark mb-2">{{ $product->product_name }}</h1>
            <p class="text-secondary mb-4">{{ $product->description }}</p>

            <div class="d-flex align-items-center gap-4 mb-4">
                @php
                $discountedPrice = $product->price - ($product->price * $product->discount_percent / 100);
                @endphp
                <span class="fs-4 fw-bold" style="color: #bd8c7d;">Rs.{{ number_format($discountedPrice, 2) }}</span>
                @if($product->discount_percent > 0)
                <span class="text-decoration-line-through text-secondary">Rs.{{ number_format($product->price, 2) }}</span>
                <span class="border rounded small px-2 py-1"
                    style="color: #bd8c7d; border-color: #bd8c7d !important;">
                    {{ $product->discount_percent }}% OFF
                </span>
                @endif
            </div>

            <hr class="my-4">

            <!-- Quantity -->
            <div class="mb-4">
                <h3 class="small fw-medium text-secondary mb-3">Quantity</h3>
                <div class="d-flex align-items-center border rounded w-fit">
                    <button type="button" id="decrease-qty" class="px-3 py-2 text-secondary border-0 bg-transparent">
                        <i class="bi bi-dash"></i>
                    </button>
                    <span id="quantity" class="px-3 py-2 text-dark w-auto text-center">1</span>
                    <button type="button" id="increase-qty" class="px-3 py-2 text-secondary border-0 bg-transparent">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
                <p class="text-secondary small mt-2 text-danger">
                    @if($product->stock < 1)
                        Out of stock
                        @elseif($product->stock <= 10)
                            {{ $product->stock }} Remaining
                            @endif

                            </p>
            </div>

            <!-- Add to Cart and Wishlist -->
            <div class="d-flex gap-3 mb-4">

                <form action="{{ route('cart.addToCart',$product->id) }}" method="post">
                    @csrf
                    <button id="add-to-cart" type="submit" class="btn flex-grow-1 text-white d-flex align-items-center justify-content-center"
                        style="background-color: #bd8c7d;" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <i class="bi bi-cart me-2"></i> Add to Cart
                    </button>
                </form>

                <button type="button" class="btn btn-outline-secondary px-3">
                    <i class="bi bi-heart"></i>
                </button>
            </div>

            <!-- Shipping Info -->
            <div class="bg-light p-4 rounded mb-4">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <i class="bi bi-truck text-secondary mt-1"></i>
                    <div>
                        <p class="small fw-medium text-dark">Free shipping</p>
                        <p class="text-secondary" style="font-size: 0.75rem;">On orders over Rs. 1,000</p>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-3 mb-3">
                    <i class="bi bi-arrow-counterclockwise text-secondary mt-1"></i>
                    <div>
                        <p class="small fw-medium text-dark">30-day returns</p>
                        <p class="text-secondary" style="font-size: 0.75rem;">Hassle-free returns</p>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-3">
                    <i class="bi bi-shield-check text-secondary mt-1"></i>
                    <div>
                        <p class="small fw-medium text-dark">Secure checkout</p>
                        <p class="text-secondary" style="font-size: 0.75rem;">Safe & protected checkout</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Product Details Tabs -->
    <div class="mb-5">
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane"
                    type="button" role="tab" aria-controls="details-tab-pane" aria-selected="true">
                    Details
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications-tab-pane"
                    type="button" role="tab" aria-controls="specifications-tab-pane" aria-selected="false">
                    Specifications
                </button>
            </li>
        </ul>
        <div class="tab-content p-4 border border-top-0 rounded-bottom" id="productTabsContent">
            <div class="tab-pane fade show active" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                <p class="text-secondary">{{ $product->description }}</p>
            </div>
            <div class="tab-pane fade" id="specifications-tab-pane" role="tabpanel" aria-labelledby="specifications-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="d-flex">
                            <span class="fw-medium text-dark" style="width: 33%;">Category:</span>
                            <span class="text-secondary" style="width: 67%;">{{ $product->category->category_name ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="d-flex">
                            <span class="fw-medium text-dark" style="width: 33%;">Vendor:</span>
                            <span class="text-secondary" style="width: 67%;">{{ $product->vendor->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="d-flex">
                            <span class="fw-medium text-dark" style="width: 33%;">Stock:</span>
                            <span class="text-secondary" style="width: 67%;">{{ $product->stock }} </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div>
        <h2 class="fs-4 fw-semibold text-dark mb-4">You May Also Like</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            @foreach($relatedProducts as $relatedProduct)
            <div class="col">
                <a href="{{ route('product.details', $relatedProduct->id) }}" class="text-decoration-none">
                    <div class="card h-100 position-relative border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="position-relative overflow-hidden" style="aspect-ratio: 1/1;">
                            <img src="{{ asset('storage/' . $relatedProduct->primary_image) }}"
                                class="card-img-top h-100 w-100 object-cover transition"
                                alt="{{ $relatedProduct->product_name }}">

                            @if($relatedProduct->discount_percent >= 20)
                            <span class="position-absolute top-0 start-0 m-2 badge text-bg-primary" style="background-color: #bd8c7d !important;">
                                Sale
                            </span>
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <h3 class="small fw-medium text-dark text-truncate">{{ $relatedProduct->product_name }}</h3>
                            <div class="d-flex justify-content-center flex-wrap align-items-center gap-2 mt-2">
                                @php
                                $discountedPrice = $relatedProduct->price - ($relatedProduct->price * $relatedProduct->discount_percent / 100);
                                @endphp
                                <span class="fw-semibold" style="color: #bd8c7d;">Rs.{{ number_format($discountedPrice, 2) }}</span>
                                @if($relatedProduct->discount_percent > 0)
                                <span class="small text-secondary text-decoration-line-through">Rs.{{ number_format($relatedProduct->price, 2) }}</span>
                                <span class="border rounded-1 px-2 py-1"
                                    style="font-size: 0.7rem; color: #bd8c7d; border-color: #bd8c7d !important;">
                                    {{ $relatedProduct->discount_percent }}% OFF
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="position-absolute bottom-0 start-0 end-0 bg-white bg-opacity-95 p-3 translate-y-100 add-to-cart-overlay">
                            <button class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-2 text-white"
                                style="background-color: #bd8c7d;" {{ $relatedProduct->stock <= 0 ? 'disabled' : '' }}>
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- JavaScript for the product page -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity Selection
        const decreaseBtn = document.getElementById('decrease-qty');
        const increaseBtn = document.getElementById('increase-qty');
        const quantitySpan = document.getElementById('quantity');
        const maxStock = {
            {
                $product - > stock
            }
        };

        decreaseBtn.addEventListener('click', function() {
            let currentQty = parseInt(quantitySpan.textContent);
            if (currentQty > 1) {
                quantitySpan.textContent = currentQty - 1;
            }
        });

        increaseBtn.addEventListener('click', function() {
            let currentQty = parseInt(quantitySpan.textContent);
            if (currentQty < maxStock) {
                quantitySpan.textContent = currentQty + 1;
            }
        });

        // Add to Cart Button
        const addToCartBtn = document.getElementById('add-to-cart');

        addToCartBtn.addEventListener('click', function() {
            const quantity = parseInt(quantitySpan.textContent);

            // Here you would normally send this data to your backend
            // For now, we'll just show an alert
            alert(`Added to cart: ${quantity} x {{ $product->product_name }}`);
        });
    });
</script>
@endsection