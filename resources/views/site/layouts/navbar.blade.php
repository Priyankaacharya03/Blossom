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
        font-weight: 700;
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

    .navbar-icons {
        display: flex;
        align-items: center;
    }

    .navbar-icons .icon-link {
        margin: 0 12px;
        position: relative;
        transition: transform 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .navbar-icons .icon-link:hover {
        transform: translateY(-3px);
    }

    .navbar-icons i {
        font-size: 20px;
        color: var(--grey);
        transition: color 0.3s ease;
    }

    .navbar-icons .icon-link:hover i {
        color: var(--rose-gold);
    }

    /* Badge styling */
    .badge-counter {
        position: absolute;
        top: -8px;
        right: -8px;
        font-size: 10px;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: var(--rose-gold);
        color: white;
        font-weight: 600;
    }

    .btn-link {
        color: var(--grey);
        transition: color 0.3s ease;
    }

    .btn-link:hover {
        color: var(--rose-gold);
    }

    .profile-img {
        height: 32px;
        width: 32px;
        border: 2px solid var(--rose-gold-light);
        border-radius: 50%;
        object-fit: cover;
        margin-left: 12px;
        cursor: pointer;
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .profile-img:hover {
        transform: scale(1.05);
        border-color: var(--rose-gold);
    }

    .dropdown-menu {
        margin-top: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 8px 0;
    }

    .dropdown-item {
        padding: 8px 20px;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: var(--light-grey);
        color: var(--rose-gold);
    }

    .dropdown-item i {
        margin-right: 10px;
        color: #6c757d;
        transition: color 0.2s ease;
    }

    .dropdown-item:hover i {
        color: var(--rose-gold);
    }

    .dropdown-divider {
        margin: 5px 0;
        opacity: 0.2;
    }

    /* Search input styling */
    #searchInput {
        border: none;
        border-bottom: 1px solid var(--light-grey);
        border-radius: 0;
        padding: 5px 10px;
        width: 0;
        opacity: 0;
        transition: all 0.3s ease;
    }

    #searchInput:focus {
        outline: none;
        box-shadow: none;
        border-bottom-color: var(--rose-gold);
    }

    #searchInput.active {
        width: 150px;
        opacity: 1;
    }

    #searchIcon {
        background: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
    }

    /* Animation */
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

    /* Responsive styles */
    @media (max-width: 991px) {
        .navbar-brand {
            position: relative !important;
            transform: translateX(0) !important;
            left: 0 !important;
        }

        .navbar-collapse {
            margin-top: 15px;
        }

        .navbar-icons {
            margin-top: 10px;
            justify-content: center;
        }

        #searchInput.active {
            width: 100%;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand fw-bold mx-auto text-center d-lg-none" href="{{route('index')}}">Blossom</a>

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
                    <a class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}" href="{{ route('vendor.dashboard') }}">Dashboard</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('become.a.seller') ? 'active' : '' }}" href="{{ route('become.a.seller') }}">Become a seller</a>
                </li>
                @endif
            </ul>
        </div>

        <a class="navbar-brand fw-bold mx-auto text-center d-none d-lg-block" href="{{route('index')}}" style="transform: translateX(-50%); left: 50%; position: absolute;">Blossom</a>

        <div class="d-flex align-items-center ms-auto navbar-icons">
            <!-- Search Icon -->
            <form action="{{ route('shop') }}" id="searchForm" class="d-flex align-items-center">
                <button type="button" id="searchIcon" class="btn">
                    <i class="bi bi-search"></i>
                </button>
                <input type="text" name="search" id="searchInput" class="form-control" placeholder="Search...">
            </form>

            <!-- Wishlist Icon -->
            <a href="{{ route('wishlist') }}" class="icon-link" title="Wishlist">
                <i class="bi bi-heart"></i>
                @if(Auth::check() && Auth::user()->wishlists->count() > 0)
                <span class="badge-counter">{{ Auth::user()->wishlists->count() }}</span>
                @endif
            </a>

            <!-- Cart Icon -->
            <a href="{{ route('cart.getCarts') }}" class="icon-link" title="Cart">
                <i class="bi bi-bag"></i>
                @if(Auth::check() && isset($carts) && $carts->count() > 0)
                <span class="badge-counter">{{ $carts->count() }}</span>
                @endif
            </a>

            <!-- User Profile -->
            @if(Auth::check())
            <div class="dropdown">
                <img src="{{ Auth::user()->profile_img ? asset('storage/users/' . Auth::user()->profile_img) : asset('assets/images/default_user.jpg') }}"
                    alt="Profile Image"
                    class="profile-img"
                    id="profileDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="bi bi-person"></i> My Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.password.change') }}"><i class="bi bi-key"></i> Change Password</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.order') }}"><i class="bi bi-receipt"></i> My Orders</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-clock-history"></i> History</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @else
            <a href="{{ route('login') }}" class="icon-link" title="Login">
                <i class="bi bi-person"></i>
            </a>
            @endif
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchIcon = document.getElementById('searchIcon');
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');

        // Toggle search input visibility
        searchIcon.addEventListener('click', function() {
            searchInput.classList.toggle('active');
            if (searchInput.classList.contains('active')) {
                searchInput.focus();
            }
        });

        // Submit form when pressing Enter
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchForm.submit();
            }
        });

        // Close search on click outside
        document.addEventListener('click', function(e) {
            if (!searchForm.contains(e.target) && searchInput.classList.contains('active')) {
                searchInput.classList.remove('active');
            }
        });
    });
</script>