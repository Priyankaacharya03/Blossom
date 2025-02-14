<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="card col-md-4 shadow" style="max-width: 400px; width: 100%;">
                <div class="card-body">
                    <div class="card-text">
                        <h3 class="card-title text-center text-dark">Reset Password</h3>
                        <form action="{{route('password.update')}}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{$token}}">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" required value=" {{ old('email') }}">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                                @if ($errors->has('password'))
                                <span class="text-danger small">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="re-enterPassword" class="form-label">Re-enter Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                                @if ($errors->has('re-enterPassword'))
                                <span class="text-danger small">{{ $errors->first('re-enterPassword') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-dark">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>