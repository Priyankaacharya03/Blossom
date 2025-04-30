<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
            color: #bd8c7d;
        }

        .btn-rose-gold {
            background-color: var(--rose-gold);
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-rose-gold:hover {
            background-color: var(--rose-gold-dark);
            color: white;
        }

        .btn-outline-rose-gold {
            border: 1px solid var(--grey);
            color: var(--grey-dark);
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-rose-gold:hover {
            background-color: var(--grey);
            color: white;
        }

        .text-rose-gold {
            color: var(--rose-gold);
        }

        a {
            color: var(--rose-gold);
            text-decoration: none;
        }

        a:hover {
            color: var(--rose-gold-dark);
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-4">Login</h2>
            <form action="{{ route('login.submit') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    <div class="text-end mt-2">
                        <a href="{{ route('password.request') }}" class="small">Forgot Password?</a>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-rose-gold">Login</button>
                </div>
            </form>
            <div class="my-3 text-center">
                <span class="text-muted">Or</span>
            </div>
            <div class="d-grid">
                <a href="{{ route('google-auth') }}" class="btn btn-outline-rose-gold d-flex align-items-center justify-content-center">
                    Sign in with Google
                </a>
            </div>
            <div class="text-center mt-3">
                <span class="text-muted">New to Blossom? <a href="{{ route('register') }}">Register</a></span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>