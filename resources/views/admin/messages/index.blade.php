@include('admin.header')

<!-- Page Wrapper -->
<div id="wrapper">
    @include('admin.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            @include('admin.topbar')

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="mb-3">
                    <button type="button" id="add_button" class="edit-btn btn btn-primary btn-sm">Add Data</button>
                </div>
                <!-- DataTables Example -->
                <div class="table-responsive">
                    <table id="datatable_message" class="display table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Subject</th>
                                <th>Body</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        @include('admin.footer')
    </div>
    <!-- End of Content Wrapper -->
</div>

@include('admin.scripts')
@include('admin.messages.edit')
@include('admin.messages.add')

<script>
    var table_message = $('#datatable_message').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('messages.ajaxList') }}',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'subject',
                name: 'subject'
            },
            {
                data: 'body',
                name: 'body'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
    $('#datatable_message').on('click', '#delete_button', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/messages/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            // Optionally, remove the row from the DataTable
                            $('#message-row-' + id).remove();
                            Swal.fire(
                                'Deleted!',
                                'The message has been deleted.',
                                'success'
                            );
                            table_message.ajax.reload();
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the message.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>
</body>

</html>
