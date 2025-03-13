let new_student_form = $('form[id="new-student"]');
let assign_course_form = $('form[id="assign-course"]');
let new_student_form_modal = new bootstrap.Modal(document.getElementById('new-student-modal'), {
    backdrop: 'static',
    keyboard: true
});
let assign_course_form_modal = new bootstrap.Modal(document.getElementById('assign-course-modal'), {
    backdrop: 'static',
    keyboard: true
});
$('[data-action="new-student"]').click(function () {
    new_student_form_modal.show();
});
document.getElementById('new-student-modal').addEventListener('show.bs.modal', event => {
    new_student_form_validator.resetForm();
    new_student_form.trigger('reset');
    date_of_birth.clear();
});
let date_of_birth = $('[name="dob"]').flatpickr({
    altInput: true,
    altFormat: "d/m/Y",
    dateFormat: "Y-m-d",
    maxDate: "today"
});
let add_courses = new TomSelect('#assign-course [name="courses[]"]', {
    hideSelected: true,
    create: false,
    allowEmptyOption: true,
    valueField: 'id',
    labelField: 'name',
    searchField: 'name',
    sortField: {
        field: "name",
        direction: "asc"
    },
    plugins: ['remove_button'],
    onChange: function (values) {
    },
});
$('[data-action="assign-course"]').click(function () {
    $.ajax({
        type: 'GET',
        url: _base_url + "students/" + $(this).attr('data-id'),
        dataType: 'json',
        success: function (response) {
            if (response.status == true) {
                $('[name="student_id"]', assign_course_form).val(response.student.id);
                $('[name="name"]', assign_course_form).val(response.student.name);
                $('[name="email"]', assign_course_form).val(response.student.email);
                add_courses.addOptions(response.all_courses);
                add_courses.setValue(Object.entries(response.student_courses).map(([key, value]) => value.course_id));
                assign_course_form_modal.show();
            } else {
                toastStatusFalse(response);
            }
        },
        error: function (response) {
            ajaxError(response);
        },
    });
});
$(document).ready(function () {
    new_student_form_validator = new_student_form.validate({
        focusInvalid: true,
        ignore: [],
        rules: {
            "name": {
                required: true,
            },
            "email": {
                required: true,
            },
            "phone": {
                required: true,
            },
            "dob": {
                required: true,
            },
            "address": {
                required: true,
            }
        },
        messages: {},
        errorPlacement: function (error, element) {
            if (element.hasClass("flatpickr-input") || element.hasClass("tomselected")) {
                $(element).parent().append(error);
            }
            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: 'POST',
                url: _base_url + "students",
                dataType: 'json',
                data: new_student_form.serialize(),
                success: function (response) {
                    if (response.status == true) {
                        new_student_form_modal.hide();
                        Swal.fire({
                            title: response.message.title,
                            text: response.message.content,
                            icon: response.message.type,
                            confirmButtonText: "OK",
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = response.redirect;
                            }
                        });
                    } else {
                        toastStatusFalse(response);
                    }
                },
                error: function (response) {
                    ajaxError(response);
                },
            });
        }
    });
    assign_course_form_validator = assign_course_form.validate({
        focusInvalid: true,
        ignore: [],
        rules: {
            "courses[]": {
                required: true,
            }
        },
        messages: {},
        errorPlacement: function (error, element) {
            if (element.hasClass("flatpickr-input") || element.hasClass("tomselected")) {
                $(element).parent().append(error);
            }
            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: 'POST',
                url: _base_url + "students/assign",
                dataType: 'json',
                data: assign_course_form.serialize(),
                success: function (response) {
                    if (response.status == true) {
                        assign_course_form_modal.hide();
                        Swal.fire({
                            title: response.message.title,
                            text: response.message.content,
                            icon: response.message.type,
                            confirmButtonText: "OK",
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        toastStatusFalse(response);
                    }
                },
                error: function (response) {
                    ajaxError(response);
                },
            });
        }
    });
});
$('[name="toggle-user"]').change(function () {
    let enable = $(this).is(':checked') ? 1 : 0;
    $.ajax({
        type: 'POST',
        url: _base_url + "students/toggle",
        dataType: 'json',
        data: { id: $(this).attr('data-id'), enable: enable },
        success: function (response) {
            if (response.status == true) {
                assign_course_form_modal.hide();
                Swal.fire({
                    title: response.message.title,
                    text: response.message.content,
                    icon: response.message.type,
                    confirmButtonText: "OK",
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            } else {
                toastStatusFalse(response);
            }
        },
        error: function (response) {
            ajaxError(response);
        },
    });
});