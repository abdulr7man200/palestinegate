$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '.edit-data', function() {
        let dataId = $(this).data('id');
        $.ajax({
            url: `/booking/edit/${dataId}`,
            method: 'GET',
            success: function(response) {
                const data = response.data;

                // Populate stay details
                $('#edit_id').val(data.id);
                $('#edit-status').val(data.status);


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

        let formData = new FormData(this);
        let dataId = $('#edit_id').val(); // Get the stay ID
        let formAction = `/booking/update/${dataId}`; // Laravel PUT route for update

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        $.ajax({
            url: formAction,
            method: "POST", // Use PUT method for updating
            data: formData,
            contentType: false,
            processData: false,
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

});
