<div class="text-right mb-3">
  <button type="button" class="btn btn-warning shadow" data-toggle="modal" data-target="#exampleModal">
    Tambah Kamar
  </button>
</div>

<table class="table bg-white shadow rounded p-3">
  <thead>
    <tr class="bg-primary">
      <th scope="col" class="text-nowrap">No kamar</th>
      <th scope="col" class="text-nowrap">Tipe sewa</th>
      <th scope="col" class="text-nowrap">Harga</th>
      <th scope="col" class="text-nowrap">Foto</th>
      <th scope="col" class="text-nowrap">Deskripsi</th>
      <th scope="col" class="text-nowrap">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Koneksi ke database dan mengambil data kamar
    $query = mysqli_query($conn, "SELECT * FROM kamar ORDER BY id_kamar DESC");
    while ($data = mysqli_fetch_array($query)) {
      ?>
      <tr>
        <td><strong>#
            <?= $data['no_kamar'] ?>
          </strong></td>
        <td>
          <?= $data['tipe_sewa'] ?>
        </td>
        <td>Rp.
          <?= number_format($data['harga']) ?>
        </td>
        <td>
          <img src="<?= $data['foto'] ?>" alt="foto kamar <?= $data['no_kamar'] ?>" width="200" class="img-thumbnail">
        </td>
        <td>
          <?= $data['deskripsi'] ?>
        </td>
        <td>
          <a href="#" onclick="editMasuk('<?= $data['id_kamar'] ?>')" class="btn btn-success mr-2 btn-sm"><i
              class="fas fa-edit"></i></a>
          <a href="index.php?page=kamar-kost&hapus=<?= $data['id_kamar'] ?>"
            onclick="return confirm('Apakah Anda yakin ingin menghapus kamar <?= $data['no_kamar'] ?>')"
            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
        </td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table>

<!-- Modal Tambah -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Tambah kamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./function.php" method="post" enctype="multipart/form-data">
          <label for="nomor-kamar" class="font-weight-normal">Nomor Kamar</label>
          <input type="number" name="no_kamar" id="nomor-kamar" placeholder="Masukkan nomor kamar..."
            class="form-control" required>
          <label for="tipe-kamar" class="font-weight-normal mt-3">Tipe Sewa</label>
          <select name="tipe_sewa" id="tipe-kamar" class="form-control">
            <!-- <option value="harian">harian</option> -->
            <option value="bulanan">bulanan</option>
            <option value="tahunan">tahunan</option>
          </select>
          <label for="harga-kamar" class="font-weight-normal mt-3">Harga (Rp. )</label>
          <input type="number" name="harga" id="harga-kamar" placeholder="Masukkan harga kamar..." class="form-control"
            required>
          <label for="foto-kamar" class="font-weight-normal mt-3">Foto kamar</label>
          <input type="file" name="foto" id="foto-kamar" placeholder="Masukkan foto kamar..." class="w-100" required>
          <label for="deskripsi-kamar" class="font-weight-normal mt-3">Deskripsi kamar</label>
          <textarea name="deskripsi" id="deskripsi-kamar" placeholder="Masukkan deskripsi kamar"
            class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" name="tambahKamar" class="btn btn-warning">Tambahkan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Edit kamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id-kamar" required>
          <label for="nomor-kamar" class="font-weight-normal">Nomor Kamar</label>
          <input type="number" name="no_kamar" id="nomor-kamar-edit" placeholder="Masukkan nomor kamar..."
            class="form-control" required>
          <label for="tipe-kamar" class="font-weight-normal mt-3">Tipe Sewa</label>
          <select name="tipe_sewa" id="tipe-kamar-edit" class="form-control">
            <!-- <option value="harian">harian</option> -->
            <option value="bulanan">bulanan</option>
            <option value="tahunan">tahunan</option>
          </select>
          <label for="harga-kamar" class="font-weight-normal mt-3">Harga (Rp. )</label>
          <input type="number" name="harga" id="harga-kamar-edit" placeholder="Masukkan harga kamar..."
            class="form-control" required>
          <label for="foto-kamar" class="font-weight-normal mt-3">Foto kamar <small class="text-danger">*Kosongkan jika
              tidak ingin diubah</small></label>
          <input type="hidden" name="foto_lama" id="foto-lama-edit" required>
          <input type="file" name="foto_baru" id="foto-kamar" placeholder="Masukkan foto kamar..." class="w-100">
          <label for="deskripsi-kamar" class="font-weight-normal mt-3">Deskripsi kamar</label>
          <textarea name="deskripsi" id="deskripsi-kamar-edit" placeholder="Masukkan deskripsi kamar"
            class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" name="editKamar" class="btn btn-warning">Simpan perubahan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
// Jika ada permintaan hapus kamar
if (isset($_GET['hapus'])) {

  // Mengambil data kamar berdasarkan ID kamar
  $query = mysqli_query($conn, "SELECT * FROM kamar WHERE id_kamar='$_GET[hapus]'");
  $data = mysqli_fetch_array($query);

  // Menghapus foto kamar jika ada
  if ($data['foto'] !== "") {
    unlink($data['foto']);
  }

  // Menghapus data kamar dari database
  $delete = mysqli_query($conn, "DELETE FROM kamar WHERE id_kamar='$_GET[hapus]'");

  // Jika penghapusan berhasil
  if ($delete) {
    ?>
    <script>
      alert("Data berhasil dihapus");
      document.location = "index.php?page=kamar-kost"
    </script>
    <?php
  } else {
    ?>
    <!-- Jika penghapusan gagal -->
    <script>
      alert("Data gagal dihapus");
      document.location = "index.php?page=kamar-kost"
    </script>
    <?php
  }
}

// Jika ada permintaan edit kamar
if (isset($_POST['editKamar'])) {
  $id_kamar = $_POST['id'];
  $no_kamar = htmlspecialchars($_POST['no_kamar']);
  $tipe_sewa = htmlspecialchars($_POST['tipe_sewa']);
  $harga = htmlspecialchars($_POST['harga']);
  $foto = $_POST['foto_lama'];
  $deskripsi = $_POST['deskripsi'];
  $status = false;

  // Memeriksa apakah ada foto baru yang diunggah
  if (isset($_FILES['foto_baru']) && $_FILES['foto_baru']['error'] == UPLOAD_ERR_OK) {
    // Menghapus foto lama jika ada
    if (file_exists($foto)) {
      unlink($foto);
    }

    $targetFile = "../dist/img/kamar/" . basename($_FILES['foto_baru']['name']);

    // Memindahkan foto baru ke lokasi target
    if (move_uploaded_file($_FILES['foto_baru']['tmp_name'], $targetFile)) {
      $foto = "../dist/img/kamar/" . basename($_FILES['foto_baru']['name']);
    } else {
      $foto = $_POST['foto_lama'];
    }
  }

  // Mengupdate data kamar ke database
  $update = "UPDATE kamar SET no_kamar='$no_kamar', deskripsi='$deskripsi', tipe_sewa='$tipe_sewa', harga='$harga', foto='$foto' 
  WHERE id_kamar='$id_kamar'";
  $result = mysqli_query($conn, $update);

  // Jika update berhasil
  if ($result) {
    ?>
    <script>   alert("Perubahan berhasil disimpan");   document.location = "index.php?page=kamar-kost";
    </script>
    <?php
  } else {
    ?>
    <!-- Jika update berhasil -->
    <script>   alert("Perubahan gagal disimpan");
    </script>
    <?php
  }
}

?>