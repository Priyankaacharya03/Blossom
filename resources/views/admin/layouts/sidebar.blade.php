<style>
    :root {
        --sidebar-bg: rgb(255, 255, 255);
        --sidebar-hover: rgba(0, 0, 0, 0.05);
        --sidebar-active: rgba(172, 172, 173, 0.1);
        --sidebar-active-color: #4a4a4a;
        --sidebar-width: 250px;
        --sidebar-collapsed-width: 70px;
        --header-height: 60px;
        --sidebar-text: #5a5a5a;
        --sidebar-icon: #6c757d;
        --sidebar-border: rgba(0, 0, 0, 0.05);
    }

    /* Sidebar Styles */
    .sidebar {
        background-color: var(--sidebar-bg);
        color: var(--sidebar-text);
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1030;
        transition: all 0.3s ease;
        overflow-y: auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        border-right: 1px solid var(--sidebar-border);
    }

    .sidebar.collapsed {
        width: var(--sidebar-collapsed-width);
    }

    .sidebar-brand {
        height: var(--header-height);
        display: flex;
        align-items: center;
        padding: 0 1.5rem;
        border-bottom: 1px solid var(--sidebar-border);
        background-color: white;
    }

    .sidebar-brand h4 {
        transition: opacity 0.3s;
        white-space: nowrap;
        color: #333;
        font-weight: 600;
    }

    .sidebar.collapsed .sidebar-brand h4 {
        opacity: 0;
    }

    .sidebar-menu {
        padding: 1rem 0;
    }

    .sidebar-item {
        position: relative;
        margin-bottom: 0.25rem;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        color: var(--sidebar-text);
        text-decoration: none;
        transition: all 0.15s ease;
        white-space: nowrap;
        border-radius: 0.25rem;
        margin: 0 0.5rem;
    }

    .sidebar-link:hover {
        background-color: var(--sidebar-hover);
        color: #333;
    }

    .sidebar-link.active {
        background-color: var(--sidebar-active);
        color: var(--sidebar-active-color);
        font-weight: 500;
    }

    .sidebar-link i {
        margin-right: 0.75rem;
        font-size: 1.1rem;
        width: 1.5rem;
        text-align: center;
        color: var(--sidebar-icon);
    }

    .sidebar-link.active i {
        color: var(--sidebar-active-color);
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
        margin-bottom: 0.25rem;
    }

    /* Toggle icon animation */
    .toggle-icon {
        transition: transform 0.3s ease;
    }

    .sidebar-link[aria-expanded="true"] .toggle-icon {
        transform: rotate(180deg);
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


<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <h4 class="m-0">{{ env('APP_NAME') }}</h4>
        <button class="sidebar-toggle ms-auto d-lg-none" id="closeSidebar">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="sidebar-menu">
        <!-- Dashboard -->
        <div class="sidebar-item">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span class="link-text">Dashboard</span>
            </a>
        </div>

        <!-- Products -->
        <div class="sidebar-item">
            <a href="#productsMenu" class="sidebar-link {{ request()->routeIs('admin.product*') ? 'active' : '' }}"
                data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs('admin.product*') ? 'true' : 'false' }}">
                <i class="bi bi-box"></i>
                <span class="link-text">Products</span>
                <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
            </a>
            <div class="submenu collapse {{ request()->routeIs('admin.product*') ? 'show' : '' }}" id="productsMenu">
                <a href="{{ route('admin.product.index') }}" class="sidebar-link {{ request()->routeIs('admin.product.index') ? 'active' : '' }}">
                    Products
                </a>
                <a href="{{ route('admin.product.create') }}" class="sidebar-link {{ request()->routeIs('admin.product.create') ? 'active' : '' }}">
                    Add Product
                </a>
            </div>
        </div>

        <!-- Categories -->
        <div class="sidebar-item">
            <a href="#categoryMenu" class="sidebar-link {{ request()->routeIs('admin.category*') ? 'active' : '' }}"
                data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs('admin.category*') ? 'true' : 'false' }}">
                <i class="bi bi-grid"></i>
                <span class="link-text">Category</span>
                <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
            </a>
            <div class="submenu collapse {{ request()->routeIs('admin.category*') ? 'show' : '' }}" id="categoryMenu">
                <a href="{{ route('admin.product-category.index') }}" class="sidebar-link {{ request()->routeIs('admin.product.category.index') ? 'active' : '' }}">
                    Category
                </a>
                <a href="{{ route('admin.product-subcategory.index') }}" class="sidebar-link {{ request()->routeIs('admin.product.subcategory.index') ? 'active' : '' }}">
                    Subcategory
                </a>
            </div>
        </div>

        <!-- Users -->
        <div class="sidebar-item">
            <a href="#usersMenu" class="sidebar-link {{ request()->routeIs('admin.user*') ? 'active' : '' }}"
                data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs('admin.user*') ? 'true' : 'false' }}">
                <i class="bi bi-people"></i>
                <span class="link-text">Users</span>
                <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
            </a>
            <div class="submenu collapse {{ request()->routeIs('admin.user*') ? 'show' : '' }}" id="usersMenu">
                <a href="{{ route('admin.user.index') }}" class="sidebar-link {{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                    User List
                </a>
                <a href="{{ route('admin.user.create') }}" class="sidebar-link {{ request()->routeIs('admin.user.create') ? 'active' : '' }}">
                    Create User
                </a>
            </div>
        </div>

        <!-- Vendors -->
        <div class="sidebar-item">
            <a href="#vendorsMenu" class="sidebar-link {{ request()->routeIs('admin.vendor*') ? 'active' : '' }}"
                data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs('admin.vendor*') ? 'true' : 'false' }}">
                <i class="bi bi-shop"></i>
                <span class="link-text">Vendors</span>
                <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
            </a>
            <div class="submenu collapse {{ request()->routeIs('admin.vendor*') ? 'show' : '' }}" id="vendorsMenu">
                <a href="{{ route('admin.vendor.request') }}" class="sidebar-link {{ request()->routeIs('admin.vendor.request') ? 'active' : '' }}">
                    Request
                </a>
                <a href="{{ route('admin.vendor.index') }}" class="sidebar-link {{ request()->routeIs('admin.vendor.index') ? 'active' : '' }}">
                    Vendors
                </a>
            </div>
        </div>

        <!-- Orders -->
        <div class="sidebar-item">
            <a href="#ordersMenu" class="sidebar-link {{ request()->routeIs('admin.order*') ? 'active' : '' }}"
                data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs('admin.order*') ? 'true' : 'false' }}">
                <i class="bi bi-cart"></i>
                <span class="link-text">Orders</span>
                <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
            </a>
            <div class="submenu collapse {{ request()->routeIs('admin.order*') ? 'show' : '' }}" id="ordersMenu">
                <a href="{{ route('admin.order.index') }}" class="sidebar-link {{ request()->routeIs('admin.order.index') ? 'active' : '' }}">
                    Order
                </a>
            </div>
        </div>

        <!-- Carousels -->
        <div class="sidebar-item">
            <a href="{{ route('admin.carousel.index') }}" class="sidebar-link {{ request()->routeIs('admin.carousel') ? 'active' : '' }}">
                <i class="bi bi-images"></i>
                <span class="link-text">Carousels</span>
            </a>
        </div>

        <!-- Settings -->
        <div class="sidebar-item">
            <a href="{{ route('admin.setting') }}" class="sidebar-link {{ request()->routeIs('admin.setting') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                <span class="link-text">Setting</span>
            </a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.querySelector('.navbar .sidebar-toggle');
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
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', toggleSidebar);
        }

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

        // Setup collapsible menus
        const collapsibleLinks = document.querySelectorAll('.sidebar-link[data-bs-toggle="collapse"]');
        collapsibleLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (isMobile()) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.classList.toggle('show');
                        this.setAttribute('aria-expanded', target.classList.contains('show'));
                    }
                }
            });
        });

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