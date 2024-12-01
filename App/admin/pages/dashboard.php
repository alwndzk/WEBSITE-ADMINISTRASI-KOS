<?php
// Mengambil data penyewa yang bukan admin
$query_penyewa = mysqli_query($conn, "SELECT * FROM user WHERE status !='admin'");
$jumlah_penyewa = mysqli_num_rows($query_penyewa);

// Mengambil data semua kamar
$query_kamar = mysqli_query($conn, "SELECT * FROM kamar");
$jumlah_kamar = mysqli_num_rows($query_kamar);

// Mengambil data tagihan yang belum lunas
$query_tagihan = mysqli_query($conn, "SELECT * FROM sewa WHERE status='belum lunas'");
$jumlah_tagihan = mysqli_num_rows($query_tagihan);
?>

<div class="row">
  <!-- Menampilkan jumlah penyewa -->
  <div class="col-md-4 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fas fa-user-friends"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Jumlah Penyewa</span>
        <span class="info-box-number">
          <?= number_format($jumlah_penyewa) ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- Menampilkan jumlah kamar -->
  <div class="col-md-4 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="fas fa-bed"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Jumlah Kamar</span>
        <span class="info-box-number">
          <?= number_format($jumlah_kamar) ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <!-- Menampilkan jumlah tagihan yang belum lunas -->
  <div class="col-md-4 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="fas fa-money-bill-wave"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Jumlah Tagihan</span>
        <span class="info-box-number">
          <?= number_format($jumlah_tagihan) ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>