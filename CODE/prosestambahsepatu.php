<?php
session_start();
include 'konek.php';
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}
if (isset($_POST['tambah'])){
// Ambil data dari formulir
$sepatu_nama = $_POST['sepatu_nama'];
$sepatu_ukuran = $_POST['sepatu_ukuran'];
$sepatu_stok = $_POST['sepatu_stok'];
$sepatu_harga = $_POST['sepatu_harga'];
$sepatu_deskripsi = $_POST['sepatu_deskripsi'];
$sepatu_kategori = $_POST['kategori_sepatu'];
// Proses upload gambar
$gambar_tmp = $_FILES['sepatu_gambar']['tmp_name'];
$gambar_nama = $_FILES['sepatu_gambar']['name'];
move_uploaded_file($gambar_tmp,"../gambar/".$gambar_nama); // Sesuaikan dengan folder penyimpanan gambar

// Masukkan data ke dalam tabel Sepatu
$query_tambah_sepatu = "INSERT INTO sepatu (sepatu_nama, sepatu_ukuran, sepatu_stok, sepatu_harga, sepatu_gambar, sepatu_deskripsi,kategori_sepatu,sepatu_penjual_id) 
                       VALUES ('$sepatu_nama', '$sepatu_ukuran', $sepatu_stok, $sepatu_harga, '$gambar_nama', '$sepatu_deskripsi','$sepatu_kategori','$user_id')";
mysqli_query($koneksi, $query_tambah_sepatu);

if( $query_tambah_sepatu ==TRUE ) {
    // kalau berhasil alihkan ke halaman index.php dengan status=sukses
    header('Location: shoppage.php?status=sukses menambahkan sepatu');
} else {
    // kalau gagal alihkan ke halaman indek.ph dengan status=gagal
    header('Location: shoppage.php?status=gagal menambahkan sepatu');
}
}
?>