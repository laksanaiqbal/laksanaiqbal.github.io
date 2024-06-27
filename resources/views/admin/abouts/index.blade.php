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
                <!-- DataTables Example -->
                <div class="table-responsive">
                    <table id="datatable_about" class="display table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Content</th>
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
@include('admin.abouts.edit')
{{-- @include('admin.abouts.add') --}}

<script>
    var table_about = $('#datatable_about').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('abouts.ajaxList') }}',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'content',
                name: 'content'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
</script>
</body>

</html>
