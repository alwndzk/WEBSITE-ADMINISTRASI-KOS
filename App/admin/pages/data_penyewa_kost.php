<?php
// Mengambil semua data user yang bukan admin dan mengurutkan berdasarkan id secara menurun
$sql = "SELECT * FROM user WHERE status !='admin' ORDER BY id DESC";
$query = mysqli_query($conn, $sql);
?>

<!-- Membuat tabel untuk menampilkan data user -->
<table class="table bg-light shadow rounded p-3">
  <thead>
    <tr class="bg-primary">
      <th scope="col" class="text-nowrap">ID User</th>
      <th scope="col" class="text-nowrap">Nama</th>
      <th scope="col" class="text-nowrap">Email</th>
      <th scope="col" class="text-nowrap">Foto</th>
      <th scope="col" class="text-nowrap">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <!-- Loop untuk menampilkan setiap data user dalam bentuk baris tabel -->
    <?php while ($data = mysqli_fetch_array($query)) {
      ?>
      <tr>
        <td><strong>#
            <?= $data['id'] ?>
          </strong></td>
        <td>
          <?= $data['nama'] ?>
        </td>
        <td>
          <?= $data['email'] ?>
        </td>
        <td>
          <!-- Menampilkan foto ktp user -->
          <img src=".<?= $data['foto'] ?>" alt="<?= $data['foto'] ?>" width="200" class="img-thumbnail">
        </td>
        <td>
          <!-- Membuat tombol yang mengarahkan ke tautan whatsapp -->
          <a href="https://wa.me/<?= $data['telp'] ?>" class="btn btn-sm btn-success">Hubungi
            <?= $data['nama'] ?>
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>