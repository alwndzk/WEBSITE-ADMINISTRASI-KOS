<div class="row">
  <div class="col-md-4">
    <!-- Card untuk menampilkan foto dan informasi profile admin -->
    <div class="card shadow w-100">
      <div class="card-header bg-primary">
        <!-- Judul header card -->
        <div class="font-weight-bold">Profile Admin</div>
      </div>
      <div class="card-body bg-white">
        <!-- Menampilkan foto profile admin -->
        <div class="text-center w-100">
          <img src=".<?= $data['foto'] ?>" alt="<?= $data['foto'] ?>" width="200px" height="200px"
            class="img-thumbnail">
        </div>
        <!-- Menampilkan role admin -->
        <div class="input-group mt-3">
          <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold" id="basic-addon1">Role</span>
          </div>
          <input type="text" class="form-control" value="<?= $data['status'] ?>" disabled>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <!-- Card untuk menampilkan data admin dan form edit -->
    <div class="card bg-white shadow">
      <div class="card-header bg-primary">
        <!-- Judul header card -->
        <div class="font-weight-bold">Data Admin</div>
      </div>
      <div class="card-body">
        <!-- Form untuk mengedit data admin -->
        <form action="./function.php" method="post" enctype="multipart/form-data">
          <!-- Input hidden untuk menyimpan ID admin -->
          <input type="hidden" name="id" value="<?= $data['id'] ?>" id="" required>
          <!-- Input untuk nama admin -->
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Nama</span>
            </div>
            <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" aria-label="Username"
              aria-describedby="basic-addon1" required>
          </div>
          <!-- Input untuk email admin -->
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Email</span>
            </div>
            <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>" aria-label="Username"
              aria-describedby="basic-addon1" required>
          </div>
          <!-- Input untuk nomor telepon admin -->
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Nomor Telepon</span>
            </div>
            <input type="text" class="form-control" name="telp" value="<?= $data['telp'] ?>" aria-label="Username"
              aria-describedby="basic-addon1" required>
          </div>
          <!-- Input untuk foto admin -->
          <div class="input-group mb-3">
            <div class="">Foto</div>
            <input type="file" name="foto" class="w-100" accept="images/*">
            <small for="foto" class="text-danger">*Kosongkan jika Anda tidak ingin mengganti foto profile Anda</small>
          </div>
          <hr>
          <!-- Tombol untuk menyimpan perubahan -->
          <div class="text-right">
            <button type="submit" name="ubahProfile" class="btn btn-primary">Simpan perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>