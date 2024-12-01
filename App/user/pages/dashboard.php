<?php
// Mengambil data admin pertama dari tabel 'user'
$query = mysqli_query($conn, "SELECT * FROM user WHERE status='admin' LIMIT 1");
$data_admin = mysqli_fetch_array($query);

// Mengambil data tagihan yang belum lunas untuk pengguna saat ini
$query = mysqli_query($conn, "SELECT * FROM sewa WHERE id_user='$_SESSION[id]' AND status='belum lunas' ORDER BY id_sewa ASC");
$tagihan = mysqli_num_rows($query);
?>

<div class="row">
  <div class="col-md-4 col-sm-6 col-12">
    <!-- Menampilkan informasi jumlah tagihan yang belum lunas -->
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="fas fa-money-bill-wave"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Jumlah Tagihan</span>
        <span class="info-box-number">
          <?= number_format($tagihan) ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>

<hr>

<div class="d-flex">
  <!-- Navigasi untuk memilih tampilan antara tagihan dan kamar -->
  <a href="#" id="btn-tagihan" onclick="show('tagihan', 'kamar', 'btn-tagihan', 'btn-kamar')"
    class="nav-custom active">Tagihan</a>
  <a href="#" id="btn-kamar" class="nav-custom" onclick="show('kamar', 'tagihan', 'btn-kamar', 'btn-tagihan')">Kamar</a>
</div>
<div class="container mt-3">
  <div id="tagihan">
    <table class="table bg-white shadow rounded p-3">
      <thead>
        <tr class="bg-warning">
          <th scope="col" class="text-nowrap">ID Kamar</th>
          <th scope="col" class="text-nowrap">Tanggal Mulai</th>
          <th scope="col" class="text-nowrap">Tanggal Akhir</th>
          <th scope="col" class="text-nowrap">Total Harga</th>
          <th scope="col" class="text-nowrap">Status</th>
          <th scope="col" class="text-nowrap">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Menampilkan data tagihan dalam tabel
        while ($data = mysqli_fetch_array($query)) {
          ?>
          <tr>
            <td><strong>#
                <?= $data['id_kamar'] ?>
              </strong></td>
            <td>
              <?= $data['tanggal_sewa'] ?>
            </td>
            <td>
              <?= $data['tanggal_selesai'] ?>
            </td>
            <td>Rp.
              <?= number_format($data['total_harga']) ?>
            </td>
            <td>
              <?= $data['status'] ?>
            </td>
            <td>
              <?php
              // Menampilkan tombol untuk meng-upload bukti transfer jika belum ada bukti
              if ($data['bukti_tf'] == "") {
                ?>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                  data-target="#id-<?= $data['id_sewa'] ?>">
                  Upload bukti transfer
                </button>
                <?php
              } else {
                ?>
                <div class="text-info font-weight-bold">pending...</div>
                <?php
              }
              ?>
            </td>
          </tr>

          <!-- Modal untuk upload bukti transfer -->
          <div class="modal fade" id="id-<?= $data['id_sewa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-warning">
                  <h5 class="modal-title" id="exampleModalLabel">Bukti Transfer</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- Form untuk upload bukti transfer -->
                  <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_sewa" value="<?= $data['id_sewa'] ?>">
                    <div class="">Masukkan bukti transfer</div>
                    <input type="file" name="bukti_tf" id="" class="w-100" accept="images/*" required>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="kirim" class="btn btn-warning px-4">Kirim</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <!-- Menampilkan tabel kamar -->
  <div id="kamar" class="d-none">
    <table class="table bg-white shadow rounded p-3">
      <thead>
        <tr class="bg-warning">
          <th scope="col" class="text-nowrap">ID kamar</th>
          <th scope="col" class="text-nowrap">Tipe sewa</th>
          <th scope="col" class="text-nowrap">Harga</th>
          <th scope="col" class="text-nowrap">Foto</th>
          <th scope="col" class="text-nowrap">Deskripsi</th>
          <th scope="col" class="text-nowrap">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Mengambil data kamar yang belum disewa
        $sql = "SELECT kamar.id_kamar, kamar.tipe_sewa, kamar.harga, kamar.foto, kamar.deskripsi
                FROM kamar
                LEFT JOIN sewa ON kamar.id_kamar = sewa.id_kamar
                WHERE sewa.id_kamar IS NULL";
        $query = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_array($query)) {
          ?>
          <tr>
            <td><strong>#
                <?= $data['id_kamar'] ?>
              </strong></td>
            <td>
              <?= $data['tipe_sewa'] ?>
            </td>
            <td>Rp.
              <?= number_format($data['harga']) ?>
            </td>
            <td>
              <img src="<?= $data['foto'] ?>" alt="foto kamar" width="200" class="img-thumbnail">
            </td>
            <td>
              <?= $data['deskripsi'] ?>
            </td>
            <td>
              <!-- Menampilkan tombol untuk melihat detail kamar -->
              <a href="index.php?page=detail&detail=<?= $data['id_kamar'] ?>" class="btn btn-warning btn-sm"><i
                  class="fas fa-eye"></i></a>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
// Menangani upload bukti transfer
if (isset($_POST['kirim'])) {
  $id_sewa = $_POST['id_sewa'];
  $foto = $_FILES['bukti_tf'];

  $targetFile = "../dist/img/tf/" . basename($foto["name"]);
  // Meng-upload file bukti transfer
  if (move_uploaded_file($foto['tmp_name'], $targetFile)) {
    // Memperbarui data bukti transfer di tabel 'sewa'
    $update = mysqli_query($conn, "UPDATE sewa SET bukti_tf='$targetFile' WHERE id_sewa='$id_sewa'");

    if ($update) {
      ?>
      <script>
        alert("Bukti tf berhasil dikirim")
        document.location = "index.php?page=dashboard";
      </script>
      <?php
    } else {
      ?>
      <script>
        alert("Bukti tf gagal dikirim")
        document.location = "index.php?page=dashboard";
      </script>
      <?php
    }

  }
}