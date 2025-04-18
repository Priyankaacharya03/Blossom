<style>
    :root {
        --rose-gold: #bd8c7d;
        --rose-gold-light: #d4b2a7;
        --rose-gold-dark: #a67c6e;
        --grey: #808080;
        --light-grey: #f0f0f0;
    }

    .navbar {
        padding: 15px 0;
        transition: all 0.3s ease;
    }

    .navbar-brand {
        font-size: 28px;
        letter-spacing: 1px;
        color: var(--rose-gold) !important;
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
    }

    .nav-link {
        font-weight: 500;
        color: var(--grey) !important;
        margin: 0 10px;
        position: relative;
        transition: color 0.3s ease;
    }

    .nav-link:after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: var(--rose-gold);
        transition: width 0.3s ease;
    }

    .nav-link:hover:after,
    .nav-link.active:after {
        width: 100%;
    }

    .nav-link.active,
    .nav-link:hover {
        color: var(--rose-gold) !important;
    }

    .navbar-icons a {
        margin: 0 12px;
        position: relative;
        transition: transform 0.3s ease;
    }

    .navbar-icons a:hover {
        transform: translateY(-3px);
    }

    .navbar-icons i {
        font-size: 20px;
        color: var(--grey);
        transition: color 0.3s ease;
    }

    .navbar-icons a:hover i {
        color: var(--rose-gold);
    }

    .btn-link {
        color: var(--grey);
        transition: color 0.3s ease;
    }

    .btn-link:hover {
        color: var(--rose-gold);
    }


    .profile-img {
        height: 25px;
        width: 25px;
        border: 1px solid #ccc;
        border-radius: 50%;
        object-fit: cover;
        margin-left: 6px;
    }

    .dropdown-menu {
        margin-top: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        padding: 8px 20px;
    }

    .dropdown-item:hover {
        background-color: rgb(220, 219, 219);
        width: auto;
    }

    .dropdown-item i {
        margin-right: 10px;
        color: #6c757d;
    }

    .dropdown-divider {
        margin: 5px 0;
    }

    /* Optional: Add a subtle animation */
    .dropdown-menu.show {
        animation: fadeIn 0.2s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 991px) {
        .navbar-brand {
            position: relative !important;
            transform: translateX(0) !important;
            left: 0 !important;
        }
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{route('shop')}}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}" href="{{route('blog')}}">Blog</a>
                    </li>
                    @if(Auth::check() && Auth::user()->role === 'vendor')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('become.a.seller') ? 'active' : '' }}" href="{{ route('vendor.dashboard') }}"> Dashboard</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('become.a.seller') ? 'active' : '' }}" href="{{ route('become.a.seller') }}">Become a seller</a>
                    </li>
                    @endif

                </ul>
            </div>

            <a class="navbar-brand fw-bold mx-auto text-center" href="{{route('index')}}" style="transform: translateX(-50%); left: 50%; position: absolute;">Blossom</a>

            <div class="d-flex align-items-center ms-auto navbar-icons">
                <!-- Search Icon -->
                <form action="{{ route('search') }}" id="searchForm" class="d-flex align-items-center">
                    <button type="button" id="searchIcon" class="btn ">
                        <i class="bi bi-search"></i>
                    </button>

                    <!-- Search Bar (Initially hidden) -->
                    <input type="text" name="keyword" id="searchInput" class="form-control" placeholder="Search..." style="display: none;">
                </form>

                <a href="{{ route('wishlist') }}" class="text-decoration-none" title="Wishlist">
                    <i class="bi bi-heart"></i>
                </a>
                <a href="{{ route('cart.getCarts') }}" class="text-decoration-none position-relative" title="Cart">
                    <i class="bi bi-bag"></i>
                    @if(Auth::check())
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $carts?->count()}}
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    @endif
                </a>

                @if(Auth::check())
                <div class="dropdown">
                    <img src="{{ Auth::user()->profile_img ? asset('storage/users/' . Auth::user()->profile_img) : asset('assets/images/default_user.jpg')  }}"
                        alt="Profile Image"
                        class="profile-img"
                        id="profileDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="bi bi-person"></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.password.change') }}"><i class="bi bi-key"></i>Change Password</a></li>

                        <li><a class="dropdown-item" href="{{ route('user.order') }}"><i class="bi bi-receipt"></i></>My Orders</a></li>

                        <li><a class="dropdown-item" href="#"><i class="bi bi-clock-history"></i></> History</a></li>

                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right"></i>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-decoration-none p-0" title="Logout">
                                        Logout
                                    </button>
                                </form>
                            </a></li>
                    </ul>
                </div>
                <!-- <div class="dropdown">
                    <img src="{{ Auth::user()->profile_img ? asset('storage/' . Auth::user()->profile_img) : asset('assets/images/default_user.jpg')  }}" alt="Profile Image" class="user_img" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div> -->



                @else
                <a href="{{ route('login') }}" class="text-decoration-none" title="Login">
                    <i class="bi bi-person fs-4 "></i>
                </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- search -->
    <!-- Add this script for toggle effect -->
    <script>
        // Get elements
        const searchIcon = document.getElementById('searchIcon');
        const searchInput = document.getElementById('searchInput');

        // Add click event listener to the search icon
        searchIcon.addEventListener('click', function() {
            // Toggle visibility of search input
            if (searchInput.style.display === 'none' || searchInput.style.display === '') {
                searchInput.style.display = 'inline-block'; // Show the search bar
                searchInput.focus(); // Focus on the input when it appears
            } else {
                searchInput.style.display = 'none'; // Hide the search bar
            }
        });
    </script>

</body>

</html>