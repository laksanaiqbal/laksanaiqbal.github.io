<!-- Edit about Modal -->
<div class="modal fade" id="editaboutModal" tabindex="-1" role="dialog" aria-labelledby="editaboutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editaboutModalLabel">Edit about</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editaboutForm">
                    <div class="form-group">
                        <label for="body">content</label>
                        <textarea class="form-control" id="content" rows="5" name="content" required></textarea>
                    </div>
                    <input type="hidden" id="id_about">
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
        $('#datatable_about').on('click', '#edit_button', function() {
            var id = $(this).data('id');
            $.get('/about/' + id + '/edit', function(data) {
                $('#editaboutModal #id_about').val(data.id);
                $('#editaboutModal #content').val(data.content);
                $('#editaboutModal').modal('show');
            });
        });

        $('#saveChanges').click(function() {
            var id = $('#editaboutModal #id_about').val();
            var content = $('#editaboutModal #content').val();
            var body = $('#editaboutModal #body').val();

            $.ajax({
                url: '/about/' + id,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    content: content,
                    body: body
                },
                success: function(response) {
                    $('#editaboutModal').modal('hide');
                    table_about.ajax.reload();

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
