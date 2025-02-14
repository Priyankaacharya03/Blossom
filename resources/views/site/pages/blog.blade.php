@extends('site.layouts.main')

@section('title', 'Blog')

@section('main-section')
<!-- <h1>Blog Page</h1>
<p>This is the Blog page content.</p> -->


<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <h3 class="card-title text-center text-primary">Register</h3>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <form class="" method="post">
                                <div class="mb-3, text-cneter">
                                    <label for="exampleInputName" class="form-label">Name</label>
                                    <input
                                        type="name"
                                        class="form-control"
                                        id="exampleInputName"
                                        name="name"
                                        aria-describedby="emailHelp" />
                                </div>
                                <div class="mb-3, text-cneter">
                                    <label for="exampleInputEmail1" class="form-label">Email </label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="exampleInputEmail1"
                                        name="email"
                                        aria-describedby="emailHelp" />


                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="exampleInputPassword1"
                                        name="password" />


                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <hr />
                            <div class="row">
                                <a href="../Bootstrap/login.html" class="col-6" text-decoration-none>Register</a>
                                <a href="#" class="col-6" text-decoration-none>Forgot password</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>










@endsection