@extends('layouts.admin', [])
@section('title', 'Courses')
@section('content')
    <div class="d-flex">
        <div class="pagetitle flex-grow-1">
            <h1>Courses</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item">Courses</li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="pagetitle-right">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href="#" type="button" data-action="new-customer" class="btn btn-secondary"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="New Booking"><i
                            class="bi bi-plus"></i></a>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header filter">
                        <div class="row">
                            <div class="col">
                                <label class="small">Booked On</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="ri-filter-2-line"></i></span>
                                    <input class="form-control form-control-sm" name="filter[created_at]" autocomplete="off"
                                        placeholder="-- Select Date --">
                                </div>
                            </div>
                            <div class="col">
                                <label class="small">Deal Status</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="ri-filter-2-line"></i></span>
                                    <select class="form-select form-select-sm" name="filter[deal_status]"
                                        autocomplete="off">
                                        <option value="">-- Select All --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label class="small">Request Status</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="ri-filter-2-line"></i></span>
                                    <select class="form-select form-select-sm" name="filter[request_status]"
                                        autocomplete="off">
                                        <option value="">-- Select All --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label class="small">Payment Mode</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="ri-filter-2-line"></i></span>
                                    <select class="form-select form-select-sm" name="filter[payment_mode]"
                                        autocomplete="off">
                                        <option value="" selected>-- Select All --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label class="small">Download</label>
                                <a href="#" class="form-control btn btn-sm btn-secondary"><i
                                        class="ri-file-excel-2-fill"></i></a>
                            </div>
                            <div class="col">
                                <label class="small">Clear</label>
                                <button class="form-control btn btn-sm btn-secondary" data-action="clear-filter"><i
                                        class="ri-filter-off-fill"></i></button>
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
                                        <th>Name</th>
                                        <th>Duration (Month)</th>
                                        <th>Fee / Month</th>
                                        <th>Total Fee</th>
                                        <th>Enrolls</th>
                                    </tr>
                                    @foreach($courses as $key => $course)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$course->name}}</td>
                                        <td>{{$course->duration}}</td>
                                        <td>{{$course->fee_per_month}}</td>
                                        <td>{{$course->duration * $course->fee_per_month}}</td>
                                        <td>{{@$course->students_count}}</td>
                                    @endforeach
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('head-assets')
    <link rel="stylesheet" href="{{ asset('assets/user/css/flatpickr.min.css?v=') . config('version.css_user') }}">
@endpush
@push('footer-assets')
    <script src="{{ asset('assets/user/js/flatpickr.js?v=') . config('version.js_user') }}"></script>
@endpush