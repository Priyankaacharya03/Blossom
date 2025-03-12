@extends('admin.layouts.main')

@section('title', 'Product-index')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Product /</span> Index</h4>

    <div class="row">
        <div class="col">
            <a
                name=""
                id=""
                class="btn btn-primary my-2"
                href="{{ route('admin.product.create') }}"
                role="button"> + Add Product</a>

            <div class="card mb-4">
                <h5 class="card-header">Products</h5>
                <div class="card-body">
                    <div
                        class="table-responsive">
                        <table
                            class="table">
                            <thead>
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Discount Amount</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Vendor Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr class="">
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->discount_amount }}</td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/'. $product->primary_image) }}" alt="" width="80px" height="70px">
                                    </td>
                                    <td>{{ $product->vendor->vendor_name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a
                                                name=""
                                                id=""
                                                class="btn btn-primary btn-sm"
                                                href="{{ route('admin.product.edit',$product->id) }}"
                                                role="button">Edit</a>

                                            <form action="{{ route('admin.product.delete',$product->id) }}" onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.')" method="post" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
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
@endsection