@extends('site.layouts.main')

@section('title', 'Checkout')

@section('main-section')


<div class="category-header">
    <h1>{{ $category->category_name }}</h1>
    <p>{{ $category->items_count }} items in this category</p>
</div>

<div class="products-list">
    @foreach($products as $product)
    <div class="product-item">
        <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->name }}">
        <h3>{{ $product->product_name }}</h3>
        <p>{{ $product->description }}</p>
        <p>${{ $product->price }}</p>
        <a href="" class="btn">View Product</a>
    </div>
    @endforeach
</div>
@endsection