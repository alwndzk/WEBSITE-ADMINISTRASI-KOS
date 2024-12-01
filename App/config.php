<?php

session_start();
include "./koneksi.php";

function alert($msg, $page)
{
    ?>
    <script>
        alert("<?= $msg ?>")
        document.location = "<?= $page ?>"
    </script>
    <?php
}

function login($id, $status)
{
    $_SESSION['login'] = true;
    $_SESSION['id'] = $id;

    if ($status == "user") {
        header("Location: user/index.php?page=dashboard");
    } else {
        header("Location: admin/index.php?page=dashboard");
    }
}

if (isset($_POST['daftar'])) {
    // Mengambil data dari form pendaftaran dan membersihkannya dari karakter berbahaya
    $nama = htmlspecialchars($_POST['nama']);
    $telp = htmlspecialchars($_POST['telp']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);
    $foto = $_FILES['foto'];

    // Mengecek apakah email sudah terdaftar di database
    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");

    if (mysqli_num_rows($query)) {
        alert("Email sudah terdaftar", "daftar.php");
        return;
    }

    // Mengecek apakah password dan konfirmasi password sesuai
    if ($password !== $password2) {
        alert("Konfirmasi password tidak sesuai", "daftar.php");
        return;
    }

    // Menentukan status pengguna baru sebagai "user" dan mengatur path penyimpanan gambar
    $status = "user";
    $pathImage = "./dist/img/user";

    $targetFile = $pathImage . basename($foto["name"]);

    // Mengunggah file foto ke server
    if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
        // Meng-hash password untuk keamanan
        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        // Menyimpan data pengguna baru ke database
        $insert = mysqli_query($conn, "INSERT INTO user (nama, telp, email, status, foto, password) VALUES ('$nama','$telp','$email','$status','$targetFile','$hash_password')");

        // Menampilkan pesan berhasil atau gagal
        if ($insert) {
            alert("Berhasil terdaftar, silahkan login terlebih dahulu", "index.php");
        } else {
            alert("data gagal di unggah", "daftar.php");
        }
    } else {
        alert("Foto gagal di unggah", "daftar.php");
    }
}

if (isset($_POST['login'])) {
    // Mengambil data dari form login dan membersihkannya dari karakter berbahaya
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Mengecek apakah email ada di database
    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    $data = mysqli_fetch_array($query);

    // Jika email ditemukan, verifikasi password
    if (mysqli_num_rows($query) > 0) {
        if (password_verify($password, $data['password'])) {
            // Jika password benar, login pengguna dan arahkan ke halaman dashboard
            login($data['id'], $data['status']);
        } else {
            alert("Email atau password tidak valid", "index.php");
        }
    } else {
        alert("Email atau password tidak valid", "index.php");
    }
}