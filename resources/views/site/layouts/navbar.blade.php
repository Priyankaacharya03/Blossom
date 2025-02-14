<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <div class="d-flex align-items-center collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('shop')}}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('blog')}}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vendor.register')}}">Become a seller</a>
                    </li>
                </ul>
            </div>

            <a class="navbar-brand fw-bold mx-auto text-center" href="{{route('home')}}" style="transform: translateX(-50%); left: 50%; position: absolute;">Blossom</a>

            <div class="d-flex align-items-center ms-auto">
                <a href="#" class="text-decoration-none mx-2">
                    <i class="bi bi-search text-dark"></i>
                </a>
                <a href="#" class="text-decoration-none mx-2">
                    <i class="bi bi-heart text-dark "></i>
                </a>
                <a href="#" class="text-decoration-none mx-2">
                    <i class="bi bi-bag text-dark "></i>
                </a>

                @if(Auth::check())
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link text-decoration-none mx-2 p-0">
                        <i class="bi bi-box-arrow-right text-dark fs-5"></i>
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="text-decoration-none mx-2">
                    <i class="bi bi-person text-dark fs-5"></i>
                </a>
                @endif
            </div>
        </div>
    </nav>

</body>

</html>