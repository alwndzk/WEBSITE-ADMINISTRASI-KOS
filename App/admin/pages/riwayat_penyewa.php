<?php
// Mengambil data sewa berdasarkan id_sewa
$sql = "SELECT * FROM sewa ORDER BY id_sewa DESC";
$query = mysqli_query($conn, $sql);
?>

<!-- Tabel riwayat penyewa -->
<table class="table bg-light shadow rounded p-3">
  <thead>
    <tr class="bg-primary">
      <th scope="col" class="text-nowrap">ID User</th>
      <th scope="col" class="text-nowrap">Nama</th>
      <th scope="col" class="text-nowrap">ID Kamar</th>
      <th scope="col" class="text-nowrap">Tanggal Selesai</th>
      <th scope="col" class="text-nowrap">Pembayaran</th>
      <th scope="col" class="text-nowrap">Status Penyewaan</th>
      <th scope="col" class="text-nowrap">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($data = mysqli_fetch_array($query)) {
      // Mengambil data kamar berdasarkan id_kamar
      $query_kamar = mysqli_query($conn, "SELECT * FROM kamar WHERE id_kamar='$data[id_kamar]'");
      $data_kamar = mysqli_fetch_array($query_kamar);
      // Mengambil data user berdasarkan id_user
      $query_user = mysqli_query($conn, "SELECT * FROM user WHERE id='$data[id_user]'");
      $data_user = mysqli_fetch_array($query_user);
      ?>
      <tr>
        <td><strong>#
            <?= $data_user['id'] ?>
          </strong></td>
        <td>
          <?= $data_user['nama'] ?>
        </td>
        <td>
          <?= $data_kamar['id_kamar'] ?>
        </td>
        <td>
          <?= $data['tanggal_selesai'] ?>
        </td>
        <td>
          <?php
          // Menampilkan status pembayaran berdasarkan nilai status
          if ($data['status'] == "belum lunas") {
            ?> <span class="text-danger font-weight-bold">belum lunas</span>
            <?php
          } else {
            ?> <span class="text-success font-weight-bold">lunas</span>
            <?php
          }
          ?>
        </td>
        <td>
          <?php
          // Menampilkan status penyewaan berdasarkan tanggal selesai
          $sekarang = new DateTime();
          $tanggal_selesai = new DateTime($data['tanggal_selesai']);
          if ($sekarang <= $tanggal_selesai) {
            echo '<span class="text-success font-weight-bold">aktif</span>';
          } else {
            echo '<span class="text-danger font-weight-bold">keluar</span>';
          }
          ?>
        </td>
        <td>
          <!-- Tombol Aksi -->
          <button type="button" data-toggle="modal" data-target="#id-<?= $data['id_sewa'] ?>"
            class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></button>
          <a href="index.php?page=riwayat-penyewa&hapus=<?= $data['id_sewa'] ?>" class="btn btn-danger btn-sm"
            onclick="return confirm('Apakah Anda yakin ingin menghapus?')">hapus</a>
        </td>
      </tr>

      <!-- Modal -->
      <!-- Menyediakan detail lebih lanjut tentang penyewaan dan user dalam bentuk modal -->
      <div class="modal fade" id="id-<?= $data['id_sewa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body bg-white">
              <div class="card bg-white shadow">
                <div class="card-header bg-warning">
                  <div class="font-weight-bold">Detail</div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="text-center w-100">
                        <img src=".<?= $data_user['foto'] ?>" alt="<?= $data_user['foto'] ?>" width="350px" height="350px"
                          class="img-thumbnail">
                      </div>
                      <div class="input-group mt-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text font-weight-bold" id="basic-addon1">Role</span>
                        </div>
                        <input type="text" class="form-control" value="<?= $data_user['status'] ?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="font-weight-semibold">Detail User</div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Nama</span>
                        </div>
                        <input type="text" class="form-control" name="nama" value="<?= $data_user['nama'] ?>"
                          aria-label="Username" aria-describedby="basic-addon1" disabled required>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Email</span>
                        </div>
                        <input type="email" class="form-control" name="email" value="<?= $data_user['email'] ?>"
                          aria-label="Username" aria-describedby="basic-addon1" disabled required>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Nomor Telepon</span>
                        </div>
                        <input type="text" class="form-control" name="telp" value="<?= $data_user['telp'] ?>"
                          aria-label="Username" aria-describedby="basic-addon1" disabled required>
                      </div>
                      <hr>
                      <div class="font-weight-semibold">Detail Sewa</div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Total Awal Sewa</span>
                        </div>
                        <input type="text" class="form-control" name="telp" value="Rp. <?= $data['tanggal_sewa'] ?>"
                          aria-label="Username" aria-describedby="basic-addon1" disabled required>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Tanggal Akhir Sewa</span>
                        </div>
                        <input type="text" class="form-control" name="telp" value="Rp. <?= $data['tanggal_selesai'] ?>"
                          aria-label="Username" aria-describedby="basic-addon1" disabled required>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Total Harga Sewa</span>
                        </div>
                        <input type="text" class="form-control" name="telp"
                          value="Rp. <?= number_format($data['total_harga']) ?>" aria-label="Username"
                          aria-describedby="basic-addon1" disabled required>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Status</span>
                        </div>
                        <input type="text" class="form-control" name="telp" value="<?= $data['status'] ?>"
                          aria-label="Username" aria-describedby="basic-addon1" disabled required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>
  </tbody>
</table>

<div class="text-right mt-3">
  <!-- button untuk mengekspor ke CSV -->
  <form action="./function.php" method="post">
    <button type="submit" name="export_csv" class="btn btn-primary">Cetak ke dalam file CSV</button>
  </form>
</div>

<?php
// Mengecek apakah parameter 'hapus' ada di URL
if (isset($_GET['hapus'])) {
  $query = mysqli_query($conn, "SELECT * FROM sewa WHERE id_sewa='$_GET[hapus]'");
  $data = mysqli_fetch_array($query);

  // Menghapus file bukti transfer jika ada
  if ($data['bukti_tf'] !== "") {
    unlink($data['bukti_tf']);
  }

  // Menghapus data dari tabel sewa
  $delete = mysqli_query($conn, "DELETE FROM sewa WHERE id_sewa='$_GET[hapus]'");

  // Menampilkan notifikasi dan mengarahkan ulang ke halaman riwayat penyewa
  if ($delete) {
    ?>
    <script>
      alert("Data berhasil dihapus"); //jika berhasil
      document.location = "index.php?page=riwayat-penyewa"
    </script>
    <?php
  } else {
    ?>
    <script>
      alert("Data gagal dihapus"); //jika gagal
      document.location = "index.php?page=riwayat-penyewa"
    </script>
    <?php
  }
}