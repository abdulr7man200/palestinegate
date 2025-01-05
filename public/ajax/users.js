$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Handle form submission
    $('#addForm').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        let formAction = $(this).attr('action');

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        $.ajax({
            url: formAction,
            method: "POST",
            data: formData,
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
            url: `/users/edit/${dataId}`,
            method: 'GET',
            success: function(response) {
                const user = response.user;
                const role = response.role[0];

                // Populate user details
                $('#edit_id').val(user.id);
                $('#edit_name').val(user.name);
                $('#edit_email').val(user.email);
                $('#edit_date_of_birth').val(user.date_of_birth);
                $('#edit_phone').val(user.phone);
                $('#edit_role').val(role.id);



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

        let formData = $(this).serialize();
        let dataId = $('#edit_id').val(); // Get the user ID
        let formAction = `/users/update/${dataId}`; // Laravel PUT route for update

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        $.ajax({
            url: formAction,
            method: "PUT", // Use PUT method for updating
            data: formData,
            success: function(response) {
                // Handle success
                $('#editModal').modal('hide'); // Hide the modal
                $('#editForm')[0].reset(); // Reset the form
                alert('updated successfully!');
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

    $(document).on('click', '.toggle-active', function() {
        let userId = $(this).data('id'); // Get user ID from the button's data attribute

        // Show confirmation dialog using SweetAlert2
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to toggle the active status of this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, toggle it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with the AJAX request if confirmed
                $.ajax({
                    url: `/users/active/${userId}`, // The route for toggling active status
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                    },
                    success: function(response) {
                        Swal.fire(
                            'Toggled!',
                            'The active status has been successfully toggled.',
                            'success'
                        );

                        // Optionally, refresh the table or update the UI
                        $('#table').DataTable().ajax.reload(null, false); // Reload DataTable
                    },
                    error: function() {
                        Swal.fire(
                            'Failed!',
                            'There was an error while toggling the active status.',
                            'error'
                        );
                    }
                });
            } else {
                // Action canceled
                Swal.fire(
                    'Canceled',
                    'No changes were made.',
                    'info'
                );
            }
        });
    });




});