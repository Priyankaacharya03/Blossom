@extends('site.layouts.main')

@section('title', 'Wishlist')

@section('main-section')
<div class="container py-5">
    <h1 class="fs-3 fw-bold mb-4">Your Wishlist</h1>

    @if ($wishlists->count() > 0)
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($wishlists as $wishlist)
        <div class="col">
            <div class="product-card bg-white">
                <div class="img-container">
                    <a href="{{ route('product.details', $wishlist->product->id) }}" style="text-decoration: none;">
                        <img src="{{ asset('storage/' . $wishlist->product->primary_image) }}" alt="{{ $wishlist->product->product_name }}">
                    </a>
                    <a href="{{ route('getAddOnWhishlist', $wishlist->product->id) }}" class="text-decoration-none" title="Remove from Wishlist">
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
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <!-- <div class="d-flex justify-content-center mt-4">
        {{ $wishlists->links() }}
    </div>
    @else
    <p>You have no items in your wishlist.</p>
    @endif -->
</div>
@endsection