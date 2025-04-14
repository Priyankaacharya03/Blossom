@extends('site.layouts.main')

@section('main-section')

<div>
    @if ($vendor)
    @if ($vendor->vendor_status === 'pending')
    <div>Your request is in pending</div>
    @elseif ($vendor->vendor_status === 'active')
    <div>Your request has been approved. Please refresh your page.</div>
    @else
    <div>Your request has been rejected</div>
    @endif
    @endif

    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <h5 class="card-header">Vendor Registration</h5>
                <div class="card-body">
                    <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="vendor_name" class="form-label">Vendor Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="vendor_name" name="vendor_name" value="{{ old('vendor_name', $vendor->vendor_name ?? '') }}">

                                @error('vendor_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="vendor_email" class="form-label">Vendor Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="vendor_email" name="vendor_email" value="{{ old('vendor_email',$vendor->vendor_email ?? '') }}">
                                @error('vendor_email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                <select class="form-control" id="city" name="city">
                                    <option value="">-- Select City --</option>
                                    @foreach(['Kathmandu', 'Lalitpur', 'Bhaktapur', 'Pokhara', 'Biratnagar', 'Birgunj', 'Dharan', 'Butwal', 'Hetauda', 'Nepalgunj'] as $city)
                                    <option value="{{ $city }}" @selected(old('city',$vendor->city ?? '')==$city)>{{ $city }}</option>

                                    @endforeach
                                </select>
                                @error('city')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="vendor_address" class="form-label">Vendor Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="vendor_address" name="vendor_address" value="{{ old('vendor_address',$vendor->vendor_address ?? '') }}">
                                @error('vendor_address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number',$vendor->phone_number ?? '') }}">
                                @error('phone_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pan_number" class="form-label">PAN Number <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="pan_number" name="pan_number" value="{{ old('pan_number',$vendor->pan_number ?? '') }}">
                                @error('pan_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="vendor_profile_img" class="form-label">Vendor Profile Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="vendor_profile_img" name="vendor_profile_img">
                                @error('vendor_profile_img')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="document" class="form-label">Document </label>
                                <input type="file" class="form-control" id="document" name="document">
                                @error('document')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection