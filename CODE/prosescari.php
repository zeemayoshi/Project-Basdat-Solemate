<?php
session_start();
include 'konek.php'; // Koneksi ke database

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Redirect atau tampilkan pesan bahwa pengguna harus login terlebih dahulu
    header('Location: login.php');
    exit();
}

// Ambil informasi sesi
$user_id = $_SESSION['user_id'];
if (isset($_POST['cari'])) {
    $search_data = $_POST['search_data'];

    // Query pencarian
    $query = "SELECT * FROM sepatu WHERE sepatu_nama LIKE '%$search_data%'";
    $result = mysqli_query($koneksi, $query);

    // Mengumpulkan hasil pencarian ke dalam array
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $search_results[] = $row;
        }
    }
    
    // Simpan hasil pencarian ke dalam sesi atau cookie
    $_SESSION['search_results'] = $search_results;

    // Redirect kembali ke shoppage.php
    header('Location: shoppage.php');
    exit();
}

?>






