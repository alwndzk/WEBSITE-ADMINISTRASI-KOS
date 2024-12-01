<!-- Menampilkan header halaman -->
<?php include "../layouts/header.php" ?>

<div class="wrapper">
  <!-- Menampilkan sidebar halaman -->
  <?php include "../sidebar/sidebar.php" ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Menampilkan header konten dengan judul $halaman -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
              <?= $halaman ?>
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php
        // Mengecek nilai dari parameter page dan menyertakan file berdasarkan $page
        if (isset($_GET['page'])) {
          if ($_GET['page'] == "profile") {
            include "pages/profile.php";
          } else if ($_GET['page'] == "detail") {
            include "pages/detail.php";
          } else {
            include "pages/dashboard.php";
          }
        } else {
          include "pages/dashboard.php";
        }
        ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>

<!-- Menampilkan footer halaman -->
<?php include "../layouts/footer.php" ?>