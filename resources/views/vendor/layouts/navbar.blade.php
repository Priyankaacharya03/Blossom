<!-- Content -->
<div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <div class="d-flex align-items-center">
            <button class="btn d-md-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
        </div>
        <div class="ms-auto dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                <img src="{{ asset('backend/assets/img/avatars/1.png') }}" class="rounded-circle me-2" width="40" height="40" alt="User">
                <span class="d-none d-sm-inline">John Doe</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
        </div>
    </nav>
</div>