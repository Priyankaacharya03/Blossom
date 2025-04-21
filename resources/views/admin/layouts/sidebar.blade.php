<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('index') }}" class="app-brand-link">

            <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ env('APP_NAME') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active':'' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item {{ request()->routeIs('admin.product*')? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Products">Products</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.product.index')? 'active' : ''}}">
                    <a href="{{ route('admin.product.index') }}" class="menu-link">
                        <div data-i18n="Products">Products</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.product.create')? 'active' : ''}}">
                    <a href="{{ route('admin.product.create') }}" class="menu-link">
                        <div data-i18n="Add Product">Add Product</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.category*')? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Category</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.product.category.index')? 'active' : ''}}">
                    <a href="{{ route('admin.product-category.index') }}" class="menu-link">
                        <div data-i18n="Product Category">Category</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.product.subcategory.index')? 'active' : ''}}">
                    <a href="{{ route('admin.product-subcategory.index') }}" class="menu-link">
                        <div data-i18n="Product Subcategory">Subcategory</div>
                    </a>
                </li>

            </ul>
        </li>




        <li class="menu-item {{ request()->routeIs('admin.user*')? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.user.index')? 'active open' : ''}}">
                    <a href="{{ route('admin.user.index') }}" class="menu-link">
                        <div data-i18n="Account">User List</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.user.create')? 'active open' : ''}}">
                    <a href="{{ route('admin.user.create') }}" class="menu-link">
                        <div data-i18n="Notifications">Create User</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Vendors">Vendors</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.vendor.request') }}" class="menu-link">
                        <div data-i18n="Basic">Request</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.vendor.index') }}" class="menu-link">
                        <div data-i18n="Basic">Vendors</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.order*')? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Orders</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.order.index')? 'active open' : ''}}">
                    <a href="{{ route('admin.order.index') }}" class="menu-link">
                        <div data-i18n="Account">Order</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.carousel') ? 'active':'' }}">
            <a href="{{ route('admin.carousel.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Carousels</div>
            </a>
        </li>
    </ul>
</aside>