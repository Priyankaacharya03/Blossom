@extends('admin.layouts.main')

@section('title', 'Vendor-Request')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Vendor /</span> Requests</h4>

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
                                @foreach ($vendorRequests as $vendorRequest)
                                <tr class="">
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/vendors/'. $vendorRequest->vendor_profile_img) }}" alt="" width="80px" height="70px">
                                    </td>
                                    <td>{{ $vendorRequest->vendor_name }}</td>
                                    <td>{{ $vendorRequest->vendor_email }}</td>
                                    <td>{{ $vendorRequest->city }}</td>
                                    <td>{{ $vendorRequest->vendor_address }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <!-- Dropdown trigger -->
                                            <i class="bi bi-three-dots" data-bs-toggle="dropdown" role="button" style="cursor: pointer;" aria-expanded="false"></i>

                                            <!-- Dropdown menu -->
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.vendor.request.details',$vendorRequest->id) }}">View Details</a>

                                                <!-- Use a button styled like a dropdown-item to trigger modal -->
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editVendorRequest{{ $vendorRequest->id }}">
                                                    Response
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editVendorRequest{{ $vendorRequest->id }}" tabindex="-1" aria-labelledby="editVendorRequest{{ $vendorRequest->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.vendor.request.handle',$vendorRequest->id) }}" method="post" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editVendorRequest{{ $vendorRequest->id }}Label">Edit Vendor Request</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('POST')
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-control" name="status" id="status">
                                                                    <option value="active" selected>Accept</option>
                                                                    <option value="rejected">Reject</option>
                                                                </select>
                                                                @error('status')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>


                                                            <div class="mb-3">
                                                                <label for="message" class="form-label">Message</label>
                                                                <textarea class="form-control" name="message" id="message" rows="4" placeholder="Enter message...">{{ old('message') }}</textarea>
                                                                @error('message')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update Vendor Request</button>
                                                        </div>
                                                    </form>
                                                </div>
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