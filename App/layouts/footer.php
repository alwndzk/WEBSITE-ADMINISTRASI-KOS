<?php
// Memuat file dashboard.user.js hanya jika halaman dashboard dibuka
if (isset($_GET['page'])) {
    if ($_GET['page'] == "dashboard") {
        ?>
        <script src="../dist/js/dashboard.user.js"></script>
        <?php
    }
}
?>
<!-- Memuat script berbagai library JavaScript dan inisialisasi DataTable dengan fitur responsif dari plugins AdminLTE-->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- data tabel -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<!-- Include DataTables Responsive JS -->
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table-init').DataTable({
            responsive: true
        });
    });
    $(document).ready(function () {
        $('#table-init-2').DataTable({
            responsive: true
        });
    });
</script>

<script>
    // Menangani fungsi edit kamar
    $(document).ready(function () {
        window.editMasuk = function (id) {
            $.ajax({
                url: './pages/edit_kamar_kost.php',
                type: 'GET',
                data: {
                    action: 'edit',
                    id_kamar: id
                },
                success: function (data) {
                    var result = JSON.parse(data); // Mengonversi string JSON menjadi objek JavaScript
                    $('#id-kamar').val(result.id_kamar);
                    $('#nomor-kamar-edit').val(result.no_kamar);
                    $('#tipe-kamar-edit').val(result.tipe_sewa);
                    $('#harga-kamar-edit').val(result.harga);
                    $('#foto-lama-edit').val(result.foto);
                    $('#deskripsi-kamar-edit').val(result.deskripsi);
                    $('#editModal').modal('show'); // Menampilkan modal dengan data yang diambil
                }
            });
        };
    })
</script>

</html>