<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        h2 {
            color: #bd8c7d;

        }

        :root {
            --rose-gold: #bd8c7d;
            --rose-gold-dark: #a57868;
            --rose-gold-light: #d5b0a0;
            --grey-dark: #4a4a4a;
            --grey: #808080;
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

        a {
            color: var(--rose-gold);
            text-decoration: none;
        }

        a:hover {
            color: var(--rose-gold-dark);
        }
    </style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow p-4" style="max-width: 415px; width: 100%;">
                    <h2 class="text-center mb-4">Register</h2>
                    <form action="{{ route('register.submit') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
                            @if ($errors->has('name'))
                            <span class="text-danger small">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                            @if ($errors->has('email'))
                            <span class="text-danger small">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            @if ($errors->has('password'))
                            <span class="text-danger small">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="re-enterPassword" class="form-label">Re-enter Password</label>
                            <input type="password" id="re-enterPassword" name="password_confirmation" class="form-control" required>
                            @if ($errors->has('re-enterPassword'))
                            <span class="text-danger small">{{ $errors->first('re-enterPassword') }}</span>
                            @endif
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-rose-gold">Create Account</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <span class="text-muted">Already have an account?
                            <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>