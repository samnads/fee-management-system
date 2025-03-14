@extends('layouts.admin', [])
@section('title', 'Dashboard')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row light-colors">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card widget" id="total-sales">
                            <div class="card-body">
                                <h5 class="card-title">Revenue</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bar-chart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="sales-amount">{{ $payments->amount_paid }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Sales Card -->
                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card widget" id="revenue">
                            <div class="card-body">
                                <h5 class="card-title">Pending Fee</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cash-coin"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="sales-amount">{{ $student_courses->total_fee - $payments->amount_paid }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Revenue Card -->
                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card widget" id="bookings">
                            <div class="card-body">
                                <h5 class="card-title">Enrolled Students</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="bookings_count">{{ $enrolled->count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Customers Card -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <!-- Reports -->
                    <div class="col-md-12">
                        <div class="card widget" id="report-chart">
                            <div class="card-body">
                                <h5 class="card-title">Reports
                                </h5>
                                <!-- Line Chart -->
                                <canvas id="myChart"></canvas>
                                <!-- End Line Chart -->
                            </div>
                        </div>
                    </div><!-- End Reports -->
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
@endsection
@push('head-assets')
    <link rel="stylesheet" href="{{ asset('assets/user/css/flatpickr.min.css?v=') . config('version.css_user') }}">
@endpush
@push('footer-assets')
    <script src="{{ asset('assets/user/js/flatpickr.js?v=') . config('version.js_user') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Revenue', 'Pending Fee', 'Enrolled Students'],
                datasets: [{
                    label: '# of Votes',
                    data: [{{ $payments->amount_paid }},
                        {{ $student_courses->total_fee - $payments->amount_paid }},
                        {{ $enrolled->count }}
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
