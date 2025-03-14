@extends('layouts.admin', [])
@section('title', 'Payments')
@section('content')
    <div class="d-flex">
        <div class="pagetitle flex-grow-1">
            <h1>Payments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item">Payments</li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header filter">
                        <div class="d-flex flex-row-reverse">
                            <div class="p-2"><button class="form-control btn btn-sm btn-info"
                                    data-action="new-student"><i class="bi bi-plus"></i>&nbsp;New Payment</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12 table-mobile-scroll">
                            <table id="booking-list-datatable"
                                class="datatable table table-lg table-hover table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Student</th>
                                        <th>Course</th>
                                        <th>Paid Amount</th>
                                        <th>Payment Date</th>
                                    </tr>
                                    @foreach ($payments as $key => $payment)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $payment->student->name }}</td>
                                            <td>{{ $payment->course->name }}</td>
                                            <td>{{ $payment->amount_paid }}</td>
                                            <td>{{ $payment->date_of_payment }}</td>
                                    @endforeach
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('popups.payment-new-popup')
@endsection
@push('head-assets')
    <link rel="stylesheet" href="{{ asset('assets/user/css/flatpickr.min.css?v=') . config('version.css_user') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/user/css/tom-select.bootstrap5.min.css?v=') . config('version.css_user') }}" />
@endpush
@push('footer-assets')
    <script src="{{ asset('assets/user/js/flatpickr.js?v=') . config('version.js_user') }}"></script>
    <script src="{{ asset('assets/user/js/tom-select.complete.js?v=') . config('version.js_user') }}"></script>
    <script src="{{ asset('assets/user/js/payments.js?v=') . config('version.js_user') }}"></script>
@endpush
