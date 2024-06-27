<!-- Edit Message Modal -->
<div class="modal fade" id="editMessageModal" tabindex="-1" role="dialog" aria-labelledby="editMessageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMessageModalLabel">Edit Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMessageForm">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" id="body" name="body" required></textarea>
                    </div>
                    <input type="hidden" id="id_message">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#datatable_message').on('click', '#edit_button', function() {
            var id = $(this).data('id');
            $.get('/messages/' + id + '/edit', function(data) {
                $('#editMessageModal #id_message').val(data.id_message);
                $('#editMessageModal #subject').val(data.subject);
                $('#editMessageModal #body').val(data.body);
                $('#editMessageModal').modal('show');
            });
        });

        $('#saveChanges').click(function() {
            var id = $('#editMessageModal #id_message').val();
            var subject = $('#editMessageModal #subject').val();
            var body = $('#editMessageModal #body').val();

            $.ajax({
                url: '/messages/' + id,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    subject: subject,
                    body: body
                },
                success: function(response) {
                    $('#editMessageModal').modal('hide');
                    table_message.ajax.reload();

                    Swal.fire({
                        title: 'Success!',
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while saving changes.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

    });
</script>
