@extends('site.layouts.main')

@section('title', 'Search')

@section('main-section')

<style>
    :root {
        --rose-gold: #bd8c7d;
        --rose-gold-dark: #a57868;
        --rose-gold-light: #d5b0a0;
        --grey-dark: #4a4a4a;
        --grey: #808080;
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
    .featured-products {
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
</style>

<section class="featured-products">
    <div class="container">
        <h2>Search Results</h2>
        <div class="products-grid">
            @if($products->count())
            @foreach($products as $product)
            <div class="product-card">
                <a href="{{ route('product.details', $product->id) }}" style="text-decoration: none;">
                    <div class="img-container">
                        <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->product_name }}">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">{{ $product->product_name }}</h3>
                        <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                            <span class="original-price">Rs.{{ $product->price }}</span>
                            <span class="actual-price">Rs.{{ $product->actual_amount }}</span>
                            <span class="discount-badge">{{ $product->discount_amount }}% OFF</span>
                        </div>
                    </div>
                </a>
                <div class="add-to-cart-container">
                    <form action="{{ route('cart.addToCart', $product->id) }}" method="post">
                        @csrf
                        <button class="btn btn-add-to-cart w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
            @else
            <p class="no-result">No results found</p>
            @endif
        </div>
    </div>
</section>

@endsection