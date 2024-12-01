<?php
// Memulai sesi
session_start();
include "../koneksi.php"; // Menyertakan file koneksi basis data

// Mengecek apakah sesi login sudah ada
if (!isset($_SESSION['login'])) {
  ?>
  <!-- Jika belum login, menampilkan pesan dan mengarahkan ke halaman login -->
  <script>
    alert("Silahkan login terlebih dahulu!");
    document.location = "../index.php";
  </script>
  <?php
} else {
  // Jika sudah login, ambil data pengguna dari basis data
  $query = mysqli_query($conn, "SELECT * FROM user WHERE id='$_SESSION[id]'");
  $data = mysqli_fetch_array($query);
}

// Menentukan halaman yang akan ditampilkan
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
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
  <?php
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