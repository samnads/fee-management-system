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
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header filter">
                        <div class="d-flex flex-row-reverse">
                            <div class="p-2"><button class="form-control btn btn-sm btn-success" data-action="new-student"><i class="bi bi-book"></i>&nbsp;New Course</button>
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
    @include('popups.course-new-popup')
    @include('popups.course-edit-popup')
@endsection
@push('head-assets')
    <link rel="stylesheet" href="{{ asset('assets/user/css/flatpickr.min.css?v=') . config('version.css_user') }}">
@endpush
@push('footer-assets')
    <script src="{{ asset('assets/user/js/flatpickr.js?v=') . config('version.js_user') }}"></script>
    <script src="{{ asset('assets/user/js/courses.js?v=') . config('version.js_user') }}"></script>
@endpush