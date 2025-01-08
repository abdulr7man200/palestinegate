$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Handle form submission
    $('#addForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this); // Use FormData for handling file uploads

        let formAction = $(this).attr('action');

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        $.ajax({
            url: formAction,
            method: "POST",
            data: formData,
            processData: false, // Do not process data (required for FormData)
            contentType: false, // Do not set contentType (required for FormData)
            success: function(response) {
                $('#addModal').modal('hide');
                $('#addForm')[0].reset();
                alert('created successfully!');
                $('#table').DataTable().ajax.reload(null, false);
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    $.each(errors, function(key, value) {
                        let inputField = $(`#${key}`);
                        inputField.addClass('is-invalid'); // Highlight invalid field
                        inputField.after(`<div class="invalid-feedback">${value[0]}</div>`); // Display error
                    });
                }
            }
        });
    });

    $(document).on('click', '.edit-data', function() {
        let dataId = $(this).data('id');
        $.ajax({
            url: `/cars/edit/${dataId}`,
            method: 'GET',
            success: function(response) {
                const data = response.data;

                // Populate user details
                $('#edit_id').val(data.id);
                $('#edit-type').val(data.type);
                $('#edit-model').val(data.model);
                $('#edit-year').val(data.year);
                $('#edit-price_per_day').val(data.price_per_day);
                $('#edit-description').val(data.description);
                $('#edit-location').val(data.location);

                // Show the modal
                $('#editModal').modal('show');
            },
            error: function() {
                alert('Failed to fetch user data.');
            }
        });
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this); // Use FormData to handle file uploads
        let dataId = $('#edit_id').val(); // Get the car ID
        let formAction = `/cars/update/${dataId}`; // Laravel PUT route for update

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        $.ajax({
            url: formAction,
            method: "POST", // Use POST for the request (Laravel handles PUT via `_method` field)
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting content type header
            success: function(response) {
                // Handle success
                $('#editModal').modal('hide'); // Hide the modal
                $('#editForm')[0].reset(); // Reset the form
                alert('Updated successfully!');
                $('#table').DataTable().ajax.reload(null, false); // Reload DataTable
            },
            error: function(xhr) {
                // Handle validation errors
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    $.each(errors, function(key, value) {
                        let inputField = $(`#edit_${key}`);
                        inputField.addClass('is-invalid'); // Highlight invalid field
                        inputField.after(`<div class="invalid-feedback">${value[0]}</div>`); // Display error
                    });
                }
            }
        });
    });

    // Bind the delete button
    $(document).on('click', '.delete-data', function() {
        var carId = $(this).data('id'); // Get the car ID from the button

        // Show SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/cars/destroy/' + carId, // The route for the destroy action
                    method: 'DELETE',
                    success: function(response) {
                        // Show success message
                        Swal.fire(
                            'Deleted!',
                            response.success, // Message from the controller
                            'success'
                        );

                        $('#table').DataTable().ajax.reload(null, false); // Reload DataTable
                    },
                    error: function(xhr, status, error) {
                        // Show error message
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the car.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});