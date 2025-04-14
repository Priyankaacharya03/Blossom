@extends('admin.layouts.main')

@section('title', 'Product-index')

@section('main-content')

<div class="container my-4">
    <h2 class="text-center">Product ProductImage for</h2>

    <!-- Upload New Images -->
    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">Upload ProductImage Images</h5>
            <form action="{{ route('admin.product.images.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mb-3">
                    <label for="images" class="form-label">Select Images</label>
                    <input type="file" class="form-control" name="images[]" multiple
                        accept="image/png, image/jpg, image/jpeg" required>
                    <small class="text-muted">You can select multiple images.</small>
                    @error('images.*')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Upload Images</button>
            </form>
        </div>
    </div>

    <!-- Display Existing ProductImage Images -->
    <div class="row">
        @foreach ($productImages as $productImage)
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/' . $productImage->product_image) }}" class="card-img-top" alt="ProductImage Image">
                <div class="card-body text-center">

                    <!-- Delete -->
                    <form action="{{ route('admin.product.images.delete', $productImage->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this image?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


<!-- Back Button -->
<div class="text-center mt-4">
    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Back to Products</a>
</div>

</div>




@endsection