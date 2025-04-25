@extends('site.layouts.main')

@section('title', 'Home')

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

    /* Carousel Styles */
    .carousel {
        position: relative;
        margin-bottom: 2rem;
    }

    .carousel-inner {
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .carousel-item {
        position: relative;
    }

    .carousel-item img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .carousel-caption {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        padding: 1rem;
    }

    .carousel-caption h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .carousel-caption p {
        font-size: 1.25rem;
        margin-bottom: 1.5rem;
    }

    /* Categories Section */
    .section {
        padding: 3rem 0;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #333;
    }

    .view-all {
        color: var(--rose-gold);
        text-decoration: none;
        font-weight: 500;
    }

    .view-all:hover {
        text-decoration: underline;
    }

    .carousel-wrapper {
        overflow: hidden;
        position: relative;
    }

    .categories-carousel {
        display: flex;
        gap: 1rem;
        animation: scroll 25s linear infinite;
        width: max-content;
    }

    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .category-item {
        flex: 0 0 auto;
        width: 160px;
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .category-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .category-img {
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
    }

    .category-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1rem;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        color: white;
    }

    .category-name {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .category-count {
        font-size: 0.875rem;
        opacity: 0.8;
    }

    /* Featured Banner */
    .featured-banner {
        margin: 2rem 0;
        border-radius: 12px;
        overflow: hidden;
        background-color: #f8f9fa;
    }

    .featured-content {
        display: grid;
        grid-template-columns: 1fr;
    }

    @media (min-width: 768px) {
        .featured-content {
            grid-template-columns: 1fr 1fr;
        }
    }

    .featured-text {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: rgba(189, 140, 125, 0.1);
    }

    .featured-text h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .featured-text p {
        margin-bottom: 1.5rem;
    }

    .featured-img {
        height: 300px;
        background-color: #ddd;
        background-size: cover;
        background-position: center;
    }

    /* Product Card Styles - Consistent with shop page */
    .product-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        height: 100%;
        transition: all 0.3s ease;
        position: relative;
        background-color: white;
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

    .product-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: var(--rose-gold);
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 15px;
        font-size: 0.7rem;
        font-weight: 600;
        z-index: 1;
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

    /* Wishlist Icon */
    .wishlist-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        border: none;
        transition: all 0.2s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .wishlist-icon:hover {
        background-color: white;
        transform: scale(1.1);
    }

    .wishlist-icon i {
        color: var(--rose-gold);
        font-size: 1.1rem;
    }

    .wishlist-icon i.bi-heart-fill {
        color: #dc3545;
    }

    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
        .product-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 767px) {
        .carousel-caption h2 {
            font-size: 1.75rem;
        }

        .carousel-caption p {
            font-size: 1rem;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .featured-text h2 {
            font-size: 1.5rem;
        }

        .featured-text p {
            font-size: 0.875rem;
        }

        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 575px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
    }

    @media (max-width: 480px) {
        .product-grid {
            grid-template-columns: repeat(1, 1fr);
        }
    }

    /* Utility Classes */
    .btn {
        display: inline-block;
        font-weight: 500;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s, background-color 0.15s, border-color 0.15s;
        cursor: pointer;
    }

    .btn-primary {
        color: #fff;
        background-color: var(--rose-gold);
        border-color: var(--rose-gold);
    }

    .btn-primary:hover {
        background-color: var(--rose-gold-dark);
        border-color: var(--rose-gold-dark);
    }

    .btn-lg {
        padding: 0.5rem 1rem;
        font-size: 1.25rem;
        line-height: 1.5;
        border-radius: 0.3rem;
    }

    /* Center Featured Products Title */
    .featured-section .section-header {
        justify-content: center;
        text-align: center;
        flex-direction: column;
    }

    .featured-section .section-header .view-all {
        margin-top: 0.5rem;
    }
</style>

<div class="container-fluid">
    <!-- Carousel Section -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('assets/images/slide1.png')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h2>Summer Collection</h2>
                    <p>Up to 50% off on selected items</p>
                    <a href="#" class="btn btn-primary btn-lg">Shop Now</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/images/slide1.png')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h2>New Arrivals</h2>
                    <p>Check out our latest products</p>
                    <a href="#" class="btn btn-primary btn-lg">Shop Now</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/images/slide1.png')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h2>Special Offers</h2>
                    <p>Limited time deals on popular items</p>
                    <a href="#" class="btn btn-primary btn-lg">Shop Now</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Shop by Categories Section - Full Width -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Shop by Categories</h2>
                <a href="#" class="view-all">View All</a>
            </div>
        </div>
        <div class="carousel-wrapper">
            <div class="categories-carousel" id="carousel">
                @foreach($categories as $category)
                <a href="{{ route('category.show', $category->id) }}" class="category-item">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="category-img">
                    <div class="category-overlay">
                        <h3 class="category-name">{{ $category->category_name }}</h3>
                        <p class="category-count">{{ $category->items_count }} items</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Banner - Full Width -->
    <div class="container">
        <div class="featured-banner">
            <div class="featured-content">
                <div class="featured-text">
                    <h2>New Arrivals</h2>
                    <p>Discover our latest collection with exclusive designs and premium quality.</p>
                    <a href="#" class="btn btn-primary">Shop Now</a>
                </div>
                <div class="featured-img" style="background-image: url('{{ asset('assets/images/featured-banner.jpg') }}')">
                </div>
            </div>
        </div>
    </div>

    <!-- Best Selling Products Section -->
    <div class="container">
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Best Selling Products</h2>
                <a href="#" class="view-all">View All</a>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($products->take(4) as $product)
                <div class="col">
                    <div class="product-card">
                        <div class="img-container">
                            @auth
                            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="wishlist-icon">
                                    <i class="bi bi-heart{{ Auth::user()->wishlists->contains('product_id', $product->id) ? '-fill' : '' }}"></i>
                                </button>
                            </form>
                            @endauth

                            <a href="{{ route('product.details', $product->id) }}">
                                <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->product_name }}">
                            </a>
                            <span class="product-badge">Best Seller</span>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">{{ $product->product_name }}</h3>
                            <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                                <span class="original-price">Rs.{{ $product->price }}</span>
                                <span class="actual-price">Rs.{{ $product->actual_amount }}</span>
                                <span class="discount-badge">{{ $product->discount_amount }}% OFF</span>
                            </div>
                        </div>
                        <div class="add-to-cart-container">
                            <form action="{{ route('cart.addToCart', $product->id) }}" method="post">
                                @csrf
                                <button class="btn btn-add-to-cart w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Featured Products Section -->
        <section class="section featured-section">
            <div class="section-header">
                <h2 class="section-title">Featured Products</h2>
            </div>
            <div class="row justify-content-center row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($featured_products->take(4) as $product)
                <div class="col">
                    <div class="product-card">
                        <div class="img-container">
                            @auth
                            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="wishlist-icon">
                                    <i class="bi bi-heart{{ Auth::user()->wishlists->contains('product_id', $product->id) ? '-fill' : '' }}"></i>
                                </button>
                            </form>
                            @endauth

                            <a href="{{ route('product.details', $product->id) }}">
                                <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->product_name }}">
                            </a>
                            <span class="product-badge">Featured</span>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">{{ $product->product_name }}</h3>
                            <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                                <span class="original-price">Rs.{{ $product->price }}</span>
                                <span class="actual-price">Rs.{{ $product->actual_amount }}</span>
                                @if(isset($product->discount_amount) && $product->discount_amount > 0)
                                <span class="discount-badge">{{ $product->discount_amount }}% OFF</span>
                                @endif
                            </div>
                        </div>
                        <div class="add-to-cart-container">
                            <form action="{{ route('cart.addToCart', $product->id) }}" method="post">
                                @csrf
                                <button class="btn btn-add-to-cart w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- All Products Section -->
        <section class="section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fs-3 fw-bold">Products</h1>
            </div>

            @if ($products->count() > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($products->take(8) as $product)
                <div class="col">
                    <div class="product-card">
                        <div class="img-container">
                            @auth
                            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="wishlist-icon">
                                    <i class="bi bi-heart{{ Auth::user()->wishlists->contains('product_id', $product->id) ? '-fill' : '' }}"></i>
                                </button>
                            </form>
                            @endauth

                            <a href="{{ route('product.details', $product->id) }}">
                                <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->product_name }}">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">{{ $product->product_name }}</h3>
                            <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                                <span class="original-price">Rs.{{ $product->price }}</span>
                                <span class="actual-price">Rs.{{ $product->actual_amount }}</span>
                                <span class="discount-badge">{{ $product->discount_amount }}% OFF</span>
                            </div>
                        </div>
                        <div class="add-to-cart-container">
                            <form action="{{ route('cart.addToCart', $product->id) }}" method="post">
                                @csrf
                                <button class="btn btn-add-to-cart w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="no-result">No products available.</p>
            @endif
        </section>
    </div>
</div>

<script>
    // Clone all children to make a loop
    window.addEventListener("DOMContentLoaded", () => {
        const carousel = document.getElementById("carousel");
        if (carousel) {
            carousel.innerHTML += carousel.innerHTML;
        }
    });
</script>
@endsection