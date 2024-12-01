<div class="row">
  <div class="col-md-4">
    <div class="card shadow w-100">
      <div class="card-header bg-warning">
        <div class="font-weight-bold">Profile User</div>
      </div>
      <div class="card-body bg-white">
        <div class="text-center w-100">
          <img src=".<?= $data['foto'] ?>" alt="<?= $data['foto'] ?>" width="300px" height="300px"
            class="img-thumbnail">
        </div>
        <div class="input-group mt-3">
          <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold" id="basic-addon1">Role</span>
          </div>
          <!-- Menampilkan peran atau status pengguna dalam input yang tidak dapat diedit  -->
          <input type="text" class="form-control" value="<?= $data['status'] ?>" disabled>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <!-- Menampilkan card data user -->
    <div class="card bg-white shadow">
      <div class="card-header bg-warning">
        <div class="font-weight-bold">Data User</div>
      </div>
      <div class="card-body">
        <form action="./function.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $data['id'] ?>" id="" required>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Nama</span>
            </div>
            <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" aria-label="Username"
              aria-describedby="basic-addon1" required>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Email</span>
            </div>
            <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>" aria-label="Username"
              aria-describedby="basic-addon1" required>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Nomor Telepon</span>
            </div>
            <input type="text" class="form-control" name="telp" value="<?= $data['telp'] ?>" aria-label="Username"
              aria-describedby="basic-addon1" required>
          </div>
          <div class="input-group mb-3">
            <div class="">Foto</div>
            <input type="file" name="foto" class="w-100" accept="images/*">
            <small for="foto" class="text-danger">*Kosongkan jika Anda tidak ingin mengganti foto Anda</small>
          </div>
          <hr>
          <div class="text-right">
            <button type="submit" name="ubahProfile" class="btn btn-primary">Simpan perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>