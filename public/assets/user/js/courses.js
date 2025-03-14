let new_student_form = $('form[id="new-student"]');
let edit_course_form = $('form[id="edit-course"]');
let new_student_form_modal = new bootstrap.Modal(document.getElementById('new-student-modal'), {
    backdrop: 'static',
    keyboard: true
});
let edit_course_form_modal = new bootstrap.Modal(document.getElementById('edit-course-modal'), {
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
$(document).ready(function () {
    new_student_form_validator = new_student_form.validate({
        focusInvalid: true,
        ignore: [],
        rules: {
            "name": {
                required: true,
            },
            "duration": {
                required: true,
            },
            "fee_per_month": {
                required: true,
            },
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
                url: _base_url + "courses",
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
    edit_course_form_validator = edit_course_form.validate({
        focusInvalid: true,
        ignore: [],
        rules: {
            "name": {
                required: true,
            },
            "duration": {
                required: true,
            },
            "fee_per_month": {
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
                type: 'PUT',
                url: _base_url + "courses",
                dataType: 'json',
                data: edit_course_form.serialize(),
                success: function (response) {
                    if (response.status == true) {
                        edit_course_form_modal.hide();
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
$('[name="toggle_course"]').change(function () {
    let enable = $(this).is(':checked') ? 1 : 0;
    $.ajax({
        type: 'POST',
        url: _base_url + "courses/toggle",
        dataType: 'json',
        data: { id: $(this).attr('data-id'), enable: enable },
        success: function (response) {
            if (response.status == true) {
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
$('[data-action="edit-course"]').click(function () {
    $.ajax({
        type: 'GET',
        url: _base_url + "courses/" + $(this).attr('data-id'),
        dataType: 'json',
        success: function (response) {
            if (response.status == true) {
                $('[name="id"]', edit_course_form).val(response.course.id);
                $('[name="name"]', edit_course_form).val(response.course.name);
                $('[name="duration"]', edit_course_form).val(response.course.duration);
                $('[name="fee_per_month"]', edit_course_form).val(response.course.fee_per_month);
                edit_course_form_modal.show();
            } else {
                toastStatusFalse(response);
            }
        },
        error: function (response) {
            ajaxError(response);
        },
    });
});