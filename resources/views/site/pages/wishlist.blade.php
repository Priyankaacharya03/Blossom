@extends('site.layouts.main')

@section('title', 'Wishlist')

@section('main-section')

<style>
    :root {
        --rose-gold: #bd8c7d;
        --rose-gold-dark: #a57868;
        --rose-gold-light: #d5b0a0;
        --grey-dark: #4a4a4a;
        --grey: #808080;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
    }

    .product-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        height: 100%;
        transition: all 0.3s ease;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .img-container {
        position: relative;
        overflow: hidden;
        aspect-ratio: 1/1;
    }

    .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .img-container img {
        transform: scale(1.05);
    }

    .product-info {
        padding: 1.25rem;
        text-align: center;
    }

    .product-name {
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--grey-dark);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .original-price {
        text-decoration: line-through;
        color: var(--grey);
        font-size: 0.8rem;
    }

    .actual-price {
        font-weight: 600;
        color: var(--rose-gold);
        font-size: 0.95rem;
    }

    .discount-badge {
        font-size: 0.7rem;
        padding: 0.1rem 0.3rem;
        border: 1px solid var(--rose-gold);
        border-radius: 3px;
        color: var(--rose-gold);
    }

    .add-to-cart-container {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.95);
        padding: 0.25rem;
        transform: translateY(100%);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .product-card:hover .add-to-cart-container {
        transform: translateY(0);
        opacity: 1;
    }

    .btn-add-to-cart {
        background-color: var(--rose-gold);
        border-color: var(--rose-gold);
        color: white;
    }

    .btn-add-to-cart:hover {
        background-color: var(--rose-gold-dark);
        border-color: var(--rose-gold-dark);
        color: white;
    }


    /* Featured Products Section */
    .wishlist-products {
        padding: 2rem 0;
        background-color: #f8f9fa;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .no-result {
        text-align: center;
        color: red;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .wishlist-icon {
        font-size: 1.6rem;
        color: rgba(255, 255, 255, 0.9);
        cursor: pointer;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .wishlist-icon.active {
        color: #e74c3c;
    }

    /* Empty Wishlist Styling */
    .empty-wishlist {
        text-align: center;
        padding: 4rem 1rem;
        margin: 0 auto;
        max-width: 600px;
    }

    .empty-wishlist-icon {
        font-size: 5rem;
        color: var(--rose-gold);
        margin-bottom: 1.5rem;
        display: inline-block;
    }

    .empty-wishlist-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--grey-dark);
        margin-bottom: 1rem;
    }

    .empty-wishlist-text {
        font-size: 1.1rem;
        color: var(--grey);
        margin-bottom: 2rem;
        max-width: 450px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .btn-shop-now {
        background-color: var(--rose-gold);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-shop-now:hover {
        background-color: var(--rose-gold-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        color: white;
    }

    .empty-wishlist-animation {
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

<section class="wishlist-products">
    <div class="container">

        @if($wishlists->count() > 0)
        <div class="products-grid">
            @foreach ($wishlists as $wishlist)
            <div class="product-card">
                <div class="img-container">
                    <a href="{{ route('product.details', $wishlist->product->id) }}" style="text-decoration: none;">
                        <img src="{{ asset('storage/' . $wishlist->product->primary_image) }}" alt="{{ $wishlist->product->product_name }}">
                    </a>
                    <a href="{{ route('wishlist.toggle', $wishlist->product->id) }}" class="text-decoration-none" title="Remove from Wishlist">
                        <i class="bi bi-heart wishlist-icon {{ in_array($wishlist->product->id, $wishlists->pluck('product_id')->toArray()) ? 'active' : '' }}" data-product-id="{{ $wishlist->product->id }}"></i>
                    </a>
                </div>
                <div class="product-info">
                    <h3 class="product-name">{{ $wishlist->product->product_name }}</h3>
                    <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                        <span class="original-price">Rs.{{ $wishlist->product->price }}</span>
                        <span class="actual-price">Rs.{{ $wishlist->product->actual_amount }}</span>
                        <span class="discount-badge">{{ $wishlist->product->discount_amount }}% OFF</span>
                    </div>
                </div>
                <div class="add-to-cart-container">
                    <form action="{{ route('cart.addToCart', $wishlist->product->id) }}" method="post">
                        @csrf
                        <button class="btn btn-add-to-cart w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-wishlist empty-wishlist-animation">
            <div class="empty-wishlist-icon">
                <i class="bi bi-heart"></i>
            </div>
            <h3 class="empty-wishlist-title">Your wishlist is empty</h3>
            <p class="empty-wishlist-text">
                Discover items you love and add them to your wishlist. We'll save them for you here!
            </p>
            <a href="{{ route('shop') }}" class="btn-shop-now">
                <i class="bi bi-bag-heart me-2"></i> Explore Products
            </a>
        </div>
        @endif
    </div>
</section>

@endsection