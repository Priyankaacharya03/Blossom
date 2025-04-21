<style>
    .content {
        display: flex;
        justify-content: flex-end;
        /* Align items to the right */
        align-items: center;
        /* Vertically align items */
        width: 100%;
        /* Ensure the content takes up full width */
    }

    .profile-img {
        height: 35px;
        width: 35px;
        border: 1px solid #ccc;
        border-radius: 50%;
        object-fit: cover;
        margin-left: 10px;
        /* Add space between the image and other items */
        cursor: pointer;
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

<!-- Content -->
<div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light px-3">
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
        @endif
    </nav>
</div>