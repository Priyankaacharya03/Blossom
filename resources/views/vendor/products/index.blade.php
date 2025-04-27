<style>
    /* Refined UI Styles */
    body {
        background-color: #f4f5f6;
    }

    /* Search bar style */
    .search-container {
        width: 300px;
        display: flex;
        position: relative;
    }

    .search-input {
        border-radius: 4px 0 0 4px;
        padding: 0.5rem;
        border: 1px solid #e0e0e0;
        width: 100%;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: rgba(172, 172, 173, 0.5);
        box-shadow: 0 0 5px rgba(172, 172, 173, 0.3);
    }

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

    /* Card and table styles */
    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
    }

    .table {
        background-color: white;
    }

    .table th {
        background-color: #f8f9fa;
        color: #4a4a4a;
        border-bottom: 2px solid #e0e0e0;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(172, 172, 173, 0.05);
    }

    /* Pagination */
    .pagination .page-link {
        background-color: rgba(172, 172, 173, 0.1);
        color: #333;
        border: 1px solid rgba(172, 172, 173, 0.3);
        margin: 0 0.25rem;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background-color: #4a4a4a;
        color: white;
        border-color: #4a4a4a;
    }

    .pagination .page-item.active .page-link {
        background-color: #4a4a4a;
        color: white;
        border-color: #4a4a4a;
    }

    /* Dropdown menu */
    .dropdown-menu {
        border: 1px solid rgba(172, 172, 173, 0.2);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item:hover {
        background-color: rgba(172, 172, 173, 0.1);
    }
</style>


@extends('vendor.layouts.main')

@section('title', 'Product-index')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Product /</span> Index</h4>

    <div class="row mb-3">
        <div class="col d-flex justify-content-between">
            <!-- Search bar -->
            <form action="{{ route('vendor.product.index') }}" method="get" class="search-form">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search products..."
                        aria-label="Search products">
                    <button class="btn btn-dark" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>


            <div class="d-flex align-items-center justify-content-center gap-3">
                <form action="{{ route('vendor.product.index') }}" method="get">
                    <select
                        class="form-select form-select-md"
                        name="filter"
                        onchange="this.form.submit()"
                        id="filter">
                        <option selected disabled>Select Category</option>
                        <option value="">All</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('filter') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                        @endforeach
                    </select>
                </form>


                <!-- Add Product button -->
                <a
                    name=""
                    id=""
                    class="btn my-2 custom-btn mb-4"
                    href="{{ route('vendor.product.create') }}"
                    role="button">
                    + Add Product
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <h5 class="card-header">Products</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Discount Percent</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Is Feature</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr class="">
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/'. $product->primary_image) }}" alt="" width="50px" height="55px">
                                    </td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->discount_percent }}</td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td>{{ $product->is_feature ? "Yes" : "No" }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <!-- Dropdown trigger -->
                                            <i class="bi bi-three-dots" data-bs-toggle="dropdown" role="button" style="cursor: pointer;" aria-expanded="false"></i>

                                            <!-- Dropdown menu -->
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('vendor.product.edit', $product->id) }}">Edit</a>

                                                <form action="{{ route('vendor.product.delete', $product->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form>

                                                <a href="{{ route('vendor.product.images.index', $product->id) }}" class="dropdown-item">
                                                    Product Images
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@endsection