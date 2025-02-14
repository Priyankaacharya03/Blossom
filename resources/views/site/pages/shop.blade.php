@extends('site.layouts.main')

@section('title', 'Shop')

@section('main-section')

<style>
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
                    <h3 class="card-title text-center text-primary">Login</h3>
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
                            <div class="text-end mt-2">
                                <a href="#" class="text-decoration-none small">Forgot Password?</a>
                            </div>

                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>
                        <div class="mb-3 text-center">
                            <span class="text-muted">Or</span>
                        </div>
                        <a
                            name=""
                            id=""
                            class="btn btn-outline-secondary"
                            href="{{ route('google-auth') }}"
                            role="button"> Sign in with Google</a>


                    </form>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection