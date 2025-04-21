@extends('vendor.layouts.main')

@section('title', 'Product-index')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Product /</span> Index</h4>

    <div class="row mb-3">
        <div class="col d-flex justify-content-between">
            <!-- Search bar -->
            <form action="{{ route('vendor.product.index') }}" method="get">
                <div class="search-container d-flex align-items-center">
                    <input type="text" class="form-control search-input" name="search" placeholder="Search Products" aria-label="Search" />
                    <!-- Search Icon -->
                    <button class="btn search-btn" type="submit">
                        <i class="bi bi-search"></i> <!-- Bootstrap search icon -->
                    </button>
                </div>
            </form>

            <div class="d-flex align-items-center gap-3">
                <div class="mb-3">
                    <form action="{{ route('vendor.product.index') }}" method="get">
                        <select
                            class="form-select form-select-lg"
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

                </div>

                <!-- Add Product button -->
                <a
                    name=""
                    id=""
                    class="btn my-2"
                    href="{{ route('vendor.product.create') }}"
                    role="button"
                    style="background-color: #bd8c7d; color: white;">
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
            </div>
        </div>
    </div>

</div>

<!-- Add your CSS to improve UI -->
<style>
    /* Search bar style */
    .search-container {
        width: 300px;
        display: flex;
        position: relative;
    }

    .search-input {
        border-radius: 4px;
        padding: 0.5rem;
        border: 1px solid #ddd;
        width: 100%;
    }

    .search-input:focus {
        border-color: #bd8c7d;
        box-shadow: 0 0 5px rgba(189, 140, 125, 0.6);
    }

    /* Search button with icon */
    .search-btn {
        background-color: #bd8c7d;
        color: white;
        border: none;
        padding: 0.6rem 1rem;
        font-size: 1rem;
        border-radius: 4px;
        margin-left: 5px;
        cursor: pointer;
    }

    .search-btn i {
        font-size: 18px;
    }

    .search-btn:hover {
        background-color: #a77966;
        color: white;
    }

    /* Button style */
    .btn {
        background-color: #bd8c7d;
        color: white;
        border-radius: 5px;
        font-weight: 600;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn:hover {
        background-color: #a77966;
        color: #fff;
    }

    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Table style */
    .table th,
    .table td {
        vertical-align: middle;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .card-header {
        font-size: 1.25rem;
        background-color: #f8f9fa;
        font-weight: 600;
        border-bottom: 2px solid #ddd;
    }
</style>
@endsection