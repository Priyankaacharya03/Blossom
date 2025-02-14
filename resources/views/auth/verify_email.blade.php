<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .input-group {
            margin: 10px 0;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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

<body>
    <div class="container">
        <h2>Verify Your Email</h2>

        <!-- Success Message -->
        @if (session('success'))
        <p class="success">{{ session('success') }}</p>
        @endif

        <!-- Error Message -->
        @if (session('error'))
        <p class="error">{{ session('error') }}</p>
        @endif

        <!-- OTP Verification Form -->
        <form action="{{ route('verify.otp') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ session('email') }}" readonly>
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="otp">Enter OTP</label>
                <input type="text" name="otp" id="otp" required>
                @error('otp') <p class="error">{{ $message }}</p> @enderror
            </div>

            <button type="submit">Verify OTP</button>
        </form>

        <!-- Resend OTP Form -->
        <p>Didn't receive the OTP? Request a new one:</p>
        <form action="{{ route('resend.otp') }}" method="POST">
            @csrf
            <button type="submit">Resend OTP</button>
        </form>
    </div>
</body>

</html>