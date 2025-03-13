@extends('layouts.admin', [])
@section('title', 'Students')
@section('content')
    <div class="d-flex">
        <div class="pagetitle flex-grow-1">
            <h1>Students</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item">Students</li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="pagetitle-right">
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header filter">
                        <div class="d-flex flex-row-reverse">
                            <div class="p-2"><button class="form-control btn btn-sm btn-dark" data-action="new-student"><i class="bi bi-person-plus"></i>&nbsp;New Student</button>
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
                                        <th>Courses</th>
                                        <th>Fee / Month</th>
                                        <th>Total Fee</th>
                                        <th width="1%">Actions</th>
                                    </tr>
                                    @foreach ($students as $key => $student)
                                        <tr style="background-color: {{$student->deleted_at == null ? 'checked' : 'red !important'}};">
                                            <td>{{ ($page - 1) * 10 + $key + 1 }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>
                                                @foreach ($student->courses as $key => $course)
                                                    <p>{{ $course->name }}</p>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($student->courses as $key => $course)
                                                    <p>{{ $course->fee_per_month }}</p>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($student->courses as $key => $course)
                                                    <p>{{ $course->duration * $course->fee_per_month }}</p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Assign Course" data-action="assign-course" data-id="{{$student->id}}"><i class="bi bi-plus"></i></button>
                                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enable / Disable">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" name="toggle_user" data-id="{{$student->id}}"
                                                                id="toggle_{{$student->id}}" {{$student->deleted_at == null ? 'checked' : ''}}>
                                                            <label class="form-check-label"
                                                                for="toggle_{{$student->id}}"></label>
                                                        </div>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $students->links() !!}
        </div>
    </section>
    @include('popups.student-new-popup')
    @include('popups.course-assign-popup')
@endsection
@push('head-assets')
    <link rel="stylesheet" href="{{ asset('assets/user/css/flatpickr.min.css?v=') . config('version.css_user') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/user/css/tom-select.bootstrap5.min.css?v=') . config('version.css_user') }}" />
@endpush
@push('footer-assets')
    <script src="{{ asset('assets/user/js/flatpickr.js?v=') . config('version.js_user') }}"></script>
    <script src="{{ asset('assets/user/js/tom-select.complete.js?v=') . config('version.js_user') }}"></script>
    <script src="{{ asset('assets/user/js/students.js?v=') . config('version.js_user') }}"></script>
@endpush
