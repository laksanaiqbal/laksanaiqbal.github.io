<!-- Bootstrap core JavaScript-->
<script src="{{ asset('css/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('css/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('css/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Additional scripts -->
<!-- Include DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        var sidebar = document.getElementById('accordionSidebar');
        sidebar.classList.toggle('collapsed');
    });
</script>
