<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Redirect atau tampilkan pesan bahwa pengguna harus login terlebih dahulu
    header('Location: login.php');
    exit();
}

// Ambil informasi sesi
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
</head>
<body>
    <h1>Selamat Datang di Halaman Utama</h1>

    <!-- Tambahkan konten halaman utama di sini -->

    <a href="logout.php">Logout</a> <!-- Tautan logout -->
</body>
</html>
