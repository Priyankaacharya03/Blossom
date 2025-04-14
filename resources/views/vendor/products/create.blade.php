@extends('vendor.layouts.main')

@section('title','Product')

@section('main-content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Product /</span> Create</h4>

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Add Products </h5>
                    <div class="card-body">
                        <form action="{{ route('vendor.product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label"><span class="text-danger">*</span><span class="text-capitalize"> name</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        id="name"
                                        value="{{ old('name') }}" />
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
                                        value="{{ old('price') }}" />
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
                                        value="{{ old('stock') }}" />
                                    @error('stock')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="discount_amount" class="form-label"><span class="text-capitalize"> discount amount</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="discount_amount"
                                        id="discount_amount"
                                        value="{{ old('discount_amount') }}" />
                                    @error('discount_amount')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="category_id" class="form-label">
                                    <span class="text-danger">*</span> <span class="text-capitalize">Category</span>
                                </label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="" selected>Select a Category</option>
                                    @foreach ($categories as $category)
                                    <!-- <option value="{{ $category->id }}" {{ old('category_id', $selectedCategory ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option> -->
                                    <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label"><span class="text-danger">*</span><span class="text-capitalize"> image</span></label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="image"
                                    id="image"
                                    value="{{ old('image') }}" />
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Is Feature</label>
                                <div class="form-check">
                                    <input type="hidden" value="0" name="is_feature" />
                                    <input class="form-check-input" type="checkbox" value="1" name="is_feature" id="featureProduct" />
                                    <label class="form-check-label" for="featureProduct">This will ensure whether to show or not in feature products </label>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="description" class="form-label"><span class="text-capitalize"> description</span></label>

                                <textarea class="form-control" name="description" id="" rows="3"></textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary">
                                Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection