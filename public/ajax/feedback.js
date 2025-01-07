document.addEventListener('DOMContentLoaded', function () {
    // Delete Feedback
    $(document).on('click', '.delete-feedback', function (e) {
        e.preventDefault();
        const feedbackId = $(this).data('id');
        const url = `/admin/feedback/${feedbackId}`;

        if (confirm('Are you sure you want to delete this feedback?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    alert(response.success || 'Feedback deleted successfully!');
                    window.LaravelDataTables['feedback-table'].ajax.reload();
                },
                error: function (xhr) {
                    alert(xhr.responseJSON.error || 'Failed to delete feedback.');
                }
            });
        }
    });
});
