@extends('site.layouts.main')

@section('title', 'Change Password')

@section('main-section')

<style>
    /* Custom CSS for Change Password Page */
    .password-section {
        background-color: #f8f9fa;
        padding: 40px 0;
    }

    .password-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: 0 auto;
    }

    .password-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-label {
        font-size: 14px;
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #bd8c7d;
        box-shadow: 0 0 5px rgba(189, 140, 125, 0.5);
    }

    .input-group {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #777;
        font-size: 14px;
        z-index: 10;
    }

    .toggle-password:hover {
        color: #333;
    }

    .btn-save {
        background-color: #bd8c7d;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 500;
        color: white;
        width: 100%;
    }

    .btn-save:hover {
        background-color: #a67c6e;
        color: white;
    }

    .error-text {
        font-size: 12px;
        color: #dc3545;
        margin-top: 5px;
        display: block;
    }

    .form-text {
        font-size: 12px;
        color: #777;
    }

    @media (max-width: 576px) {
        .password-container {
            padding: 20px;
        }

        .password-title {
            font-size: 20px;
        }
    }
</style>

<section class="password-section">
    <div class="container">
        <div class="password-container">
            <h2 class="password-title">Change Password</h2>

            <form action="{{ route('user.password.update') }}" method="POST">
                @csrf

                <!-- Current Password -->
                <div class="mb-4">
                    <label for="current_password" class="form-label">Current Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="current_password" id="current_password"
                            placeholder="Enter current password">
                        <span class="toggle-password" onclick="togglePassword('current_password')">Show</span>
                    </div>
                    @error('current_password')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label for="new_password" class="form-label">New Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="new_password" id="new_password"
                            placeholder="Enter new password">
                        <span class="toggle-password" onclick="togglePassword('new_password')">Show</span>
                    </div>
                    @error('new_password')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="mb-4">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="new_password_confirmation"
                            id="new_password_confirmation" placeholder="Confirm new password">
                        <span class="toggle-password" onclick="togglePassword('new_password_confirmation')">Show</span>
                    </div>
                    @error('new_password_confirmation')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-save">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- JavaScript for Password Toggle -->
<script>
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const toggle = input.nextElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            toggle.textContent = 'Hide';
        } else {
            input.type = 'password';
            toggle.textContent = 'Show';
        }
    }
</script>

@endsection