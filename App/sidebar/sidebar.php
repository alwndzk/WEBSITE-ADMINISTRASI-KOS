<!-- Menggunakan Preloader untuk menampilkan animasi preloader saat halaman sedang dimuat -->
<div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="../dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-primary shadow">
  <!-- Left navbar links -->
  <!-- Mengaktifkan push menu -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- right navbar links -->
  <!-- Mengaktifkan control sidebar -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-white bg-light elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="../dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle" style="opacity: 1.2">
    <span class="brand-text font-weight-light text-primary font-weight-bold">MKOS</span>
  </a>

  <hr class="my-0">

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <!--  Menu navigasi berdasarkan status pengguna (admin atau user) -->
    <nav class="mt-2">
      <?php if ($data['status'] == "admin") { ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/kost/App/admin/index.php?page=dashboard"
              class="nav-link <?= $halaman == "dashboard" ? "active" : "" ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/kost/App/admin/index.php?page=kamar-kost"
              class="nav-link <?= $halaman == "kamar-kost" ? "active" : "" ?>">
              <i class="nav-icon fas fa-bed"></i>
              <p>
                Data Kamar Kost
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/kost/App/admin/index.php?page=penyewa-kost"
              class="nav-link <?= $halaman == "penyewa-kost" ? "active" : "" ?>">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Data Penyewa Kost
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/kost/App/admin/index.php?page=transaksi"
              class="nav-link <?= $halaman == "transaksi" ? "active" : "" ?>">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Transaksi Pembayaran
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/kost/App/admin/index.php?page=profile-admin"
              class="nav-link <?= $halaman == "profile-admin" ? "active" : "" ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/kost/App/admin/index.php?page=riwayat-penyewa"
              class="nav-link <?= $halaman == "riwayat-penyewa" ? "active" : "" ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Riwayat Penyewa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')" class="nav-link">
              <i class="nav-icon fas fa-arrow-right"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      <?php } else { ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/kost/App/user/index.php?page=dashboard"
              class="nav-link <?= $halaman == "dashboard" ? "active" : "" ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/kost/App/user/index.php?page=profile" class="nav-link <?= $halaman == "profile" ? "active" : "" ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')" class="nav-link">
              <i class="nav-icon fas fa-arrow-right"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      <?php } ?>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>