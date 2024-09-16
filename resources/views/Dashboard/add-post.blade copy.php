<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Post</title>
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

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Include jQuery Validation Plugin from a different CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            // Ensure jQuery Validation is loaded
            if (typeof $.fn.validate === 'undefined') {
                console.error("jQuery Validation Plugin is not loaded.");
                return;
            }
            // Your validation code
            jQuery('#postForm').validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 5
                    },
                    description: {
                        required: true,
                        minlength: 10
                    },
                    category: {
                        required: true
                    },
                    thumbnail_image: {
                        required: true,
                        extension: "jpg|jpeg|png|gif"
                    },
                    auther_name: {
                        required: true,
                        minlength: 3
                    },
                    publish_date: {
                        required: true,
                        date: true
                    },
                    post_type: {
                        required: true
                    }
                },
                messages: {
                    title: {
                        required: "Title is required",
                        minlength: "Title must be at least 5 characters"
                    },
                    description: {
                        required: "Description is required",
                        minlength: "Description must be at least 10 characters"
                    },
                    category: {
                        required: "Please select a category"
                    },
                    thumbnail_image: {
                        required: "Please upload an image",
                        extension: "Only image files are allowed (jpg, jpeg, png, gif)"
                    },
                    auther_name: {
                        required: "Author name is required",
                        minlength: "Author name must be at least 3 characters"
                    },
                    publish_date: {
                        required: "Publish date is required",
                        date: "Please enter a valid date"
                    },
                    post_type: {
                        required: "Please select a post type"
                    }
                },
                errorClass: 'is-invalid',
                errorElement: 'div',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    if (element.prop('type') === 'file') {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    event.preventDefault(); // Prevent default form submission
                    var formData = new FormData(form);

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

</body>

</html>
