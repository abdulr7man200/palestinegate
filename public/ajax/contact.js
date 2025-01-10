$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // Bind the delete button
    $(document).on('click', '.delete-data', function() {
        let contactId = $(this).data('id');

        // Show SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/contact/destroy/${contactId}`, // The route for the destroy action
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
                            'There was an issue deleting the message.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
