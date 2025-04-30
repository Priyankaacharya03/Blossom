@extends('admin.layouts.main')

@section('title', 'Vendor-Request')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Vendors </span> </h4>
    <div class="row">
        <div class="col">
            <div>
                <form action="">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input
                            type="search"
                            class="form-control"
                            name="search"
                            id="search"
                            aria-describedby="helpId"
                            placeholder="Search by name or email..." />
                    </div>

                </form>
            </div>

            <div class="card mb-4">
                <h5 class="card-header">Vendors</h5>
                <div class="card-body">
                    <div
                        class="table-responsive">
                        <table
                            class="table">
                            <thead>
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendors as $vendor)
                                <tr class="">
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/vendors/'. $vendor->vendor_profile_img) }}" alt="" width="80px" height="70px">
                                    </td>
                                    <td>{{ $vendor->vendor_name }}</td>
                                    <td>{{ $vendor->vendor_email }}</td>
                                    <td>{{ $vendor->city }}</td>
                                    <td>{{ $vendor->vendor_address }}</td>
                                    <td>
                                        <div class="dropdown dropstart">
                                            <!-- Dropdown trigger -->
                                            <i class="bi bi-three-dots" data-bs-toggle="dropdown" role="button" style="cursor: pointer;" aria-expanded="false"></i>

                                            <!-- Dropdown menu -->
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.vendor.request.details',$vendor->id) }}">View Details</a>

                                                <!-- Use a button styled like a dropdown-item to trigger modal -->
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editVendorRequest{{ $vendor->id }}">
                                                    Response
                                                </button>
                                            </div>
                                        </div>

                                    </td>


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

@endsection