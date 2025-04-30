<style>
    .content {
        background-color: rgba(157, 157, 159, 0.1);
        display: flex;
        justify-content: flex-end;
        align-items: center;
        width: 100%;
    }

    .profile-img {
        height: 40px;
        width: 40px;
        border: 2px solid #ddd;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer;
    }

    .dropdown-menu {
        margin-top: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        padding: 10px 20px;
        font-size: 14px;
        transition: background-color 0.3s ease;
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

    .dropdown-item .d-flex {
        display: flex;
        align-items: center;
    }

    .avatar {
        margin-right: 15px;
    }

    .flex-grow-1 {
        flex-grow: 1;
    }

    .fw-semibold {
        font-weight: 600;
    }

    .text-muted {
        color: #6c757d;
    }

    .navbar-dropdown {
        display: flex;
        align-items: center;
    }

    .avatar img {
        border-radius: 50%;
        object-fit: cover;
        width: 40px;
        height: 40px;
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
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <img src="{{ Auth::user()->profile_img ? asset('storage/users/' . Auth::user()->profile_img) : asset('assets/images/default_user.jpg') }}"
                                        alt="Profile Image" class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                <small class="text-muted">Admin</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <i class="bi bi-person me-2"></i>
                        My Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('user.password.change') }}"><i class="bi bi-key"></i> Change Password</a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        Settings
                    </a>
                </li>
                <li>
                    <a class="dropdown-item text-danger" href="#">
                        <i class="bi bi-box-arrow-right"></i>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-decoration-none p-0" title="Logout">
                                Logout
                            </button>
                        </form>
                    </a>
                </li>
            </ul>
        </div>
        @endif
    </nav>
</div>