<?php
// Memulai sesi untuk akses variabel sesi
session_start();
include "../../koneksi.php"; // Menghubungkan ke database

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
    ?>
    <script>
        // Menampilkan alert jika pengguna belum login dan mengarahkan ke halaman login
        alert("Silahkan login terlebih dahulu!");
        document.location = "../index.php";
    </script>
    <?php
} else {
    // Mengambil data pengguna dari database berdasarkan ID yang disimpan di sesi
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id='$_SESSION[id]'");
    $data = mysqli_fetch_array($query);
}

// Menentukan halaman yang aktif, default ke 'dashboard'
$halaman = "dashboard";
if (isset($_GET['page'])) {
    $halaman = $_GET['page'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MKOST |
        <?= $halaman ?>
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="../../dist/css/style.css">
    <?php
    // Menentukan favicon berdasarkan halaman aktif
    if (isset($_GET['page'])) {
        ?>
        <!-- favicon -->
        <link rel="shortcut icon" href="../dist/img/favicon.ico" type="image/x-icon">
        <?php
    } else {
        ?>
        <!-- favicon -->
        <link rel="shortcut icon" href="./dist/img/favicon.ico" type="image/x-icon">
        <?php
    }
    ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php
    // Menangani proses pemesanan kamar
    if (isset($_POST['sewa'])) {
        $id_user = $_POST['id_user'];
        $id_kamar = $_POST['id_kamar'];
        $tipe_sewa = $_POST['tipe_sewa'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $tanggal_mulai = $_POST['tanggal_mulai'];

        $date = new DateTime($tanggal_mulai);

        // Menghitung tanggal akhir berdasarkan tipe sewa
        if ($tipe_sewa == "harian") {
            $tipe = "hari";
            $date->modify("+$jumlah days");
        } else if ($tipe_sewa == "bulanan") {
            $tipe = "bulan";
            $date->modify("+$jumlah months");
        } else {
            $tipe = "tahun";
            $date->modify("+$jumlah years");
        }

        $tanggal_akhir = $date->format('Y-m-d');
        $total_harga = $jumlah * $harga;
    }

    // Menangani konfirmasi sewa
    if (isset($_POST['konfirmasi'])) {
        $id_kamar = $_POST['id_kamar'];
        $id_user = $_POST['id_user'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_akhir = $_POST['tanggal_akhir'];
        $total_harga = $_POST['total_harga'];
        $status = "belum lunas";

        // Menyimpan data pemesanan ke dalam database
        $insert = mysqli_query($conn, "INSERT INTO sewa (id_kamar, id_user, tanggal_sewa, tanggal_selesai, total_harga, status) VALUES ('$id_kamar','$id_user','$tanggal_mulai','$tanggal_akhir','$total_harga','$status')");

        // Menampilkan pesan berdasarkan hasil pemesanan
        if ($insert) {
            ?>
            <script>
                alert("Pemesanan kamar berhasil, silahkan melakukan pembayaran sesuai harga akhir!");
                document.location = "../index.php?page=dashboard";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Pemesanan kamar gagal");
                document.location = "../index.php?page=detail&detail=<?= $id_kamar ?>";
            </script>
            <?php
        }
    }

    ?>

    <div class="container my-5">

        <a href="../index.php?page=detail&detail=<?= $id_kamar ?>" class="btn btn-danger px-4">kembali</a>

        <div class="mt-3 w-100 text-center">
            <div class="card shadow">
                <div class="card-header bg-warning">Detail Sewa</div>
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-5 text-right mt-2">Nomor Kamar</div>
                        <div class="col-md-1 text-right mt-2">:</div>
                        <div class="col-md-5 text-right mt-2"><strong>#
                                <?= $id_kamar ?>
                            </strong></div>
                        <div class="col-md-5 text-right mt-2">Tipe Sewa</div>
                        <div class="col-md-1 text-right mt-2">:</div>
                        <div class="col-md-5 text-right mt-2">
                            <?= $tipe_sewa ?>
                        </div>
                        <div class="col-md-5 text-right mt-2">Jumlah Sewa</div>
                        <div class="col-md-1 text-right mt-2">:</div>
                        <div class="col-md-5 text-right mt-2">
                            <?= number_format($jumlah) ?>
                            <?= $tipe ?>
                        </div>
                        <div class="col-md-5 text-right mt-2">Tanggal Mulai</div>
                        <div class="col-md-1 text-right mt-2">:</div>
                        <div class="col-md-5 text-right mt-2">
                            <?= $tanggal_mulai ?>
                        </div>
                        <div class="col-md-5 text-right mt-2">Tanggal Selesai</div>
                        <div class="col-md-1 text-right mt-2">:</div>
                        <div class="col-md-5 text-right mt-2">
                            <?= $tanggal_akhir ?>
                        </div>
                        <div class="col-md-5 text-right mt-2">Harga per
                            <?= $tipe ?>
                        </div>
                        <div class="col-md-1 text-right mt-2">:</div>
                        <div class="col-md-5 text-right mt-2">Rp.
                            <?= number_format($harga) ?>
                        </div>
                        <div class="col-md-5 text-right mt-2">Total Harga</div>
                        <div class="col-md-1 text-right mt-2">:</div>
                        <div class="col-md-5 text-right mt-2"><strong>Rp.
                                <?= number_format($total_harga) ?>
                            </strong></div>
                    </div>
                    <hr />
                    <!-- Formulir Konfirmasi Sewa -->
                    <form action="" method="post">
                        <input type="hidden" name="id_kamar" value="<?= $id_kamar ?>">
                        <input type="hidden" name="id_user" value="<?= $id_user ?>">
                        <input type="hidden" name="tanggal_mulai" value="<?= $tanggal_mulai ?>">
                        <input type="hidden" name="tanggal_akhir" value="<?= $tanggal_akhir ?>">
                        <input type="hidden" name="total_harga" value="<?= $total_harga ?>">
                        <div class="text-right">
                            <button type="submit" name="konfirmasi" class="btn btn-primary px-4">Konfirmasi
                                Sewa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../../plugins/moment/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.js"></script>

</html>