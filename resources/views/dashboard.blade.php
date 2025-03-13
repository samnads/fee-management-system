@extends('layouts.admin', [])
@section('title', 'Dashboard')
@section('content')
    <div class="pagetitle">
        <h1>Booking Report</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <form class="g-3" id="new-booking" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-lg-12" id="customer-top">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Filter</h5>
                            <!-- Horizontal Form -->
                            <div class="row g-3">
                                <div class="col-md-2 col-sm-4">
                                    <label class="form-label">Date
                                        <rf />
                                    </label>
                                    <input type="text" class="form-control pickup_date" name="date" autocomplete="off"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label">Show Time
                                        <rf />
                                    </label>
                                    <select class="form-select" name="time">
                                        <option value="10:00:00" selected>10:00 AM</option>
                                        <option value="03:00:00">03:00 PM</option>
                                        <option value="09:00:00">09:00 PM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12 fs-4">
                                Seats Available : <span id="available" class="text-success fw-bold">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ro">
                    <div class="col-lg-12">
                        <div class="card pt-2">
                            <div class="card-body">
                                <table id="customer-list-datatable"
                                    class="datatable table table-sm table-hover table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sl. No.</th>
                                            <th>User</th>
                                            <th>No. of Seats Booked</th>
                                        </tr>
                                    </thead>
                                    <tbody id="report">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </section>
@endsection
@push('head-assets')
    <link rel="stylesheet" href="{{ asset('assets/user/css/flatpickr.min.css?v=') . config('version.css_user') }}">
@endpush
@push('footer-assets')
    <script src="{{ asset('assets/user/js/flatpickr.js?v=') . config('version.js_user') }}"></script>
    <script src="{{ asset('assets/user/js/admin.home.js?v=') . config('version.js_user') }}"></script>
@endpush