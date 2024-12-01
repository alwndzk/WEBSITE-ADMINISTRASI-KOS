<?php
// Mengecek apakah parameter 'detail' ada di URL dan mengambil detail kamar sesuai dengan ID yang diberikan
if (isset($_GET['detail'])) {
    $query = mysqli_query($conn, "SELECT * FROM kamar WHERE id_kamar='$_GET[detail]'");
    $data = mysqli_fetch_array($query);
}
?>

<!-- Tombol untuk kembali ke halaman dashboard --> -->
<a href="index.php?page=dashboard" class="btn btn-secondary mb-3 px-4">Kembali</a>

<div class="row">
    <div class="col-md-6">
        <!-- Menampilkan foto kamar -->
        <img src="<?= $data['foto'] ?>" alt="<?= $data['foto'] ?>" class="w-100 img-thumbnail shadow">
    </div>
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-warning">
                Detail Kamar
            </div>
            <div class="card-body">
                <!-- Menampilkan ID kamar -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">ID kamar : </span>
                    </div>
                    <input type="text" class="form-control" value="<?= $data['id_kamar'] ?>" disabled>
                </div>
                <div class="input-group mb-3">
                    <!-- Menampilkan tipe sewa -->
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Tipe Sewa : </span>
                    </div>
                    <input type="text" class="form-control" value="<?= $data['tipe_sewa'] ?>" disabled>
                </div>
                <div class="input-group mb-3">
                    <!-- Menampilkan harga sewa -->
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Harga
                            <?= $data['tipe_sewa'] ?> :
                        </span>
                    </div>
                    <input type="text" class="form-control" value="Rp. <?= number_format($data['harga']) ?>" disabled>
                </div>
                <!-- Menampilkan deskripsi kamar -->
                <div class="text-secondary">Deskripsi</div>
                <p>
                    <?= $data['deskripsi'] ?>
                </p>
                <!-- Menampilkan teks batas waktu pembayaran -->
                <b>Batas waktu pembayaran yang harus dilakukan maksimal 2x24 jam</b>
            </div>
        </div>
        <div class="card shadow mt-2">
            <div class="card-header bg-success">
                Sewa Kamar
            </div>
            <div class="card-body">
                <!-- Formulir untuk menyewa kamar -->
                <form action="pages/konfir.php" method="post">
                    <input type="hidden" name="id_user" value="<?= $_SESSION['id'] ?>">
                    <input type="hidden" name="id_kamar" value="<?= $data['id_kamar'] ?>">
                    <input type="hidden" name="tipe_sewa" value="<?= $data['tipe_sewa'] ?>">
                    <input type="hidden" name="harga" value="<?= $data['harga'] ?>">
                    <?php
                    // Menentukan tipe sewa (bulan/tahun) berdasarkan tipe sewa kamar
                    if ($data['tipe_sewa'] == "bulanan") {
                        $tipe = "bulan";
                    } else {
                        $tipe = "tahun";
                    }
                    ?>
                    <div for="jumlah">Untuk berapa
                        <?= $tipe ?>
                    </div>
                    <input type="number" name="jumlah" id="jumlah" placeholder="Masukkan jumlah <?= $tipe ?>"
                        class="form-control" required>
                    <div for="jumlah" class="mt-3">Dari tanggal berapa</div>
                    <input type="date" name="tanggal_mulai" id="jumlah" placeholder="Masukkan jumlah <?= $tipe ?>"
                        class="form-control" required>
                    <button type="submit" name="sewa" class="btn btn-success btn-block mt-3">Sewa Kamar</button>
                </form>
            </div>
        </div>
    </div>
</div>