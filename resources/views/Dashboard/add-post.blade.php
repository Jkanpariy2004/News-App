<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('layout.sidenavbar')

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('layout.header')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Create Post</h5>
                                <div class="card-body">
                                    <form id="postForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" id="title"
                                                placeholder="Enter Post Title" />
                                            <div class="invalid-feedback" id="title-error"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="descriptionEditor" class="form-label">Description</label>
                                            <textarea id="description" name="description" class="form-control" placeholder="Enter Post Description"></textarea>
                                            <div class="invalid-feedback" id="description-error"></div>
                                        </div>

                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>


                                        <div class="mb-3">
                                            <label for="exampleFormControlSelect1" class="form-label">Post
                                                Category</label>
                                            <select class="form-select" id="category"
                                                aria-label="Default select example" name="category">
                                                <option value="" hidden>Select Post Category</option>
                                                @foreach ($categorys as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback" id="category-error"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Upload
                                                Image</label>
                                            <input type="file" class="form-control" name="thumbnail_image"
                                                id="thumbnail_image" />
                                            <div class="invalid-feedback" id="thumbnail_image-error"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Auther
                                                Name</label>
                                            <input type="text" class="form-control" name="auther_name"
                                                id="auther_name" placeholder="Enter Post Auther Name" />
                                            <div class="invalid-feedback" id="auther_name-error"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="publishDate" class="form-label">Post Publish Date</label>
                                            <input type="date" class="form-control" name="publish_date"
                                                id="publish_date" />
                                            <div class="invalid-feedback" id="publish_date-error"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="post_type" class="form-label">Post Type</label>
                                            <select class="form-select" id="post_type"
                                                aria-label="Default select example" name="post_type">
                                                <option value="" hidden>Select Post Type</option>
                                                <option value="Popular Post">Popular Post</option>
                                                <option value="New Post">New Post</option>
                                                <option value="Trendy Post">Trendy Post</option>
                                                <option value="Top Post">Top Post</option>
                                            </select>
                                            <div class="invalid-feedback" id="post_type-error"></div>
                                            @error('post_type')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    @include('layout.footer')

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('input, select, textarea').on('input', function() {
            $(this).removeClass('is-invalid');
            $('#' + $(this).attr('id') + '-error').text('');
        });

        $('#postForm').on('submit', function(e) {
            e.preventDefault();

            var isValid = true; // Flag for validation
            // Validate required fields
            $('input[required], select[required], textarea[required]').each(function() {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                    $('#' + $(this).attr('id') + '-error').text('This field is required.');
                    isValid = false; // Set flag to false if any field is invalid
                }
            });

            if (!isValid) return; // Stop submission if validation fails

            var formData = new FormData(this);

            $.ajax({
                url: '/SubmitPost',
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
                        window.location.href = '/post';
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
        });
    });
</script>

</html>
