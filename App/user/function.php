<?php
// Koneksi ke database
include "../koneksi.php";

// Membuat fungsi alert untuk menampilkan pesan
function alert($msg, $page)
{
    ?>
    <script>
        alert("<?= $msg ?>")
        document.location = "<?= $page ?>"
    </script>
    <?php
}

// Memeriksa apakah form dengan tombol ubahProfile telah dikirim
if (isset($_POST['ubahProfile'])) {
    // Mengambil data dari form dan mengamankannya dengan htmlspecialchars
    $id = htmlspecialchars($_POST['id']);
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $email = htmlspecialchars($_POST['email']);
    $telp = htmlspecialchars($_POST['telp']);
    $status = false;

    // Memeriksa apakah email baru sudah terdaftar di database
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
    $data = mysqli_fetch_array($query);

    if ($data['email'] !== $email) {
        $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");

        // Menampilkan pesan error jika email sudah terdaftar dan menghentikan eksekusi lebih lanjut
        if (mysqli_num_rows($query)) {
            alert("Email sudah terdaftar", "index.php?page=profile-admin");
            return;
        }
    }

    // Mengunggah foto baru jika ada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {

        $foto = $_FILES['foto'];

        // Menghapus foto lama dari server jika ada
        if (!empty("." . $data['foto'])) {
            unlink("." . $data['foto']);
        }

        // Mengunggah foto baru ke server dan memperbarui informasi foto di database
        $targetFile = "../dist/img/user/" . basename($foto["name"]);
        if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
            $new_foto = "./dist/img/user/" . basename($foto["name"]);
            $update = mysqli_query($conn, "UPDATE user SET nama='$nama', email='$email', telp='$telp', foto='$new_foto' WHERE id='$id'");
            if ($update) {
                $status = true;
            }
        }
    } else {
        // Memperbarui data pengguna di database tanpa mengubah informasi foto jika tidak ada foto baru yang diunggah
        $update = mysqli_query($conn, "UPDATE user SET nama='$nama', email='$email', telp='$telp' WHERE id='$id'");

        if ($update) {
            $status = true;
        }
    }

    // Menampilkan pesan hasil pembaruan kepada pengguna
    if ($status) {
        alert("Data berhasil diubah", "index.php?page=profile");
    } else {
        alert("Data gagal diubah", "index.php?page=profile");
    }
}
