<head>
    @extends('site.layouts.main')

    @section('title', 'Edit Profile')

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
            background-color: #f8f9fa;
            color: var(--grey-dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .vendor-header {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .vendor-banner {
            height: 200px;
            background-color: var(--rose-gold-light);
            position: relative;
        }

        .vendor-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            position: absolute;
            bottom: -75px;
            left: 50px;
            background-color: white;
            object-fit: cover;
        }

        .vendor-info {
            padding: 30px 20px 20px;
            margin-top: 50px;
        }

        .vendor-name {
            color: var(--rose-gold-dark);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .vendor-contact {
            color: var(--grey);
            margin-bottom: 5px;
        }

        .vendor-bio {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            border-left: 4px solid var(--rose-gold);
        }

        .products-section {
            margin-top: 40px;
        }

        .section-title {
            color: var(--rose-gold-dark);
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 10px;
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
    </style>
</head>

<body>
    <div class="container py-5">
        <!-- Vendor Profile Header -->
        <div class="vendor-header mb-4">
            <div class="vendor-banner">
                @if(isset($vendor->banner_image) && $vendor->banner_image)
                <img src="{{ $vendor->banner_image }}" alt="Banner" class="w-100 h-100 object-fit-cover">
                @endif

                @if(isset($vendor->vendor_profile_img) && $vendor->vendor_profile_img)

                <img src="{{ asset('storage/vendors/' . $vendor->vendor_profile_img) }}" alt="{{ $vendor->vendor_name }}" class="vendor-avatar">


                @else
                <div class="vendor-avatar d-flex align-items-center justify-content-center bg-light">
                    <i class="fas fa-store fa-3x text-secondary"></i>
                </div>
                @endif
            </div>

            <div class="vendor-info">
                <h1 class="vendor-name display-5">{{ $vendor->vendor_name }}</h1>

                <div class="row">
                    <div class="col-md-6">
                        <p class="vendor-contact">
                            <i class="fas fa-envelope contact-icon"></i>
                            {{ $vendor->vendor_email }}
                        </p>
                        <p class="vendor-contact">
                            <i class="fas fa-map-marker-alt contact-icon"></i>
                            {{ $vendor->city }}, {{ $vendor->address }}
                        </p>
                        <p class="vendor-contact">
                            <i class="fas fa-phone contact-icon"></i>
                            {{ $vendor->phone_number }}
                        </p>
                    </div>

                </div>

                @if(isset($vendor->bio) && $vendor->bio)
                <div class="vendor-bio mt-4">
                    <h5 class="mb-2">About {{ $vendor->vendor_name }}</h5>
                    <p class="mb-0">{{ $vendor->bio }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Products Section -->
        <div class="products-section">
            <h3 class="section-title">Products by {{ $vendor->vendor_name }}</h3>

            @if(count($products) > 0)
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach($products as $product)
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
                                <span class="discount-badge">{{ $product->discount_percent }}% OFF</span>
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
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> This vendor hasn't added any products yet.
            </div>
            @endif
        </div>
    </div>

</body>

</html>
@endsection