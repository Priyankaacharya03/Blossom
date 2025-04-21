@extends('site.layouts.main')

@section('title', 'Become a Seller')

@section('main-section')
<style>
    :root {
        --rose-gold: #bd8c7d;
        --rose-gold-dark: #a57868;
        --rose-gold-light: #d5b0a0;
        --grey-dark: #4a4a4a;
        --grey: #808080;
        --light-bg: #f9f9f9;
    }

    body {
        background-color: var(--light-bg);
    }

    .status-card {
        font-size: 0.95rem;
        padding: 0.75rem 1rem;
        border-radius: 6px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .status-pending {
        background-color: #fff4e5;
        color: #a36b00;
        border: 1px solid #ffe1b3;
    }

    .status-active {
        background-color: #e6ffed;
        color: #237a3d;
        border: 1px solid #b9f5c9;
    }

    .status-rejected {
        background-color: #ffe6e6;
        color: #b30000;
        border: 1px solid #ffb3b3;
    }


    .vendor-form-container {
        margin-top: 2px;
        padding: 2rem 1rem;
        background-color: white;
        max-width: 900px;
        margin: auto;
    }

    .vendor-form-title {
        font-size: 2rem;
        font-weight: 600;
        color: var(--grey-dark);
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--rose-gold);
        margin-bottom: 1rem;
        border-bottom: 1px solid #ddd;
        padding-bottom: 0.5rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--grey-dark);
        margin-bottom: 0.4rem;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 0.6rem 1rem;
        border: 1px solid #ccc;
        font-size: 1rem;
        background-color: #fff;
    }

    .form-control:focus {
        border-color: var(--rose-gold);
        outline: none;
    }

    .required-field {
        color: #dc3545;
        font-weight: bold;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .col-half {
        flex: 1 1 48%;
    }

    .file-upload-label {
        font-size: 0.85rem;
        color: var(--grey);
        margin-top: 0.25rem;
        display: block;
    }

    .submit-btn {
        background-color: var(--rose-gold);
        color: white;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        border-radius: .25rem;
    }

    .submit-btn:hover {
        background-color: var(--rose-gold-dark);
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    @media (max-width: 768px) {
        .col-half {
            flex: 1 1 100%;
        }
    }
</style>

<div class="vendor-form-container">
    <h1 class="vendor-form-title">Become a Seller on Blossom</h1>

    @if ($vendor)
    @php
    if ($vendor->vendor_status === 'pending') {
    toastr()->info('Your seller application is currently under review. We\'ll notify you once it\'s processed.');
    } elseif ($vendor->vendor_status === 'active') {
    toastr()->success('Congratulations! Your seller account has been approved. Please refresh the page to access your dashboard.');
    } else {
    toastr()->error('Your seller application has been rejected. Please contact support for more information.');
    }
    @endphp

    <div class="status-card status-{{ $vendor->vendor_status }}">
        @if ($vendor->vendor_status === 'pending')
        <i class="bi bi-hourglass-split me-2"></i> Your seller application is currently under review.
        @elseif ($vendor->vendor_status === 'active')
        <i class="bi bi-check-circle me-2"></i> Your seller account has been approved.
        @else
        <i class="bi bi-x-circle me-2"></i> Your seller application has been rejected.
        @endif
    </div>
    @endif

    <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-section-title">Business Information</div>
        <div class="row">
            <div class="col-half">
                <label for="vendor_name" class="form-label">Business Name <span class="required-field">*</span></label>
                <input type="text" class="form-control @error('vendor_name') is-invalid @enderror" id="vendor_name" name="vendor_name" value="{{ old('vendor_name', $vendor->vendor_name ?? '') }}">
                @error('vendor_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-half">
                <label for="vendor_email" class="form-label">Business Email <span class="required-field">*</span></label>
                <input type="email" class="form-control @error('vendor_email') is-invalid @enderror" id="vendor_email" name="vendor_email" value="{{ old('vendor_email', $vendor->vendor_email ?? '') }}">
                @error('vendor_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-section-title">Location Details</div>
        <div class="row">
            <div class="col-half">
                <label for="city" class="form-label">City <span class="required-field">*</span></label>
                <select class="form-control @error('city') is-invalid @enderror" id="city" name="city">
                    <option value="">-- Select City --</option>
                    @foreach(['Kathmandu', 'Lalitpur', 'Bhaktapur', 'Pokhara', 'Biratnagar', 'Birgunj', 'Dharan', 'Butwal', 'Hetauda', 'Nepalgunj'] as $city)
                    <option value="{{ $city }}" @selected(old('city', $vendor->city ?? '') == $city)>{{ $city }}</option>
                    @endforeach
                </select>
                @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-half">
                <label for="vendor_address" class="form-label">Full Address <span class="required-field">*</span></label>
                <input type="text" class="form-control @error('vendor_address') is-invalid @enderror" id="vendor_address" name="vendor_address" value="{{ old('vendor_address', $vendor->vendor_address ?? '') }}">
                @error('vendor_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-section-title">Contact & Business Details</div>
        <div class="row">
            <div class="col-half">
                <label for="phone_number" class="form-label">Phone Number <span class="required-field">*</span></label>
                <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $vendor->phone_number ?? '') }}">
                @error('phone_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-half">
                <label for="pan_number" class="form-label">PAN Number <span class="required-field">*</span></label>
                <input type="number" class="form-control @error('pan_number') is-invalid @enderror" id="pan_number" name="pan_number" value="{{ old('pan_number', $vendor->pan_number ?? '') }}">
                @error('pan_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-section-title">Upload Documents</div>
        <div class="row">
            <div class="col-half">
                <label for="vendor_profile_img" class="form-label">Business Logo <span class="required-field">*</span></label>
                <input type="file" class="form-control @error('vendor_profile_img') is-invalid @enderror" id="vendor_profile_img" name="vendor_profile_img">
                <span class="file-upload-label">JPG/PNG, max 2MB</span>
                @error('vendor_profile_img') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-half">
                <label for="document" class="form-label">Business Document <span class="required-field">*</span></label>
                <input type="file" class="form-control @error('document') is-invalid @enderror" id="document" name="document">
                <span class="file-upload-label">PDF/JPG, max 5MB</span>
                @error('document') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="submit-btn">Submit Application</button>
        </div>
    </form>
</div>
@endsection