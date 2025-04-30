@extends('vendor.layouts.main')

@section('title','Vendor Dashboard')

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-12 px-md-4 py-4">
            <!-- Welcome Banner -->
            <div class="card border-0 text-white mb-4 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="row">
                        <div class="col-lg-8 text-dark">
                            <h2 class="fw-bold mb-2">Welcome back, {{ $vendor->name }}!</h2>
                            <p class="mb-4 opacity-75">Here's what's happening with your store today.</p>
                            <a href="{{ route('vendor.product.create') }}" class="btn btn-light">Add New Product</a>
                        </div>
                    </div>
                    <!-- <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(15%, -15%);">
                        <i class="bi bi-shop" style="font-size: 180px;"></i>
                    </div> -->
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <!-- Total Products Card -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted small mb-1">Total Products</p>
                                    <h3 class="fw-bold mb-0">{{ number_format($totalProducts) }}</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-box fs-4 text-white"></i>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="small mb-0">Out of Stock</p>
                                    <h6>{{ number_format($outOfStockProducts) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Orders Card -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted small mb-1">Total Orders</p>
                                    <h3 class="fw-bold mb-0">{{ number_format($totalOrders) }}</h3>

                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-cart fs-4 text-white"></i>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="small mb-0">Pending</p>
                                    <h6>{{ number_format($pendingOrders) }}</h6>
                                </div>
                                <div>
                                    <p class="small mb-0">Completed</p>
                                    <h6>{{ number_format($completedOrders) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue Card -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted small mb-1">Total Revenue</p>
                                    <h3 class="fw-bold mb-0">RS {{ number_format($totalRevenue, 2) }}</h3>

                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-currency-dollar fs-4 text-white"></i>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="small mb-0">This Month</p>
                                    <h6>${{ number_format($currentMonthRevenue, 2) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <!-- Charts Section -->
            <div class="row g-4 mb-4">
                <!-- Sales Overview -->
                <div class="col-12 col-lg-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Sales Overview</h5>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary active">Weekly</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Monthly</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Yearly</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- <canvas id="salesChart" height="250"></canvas> -->
                        </div>
                    </div>
                </div>

                <!-- Top Products -->
                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0">
                            <h5 class="card-title mb-0">Top Products</h5>
                        </div>
                        <div class="card-body">
                            <!-- <canvas id="productsChart" height="250"></canvas> -->
                        </div>
                    </div>
                </div>
            </div>
            --}}

            <!-- Recent Orders -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Recent Orders</h5>
                    <a href="{{ route('vendor.order.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('storage/'.$order->product->primary_image)}}" class="rounded me-2" width="40" height="40" alt="{{ $order->product->product_name }}">
                                            <div class="text-truncate" style="max-width: 150px;">
                                                {{ $order->product->product_name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $order->order->user?->name }}</td>
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
                                        <span class="badge bg-secondary">{{ ucfirst($order->order->order_status) }}</span>
                                        @endif
                                    </td>
                                    <td>RS {{ number_format($order->price, 2) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light" type="button" id="dropdownMenuButton{{ $order->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $order->id }}">
                                                <li><a class="dropdown-item" href="{{ route('vendor.order.items', $order->id) }}">View Details</a></li>
                                                <li><a class="dropdown-item" href="">Update Status</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">No recent orders found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Inventory Alert -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0">Low Stock Alert</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lowStockProducts as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $product->thumbnail }}" class="rounded me-2" width="40" height="40" alt="{{ $product->name }}">
                                            <div class="text-truncate" style="max-width: 150px;">
                                                {{ $product->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <span class="badge bg-danger">{{ $product->stock }} left</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('vendor.product.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">Update Stock</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No low stock products found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles */
    body {
        background-color: #f8f9fa;
    }

    .sidebar {
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        padding: 0;
    }

    .sidebar .nav-link {
        color: #6c757d;
        font-weight: 500;
        padding: .75rem 1rem;
        border-radius: .25rem;
        margin: 0 0.5rem 0.25rem 0.5rem;
    }

    .sidebar .nav-link:hover {
        color: #212529;
        background-color: #f8f9fa;
    }

    .sidebar .nav-link.active {
        color: #fff;
        background-color: #0d6efd;
    }

    .sidebar .nav-link.active:hover {
        color: #fff;
    }

    .sidebar .nav-link i {
        color: inherit;
    }

    .sidebar-heading {
        font-size: .75rem;
        text-transform: uppercase;
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

    /* Card hover effect */
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sales Chart - Weekly Data (Static)
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Orders',
                    data: [12, 19, 15, 22, 18, 25, 30],
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#0d6efd',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 6,
                    pointHoverBorderWidth: 2
                }, {
                    label: 'Revenue ($)',
                    data: [450, 720, 600, 890, 750, 1050, 1250],
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#198754',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 6,
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#2a3042',
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 12
                        },
                        padding: 12,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.datasetIndex === 1) {
                                    label += '$' + context.raw;
                                } else {
                                    label += context.raw;
                                }
                                return label;
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                if (value >= 1000) {
                                    return '$' + value / 1000 + 'k';
                                }
                                return '$' + value;
                            }
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

        // Products Chart - Top Products (Static)
        const productsCtx = document.getElementById('productsChart').getContext('2d');
        const productsChart = new Chart(productsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Wireless Earbuds', 'Smart Watch', 'Bluetooth Speaker', 'Power Bank', 'Phone Case'],
                datasets: [{
                    data: [35, 25, 20, 15, 5],
                    backgroundColor: [
                        '#0d6efd',
                        '#6f42c1',
                        '#fd7e14',
                        '#20c997',
                        '#6c757d'
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#2a3042',
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 12
                        },
                        padding: 12,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} sales (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '70%',
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });

        // Chart button switching (for demo purposes)
        document.querySelectorAll('.btn-group .btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.btn-group .btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                // In a real implementation, you would update the chart data here
                // based on the selected time period (weekly, monthly, yearly)
            });
        });
    });
</script>
@endsection