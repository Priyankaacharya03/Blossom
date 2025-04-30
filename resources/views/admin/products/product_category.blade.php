@extends('admin.layouts.main')

@section('title','Product Category')

@section('main-content')

<style>
    /* Search and Add Product buttons */
    .custom-btn {
        background-color: #4a4a4a !important;
        color: white !important;
        border: 1px solid rgba(101, 101, 101, 0.3);
        border-radius: 0 4px 4px 0;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }


    .custom-btn:hover {
        background-color: #4a4a4a;
        color: white;
        border-color: #4a4a4a;
    }

    .search-btn i {
        font-size: 1rem;
    }

    /* Category dropdown */
    .form-select {
        border-color: #e0e0e0;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        border-color: rgba(172, 172, 173, 0.5);
        box-shadow: 0 0 5px rgba(172, 172, 173, 0.3);
    }
</style>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Product /</span> Category</h4>

        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#productCategory">
            Add category
        </button> -->

        <div class="row mb-3">
            <div class="col d-flex justify-content-between">
                <!-- Search bar -->
                <form action="{{ route('admin.product-category.index') }}" method="get" class="search-form">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search categories..."
                            aria-label="Search categories"
                            value="{{ request('search') }}">
                        <button class="btn btn-dark" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <div class="d-flex align-items-center justify-content-center gap-3">
                    <form action="{{ route('admin.product-category.index') }}" method="get">
                        <select
                            class="form-select form-select-md"
                            name="filter"
                            onchange="this.form.submit()"
                            id="filter">
                            <option selected disabled>Select Category</option>
                            <option value="">All</option>
                            @foreach ($allCategories as $category)
                            <option value="{{ $category->id }}" {{ request('filter') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </form>

                    <!-- Add Category button -->
                    <button type="button" class="btn my-2 custom-btn mb-2" data-bs-toggle="modal" data-bs-target="#productCategory">
                        Add Category
                    </button>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="productCategory" tabindex="-1" aria-labelledby="productCategoryLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.product-category.store') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productCategoryLabel">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                    value="{{ old('name') }}"
                                    aria-describedby="nameHelpId" />
                                @error('name')
                                <small id="nameHelpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Hidden</option>
                                </select>
                                @error('status')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label"><span class="text-danger">*</span><span class="text-capitalize"> image</span></label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="image"
                                    id="image"
                                    accept="image/*" />
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Product Category</h5>
                    <div class="card-body">
                        <div
                            class="table-responsive">
                            <table
                                class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SN</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category )
                                    <tr class="">
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->status }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'. $category->image) }}" alt="" width="80px" height="70px">
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCategory{{ $category->id }}">
                                                Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1" aria-labelledby="editCategory{{ $category->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.product-category.update',$category->id) }}" method="post" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editCategory{{ $category->id }}Label">Edit Category</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Name</label>
                                                                    <input
                                                                        type="name"
                                                                        class="form-control"
                                                                        name="name"
                                                                        id=""
                                                                        aria-describedby="nameHelpId"
                                                                        value="{{ $category->category_name }}" />
                                                                    @error('name')
                                                                    <small id="nameHelpId" class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select class="form-control" name="status" id="status">
                                                                        <option value="1" selected>Active</option>
                                                                        <option value="0">Hidden</option>
                                                                    </select>
                                                                    @error('status')
                                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="image" class="form-label">Current Image</label> <br>
                                                                    @if($category->image)
                                                                    <img src="{{ asset('storage/' . $category->image) }}" alt="Product Image" width="200" class="mb-3">
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

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update Category</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('admin.product-category.delete',$category->id) }}" onclick="return confirm('Are you sure you want to delete this category? This action cannot be undone.')" method="post" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection