<link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="/assets/css/demo.css" />

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include('layout.sidenavbar')

        <div class="layout-page">

            @include('layout.header')

            <div class="content-wrapper">

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Post
                        </h4>

                        <div class="card p-4">
                            <div class="card-datatable table-responsive pt-0">
                                <div class="card p-3 mb-3">
                                    <div>
                                        <h3>Custom Search</h3>
                                    </div>
                                    <form id="search-form">
                                        @csrf
                                        <div class="d-flex flex-row">
                                            <div class="mb-3 w-50 m-1">
                                                <label for="exampleFormControlSelect1" class="form-label">Post
                                                    Category</label>
                                                <select class="form-select" id="category" name="category">
                                                    <option value="" hidden>Select Post Category</option>
                                                    @foreach ($categorys as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback" id="category-error"></div>
                                            </div>
                                            <div class="mb-3 w-50 m-1">
                                                <label class="form-label">Post Title</label>
                                                <input type="text" class="form-control" name="post_title"
                                                    id="post_title" placeholder="Enter Post Title" />
                                                <div class="invalid-feedback" id="post_title-error"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <div class="mb-3 w-50 m-1">
                                                <label for="post_date" class="form-label">Select Post Date</label>
                                                <input type="text" class="form-control flatpickr"
                                                    placeholder="YYYY-MM-DD to YYYY-MM-DD" id="post_date"
                                                    name="post_date" data-range="true" data-multiple="true" />
                                                <div class="invalid-feedback" id="post_date-error"></div>
                                            </div>
                                            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                                            <script>
                                                flatpickr("#post_date", {
                                                    mode: "range",
                                                    dateFormat: "Y-m-d",
                                                });
                                            </script>
                                            <div class="mb-3 w-50 m-1">
                                                <button type="submit" class="btn btn-instagram w-100"
                                                    style="margin-top: 22px;">
                                                    <i class="fa fa-search"></i> <span class="mx-1">Search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('input, select, textarea').on('input', function() {
                                            $(this).removeClass('is-invalid');
                                            $('#' + $(this).attr('id') + '-error').text('');
                                        });

                                        $('#search-form').on('submit', function(e) {
                                            e.preventDefault();
                                            let formData = $(this).serialize();

                                            $.ajax({
                                                url: '/search',
                                                type: 'POST',
                                                data: formData,
                                                success: function(response) {
                                                    $('#example').DataTable().clear().draw();

                                                    let tableData = response.data.map(item => [
                                                        `<input type="checkbox" class="select-item animated-checkbox" data-id="${item.id}" />`,
                                                        item.id,
                                                        item.title,
                                                        `<div class="truncate">${item.description}</div>`,
                                                        item.category_name ?? item.category,
                                                        `<a href="#" data-bs-toggle="modal" data-bs-target="#imageModal${item.id}">
                                                        <img src="${item.thumbnail_image}" class="rounded-circle" alt="Thumbnail" style="width: 70px; height: 70px;">
                                                        </a>`,
                                                        item.auther_name,
                                                        new Date(item.publish_date).toLocaleDateString('en-GB'),
                                                        item.post_type,
                                                        `<a href="/post-edit/${item.id}" class="btn btn-sm btn-icon item-edit">
                                                        <i class="text-primary ti ti-pencil"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-icon item-delete" href="#" data-id="${item.id}">
                                                        <i class="text-danger ti ti-trash"></i>
                                                    </a>`
                                                    ]);

                                                    $('#example').DataTable().rows.add(tableData).draw();
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

                                <div class="d-flex mb-3">
                                    <div class="w-50 text-start">
                                        <h3>Post Data</h3>
                                    </div>
                                    <div class="w-50 text-end">
                                        <a href="/add-post" class="btn btn-primary">
                                            <i class="ti ti-plus me-sm-1"></i>Add Post
                                        </a>
                                        <a href="#" id="fetch-articles-btn" class="btn btn-success">
                                            <i class="ti ti-plus me-sm-1"></i> Get New Articles
                                        </a>

                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                        <script>
                                            $('#fetch-articles-btn').on('click', function(e) {
                                                e.preventDefault();

                                                Swal.fire({
                                                    title: 'Processing...',
                                                    text: 'Fetching and inserting new articles, please wait...',
                                                    allowOutsideClick: false,
                                                    didOpen: () => {
                                                        Swal.showLoading();
                                                    }
                                                });

                                                $.ajax({
                                                    url: "{{ route('fetch.articles') }}",
                                                    method: 'GET',
                                                    success: function(response) {

                                                        Swal.close();

                                                        Swal.fire({
                                                            icon: 'success',
                                                            title: 'Success',
                                                            text: response.message,
                                                            timer: 3000,
                                                            showConfirmButton: true,
                                                            timerProgressBar: true,
                                                        });

                                                        setTimeout(function() {
                                                            location
                                                                .reload();
                                                        }, 3000);
                                                    },
                                                    error: function(xhr) {
                                                        Swal.close();

                                                        let errorMessage = xhr.responseJSON ? xhr
                                                            .responseJSON.error :
                                                            'An unknown error occurred.';

                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Error',
                                                            text: errorMessage
                                                        });
                                                    }
                                                });
                                            });
                                        </script>


                                        <a href="#" id="bulk-delete-btn" class="btn btn-danger">
                                            <i class="ti ti-trash me-sm-1"></i>Bulk Delete
                                        </a>
                                    </div>
                                </div>
                                {{-- <table class="datatables-basic table" id="example"> --}}
                                <table class="table" id="example">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" id="select-all"
                                                    class="animated-checkbox" /></th>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Thumbnail Image</th>
                                            <th class="text-center">Auther Name</th>
                                            <th class="text-center">Publish Date</th>
                                            <th class="text-center">Post Type</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>

                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        @if (session('success'))
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success!',
                                                text: "{{ session('success') }}",
                                                confirmButtonText: 'OK'
                                            });
                                        @endif

                                        @if (session('error'))
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error!',
                                                text: "{{ session('error') }}",
                                                confirmButtonText: 'OK'
                                            });
                                        @endif

                                        $(document).ready(function() {
                                            $.ajax({
                                                type: "GET",
                                                url: "/fetch-data",
                                                dataType: "json",
                                                success: function(response) {
                                                    $('#example').DataTable().clear().destroy();

                                                    let tableData = [];

                                                    $.each(response.posts, function(key, item) {
                                                        tableData.push([
                                                            `<input type="checkbox" class="select-item animated-checkbox" data-id="${item.id}" />`,
                                                            item.id,
                                                            item.title,
                                                            `<div class="truncate">${item.description}</div>`,
                                                            item.category_name ?? item.category,
                                                            `<a href="#" data-bs-toggle="modal" data-bs-target="#imageModal${item.id}">
                                                            <img src="${item.thumbnail_image}" class="rounded-circle" alt="Thumbnail"
                                                                style="width: 70px; height: 70px;">
                                                            </a>`,
                                                            item.auther_name,
                                                            new Date(item.publish_date).toLocaleDateString(
                                                                'en-GB'),
                                                            item.post_type,
                                                            `<a href="/post-edit/${item.id}"  class="btn btn-sm btn-icon item-edit">
                                                            <i class="text-primary ti ti-pencil"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-icon item-delete" href="#" data-id="${item.id}">
                                                            <i class="text-danger ti ti-trash"></i>
                                                        </a>`
                                                        ]);

                                                        $('body').append(`
                                                        <div class="modal fade" id="imageModal${item.id}" tabindex="-1"
                                                            aria-labelledby="imageModalLabel${item.id}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="imageModalLabel${item.id}">Image Preview</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <img src="${item.thumbnail_image}" class="img-fluid" alt="Thumbnail">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    `);
                                                    });

                                                    $('#example').DataTable({
                                                        data: tableData,
                                                        lengthMenu: [7, 10, 25, 50, 75, 100],
                                                        responsive: true,
                                                        paging: true,
                                                        searching: true,
                                                        ordering: true,
                                                        columnDefs: [{
                                                            targets: 0,
                                                            orderable: false
                                                        }],
                                                        drawCallback: function(settings) {
                                                            $('.item-delete').off('click').on('click', function(
                                                                event) {
                                                                event.preventDefault();
                                                                const id = $(this).data('id');

                                                                Swal.fire({
                                                                    title: 'Are you sure?',
                                                                    text: "You won't be able to revert this!",
                                                                    icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: '#3085d6',
                                                                    cancelButtonColor: '#d33',
                                                                    confirmButtonText: 'Yes, delete it!'
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        $.ajax({
                                                                            url: `/post-delete/${id}`,
                                                                            method: 'GET',
                                                                            data: {
                                                                                _token: '{{ csrf_token() }}'
                                                                            },
                                                                            success: function(
                                                                                response
                                                                            ) {
                                                                                Swal.fire({
                                                                                        icon: 'success',
                                                                                        title: 'Deleted!',
                                                                                        text: 'The post has been deleted.',
                                                                                        confirmButtonText: 'OK'
                                                                                    })
                                                                                    .then(
                                                                                        () => {
                                                                                            $('#example')
                                                                                                .DataTable()
                                                                                                .row(
                                                                                                    $(event
                                                                                                        .target
                                                                                                        )
                                                                                                    .closest(
                                                                                                        'tr'
                                                                                                        )
                                                                                                    )
                                                                                                .remove()
                                                                                                .draw();
                                                                                        }
                                                                                    );
                                                                            },
                                                                            error: function(
                                                                                xhr,
                                                                                status,
                                                                                error
                                                                                ) {
                                                                                console
                                                                                    .error(
                                                                                        'Error deleting post:',
                                                                                        xhr,
                                                                                        status,
                                                                                        error
                                                                                        );
                                                                                Swal.fire({
                                                                                    icon: 'error',
                                                                                    title: 'Error!',
                                                                                    text: 'An error occurred while deleting the post.',
                                                                                    confirmButtonText: 'OK'
                                                                                });
                                                                            }
                                                                        });
                                                                    }
                                                                });
                                                            });
                                                        }
                                                    });
                                                }
                                            });

                                            $('#select-all').on('click', function() {
                                                const isChecked = $(this).prop('checked');
                                                $('.select-item').prop('checked', isChecked);
                                            });

                                            $('#bulk-delete-btn').on('click', function(event) {
                                                event.preventDefault();
                                                const selectedIds = [];
                                                $('.select-item:checked').each(function() {
                                                    selectedIds.push($(this).data('id'));
                                                });

                                                if (selectedIds.length === 0) {
                                                    Swal.fire({
                                                        icon: 'warning',
                                                        title: 'No selection',
                                                        text: 'Please select at least one item to delete.',
                                                        confirmButtonText: 'OK'
                                                    });
                                                    return;
                                                }

                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    text: `You are about to delete ${selectedIds.length} items!`,
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Yes, delete them!'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        $.ajax({
                                                            url: '/bulk-delete',
                                                            method: 'POST',
                                                            data: {
                                                                ids: selectedIds,
                                                                _token: '{{ csrf_token() }}'
                                                            },
                                                            success: function(response) {
                                                                Swal.fire({
                                                                    icon: 'success',
                                                                    title: 'Deleted!',
                                                                    text: 'Selected items have been deleted.',
                                                                    confirmButtonText: 'OK'
                                                                }).then(() => {
                                                                    var table = $('#example')
                                                                        .DataTable();
                                                                    selectedIds.forEach(function(
                                                                    id) {
                                                                        table.row($(
                                                                                    `input[data-id="${id}"]`)
                                                                                .closest(
                                                                                    'tr'))
                                                                            .remove();
                                                                    });
                                                                    table.draw();

                                                                    $('#select-all').prop('checked',
                                                                        false);
                                                                });
                                                            },
                                                            error: function(xhr, status, error) {
                                                                console.error('Error deleting items:', xhr,
                                                                    status, error);
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    title: 'Error!',
                                                                    text: 'An error occurred while deleting items.',
                                                                    confirmButtonText: 'OK'
                                                                });
                                                            }
                                                        });
                                                    }
                                                });
                                            });
                                        });
                                    });
                                </script>
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
