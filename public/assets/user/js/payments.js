let new_student_form = $('form[id="new-student"]');
let new_student_form_modal = new bootstrap.Modal(document.getElementById('new-student-modal'), {
    backdrop: 'static',
    keyboard: true
});
$('[data-action="new-student"]').click(function () {
    new_student_form_modal.show();
});
document.getElementById('new-student-modal').addEventListener('show.bs.modal', event => {
    student_dropdown.clear();
    date_of_payment.clear();
    new_student_form_validator.resetForm();
    new_student_form.trigger('reset');
});
let date_of_payment = $('[name="date_of_payment"]').flatpickr({
    altInput: true,
    altFormat: "d/m/Y",
    dateFormat: "Y-m-d",
    maxDate: "today"
});
let student_dropdown = new TomSelect('#new-student [name="student_id"]', {
    hideSelected: true,
    create: false,
    allowEmptyOption: true,
    valueField: 'id',
    labelField: 'name',
    searchField: 'name',
    plugins: ['remove_button'],
    onChange: function (value) {
        courses_dropdown.clear();
        courses_dropdown.clearOptions();
        if (value) {
            $.ajax({
                type: 'GET',
                url: _base_url + "students/" + value,
                dataType: 'json',
                success: function (response) {
                    if (response.status == true) {
                        courses_dropdown.addOptions(response.student_courses);
                        if (response.student_courses.length == 0) {
                            toast('No Courses !', 'No courses assigned for this student !', 'warning');
                        }
                    } else {
                        toastStatusFalse(response);
                    }
                },
                error: function (response) {
                    ajaxError(response);
                },
            });
        }
    },
});
let courses_dropdown = new TomSelect('#new-student [name="course_id"]', {
    hideSelected: true,
    create: false,
    allowEmptyOption: true,
    valueField: 'id',
    labelField: 'name',
    searchField: 'name',
    sortField: {
        field: "id",
        direction: "desc"
    },
    plugins: ['remove_button'],
    onChange: function (value) {
    },
});
$(document).ready(function () {
    new_student_form_validator = new_student_form.validate({
        focusInvalid: true,
        ignore: [],
        rules: {
            "student_id": {
                required: true,
            },
            "course_id": {
                required: true,
            },
            "amount": {
                required: true,
            },
            "date_of_payment": {
                required: true
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
                url: _base_url + "payments",
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