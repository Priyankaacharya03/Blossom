<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --rose-gold: #bd8c7d;
            --rose-gold-dark: #a57868;
            --rose-gold-light: #d5b0a0;
            --grey-dark: #4a4a4a;
            --grey: #808080;
        }

        h2 {
            color: var(--rose-gold);
        }

        .btn-rose-gold {
            background-color: var(--rose-gold);
            color: white;
            border: none;
        }

        .btn-rose-gold:hover {
            background-color: var(--rose-gold-dark);
            color: white;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .success {
            color: green;
            font-size: 14px;
        }
    </style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow p-4">
                    <h2 class="text-center mb-4">Verify Your Email</h2>

                    @if (session('success'))
                    <p class="success text-center">{{ session('success') }}</p>
                    @endif

                    @if (session('error'))
                    <p class="error text-center">{{ session('error') }}</p>
                    @endif

                    <!-- OTP Verification Form -->
                    <form action="{{ route('verify.otp') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" value="{{ session('email') }}" class="form-control" readonly>
                            @error('email') <p class="error">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="otp" class="form-label">Enter OTP</label>
                            <input type="text" name="otp" id="otp" class="form-control" required>
                            @error('otp') <p class="error">{{ $message }}</p> @enderror
                        </div>

                        <div class="d-grid mb-2">
                            <button type="submit" class="btn btn-rose-gold">Verify OTP</button>
                        </div>
                    </form>

                    <!-- Resend OTP -->
                    <p class="text-center mt-3">Didn't receive the OTP?</p>
                    <form action="{{ route('resend.otp') }}" method="POST">
                        @csrf
                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-secondary">Resend OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>