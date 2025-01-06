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
                alert('Created successfully!');
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
            url: `/stays/edit/${dataId}`,
            method: 'GET',
            success: function(response) {
                const data = response.data;

                // Populate stay details
                $('#edit_id').val(data.id);
                $('#edit-name').val(data.name);
                $('#edit-Type').val(data.Type);
                $('#edit-description').val(data.description);
                $('#edit-city').val(data.city);
                $('#edit-streetaddress').val(data.streetaddress);
                $('#edit-amenities').val(data.amenities);
                $('#edit-price').val(data.price);
                $('#edit-numberofbedrooms').val(data.numberofbedrooms);
                $('#edit-maxnumofguests').val(data.maxnumofguests);

                // Show the modal
                $('#editModal').modal('show');
            },
            error: function() {
                alert('Failed to fetch stay data.');
            }
        });
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();
        let dataId = $('#edit_id').val(); // Get the stay ID
        let formAction = `/stays/update/${dataId}`; // Laravel PUT route for update

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
        var stayId = $(this).data('id'); // Get the stay ID from the button

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
                    url: '/stays/destroy/' + stayId, // The route for the destroy action
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
                            'There was an issue deleting the stay.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
