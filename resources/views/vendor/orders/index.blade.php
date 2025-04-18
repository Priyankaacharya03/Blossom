@extends('vendor.layouts.main')

@section('title', 'Order-index')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Order /</span> Index</h4>

    <div class="row">
        <div class="col">
            <a
                name=""
                id=""
                class="btn btn-primary my-2"
                href=""
                role="button"> + Add Order</a>

            <div class="card mb-4">
                <h5 class="card-header">Orders</h5>
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
                                    <th scope="col">Is Feature</th>
                                    <th scope="col">Vendor Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr class="">
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $order->order_name }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->stock }}</td>
                                    <td>{{ $order->discount_amount }}</td>
                                    <td>{{ $order->category->category_name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/'. $order->primary_image) }}" alt="" width="80px" height="70px">
                                    </td>
                                    <td>{{ $order->is_feature ? "Yes": "No"}}</td>
                                    <td>{{ $order->vendor->vendor_name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a
                                                name=""
                                                id=""
                                                class="btn btn-primary btn-sm"
                                                href="{{ route('vendor.order.edit',$order->id) }}"
                                                role="button">Edit</a>

                                            <form action="{{ route('vendor.order.delete',$order->id) }}" onclick="return confirm('Are you sure you want to delete this order? This action cannot be undone.')" method="post" class="d-inline-block">
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