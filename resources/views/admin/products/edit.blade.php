@extends('admin.layouts.main')

@section('title','Product')

@section('main-content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Product /</span> Edit</h4>

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Products </h5>
                    <div class="card-body">
                        <form action="{{ route('admin.product.update',$product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label"><span class="text-danger">*</span><span class="text-capitalize"> name</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        id="name"
                                        value="{{ old('name', $product->product_name) }}" />
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="price" class="form-label"><span class="text-danger">*</span><span class="text-capitalize"> price</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="price"
                                        id="price"
                                        value="{{old('price',$product->price) }}" />
                                    @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label for="stock" class="form-label"><span class="text-danger">*</span><span class="text-capitalize"> stock</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="stock"
                                        id="stock"
                                        value=" {{ old('stock', $product->stock )  }}" />
                                    @error('stock')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class=" col-md-6">
                                    <label for="discount_amount" class="form-label"><span class="text-capitalize"> discount amount</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="discount_amount"
                                        id="discount_amount"
                                        value="{{old('diccount_amount', $product->discount_amount ) }}" />
                                    @error('discount_amount')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="category_id" class="form-label">
                                    <span class="text-danger">*</span> <span class="text-capitalize">category</span>
                                </label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="" selected>Select a Category</option>
                                    @foreach ($categories as $category)
                                    <!-- <option value="{{ $category->id }}" {{ old('category_id', $selectedCategory ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option> -->
                                    <!-- <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>{{ $category->category_name }}</option> -->
                                    <option value="{{ $category->id }}"
                                        @selected(old('category_id', $product->category_id) == $category->id)>
                                        {{ $category->category_name }}
                                    </option>

                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Current Image</label> <br>

                                @if($product->primary_image)
                                <img src="{{ asset('storage/' . $product->primary_image) }}" alt="Product Image" width="200" class="mb-3">
                                @else
                                <p class="text-muted">No Image Available</p>
                                @endif

                                <label for="image" class="form-label d-block ">
                                    Upload New Image
                                </label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="image"
                                    id="image" />
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label"><span class="text-capitalize"> description</span></label>

                                <textarea class="form-control" name="description" id="" rows="3">{{ old('description', $product->description) }}</textarea>

                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection