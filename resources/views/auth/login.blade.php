<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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

                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>

                    <div class="text-end mt-2">
                        <a href="{{route('password.request')}}" class="text-decoration-none small">Forgot Password?</a>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark">Login</button>
                </div>
            </form>
            <div class="my-3 text-center">
                <span class="text-muted">Or</span>
            </div>
            <div class="d-grid">
                <a href="{{ route('google-auth') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center">

                    Sign in with Google
                </a>
            </div>
            <div class="text-center mt-3">
                <span class="text-muted">New to Blossom? <a href="{{ route('register') }}" class="text-decoration-none">Register</a></span>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>