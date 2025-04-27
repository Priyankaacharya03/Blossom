@extends('admin.layouts.main')

@section('title','Admin Dashboard')


@section('main-content')
<div class="container-fluid">
    <div class="row">

        <!-- Main Content -->
        <main class="col-md-12 ms-sm-auto px-md-4">
            <!-- Top Navigation -->

            <div class="mb-4">
                <p class="text-muted">Welcome back! Here's what's happening with your store today.</p>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <!-- Total Users Card -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-muted small mb-1">Total Users</p>
                                    <h3 class="fw-bold">{{ number_format($totalUsers) }}</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-people fs-4 text-primary"></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <span class="badge bg-success d-flex align-items-center">
                                    <i class="bi bi-arrow-up me-1"></i> 12%
                                </span>
                                <span class="text-muted ms-2 small">Since last month</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Orders Card -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-muted small mb-1">Total Orders</p>
                                    <h3 class="fw-bold">{{ number_format($totalOrders) }}</h3>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-cart fs-4 text-warning"></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <span class="badge bg-success d-flex align-items-center">
                                    <i class="bi bi-arrow-up me-1"></i> 8%
                                </span>
                                <span class="text-muted ms-2 small">Since last month</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Vendors Card -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-muted small mb-1">Total Vendors</p>
                                    <h3 class="fw-bold">{{ number_format($totalVendors) }}</h3>
                                </div>
                                <div class="bg-purple bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-shop fs-4 text-purple"></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <span class="badge bg-danger d-flex align-items-center">
                                    <i class="bi bi-arrow-down me-1"></i> 3%
                                </span>
                                <span class="text-muted ms-2 small">Since last month</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue Card -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-muted small mb-1">Total Revenue</p>
                                    <h3 class="fw-bold">${{ number_format($totalRevenue) }}</h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-currency-dollar fs-4 text-success"></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <span class="badge bg-success d-flex align-items-center">
                                    <i class="bi bi-arrow-up me-1"></i> 14%
                                </span>
                                <span class="text-muted ms-2 small">Since last month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Recent Orders -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Recent Orders</h5>
                    <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>#{{ $order->order_number }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $order->user->profile_img }}" class="rounded-circle me-2" width="32" height="32" alt="{{ $order->user->name }}">
                                            <div>
                                                <h6 class="mb-0">{{ $order->user->name }}</h6>
                                                <small class="text-muted">{{ $order->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($order->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                        @elseif($order->status == 'processing')
                                        <span class="badge bg-warning text-dark">Processing</span>
                                        @elseif($order->status == 'shipped')
                                        <span class="badge bg-info">Shipped</span>
                                        @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                        @else
                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light" type="button" id="dropdownMenuButton{{ $order->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $order->id }}">
                                                <li><a class="dropdown-item" href="{{ route('admin.order.items', $order->id) }}">View Details</a></li>
                                                {{-- <li><a class="dropdown-item" href="{{ route('admin.orders.edit', $order->id) }}">Edit Order</a></li> --}}
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    {{-- ou want to delete this order?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                                    </form> --}}
                                                    Delete
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Custom styles */
    .bg-purple {
        background-color: #6f42c1;
    }

    .text-purple {
        color: #6f42c1;
    }

    /* Sidebar styles */
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    .sidebar .nav-link {
        font-weight: 500;
        padding: .75rem 1rem;
        border-radius: .25rem;
        margin-bottom: .25rem;
    }

    .sidebar .nav-link.active {
        background-color: rgba(255, 255, 255, .1);
    }

    .sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, .075);
    }

    @media (max-width: 767.98px) {
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            padding: 0;
            width: 280px !important;
            transform: translateX(-100%);
            transition: transform .3s ease-in-out;
        }

        .sidebar.show {
            transform: translateX(0);
        }
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Initialize mobile sidebar
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.querySelector('[data-bs-toggle="offcanvas"]');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                document.querySelector('#sidebar').classList.toggle('show');
            });
        }

        const closeSidebar = document.querySelector('.btn-close');
        if (closeSidebar) {
            closeSidebar.addEventListener('click', function() {
                document.querySelector('#sidebar').classList.remove('show');
            });
        }

        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales',
                    data: [65, 59, 80, 81, 56, 55, 40, 45, 60, 70, 75, 90],
                    fill: false,
                    borderColor: '#0d6efd',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'doughnut',
            data: {
                labels: ['Electronics', 'Clothing', 'Food', 'Books', 'Other'],
                datasets: [{
                    data: [30, 25, 20, 15, 10],
                    backgroundColor: [
                        '#0d6efd',
                        '#6f42c1',
                        '#fd7e14',
                        '#20c997',
                        '#6c757d'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endsection