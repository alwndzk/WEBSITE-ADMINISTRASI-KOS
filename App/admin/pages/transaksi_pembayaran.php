<?php
// Menampilkan data penyewaan berdasarkan id_sewa
$sql = "SELECT * FROM sewa ORDER BY id_sewa DESC";
$query = mysqli_query($conn, $sql);
?>

<table class="table bg-light shadow rounded p-3">
  <thead>
    <tr class="bg-primary">
      <th scope="col" class="text-nowrap">ID User</th>
      <th scope="col" class="text-nowrap">Nama</th>
      <th scope="col" class="text-nowrap">ID Kamar</th>
      <th scope="col" class="text-nowrap">Konfirmasi</th>
      <th scope="col" class="text-nowrap">Status</th>
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
          <?php
          // Menampilkan status konfirmasi berdasarkan nilai status dan bukti_tf
          if ($data['status'] == "belum lunas" && $data['bukti_tf'] !== "") {
            ?>
            <div class="font-weight-bold text-info">Belum dikonfirmasi</div>
            <?php
          } else if ($data['status'] == "lunas" && $data['bukti_tf'] !== "") {
            ?>
              <div class="font-weight-bold text-success">dikonfirmasi</div>
            <?php
          }
          ?>
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
          <button type="button" data-toggle="modal" data-target="#id-<?= $data['id_sewa'] ?>" class="btn btn-warning"><i
              class="fas fa-eye"></i></button>
        </td>
      </tr>

      <!-- Modal Detail -->
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
            <!-- Menampilkan foto ktp user, detail sewa, bukti transfer, dan total bayar jika status sudah lunas. -->
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
                      <hr>
                      <div class="font-weight-semibold mt-3">Bukti Transfer</div>
                      <img src="<?= $data['bukti_tf'] ?>" alt="<?= $data['bukti_tf'] ?>" width="250">
                      <?php
                      if ($data['status'] == "lunas") {
                        ?>
                        <hr>
                        <div class="font-weight-semibold">Detail Bayar</div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Total Bayar</span>
                          </div>
                          <input type="text" class="form-control" name="telp"
                            value="Rp. <?= number_format($data['total_bayar']) ?>" aria-label="Username"
                            aria-describedby="basic-addon1" disabled required>
                        </div>
                        <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <?php
              if ($data['status'] == "belum lunas") {
                ?>
                <button type="button" data-toggle="modal" data-target="#bayar-<?= $data['id_sewa'] ?>"
                  class="btn btn-warning px-4">Tandai sudah lunas</button>
                <?php
              } else {
                ?>
                <a href="index.php?page=transaksi&hapus=<?= $data['id_sewa'] ?>"
                  onclick="return confirm('Dengan menekan tombol ini penyewaa sudah lunas dan data ini akan dihapus, tetap lanjutkan?')"
                  class="btn btn-danger px-4">Batal</a>
                <?php
              }
              ?>
              <!-- Menghubungi penyewa atau pengguna melalui whatsapp -->
              <a href="https://wa.me/<?= $data_user['telp'] ?>" target="_blank" class="btn btn-success px-4">Hubungi
                <?= $data_user['nama'] ?>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Konfirmasi Pembayaran -->
      <!-- Admin melakukan konfirmasi pembayaran -->
      <div class="modal fade" id="bayar-<?= $data['id_sewa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h5 class="modal-title" id="exampleModalLabel">Bayar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <input type="hidden" name="id_sewa" value="<?= $data['id_sewa'] ?>">
                <input type="hidden" name="total_harga" value="<?= $data['total_harga'] ?>">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Total Harga</span>
                  </div>
                  <input type="text" class="form-control" name="nama"
                    value="Rp. <?= number_format($data['total_harga']) ?>" aria-label="Username"
                    aria-describedby="basic-addon1" disabled required>
                </div>
                <div class="">Jumlah bayar</div>
                <input type="number" name="jumlah_bayar" id="" placeholder="Masukkan jumlah bayar"
                  min="<?= $data['total_harga'] ?>" class="form-control" required>
            </div>
            <div class="modal-footer">
              <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>


    <?php } ?>
  </tbody>
</table>

<?php
// Memeriksa apakah form submit telah di-submit
if (isset($_POST['simpan'])) {
  // Mengambil data dari form
  $id_sewa = $_POST['id_sewa'];
  $jumlah_bayar = htmlspecialchars($_POST['jumlah_bayar']);
  $total_harga = $_POST['total_harga'];
  $kembalian = $jumlah_bayar - $total_harga;

  // Mengupdate data penyewaan dalam database
  $inesrt = mysqli_query($conn, "UPDATE sewa SET total_bayar='$jumlah_bayar', kembalian='$kembalian', status='lunas' 
  WHERE id_sewa='$id_sewa'");

  // Menampilkan pesan sukses atau gagal
  if ($inesrt) {
    ?>
    <script>
      alert("Berhasil disimpan!") //jika berhasil disimpan
      document.location = "index.php?page=transaksi";
    </script>
    <?php
  } else {
    ?>
    <script>
      alert("Gagal disimpan!") //jika gagal
      document.location = "index.php?page=transaksi";
    </script>
    <?php
  }
}

// Memeriksa apakah ada permintaan untuk menghapus data
if (isset($_GET['hapus'])) {
  // Mengambil data penyewaan dari database
  $query = mysqli_query($conn, "SELECT * FROM sewa WHERE id_sewa='$_GET[hapus]'");
  $data = mysqli_fetch_array($query);

  // Menghapus file bukti transfer jika ada
  if (!empty($data['bukti_tf']) && file_exists($data['bukti_tf'])) {
    unlink($data['bukti_tf']);
  }

  // Menghapus data penyewaan dari database
  $delete = mysqli_query($conn, "DELETE FROM sewa WHERE id_sewa='$_GET[hapus]'");
  // Menampilkan pesan sukses atau gagal
  if ($delete) {
    ?>
    <script>
      alert("Berhasil dihapus") //Jika berhasil dihapus
      document.location = "index.php?page=transaksi";
    </script>
    <?php
  } else {
    ?>
    <script>
      alert("Gagal dihapus") //Jika gagal dihapus
      document.location = "index.php?page=transaksi";
    </script>
    <?php
  }
}