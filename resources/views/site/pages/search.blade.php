@extends('site.layouts.main')

@section('title', 'Search')

@section('main-section')

<section class="featured-products">
    <div class="container">
        <h2>Searching Result</h2>
        <div class="products-grid">
            @if($products->count())
            @foreach($products as $product)
            <div class="product-card">
                <a href="{{ route('product.details', $product->id) }}">
                    <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->name }}" class="product-img">
                </a>
                <div class="card-body">
                    <h5 class="product-title">{{ $product->product_name }}</< /h5>

                        <p class="product-dec">{{ $product->description }}</p>

                        <p class="product-price">Rs.{{ $product->price }}</>
                </div>
            </div>
            @endforeach
            @else
            <p style="color: red;">No result found</>
                @endif
        </div>
    </div>
</section>
@endsection