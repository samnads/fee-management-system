let new_student_form = $('form[id="new-student"]');
let new_student_form_modal = new bootstrap.Modal(document.getElementById('new-student-modal'), {
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
});