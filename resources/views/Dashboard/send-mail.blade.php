<link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="/assets/css/demo.css" />
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include('layout.sidenavbar')

        <div class="layout-page">

            @include('layout.header')


            <div class="content-wrapper">

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Mail Send</h5>
                            <div class="card-body">
                                <form id="MailForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Sender Mail:</label>
                                        <input type="text" class="form-control" name="mail_to"
                                            id="mail_to" placeholder="Enter Send Mail Address" />
                                        <div class="invalid-feedback" id="mail_to-error"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Subject:</label>
                                        <input type="text" class="form-control" name="mail_subject"
                                            id="mail_subject" placeholder="Enter Mail Subject" />
                                        <div class="invalid-feedback" id="mail_subject-error"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Message:</label>
                                        <textarea type="text" class="form-control" name="mail_message"
                                            id="mail_message" placeholder="Enter Mail Message" ></textarea>
                                        <div class="invalid-feedback" id="mail_message-error"></div>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-100">Send Mail</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @include('layout.footer')

                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>

    <div class="drag-target"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('input, select, textarea').on('input', function() {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
            $('#' + $(this).attr('id') + '-error').text('');
        });

        $('#MailForm').on('submit', function(e) {
            e.preventDefault();

            var isValid = true;

            var to = $('#mail_to').val();
            if (to.trim() === '') {
                $('#mail_to').addClass('is-invalid');
                $('#mail_to-error').text('Please Enter Sender Email Address.');
                isValid = false;
            }

            var subject = $('#mail_subject').val();
            if (subject.trim() === '') {
                $('#mail_subject').addClass('is-invalid');
                $('#mail_subject-error').text('Please enter Mail Subject.');
                isValid = false;
            }

            var message = $('#mail_message').val();
            if (message === '') {
                $('#mail_message').addClass('is-invalid');
                $('#mail_message-error').text('Please Enter Mail Message.');
                isValid = false;
            }

            if (isValid) {
                var formData = new FormData(this);

                Swal.fire({
                    title: 'Processing...',
                    text: 'Mail Sending in Process, please wait...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });


                $.ajax({
                    url: '/Mail-Send',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        timer: 3000,
                        timerProgressBar: true,
                        confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '/send-mail';
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').text('');

                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key + '-error').text(value[0]);
                        });
                    }
                });
            }
        });
    });
</script>

<style>
    .custom-loader {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px; /* Adjust height as needed */
    }

    .custom-loader::after {
        content: '';
        display: block;
        width: 40px; /* Adjust size as needed */
        height: 40px; /* Adjust size as needed */
        border: 4px solid rgba(0, 0, 0, 0.1);
        border-left-color: #007bff; /* Change color as needed */
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
