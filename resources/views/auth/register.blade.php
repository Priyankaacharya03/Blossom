<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow p-4">
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
                            <input type="email" id="email" name="email" value="{{ old(key: 'email') }}" class="form-control" required>
                            @if ($errors->has('email'))
                            <span class="text-danger small">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-select" required>
                                <option value="" disabled selected>Select your gender</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @if ($errors->has('gender'))
                            <span class="text-danger small">{{ $errors->first('gender') }}</span>
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
                            <button type="submit" class="btn btn-dark">Create Account</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <span class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>