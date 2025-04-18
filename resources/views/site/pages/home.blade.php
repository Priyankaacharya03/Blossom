@extends('site.layouts.main')

@section('title', 'Home')

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

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f8f9fa;
    }

    .container {
        width: 100%;
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 15px;
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

    .carousel-indicators {
        position: absolute;
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 0.5rem;
        z-index: 10;
    }

    .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: white;
        opacity: 0.5;
        border: none;
        cursor: pointer;
    }

    .carousel-indicators button.active {
        opacity: 1;
    }

    .carousel-control-prev,
    .carousel-control-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.3);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
    }

    .carousel-control-prev {
        left: 1rem;
    }

    .carousel-control-next {
        right: 1rem;
    }

    /* Section Styles */
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
        color: #dc3545;
        text-decoration: none;
        font-weight: 500;
    }

    .view-all:hover {
        text-decoration: underline;
    }

    /* Category Styles */
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

    /* Repeat existing category styles */
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
        background-color: rgba(220, 53, 69, 0.1);
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
        background-image: url('https://via.placeholder.com/600x400');
        background-size: cover;
        background-position: center;
    }

    /* Product Grid - Exactly 4 items per row */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        height: 320px;

    }

    /* Product Item - More compact design */
    .product-item {
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-item:hover {
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

    .product-item:hover .img-container img {
        transform: scale(1.05);
    }

    .product-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: var(--rose-gold, #bd8c7d);
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
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-name {
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--grey-dark, #4a4a4a);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .price-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        flex-wrap: wrap;
    }

    .original-price {
        text-decoration: line-through;
        color: var(--grey, #808080);
        font-size: 0.8rem;
    }

    .actual-price {
        font-weight: 600;
        color: var(--rose-gold, #bd8c7d);
        font-size: 0.95rem;
    }

    .discount-badge {
        font-size: 0.7rem;
        padding: 0.1rem 0.3rem;
        border: 1px solid var(--rose-gold, #bd8c7d);
        border-radius: 3px;
        color: var(--rose-gold, #bd8c7d);
    }

    /* Add to Cart - Only visible on hover */
    .add-to-cart-container {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.95);
        padding: 0.75rem;
        transform: translateY(100%);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .product-item:hover .add-to-cart-container {
        transform: translateY(0);
        opacity: 1;
    }

    .add-to-cart {
        width: 100%;
        background-color: var(--rose-gold);
        color: white;
        border: none;
        border-radius: 4px;
        padding: 0.5rem;
        font-size: 0.9rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .add-to-cart:hover {
        background-color: var(--rose-gold-dark);
    }

    #searchInput {
        transition: width 0.3s ease;
        width: 0;
        opacity: 0;
    }

    #searchInput:focus {
        width: 200px;
        opacity: 1;
    }

    #searchIcon {
        background-color: transparent;
        border: none;
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
        .categories-grid {
            grid-template-columns: repeat(2, 1fr);
        }

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
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-primary:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-lg {
        padding: 0.5rem 1rem;
        font-size: 1.25rem;
        line-height: 1.5;
        border-radius: 0.3rem;
    }

    /* Wishlist Icon */
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
</style>
</head>

<body>
    <div class="container">
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

        <!-- Shop by Categories Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Shop by Categories</h2>
                <a href="#" class="view-all">View All</a>
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


        <!-- Featured Banner -->
        <div class="featured-banner">
            <div class="featured-content">
                <div class="featured-text">
                    <h2>New Arrivals</h2>
                    <p>Discover our latest collection with exclusive designs and premium quality.</p>
                    <a href="#" class="btn btn-primary">Shop Now</a>
                </div>
                <div class="featured-img">
                    <!-- <div class="slider">
                        <div class="slides">
                            <a class="slide"><img src="img/slider-2.jpg" alt="Product 2"></a>
                            <a class="slide"><img src="img/slider-1.jpg" alt="Product 1"></a>
                            <a class="slide"><img src="img/slider-3.jpg" alt="Product 3"></a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Best Selling Products Section -->

        <section class="section" style="background-color: #f8f9fa;">
            <div class="section-header">
                <h2 class="section-title">Best Selling Products</h2>
                <a href="#" class="view-all">View All</a>
            </div>
            <div class="product-grid">
                <!-- Product Item Template - Show only 4 products -->
                @foreach ($products->take(4) as $product)
                <div class="product-item">
                    <div class="img-container">
                        <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->product_name }}">
                        @if($product->is_best_seller)
                        <span class="product-badge">Best Seller</span>
                        @endif
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">{{ $product->product_name }}</h3>
                        <div class="price-container">
                            <span class="original-price">Rs.{{ $product->price }}</span>
                            <span class="actual-price">Rs.{{ $product->actual_amount }}</span>
                            <span class="discount-badge">{{ $product->discount_percent }}% OFF</span>
                        </div>
                    </div>
                    <div class="add-to-cart-container">
                        <form action="{{ route('cart.addToCart', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="add-to-cart">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Featured Products Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Featured Products</h2>
                <a href="#" class="view-all">View All</a>
            </div>
            <div class="product-grid">
                <!-- Product Item Template - Show only 4 products -->
                @foreach ($featured_products->take(4) as $product)
                <div class="product-item">
                    <div class="img-container">
                        <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->product_name }}">
                        @if($product->is_featured)
                        <span class="product-badge">Featured</span>
                        @endif
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">{{ $product->product_name }}</h3>
                        <div class="price-container">
                            <span class="original-price">Rs.{{ $product->price }}</span>
                            <span class="actual-price">Rs.{{ $product->actual_amount }}</span>
                            @if(isset($product->discount_percent) && $product->discount_percent > 0)
                            <span class="discount-badge">{{ number_format($product->discount_percent, 0) }}% OFF</span>
                            @endif
                        </div>
                    </div>
                    <div class="add-to-cart-container">
                        <form action="{{ route('cart.addToCart', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="add-to-cart">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fs-3 fw-bold">Products</h1>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <!-- Product Card 1 -->
                @foreach ($products as $product )

                <div class="col">
                    <div class="product-card bg-white">

                        <div class="img-container">
                            <a href="{{route('getAddOnWhishlist', $product->id)}}" class="text-decoration-none" title="Wishlist">
                                <i class="bi bi-heart wishlist-icon"></i>
                            </a>
                            <a href="{{ route('product.details', $product->id) }}" style="text-decoration: none;">
                                <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->product_name }}">
                            </a>
                            <!-- <span class="best-seller-badge">Best Seller</span> -->
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
                            <button class="btn btn-add-to-cart w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // Clone all children to make a loop
        window.addEventListener("DOMContentLoaded", () => {
            const carousel = document.getElementById("carousel");
            carousel.innerHTML += carousel.innerHTML;
        });
    </script>

    <script>
        // Toggle wishlist icon to add in a wishlist card
        const wishlistIcons = document.querySelectorAll('.wishlist-icon');

        wishlistIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                this.classList.toggle('active');

                // Get product ID
                const productId = this.getAttribute('data-product-id');

                // Make an AJAX call to update wishlist in the backend
                fetch(`/wishlist/${productId}`, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update the state based on the response
                        if (data.status === 'added') {
                            this.classList.add('active');
                        } else if (data.status === 'removed') {
                            this.classList.remove('active');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>

    @endsection