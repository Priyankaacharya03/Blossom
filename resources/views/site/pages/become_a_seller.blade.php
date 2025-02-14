@extends('site.layouts.main')

@section('main-section')

<style>
    body {
        font: 1rem/1.5 var(--bs-font-sans-serif);
    }

    form {
        align-items: center;
    }

    .hidden {
        display: none;
    }
</style>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="card col-md-4 shadow" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <div class="card-text">
                    <h3 class="card-title text-center text-dark">Vendor Registration</h3>

                    <form id="vendorRegistrationForm" method="post" action="{{ route('register') }}">
                        @csrf

                        <div id="step-1">
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required />
                            </div>
                            <div class="mb-3">
                                <label for="business_name" class="form-label">Business Name</label>
                                <input type="text" class="form-control" id="business_name" name="business_name" required />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required />
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required />
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required />
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-dark" id="next-1">Next →</button>
                            </div>
                        </div>

                        <div id="step-2" class="hidden">
                            <div class="mb-3">
                                <label for="otp" class="form-label">Enter OTP sent to email</label>
                                <input type="text" class="form-control" id="otp" name="otp" required />
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-secondary" id="prev-2">← Previous</button>
                                <button type="button" class="btn btn-dark" id="verify-otp">Verify & Continue</button>
                            </div>
                        </div>

                        <div id="step-3" class="hidden">
                            <div class="mb-3">
                                <label for="pan" class="form-label">PAN/VAT Number</label>
                                <input type="text" class="form-control" id="pan" name="pan" required />
                            </div>
                            <div class="mb-3">
                                <label for="business_logo" class="form-label">Business Logo</label>
                                <input type="file" class="form-control" id="business_logo" name="business_logo" />
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-secondary" id="prev-3">← Previous</button>
                                <button type="button" class="btn btn-dark" id="next-3">Next →</button>
                            </div>
                        </div>

                        <div id="step-4" class="hidden">
                            <div class="mb-3">
                                <label for="address" class="form-label">Business Address</label>
                                <input type="text" class="form-control" id="address" name="address" required />
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City / District</label>
                                <input type="text" class="form-control" id="city" name="city" required />
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">State / Province</label>
                                <input type="text" class="form-control" id="state" name="state" required />
                            </div>
                            <div class="mb-3">
                                <label for="zip" class="form-label">ZIP/Postal Code</label>
                                <input type="text" class="form-control" id="zip" name="zip" required />
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-secondary" id="prev-4">← Previous</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let step = 1;

        function showStep(stepNumber) {
            document.querySelectorAll('[id^="step-"]').forEach(el => el.classList.add("hidden"));
            document.getElementById(`step-${stepNumber}`).classList.remove("hidden");
        }

        document.getElementById("next-1").addEventListener("click", function() {
            step = 2;
            showStep(step);
        });

        document.getElementById("prev-2").addEventListener("click", function() {
            step = 1;
            showStep(step);
        });

        document.getElementById("verify-otp").addEventListener("click", function() {
            // Here, you'd validate OTP before moving to step 3
            step = 3;
            showStep(step);
        });

        document.getElementById("prev-3").addEventListener("click", function() {
            step = 2;
            showStep(step);
        });

        document.getElementById("next-3").addEventListener("click", function() {
            step = 4;
            showStep(step);
        });

        document.getElementById("prev-4").addEventListener("click", function() {
            step = 3;
            showStep(step);
        });
    });
</script>



<!-- <style>
    body {
        font: 1rem/1.5 var(--bs-font-sans-serif);
    }

    form {
        align-items: center;
    }
</style>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="card col-md-4 shadow" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <div class="card-text">
                    <h3 class="card-title text-center text-dark">Vendor Registration</h3>
                    <form action="{{ route('login') }}" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email" required />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password" />

                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->




@endsection