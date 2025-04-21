<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <h4 class="m-0">Blossom</h4>
        <button class="sidebar-toggle ms-auto d-lg-none" id="closeSidebar">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="sidebar-menu">
        <!-- Dashboard -->
        <div class="sidebar-item">
            <a href="{{ route('vendor.dashboard') }}" class="sidebar-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span class="link-text">Dashboard</span>
            </a>
        </div>

        <!-- Products -->
        <div class="sidebar-item">
            <a href="#productsMenu" class="sidebar-link {{ request()->routeIs('vendor.product*') ? 'active' : '' }}"
                data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs('vendor.product*') ? 'true' : 'false' }}">
                <i class="bi bi-box"></i>
                <span class="link-text">Products</span>
                <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
            </a>
            <div class="submenu collapse {{ request()->routeIs('vendor.product*') ? 'show' : '' }}" id="productsMenu">
                <a href="{{ route('vendor.product.index') }}" class="sidebar-link {{ request()->routeIs('vendor.product.index') ? 'active' : '' }}">
                    Product List
                </a>
                <a href="{{ route('vendor.product.create') }}" class="sidebar-link {{ request()->routeIs('vendor.product.create') ? 'active' : '' }}">
                    Add Product
                </a>
            </div>
        </div>


        <!-- Orders -->
        <div class="sidebar-item">
            <a href="{{ route('vendor.order.index') }}" class="sidebar-link {{ request()->routeIs('vendor.order*') ? 'active' : '' }}">
                <i class="bi bi-cart"></i>
                <span class="link-text">Orders</span>
            </a>
        </div>

        <!-- Home -->
        <div class="sidebar-item">
            <a href="{{ route('index') }}" class="sidebar-link {{ request()->routeIs('index') ? 'active' : '' }}">
                <i class="bi bi-house"></i>
                <span class="link-text">Home</span>
            </a>
        </div>
    </div>
</nav>

<style>
    :root {
        --sidebar-bg: rgb(101, 101, 101);
        --sidebar-hover: rgba(255, 255, 255, 0.1);
        --sidebar-active: rgba(255, 255, 255, 0.2);
        --sidebar-width: 250px;
        --sidebar-collapsed-width: 70px;
        --header-height: 60px;
    }

    /* Sidebar Styles */
    .sidebar {
        background-color: var(--sidebar-bg);
        color: white;
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1030;
        transition: all 0.3s ease;
        overflow-y: auto;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .sidebar.collapsed {
        width: var(--sidebar-collapsed-width);
    }

    .sidebar-brand {
        height: var(--header-height);
        display: flex;
        align-items: center;
        padding: 0 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-brand h4 {
        transition: opacity 0.3s;
        white-space: nowrap;
    }

    .sidebar.collapsed .sidebar-brand h4 {
        opacity: 0;
    }

    .sidebar-menu {
        padding: 1rem 0;
    }

    .sidebar-item {
        position: relative;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s;
        white-space: nowrap;
    }

    .sidebar-link:hover {
        background-color: var(--sidebar-hover);
        color: white;
    }

    .sidebar-link.active {
        /* background-color: var(--sidebar-active); */
        color: white;
        font-weight: 500;
    }

    .sidebar-link i {
        margin-right: 0.75rem;
        font-size: 1.1rem;
        width: 1.5rem;
        text-align: center;
    }

    .sidebar-link .link-text {
        transition: opacity 0.3s;
    }

    .sidebar.collapsed .sidebar-link .link-text,
    .sidebar.collapsed .sidebar-link .toggle-icon,
    .sidebar.collapsed .submenu {
        display: none;
    }

    .submenu {
        padding-left: 3.25rem;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .submenu.show {
        max-height: 500px;
    }

    .submenu .sidebar-link {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    /* Overlay for mobile */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1025;
        display: none;
    }

    .sidebar-overlay.show {
        display: block;
    }

    /* Toggle Button */
    .sidebar-toggle {
        background: transparent;
        border: none;
        color: #555;
        font-size: 1.25rem;
        cursor: pointer;
        padding: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
            width: var(--sidebar-width);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        body {
            padding-left: 0 !important;
        }
    }

    /* Adjust main content based on sidebar state */
    body {
        padding-left: var(--sidebar-width);
        transition: padding 0.3s ease;
    }

    body.sidebar-collapsed {
        padding-left: var(--sidebar-collapsed-width);
    }

    @media (max-width: 991.98px) {
        body {
            padding-left: 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.querySelector('.navbar .btn');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const body = document.body;

        // Function to check if we're on mobile
        function isMobile() {
            return window.innerWidth < 992;
        }

        // Initialize sidebar state based on screen size
        function initSidebar() {
            if (isMobile()) {
                sidebar.classList.remove('show');
                body.classList.remove('sidebar-collapsed');
            } else {
                sidebar.classList.remove('collapsed');
                body.classList.remove('sidebar-collapsed');
            }
        }

        // Toggle sidebar
        function toggleSidebar() {
            if (isMobile()) {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                body.classList.toggle('sidebar-collapsed');
            }
        }

        // Override the existing toggleSidebar function
        window.toggleSidebar = toggleSidebar;

        // Event listeners
        if (closeSidebar) {
            closeSidebar.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (!isMobile()) {
                sidebarOverlay.classList.remove('show');
                if (sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    sidebar.classList.remove('collapsed');
                    body.classList.remove('sidebar-collapsed');
                }
            } else {
                sidebar.classList.remove('collapsed');
                body.classList.remove('sidebar-collapsed');
            }
        });

        // Initialize
        initSidebar();
    });
</script>