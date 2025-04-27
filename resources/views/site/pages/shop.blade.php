@extends('site.layouts.main')

@section('title', 'Shop')

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

    /* .best-seller-badge {
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
    } */

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

    /* Filter Styles */
    .filter-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        background-color: white;
        margin-bottom: 1.5rem;
    }

    .filter-header {
        padding: 1rem;
        border-bottom: 1px solid #eee;
        font-weight: 600;
        color: var(--grey-dark);
    }

    .filter-body {
        padding: 1rem;
    }

    .filter-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--grey-dark);
        margin-bottom: 0.75rem;
    }

    .price-range-inputs {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .price-input {
        width: 100%;
        padding: 0.375rem 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        font-size: 0.875rem;
    }

    .filter-checkbox {
        margin-right: 0.5rem;
    }

    .filter-label {
        font-size: 0.875rem;
        color: var(--grey-dark);
    }

    .filter-count {
        font-size: 0.75rem;
        color: var(--grey);
        margin-left: 0.25rem;
    }

    .btn-filter {
        background-color: var(--rose-gold);
        border-color: var(--rose-gold);
        color: white;
        width: 100%;
        margin-top: 1rem;
    }

    .btn-filter:hover {
        background-color: var(--rose-gold-dark);
        border-color: var(--rose-gold-dark);
        color: white;
    }

    .btn-reset {
        background-color: transparent;
        border-color: var(--grey);
        color: var(--grey);
        width: 100%;
        margin-top: 0.5rem;
    }

    .btn-reset:hover {
        background-color: #f1f1f1;
        border-color: var(--grey-dark);
        color: var(--grey-dark);
    }

    .sort-select {
        padding: 0.375rem 2rem 0.375rem 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        background-position: right 0.75rem center;
    }

    .active-filter {
        background-color: var(--rose-gold-light);
        color: white;
        border-radius: 15px;
        padding: 0.2rem 0.5rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        display: inline-block;
        font-size: 0.75rem;
    }

    .active-filter .close {
        margin-left: 0.25rem;
        font-weight: bold;
    }

    /* Mobile Filters */
    .mobile-filter-toggle {
        display: none;
    }

    @media (max-width: 991.98px) {
        .mobile-filter-toggle {
            display: block;
            margin-bottom: 1rem;
        }

        .filter-sidebar {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            /* Changed from right to left */
            bottom: 0;
            width: 280px;
            background-color: white;
            z-index: 1050;
            overflow-y: auto;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
            /* Changed shadow direction */
            padding: 1rem;
            transition: transform 0.3s ease;
        }

        .filter-sidebar.show {
            display: block;
            transform: translateX(0);
        }

        .filter-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5rem;
            cursor: pointer;
        }
    }

    /* No products found */
    .no-products {
        padding: 2rem;
        text-align: center;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .no-products i {
        font-size: 3rem;
        color: var(--grey);
        margin-bottom: 1rem;
    }

    /* Search bar */
    .search-container {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .search-input {
        width: 100%;
        padding: 0.5rem 2.5rem 0.5rem 1rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        font-size: 0.875rem;
    }

    .search-btn {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--grey);
        cursor: pointer;
    }

    .search-btn:hover {
        color: var(--rose-gold);
    }

    /* Overlay for mobile filter */
    .filter-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1040;
    }

    .filter-overlay.show {
        display: block;
    }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fs-3 fw-bold">Shop Collection</h1>
        <div class="d-flex align-items-center">
            <form action="{{ route('shop') }}" method="GET" class="d-flex">
                <!-- Preserve existing filters when sorting -->
                @if(request('category_id'))
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                @endif

                @if(request('subcategory_id'))
                <input type="hidden" name="subcategory_id" value="{{ request('subcategory_id') }}">
                @endif

                @if(request('min_price'))
                <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                @endif

                @if(request('max_price'))
                <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                @endif

                @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                <select name="sort" class="form-select sort-select" onchange="this.form.submit()">
                    <option value="" {{ !request('sort') ? 'selected' : '' }}>Sort By</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="search-container">
        <form action="{{ route('shop') }}" method="GET">
            <!-- Preserve existing filters when searching -->
            @if(request('category_id'))
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            @endif

            @if(request('subcategory_id'))
            <input type="hidden" name="subcategory_id" value="{{ request('subcategory_id') }}">
            @endif

            @if(request('min_price'))
            <input type="hidden" name="min_price" value="{{ request('min_price') }}">
            @endif

            @if(request('max_price'))
            <input type="hidden" name="max_price" value="{{ request('max_price') }}">
            @endif

            @if(request('sort'))
            <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif

            <input type="text" name="search" class="search-input" placeholder="Search products..." value="{{ request('search') }}">
            <button type="submit" class="search-btn">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <!-- Mobile Filter Toggle Button -->
    <button class="btn btn-outline-secondary w-100 mobile-filter-toggle" type="button" onclick="toggleMobileFilter()">
        <i class="bi bi-funnel"></i> Show Filters
    </button>

    <!-- Active Filters Display -->
    @if(request('category_id') || request('subcategory_id') || request('min_price') || request('max_price') || request('search'))
    <div class="mb-3">
        <div class="d-flex flex-wrap">
            @if(request('search'))
            <div class="active-filter">
                Search: "{{ request('search') }}"
                <a href="{{ route('shop', array_merge(request()->except('search'), ['page' => 1])) }}" class="text-white text-decoration-none">
                    <span class="close">×</span>
                </a>
            </div>
            @endif

            @if(request('category_id') && isset($selectedCategory))
            <div class="active-filter">
                Category: {{ $selectedCategory->name }}
                <a href="{{ route('shop', array_merge(request()->except('category_id', 'subcategory_id'), ['page' => 1])) }}" class="text-white text-decoration-none">
                    <span class="close">×</span>
                </a>
            </div>
            @endif

            @if(request('subcategory_id') && isset($selectedSubcategory))
            <div class="active-filter">
                Subcategory: {{ $selectedSubcategory->name }}
                <a href="{{ route('shop', array_merge(request()->except('subcategory_id'), ['page' => 1])) }}" class="text-white text-decoration-none">
                    <span class="close">×</span>
                </a>
            </div>
            @endif

            @if(request('min_price') || request('max_price'))
            <div class="active-filter">
                Price: Rs.{{ request('min_price', 0) }} - Rs.{{ request('max_price', 'max') }}
                <a href="{{ route('shop', array_merge(request()->except(['min_price', 'max_price']), ['page' => 1])) }}" class="text-white text-decoration-none">
                    <span class="close">×</span>
                </a>
            </div>
            @endif

            @if(request('category_id') || request('subcategory_id') || request('min_price') || request('max_price') || request('search'))
            <div>
                <a href="{{ route('shop') }}" class="btn btn-sm btn-outline-secondary">
                    Clear All Filters
                </a>
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="row">
        <!-- Filter Sidebar - Now on the left side -->
        <div class="col-lg-3 order-2 order-lg-1 mb-4 mb-lg-0">
            <div class="filter-sidebar" id="filterSidebar">
                <div class="d-lg-none">
                    <span class="filter-close" onclick="toggleMobileFilter()">&times;</span>
                    <h5 class="mb-3">Filters</h5>
                </div>

                <form action="{{ route('shop') }}" method="GET" id="filterForm">
                    <!-- Preserve search when filtering -->
                    @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <!-- Preserve sort when filtering -->
                    @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <!-- Categories Filter -->
                    <div class="filter-card">
                        <div class="filter-header">Categories</div>
                        <div class="filter-body">
                            @if(isset($categories) && $categories->count() > 0)
                            @foreach($categories as $category)
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="radio" name="category_id"
                                    id="category{{ $category->id }}" value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                <label class="form-check-label filter-label" for="category{{ $category->id }}">
                                    {{ $category->category_name }}
                                    <span class="filter-count">({{ $category->products_count ?? 0 }})</span>
                                </label>
                            </div>
                            @endforeach
                            @else
                            <p class="text-muted">No categories available</p>
                            @endif
                        </div>
                    </div>

                    <!-- Subcategories Filter -->
                    @if(request('category_id') && isset($subcategories) && $subcategories->count() > 0)
                    <div class="filter-card">
                        <div class="filter-header">Subcategories</div>
                        <div class="filter-body">
                            @foreach($subcategories as $subcategory)
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="radio" name="subcategory_id"
                                    id="subcategory{{ $subcategory->id }}" value="{{ $subcategory->id }}"
                                    {{ request('subcategory_id') == $subcategory->id ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                <label class="form-check-label filter-label" for="subcategory{{ $subcategory->id }}">
                                    {{ $subcategory->subcategory_name }}
                                    <span class="filter-count">({{ $subcategory->products_count ?? 0 }})</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Price Range Filter -->
                    <div class="filter-card">
                        <div class="filter-header">Price Range</div>
                        <div class="filter-body">
                            <div class="price-range-inputs">
                                <input type="number" class="price-input" name="min_price" placeholder="Min"
                                    value="{{ request('min_price') }}" min="0">
                                <span>-</span>
                                <input type="number" class="price-input" name="max_price" placeholder="Max"
                                    value="{{ request('max_price') }}" min="0">
                            </div>
                            <button type="submit" class="btn btn-filter mt-3">Apply Filter</button>
                            <a href="{{ route('shop', request()->except(['min_price', 'max_price', 'page'])) }}"
                                class="btn btn-reset">Reset Price</a>
                        </div>
                    </div>

                    <!-- Apply Filters Button (Mobile) -->
                    <div class="d-lg-none">
                        <button type="submit" class="btn btn-filter">Apply Filters</button>
                        <a href="{{ route('shop') }}" class="btn btn-reset">Reset All</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Product Listing - Now on the right side -->
        <div class="col-lg-9 order-1 order-lg-2">
            @if(isset($products) && $products->count() > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @foreach ($products as $product)
                <div class="col">
                    <div class="product-card bg-white">
                        <div class="img-container">
                            <a href="{{ route('product.details', $product->id) }}" style="text-decoration: none;">
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

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->appends(request()->query())->links() }}
            </div>
            @else
            <div class="no-products">
                <i class="bi bi-search"></i>
                <h3>No products found</h3>
                <p>Try adjusting your search or filter criteria</p>
                <a href="{{ route('shop') }}" class="btn btn-outline-secondary mt-2">
                    Clear All Filters
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Overlay for mobile filter -->
<div class="filter-overlay" id="filterOverlay" onclick="toggleMobileFilter()"></div>

<script>
    function toggleMobileFilter() {
        const filterSidebar = document.getElementById('filterSidebar');
        const filterOverlay = document.getElementById('filterOverlay');

        filterSidebar.classList.toggle('show');
        filterOverlay.classList.toggle('show');

        // Prevent body scrolling when filter is open
        if (filterSidebar.classList.contains('show')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }
</script>

@endsection