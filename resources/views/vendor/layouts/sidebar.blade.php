<style>
    .sidebar {
        width: 320px;
        min-height: 100vh;
        background-color: #f8f9fa;
        transition: transform 0.3s ease;
    }

    .sidebar.collapsed {
        transform: translateX(-100%);
    }

    .sidebar .nav-link.active {
        background-color: #e9ecef;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .sidebar {
            position: absolute;
            z-index: 1030;
        }
    }

    .content {
        flex-grow: 1;
    }
</style>


<!-- Sidebar -->
<nav class="sidebar p-3" id="sidebar">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0">Blossom</h4>
        <button class="btn btn-sm d-md-none" onclick="toggleSidebar()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('vendor.dashboard') }}" class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.product*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#productsMenu" role="button" aria-expanded="false">
                <i class="bi bi-box me-2"></i> Products
            </a>
            <div class="collapse {{ request()->routeIs('vendor.product*') ? 'show' : '' }}" id="productsMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a href="{{ route('vendor.product.index') }}" class="nav-link {{ request()->routeIs('vendor.product.index') ? 'active' : '' }}">Product List</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('vendor.product.create') }}" class="nav-link {{ request()->routeIs('vendor.product.create') ? 'active' : '' }}">Add Product</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.user*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#usersMenu" role="button" aria-expanded="false">
                <i class="bi bi-people me-2"></i> Users
            </a>
            <div class="collapse {{ request()->routeIs('vendor.user*') ? 'show' : '' }}" id="usersMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.index') ? 'active' : '' }}">User List</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a href="{{ route('index') }}" class="nav-link ">
                <i class="bi bi-house-door me-2"></i> Home
            </a>
        </li>
    </ul>
</nav>