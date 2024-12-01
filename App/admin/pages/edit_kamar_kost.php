<?php
// Menyertakan file koneksi ke database
include "../../koneksi.php";

// Memeriksa apakah parameter id_kamar ada dalam URL
if (isset($_GET['id_kamar'])) {
    // Menyimpan nilai id_kamar dari URL ke dalam variabel $id
    $id = $_GET['id_kamar'];

    // Menjalankan query SQL untuk mengambil data kamar berdasarkan id_kamar
    $query = mysqli_query($conn, "SELECT * FROM kamar WHERE id_kamar='$id'");
    // Mengambil hasil query dalam bentuk array asosiatif
    $data = mysqli_fetch_array($query);

    // Mengembalikan data dalam format JSON jika ditemukan, atau JSON kosong jika tidak ditemukan
    if ($data) {
        echo json_encode($data); // Mengubah array asosiatif $data menjadi format JSON dan mengirimkannya sebagai respons
    } else {
        echo json_encode([]); // Mengirimkan respons JSON kosong jika tidak ada data yang ditemukan
    }
}