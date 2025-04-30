@extends('site.layouts.main')

@section('title', 'Edit Profile')

@section('main-section')

<style>
    /* Custom CSS for Profile Pages */
    :root {
        --rose-gold: #bd8c7d;
        --rose-gold-light: #d4b2a7;
        --rose-gold-dark: #a67c6e;
        --grey: #808080;
        --light-grey: #f0f0f0;
    }

    body {
        background-color: #f8f9fa;
        color: #333;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .profile-heading {
        font-weight: 700;
        font-size: 28px;
        color: var(--rose-gold-dark);
    }

    .profile-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .profile-image-container {
        padding: 25px 15px;
        border-right: 1px solid #eee;
    }

    .profile-card {
        padding: 25px;
        border-bottom: 1px solid #eee;
    }

    .profile-item {
        margin-bottom: 20px;
    }

    .profile-item:last-child {
        margin-bottom: 0;
    }

    .profile-label {
        font-size: 14px;
        color: var(--grey);
        margin-bottom: 5px;
    }

    .profile-value {
        font-size: 16px;
        color: #212529;
    }

    .edit-icon {
        color: var(--rose-gold);
        font-size: 14px;
    }

    .edit-icon:hover {
        color: var(--rose-gold-dark);
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        color: var(--rose-gold-dark);
    }

    .btn-add {
        color: var(--rose-gold);
        font-size: 14px;
        padding: 4px 12px;
        background: none;
        border: 1px solid var(--rose-gold);
        border-radius: 4px;
    }

    .btn-add:hover {
        background-color: var(--rose-gold);
        color: white;
    }

    .no-data-message {
        background-color: var(--light-grey);
        border-radius: 4px;
        padding: 15px;
        color: var(--grey);
        font-size: 14px;
    }

    .no-data-message i {
        margin-right: 5px;
    }

    .form-control,
    .form-select {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 8px 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--rose-gold-light);
        box-shadow: 0 0 0 0.2rem rgba(189, 140, 125, 0.25);
    }

    .form-control[readonly] {
        background-color: var(--light-grey);
    }

    .form-text {
        font-size: 12px;
    }

    /* Profile Modal Styling */
    .modal-content {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .modal-dialog {
        max-width: 500px;
    }

    .profile-img-container {
        position: relative;
        width: 100px;
        height: 100px;
        margin: 20px auto;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid var(--rose-gold);
    }

    .profile-img {
        object-fit: cover;
        border-radius: 50%;
    }

    .profile-img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
        cursor: pointer;
    }

    .profile-img-container:hover .profile-img-overlay {
        opacity: 1;
    }

    .file-input-wrapper {
        position: relative;
        margin-top: 10px;
    }

    .btn-file {
        display: inline-block;
        padding: 6px 12px;
        background-color: var(--rose-gold);
        color: white;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    .btn-file:hover {
        background-color: var(--rose-gold-dark);
    }

    input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .error-text {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }

    .form-label {
        color: var(--grey);
        font-weight: 500;
    }

    .btn-save {
        background-color: var(--rose-gold);
        color: white;
        border: none;
        padding: 8px 24px;
        border-radius: 4px;
        font-weight: 500;
        margin: 20px 0;
        transition: background-color 0.3s;
    }

    .btn-save:hover {
        background-color: var(--rose-gold-dark);
    }

    .btn {
        background-color: var(--rose-gold);
        border-color: var(--rose-gold);
        transition: all 0.3s;
        color: white;
    }

    .btn:hover {
        background-color: var(--rose-gold-dark);
        border-color: var(--rose-gold-dark);
        color: white;

    }

    /* Responsive adjustments */
    @media (max-width: 767px) {
        .profile-image-container {
            border-right: none;
            border-bottom: 1px solid #eee;
            padding-bottom: 25px;
            margin-bottom: 20px;
        }

        .modal-dialog {
            margin: 10px;
        }
    }
</style>


<div class="container mt-5">
    <h1 class="profile-heading mb-4">Profile</h1>

    <div class="profile-container">
        <div class="row">
            <!-- Profile Image Column (Left Side) -->
            <div class="col-md-3 text-center profile-image-container">
                <div class="profile-img-wrapper">
                    <img src="{{ asset('storage/users/' . ($user->profile_img ?? 'default-profile.png')) }}" class="profile-img" alt="Profile Image" class="profile-img" style="width: 100px; height: 100px;">
                </div>
                <button type="button" class="btn  mt-3" data-bs-toggle="modal" data-bs-target="#editProfile{{ $user->id }}">
                    Edit Profile
                </button>

                <!-- Modal -->
                <div class="modal fade" id="editProfile{{ $user->id }}" tabindex="-1" aria-labelledby="editProfile{{ $user->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Profile Image Section -->
                                <div class="text-center mb-4">
                                    <div class="profile-img-container">
                                        <img src="{{ asset('storage/users/' . ($user->profile_img ?? 'default-profile.png')) }}"
                                            alt="Profile Image" class="profile-img" id="profile-preview"
                                            style="width: 100px; height: 100px;">
                                        <div class="profile-img-overlay">
                                            <span>Change Photo</span>
                                        </div>
                                    </div>
                                    <div class="file-input-wrapper">
                                        <span class="btn-file">Upload New Photo</span>
                                        <input type="file" name="profile_img" id="profile_img" accept="image/*"
                                            onchange="previewImage(event)">
                                        @error('profile_img')
                                        <div class="error-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Name Field -->
                                <div class="mb-4">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name', $user->name) }}" placeholder="Enter your full name">
                                    @error('name')
                                    <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email"
                                        value="{{ old('email', $user->email) }}" placeholder="Your email" readonly>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-save">Save Changes</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Information Column (Right Side) -->
            <div class="col-md-9">
                <div class="profile-card mb-4">
                    <div class="profile-item">
                        <div class="profile-label">Name</div>
                        <div class="profile-value d-flex justify-content-between">
                            <span>{{ $user->name}}</span>
                            <a href="edit-profile.html" class="edit-icon"><i class="fas fa-pencil-alt"></i></a>
                        </div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-label">Email</div>
                        <div class="profile-value">{{ $user->email }}</div>
                    </div>

                </div>

                <div class="profile-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="section-title">Addresses</h5>
                        <div class="profile-value"></div>

                    </div>

                    <!-- Check if there are shipping addresses -->
                    @if ($shippingInfo->isNotEmpty())
                    <!-- If there are addresses, display them -->
                    <div class="address-list">
                        @foreach ($shippingInfo as $address)
                        <div class="address-card">
                            <p>{{ $address->address }}</p>
                            <p>{{ $address->state }}, Postal code - {{ $address->postal_code }}</p>
                            Contact <p>{{ $address->phone_number }}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <!-- If no addresses, show no data message -->
                    <div class="no-data-message">
                        <i class="fas fa-info-circle"></i> No addresses added
                    </div>
                    <button class="btn btn-add"><i class="fas fa-plus"></i> Add</button>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>



<!-- JavaScript for Image Preview -->
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('profile-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection