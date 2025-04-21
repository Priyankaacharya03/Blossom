@extends('admin.layouts.main')

@section('title', 'Vendor-Request')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Vendor /</span> Details</h4>

    <div class="card mb-4">
        <h5 class="card-header">Vendors</h5>
        <div class="card-body">
            <div
                class="table-responsive">
                <table
                    class="table">
                    <thead>
                        <tr>
                            <th scope="col">Phone Number</th>
                            <th scope="col">PAN No.</th>
                            <th scope="col">Document</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendorRequestDetails as $vendorRequestDetail)
                        <tr class="">
                            <td>{{ $vendorRequestDetail->phone_number}}</td>
                            <td>{{ $vendorRequestDetail->pan_number }}</td>
                            <td>
                                <img src="{{ asset('storage/documents/' . $vendorRequestDetail->document) }}" alt="Document">

                            </td>

            </div>
        </div>
        @endforeach
        </tbody>
        </table>
    </div>

</div>

@endsection