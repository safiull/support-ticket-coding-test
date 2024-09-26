// Set CSRF token for AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Helper function to show a loading spinner
const savingLoader = '<div class="d-flex justify-content-center align-items-center">' +
    '<div class="spinner-border spinner-border-sm text-center" role="status">' +
    '<span class="visually-hidden">Loading...</span>' +
    '</div>' +
    '<span class="ms-2">Processing...</span>' +
    '</div>';

// Handle form submission using AJAX
const ajax_form = $(".ajax-form");
ajax_form.initFormValidation();
$(document).on('submit', '.ajax-form', function (e) {
    e.preventDefault();

    let form = $(this);
    let submitButton = form.find('.ajax-button');
    let originalButtonText = submitButton.html();

    if (form.valid()) {
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.html(savingLoader).attr('disabled', true);
            },
            success: function (res) {
                submitButton.html(originalButtonText).attr('disabled', false);
                Notify('success', null, res);
            },
            error: function (xhr) {
                console.log(xhr)
                submitButton.html(originalButtonText).attr('disabled', false);
                if (xhr.responseJSON?.errors ?? false) {
                    showInputErrors(xhr.responseJSON);
                } else {
                    Notify('error', xhr);
                }
            }
        });
    }
});

// Handle form submission with instant page reload
const custom_reload_form = $(".custom-reload-form");
custom_reload_form.initFormValidation();
$(document).on('submit', '.custom-reload-form', function (e) {
    e.preventDefault();

    let form = $(this);
    let submitButton = form.find('.ajax-btn');
    let originalButtonText = submitButton.html();

    if (form.valid()) {
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.html(savingLoader).addClass('disabled').attr('disabled', true);
            },
            success: function (res) {
                submitButton.html(originalButtonText).removeClass('disabled').attr('disabled', false);
                window.sessionStorage.hasPreviousMessage = true;
                window.sessionStorage.previousMessage = res.message ?? null;

                if (res.redirect) {
                    location.href = res.redirect;
                }
            },
            error: function (xhr) {
                submitButton.html(originalButtonText).removeClass('disabled').attr('disabled', false);
                showInputErrors(xhr);
                Notify('error', xhr);
            }
        });
    }
});
