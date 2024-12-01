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


// Menambahkan data kamar ke database
if (isset($_POST['tambahKamar'])) {
    // Mengambil data dari form dan membersihkannya
    $no_kamar = htmlspecialchars($_POST['no_kamar']);
    $tipe_sewa = htmlspecialchars($_POST['tipe_sewa']);
    $harga = htmlspecialchars($_POST['harga']);
    $deskripsi = $_POST['deskripsi'];

    // Menentukan direktori penyimpanan foto
    $path_dir = "../dist/img/kamar/";

    $targetFile = $path_dir . basename($_FILES['foto']['name']);

    // Mengunggah foto dan menyimpan data kamar ke database
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {

        $insert = mysqli_query($conn, "INSERT INTO kamar (no_kamar, deskripsi, tipe_sewa, harga, foto) 
        VALUES ('$no_kamar','$deskripsi','$tipe_sewa','$harga','$targetFile')");

        // Menampilkan pesan berdasarkan hasil operasi
        if ($insert) {
            alert("Data berhasil ditambahkan", "index.php?page=kamar-kost");
        } else {
            alert("Data gagal ditambahkan", "index.php?page=kamar-kost");
        }

    } else {
        alert("Foto gagal diupload", "index.php?page=kamar-kost");
    }
}

// Memeriksa apakah form dengan tombol ubahProfile telah dikirim
if (isset($_POST['ubahProfile'])) {
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
        if (!empty($data['foto']) && file_exists("." . $data['foto'])) {
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
        alert("Data berhasil diubah", "index.php?page=profile-admin");
    } else {
        alert("Data gagal diubah", "index.php?page=profile-admin");
    }
}

// Mengekspor Data ke CSV
function exportToCSV($conn)
{
    $sekarang = date('d m Y');
    $filename = "data_sewa " . $sekarang . ".csv";
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen('php://output', 'w');

    // Menulis header kolom
    fputcsv($output, array(
        'ID User',
        'Nama',
        'ID Kamar',
        'Tanggal Mulai',
        'Tanggal Selesai',
        'Pembayaran',
        'Status Penyewaan',
        'Total Harga'
    ), ";");

    // Query untuk mengambil data dari tabel sewa
    $sql = "SELECT * FROM sewa ORDER BY id_sewa DESC";
    $query = mysqli_query($conn, $sql);

    while ($data = mysqli_fetch_array($query)) {
        // Mendapatkan data kamar
        $query_kamar = mysqli_query($conn, "SELECT * FROM kamar WHERE id_kamar='" . $data['id_kamar'] . "'");
        $data_kamar = mysqli_fetch_array($query_kamar);

        // Mendapatkan data user
        $query_user = mysqli_query($conn, "SELECT * FROM user WHERE id='" . $data['id_user'] . "'");
        $data_user = mysqli_fetch_array($query_user);

        // Menentukan status pembayaran
        $pembayaran = $data['status'] == "belum lunas" ? 'belum lunas' : 'lunas';

        // Menentukan status penyewaan
        $sekarang = new DateTime();
        $tanggal_selesai = new DateTime($data['tanggal_selesai']);
        $status_penyewaan = $sekarang <= $tanggal_selesai ? 'aktif' : 'keluar';

        $tanggal_selesai_format = $tanggal_selesai->format('Y-m-d');

        // Menentukan status penyewaan
        $tanggal_sewa = new DateTime($data['tanggal_sewa']);

        $tanggal_sewa_format = $tanggal_sewa->format('Y-m-d');

        // Menulis baris ke file CSV
        fputcsv($output, array(
            $data_user['id'],
            $data_user['nama'],
            $data_kamar['id_kamar'],
            $tanggal_sewa_format,
            $tanggal_selesai_format,
            $pembayaran,
            $status_penyewaan,
            $data['total_harga']
        ), ";");
    }

    fclose($output);
    exit();
}

if (isset($_POST['export_csv'])) {
    exportToCSV($conn);
}