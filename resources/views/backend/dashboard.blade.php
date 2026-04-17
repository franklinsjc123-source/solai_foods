@extends('backend.app_template')
@section('title','Dashboard')
@section('content')

<style>
.chart-box {
    position: relative;
    height: 350px;   /* same height */
    width: 100%;
}
</style>


<main class="app-wrapper">
    <div class="container-fluid">



        <?php if (Auth::user()->auth_level == 4) { ?>
            <!-- Section for Shop/Delivery Admins -->
            <div class="row mt-5">
                <div class="col-md-6 col-xl-4 col-xxl-4">
                    <div class="card card-h-100 webGradient text-white">
                        <a href="{{ route('orders') }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between gap-5 mb-5">
                                    <div>
                                        <h4 class="text-white mb-1">Total Orders</h4>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="h-48px w-48px bg-white fs-5 rounded d-flex justify-content-center align-items-center text-black fw-semibold">{{ $order_count ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 col-xxl-4">
                    <div class="card card-h-100 IntelligenceGradient text-white">
                        <a href="{{ route('orders') }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between gap-5 mb-5">
                                    <div>
                                        <h4 class="text-white mb-1">Today Orders</h4>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="h-48px w-48px bg-white fs-5 rounded d-flex justify-content-center align-items-center text-black fw-semibold">{{ $today_order_count ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 col-xxl-4">
                    <div class="card card-h-100 datascienceGradient text-white">
                        <a href="{{ route('product') }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between gap-5 mb-5">
                                    <div>
                                        <h4 class="text-white mb-1">Total Products</h4>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="h-48px w-48px bg-white fs-5 rounded d-flex justify-content-center align-items-center text-black fw-semibold">{{ $product_count ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        <?php } else { ?>
            <!-- Section for Super Admins -->
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card card-h-100 webGradient text-white">
                        <a href="{{ route('orders') }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between gap-5 mb-5">
                                    <div><h4 class="text-white mb-1">Total Orders</h4></div>
                                    <div class="flex-shrink-0">
                                        <div class="h-48px w-48px bg-white fs-5 rounded d-flex justify-content-center align-items-center text-black fw-semibold">{{ $order_count ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-h-100 IntelligenceGradient text-white">
                        <a href="{{ route('orders') }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between gap-5 mb-5">
                                    <div><h4 class="text-white mb-1">Today Orders</h4></div>
                                    <div class="flex-shrink-0">
                                        <div class="h-48px w-48px bg-white fs-5 rounded d-flex justify-content-center align-items-center text-black fw-semibold">{{ $today_order_count ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-h-100 datascienceGradient text-white">
                        <a href="{{ route('product') }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between gap-5 mb-5">
                                    <div><h4 class="text-white mb-1">Total Products</h4></div>
                                    <div class="flex-shrink-0">
                                        <div class="h-48px w-48px bg-white fs-5 rounded d-flex justify-content-center align-items-center text-black fw-semibold">{{ $product_count ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card card-h-100 webGradient text-white">
                        <a href="{{ route('customers') }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between gap-5 mb-5">
                                    <div><h4 class="text-white mb-1">Total Customers</h4></div>
                                    <div class="flex-shrink-0">
                                        <div class="h-48px w-48px bg-white fs-5 rounded d-flex justify-content-center align-items-center text-black fw-semibold">{{ $customer_count ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-h-100 IntelligenceGradient text-white">
                        <a href="{{ route('deliveryPerson') }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between gap-5 mb-5">
                                    <div><h4 class="text-white mb-1">Delivery Persons</h4></div>
                                    <div class="flex-shrink-0">
                                        <div class="h-48px w-48px bg-white fs-5 rounded d-flex justify-content-center align-items-center text-black fw-semibold">{{ $delivert_person_count ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-h-100 datascienceGradient text-white">
                        <a href="{{ route('category') }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between gap-5 mb-5">
                                    <div><h4 class="text-white mb-1">Total Categories</h4></div>
                                    <div class="flex-shrink-0">
                                        <div class="h-48px w-48px bg-white fs-5 rounded d-flex justify-content-center align-items-center text-black fw-semibold">{{ $category_count ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>

     




    
            <div class="row mt-4">
                <div class="col-xl-6">
                    <div class="card h-100">
                        <div class="card-header border-0 pb-0">
                            <h5 class="mb-0">Orders vs Month</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-box">
                                <canvas id="monthlyOrdersBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card h-100">
                        <div class="card-header border-0 pb-0">
                            <h5 class="mb-0">Products vs Category</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-box">
                                <canvas id="categoryPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      




    </div><!--End container-fluid-->
</main>
<!--End app-wrapper-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // 📊 Monthly Orders Bar Chart
const barCtx = document.getElementById('monthlyOrdersBarChart').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($monthLabels) !!},
        datasets: [{
            label: 'Orders',
            data: {!! json_encode($monthlyOrderData) !!},
            backgroundColor: '#6f42c1',
            borderRadius: 5,
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
                ticks: {
                    precision: 0
                }
            }
        }
    }
});

var ctx = document.getElementById('categoryPieChart').getContext('2d');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: {!! json_encode($categoryLabels) !!},
        datasets: [{
            data: {!! json_encode($productCounts) !!},
            backgroundColor: [
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#4BC0C0',
                '#9966FF',
                '#FF9F40'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,   // 👈 important
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {

                        var shopCounts = {!! json_encode($shopCounts) !!};
                        var productCounts = {!! json_encode($productCounts) !!};

                        var index = context.dataIndex;

                        return [
                            "Products: " + productCounts[index]
                        ];
                    }
                }
            },
            legend: {
                position: 'right'   // 👈 vertical legend
            }
        }
    }
});




</script>
@endsection
